<?php
require_once 'includes/header.php';

// Handle Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    
    // Attempt to delete physical file if it was uploaded
    $stmt = $pdo->prepare("SELECT image_url FROM home_slider WHERE id = ?");
    $stmt->execute([$id]);
    $item = $stmt->fetch();
    if ($item && strpos($item['image_url'], 'http') !== 0) {
        $path = __DIR__ . '/../' . $item['image_url'];
        if (file_exists($path)) {
            unlink($path);
        }
    }

    $pdo->prepare("DELETE FROM home_slider WHERE id = ?")->execute([$id]);
    $_SESSION['success'] = "Slide deleted.";
    header("Location: manage_slider.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title_hi = $_POST['title_hi'];
    $title_en = $_POST['title_en'];
    $subtitle_hi = $_POST['subtitle_hi'];
    $subtitle_en = $_POST['subtitle_en'];
    $button_link = ltrim($_POST['button_link'] ?? '', '/');
    $order = (int)$_POST['display_order'];
    $url = '';

    // Handle Image Upload
    if (isset($_FILES['image_upload']) && $_FILES['image_upload']['error'] == UPLOAD_ERR_OK) {
        $ext = strtolower(pathinfo($_FILES['image_upload']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png','gif','webp'];
        if (in_array($ext, $allowed)) {
            $filename = uniqid('slider_') . '.' . $ext;
            $target = "../uploads/" . $filename;
            if (move_uploaded_file($_FILES['image_upload']['tmp_name'], __DIR__ . '/' . $target)) {
                $url = 'uploads/' . $filename;
            }
        } else {
            $_SESSION['error'] = "Invalid image format.";
        }
    } elseif (!empty($_POST['image_url'])) {
        $url = $_POST['image_url'];
    }

    if (!empty($url)) {
        if (!isset($_SESSION['error'])) {
            $stmt = $pdo->prepare("INSERT INTO home_slider (image_url, title_hi, title_en, subtitle_hi, subtitle_en, button_link, display_order) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$url, $title_hi, $title_en, $subtitle_hi, $subtitle_en, $button_link, $order]);
            $_SESSION['success'] = "Slide added.";
        }
    } else {
        if (!isset($_SESSION['error'])) $_SESSION['error'] = "Please provide an image.";
    }

    header("Location: manage_slider.php");
    exit;
}

$items = $pdo->query("SELECT * FROM home_slider ORDER BY display_order ASC")->fetchAll();
?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-blue">Manage Home Slider</h2>
    </div>

    <div class="row">
        <!-- Form -->
        <div class="col-md-5">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0 text-orange">Add New Slide</h5>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        
                        <div class="mb-3">
                            <label>Upload Image</label>
                            <input type="file" class="form-control" name="image_upload" accept="image/*">
                        </div>
                        <div class="text-center mb-2"><strong>OR</strong></div>
                        <div class="mb-3">
                            <label>Image Direct URL</label>
                            <input type="url" class="form-control" name="image_url" placeholder="https://example.com/image.jpg">
                        </div>

                        <ul class="nav nav-tabs mb-3" id="langTabs" role="tablist">
                            <li class="nav-item" role="presentation"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#hi" type="button">Hindi</button></li>
                            <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#en" type="button">English</button></li>
                        </ul>
                        <div class="tab-content" id="langTabsContent">
                            <div class="tab-pane fade show active" id="hi" role="tabpanel">
                                <div class="mb-3"><label>Title</label><input type="text" class="form-control" name="title_hi"></div>
                                <div class="mb-3"><label>Subtitle (Optional)</label><input type="text" class="form-control" name="subtitle_hi"></div>
                            </div>
                            <div class="tab-pane fade" id="en" role="tabpanel">
                                <div class="mb-3"><label>Title</label><input type="text" class="form-control" name="title_en"></div>
                                <div class="mb-3"><label>Subtitle (Optional)</label><input type="text" class="form-control" name="subtitle_en"></div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Button Link (Optional)</label>
                            <div class="input-group">
                                <span class="input-group-text">/</span>
                                <input type="text" class="form-control" name="button_link" placeholder="about.php">
                            </div>
                            <small class="text-muted">Will show "Learn More" / "और जानें" button on slide.</small>
                        </div>

                        <div class="mb-3">
                            <label>Display Order</label>
                            <input type="number" class="form-control" name="display_order" value="0">
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mt-2" style="background:#003893">Add Slide</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- List -->
        <div class="col-md-7">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white">
                    <h5 class="mb-0 text-blue">Current Slides</h5>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Image</th>
                                <th>Title (EN)</th>
                                <th>Order</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($items as $item): ?>
                                <tr>
                                    <td>
                                        <img src="<?= htmlspecialchars((strpos($item['image_url'], 'http') === 0) ? $item['image_url'] : '../'.$item['image_url']) ?>" style="width: 100px; height: 50px; object-fit: cover; border-radius:4px;">
                                    </td>
                                    <td><?= htmlspecialchars($item['title_en']) ?></td>
                                    <td><?= $item['display_order'] ?></td>
                                    <td>
                                        <a href="?delete=<?= $item['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this slide?');"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if(empty($items)) echo "<tr><td colspan='4' class='text-center py-3'>No slides found.</td></tr>"; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
