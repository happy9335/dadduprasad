<?php
require_once 'includes/header.php';

// Handle Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    
    $stmt = $pdo->prepare("SELECT image_url FROM press_releases WHERE id = ?");
    $stmt->execute([$id]);
    $item = $stmt->fetch();
    if ($item && !empty($item['image_url']) && strpos($item['image_url'], 'http') !== 0) {
        $path = __DIR__ . '/../' . $item['image_url'];
        if (file_exists($path)) {
            unlink($path);
        }
    }

    $pdo->prepare("DELETE FROM press_releases WHERE id = ?")->execute([$id]);
    $_SESSION['success'] = "Press Release deleted.";
    header("Location: manage_press.php");
    exit;
}

// Handle Add/Edit
$editItem = null;
if (isset($_GET['edit'])) {
    $editItem = $pdo->prepare("SELECT * FROM press_releases WHERE id = ?");
    $editItem->execute([(int)$_GET['edit']]);
    $editItem = $editItem->fetch();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date = $_POST['release_date'];
    $loc_hi = $_POST['location_hi'];
    $loc_en = $_POST['location_en'];
    $title_hi = $_POST['title_hi'];
    $title_en = $_POST['title_en'];
    $content_hi = $_POST['content_hi'];
    $content_en = $_POST['content_en'];
    $url = $editItem ? $editItem['image_url'] : '';

    // Handle Image Upload
    if (isset($_FILES['image_upload']) && $_FILES['image_upload']['error'] == UPLOAD_ERR_OK) {
        $ext = strtolower(pathinfo($_FILES['image_upload']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png','gif','webp'];
        if (in_array($ext, $allowed)) {
            $filename = uniqid('press_') . '.' . $ext;
            $target = "../uploads/" . $filename;
            if (move_uploaded_file($_FILES['image_upload']['tmp_name'], __DIR__ . '/' . $target)) {
                $url = 'uploads/' . $filename;
            }
        } else {
            $_SESSION['error'] = "Invalid image format.";
        }
    } elseif (!empty($_POST['image_url_direct'])) {
        $url = $_POST['image_url_direct'];
    }
    
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $stmt = $pdo->prepare("UPDATE press_releases SET release_date=?, image_url=?, location_hi=?, location_en=?, title_hi=?, title_en=?, content_hi=?, content_en=? WHERE id=?");
        $stmt->execute([$date, $url, $loc_hi, $loc_en, $title_hi, $title_en, $content_hi, $content_en, $_POST['id']]);
        $_SESSION['success'] = "Press Release updated.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO press_releases (release_date, image_url, location_hi, location_en, title_hi, title_en, content_hi, content_en) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$date, $url, $loc_hi, $loc_en, $title_hi, $title_en, $content_hi, $content_en]);
        $_SESSION['success'] = "Press Release added.";
    }
    header("Location: manage_press.php");
    exit;
}

$items = $pdo->query("SELECT * FROM press_releases ORDER BY release_date DESC")->fetchAll();
?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-blue">Manage Press Releases</h2>
        <?php if($editItem): ?>
            <a href="manage_press.php" class="btn btn-secondary">Cancel Edit & Add New</a>
        <?php endif; ?>
    </div>

    <div class="row">
        <!-- Form -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0 text-orange"><?= $editItem ? 'Edit Press Release' : 'Add New Press Release' ?></h5>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <?php if($editItem): ?><input type="hidden" name="id" value="<?= $editItem['id'] ?>"><?php endif; ?>
                        
                        <div class="mb-3">
                            <label>Release Date</label>
                            <input type="date" class="form-control" name="release_date" value="<?= $editItem['release_date'] ?? date('Y-m-d') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label>Upload Image (Optional)</label>
                            <input type="file" class="form-control" name="image_upload" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label>Or Image Direct URL (Optional)</label>
                            <input type="url" class="form-control" name="image_url_direct" value="<?= htmlspecialchars((!empty($editItem['image_url']) && strpos($editItem['image_url'], 'http') === 0) ? $editItem['image_url'] : '') ?>" placeholder="https://example.com/image.jpg">
                        </div>

                        <ul class="nav nav-tabs mb-3" id="langTabs" role="tablist">
                            <li class="nav-item" role="presentation"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#hi" type="button">Hindi</button></li>
                            <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#en" type="button">English</button></li>
                        </ul>
                        <div class="tab-content" id="langTabsContent">
                            <div class="tab-pane fade show active" id="hi" role="tabpanel">
                                <div class="mb-3"><label>Location</label><input type="text" class="form-control" name="location_hi" value="<?= htmlspecialchars($editItem['location_hi'] ?? '') ?>" required></div>
                                <div class="mb-3"><label>Title</label><input type="text" class="form-control" name="title_hi" value="<?= htmlspecialchars($editItem['title_hi'] ?? '') ?>" required></div>
                                <div class="mb-3"><label>Content Breakdown</label><textarea class="form-control" name="content_hi" rows="6" required><?= htmlspecialchars($editItem['content_hi'] ?? '') ?></textarea></div>
                            </div>
                            <div class="tab-pane fade" id="en" role="tabpanel">
                                <div class="mb-3"><label>Location</label><input type="text" class="form-control" name="location_en" value="<?= htmlspecialchars($editItem['location_en'] ?? '') ?>" required></div>
                                <div class="mb-3"><label>Title</label><input type="text" class="form-control" name="title_en" value="<?= htmlspecialchars($editItem['title_en'] ?? '') ?>" required></div>
                                <div class="mb-3"><label>Content Breakdown</label><textarea class="form-control" name="content_en" rows="6" required><?= htmlspecialchars($editItem['content_en'] ?? '') ?></textarea></div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mt-2" style="background:#003893">Save Press Release</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- List -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white">
                    <h5 class="mb-0 text-blue">Press Releases</h5>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Date</th>
                                <th>Image</th>
                                <th>Title (EN)</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($items as $item): ?>
                                <tr>
                                    <td style="white-space:nowrap;"><?= date('d M Y', strtotime($item['release_date'])) ?></td>
                                    <td>
                                        <?php if(!empty($item['image_url'])): ?>
                                            <img src="<?= htmlspecialchars((strpos($item['image_url'], 'http') === 0) ? $item['image_url'] : '../'.$item['image_url']) ?>" style="width: 50px; height: 50px; object-fit: cover; border-radius:4px;">
                                        <?php endif; ?>
                                    </td>
                                    <td><?= htmlspecialchars(substr($item['title_en'], 0, 50)) ?>...</td>
                                    <td style="white-space:nowrap;">
                                        <a href="?edit=<?= $item['id'] ?>" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                                        <a href="?delete=<?= $item['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this record?');"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if(empty($items)) echo "<tr><td colspan='4' class='text-center py-3'>No press releases added.</td></tr>"; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
