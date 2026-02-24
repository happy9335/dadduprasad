<?php
require_once 'includes/header.php';

// Handle Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    
    // Attempt to delete physical file if it was uploaded
    $stmt = $pdo->prepare("SELECT media_url FROM media_gallery WHERE id = ?");
    $stmt->execute([$id]);
    $item = $stmt->fetch();
    if ($item && strpos($item['media_url'], '../uploads/') === 0) {
        $path = __DIR__ . '/' . $item['media_url'];
        if (file_exists($path)) {
            unlink($path);
        }
    }

    $pdo->prepare("DELETE FROM media_gallery WHERE id = ?")->execute([$id]);
    $_SESSION['success'] = "Media item deleted.";
    header("Location: manage_gallery.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $type = $_POST['media_type'];
    $cat_hi = $_POST['category_hi'] ?? 'विविध';
    $cat_en = $_POST['category_en'] ?? 'Miscellaneous';
    $cap_hi = $_POST['caption_hi'] ?? '';
    $cap_en = $_POST['caption_en'] ?? '';
    $order = (int)$_POST['display_order'];

    $url = '';

    if ($type == 'video') {
        $url = $_POST['video_url'];
        // Basic conversion to embed
        if (strpos($url, 'watch?v=') !== false) {
            $url = str_replace('watch?v=', 'embed/', $url);
        }
    } else {
        // Image type - Check upload first, then direct URL
        if (isset($_FILES['image_upload']) && $_FILES['image_upload']['error'] == UPLOAD_ERR_OK) {
            $ext = strtolower(pathinfo($_FILES['image_upload']['name'], PATHINFO_EXTENSION));
            $allowed = ['jpg','jpeg','png','gif','webp'];
            if (in_array($ext, $allowed)) {
                $filename = uniqid('img_') . '.' . $ext;
                $target = "../uploads/" . $filename;
                if (move_uploaded_file($_FILES['image_upload']['tmp_name'], __DIR__ . '/' . $target)) {
                    $url = 'uploads/' . $filename; // Saving relative path for DB
                }
            } else {
                $_SESSION['error'] = "Invalid image format.";
            }
        } elseif (!empty($_POST['image_url'])) {
            $url = $_POST['image_url'];
        }
    }

    if (!empty($url)) {
        if (!isset($_SESSION['error'])) {
            $stmt = $pdo->prepare("INSERT INTO media_gallery (media_type, category_hi, category_en, media_url, caption_hi, caption_en, display_order) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$type, $cat_hi, $cat_en, $url, $cap_hi, $cap_en, $order]);
            $_SESSION['success'] = "Media item added.";
        }
    } else {
        if (!isset($_SESSION['error'])) $_SESSION['error'] = "Please provide an image file, an image URL, or a video URL.";
    }

    header("Location: manage_gallery.php");
    exit;
}

$items = $pdo->query("SELECT * FROM media_gallery ORDER BY display_order ASC, id DESC")->fetchAll();
?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-blue">Manage Media Gallery</h2>
    </div>

    <div class="row">
        <!-- Form -->
        <div class="col-md-5">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0 text-orange">Add New Media</h5>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label>Media Type</label>
                            <select class="form-select" name="media_type" id="mediaTypeToggle" onchange="toggleMediaFields()">
                                <option value="image">Image</option>
                                <option value="video">Video</option>
                            </select>
                        </div>
                        
                        <div id="imageFields">
                            <div class="mb-3" id="uploadField">
                                <label>Upload Image</label>
                                <input type="file" class="form-control" name="image_upload" accept="image/*">
                            </div>
                            <div class="text-center mb-2"><strong>OR</strong></div>
                            <div class="mb-3" id="urlField">
                                <label>Image Direct URL</label>
                                <input type="url" class="form-control" name="image_url" placeholder="https://example.com/image.jpg">
                            </div>
                        </div>

                        <div id="videoFields" style="display:none;">
                            <div class="mb-3">
                                <label>YouTube Embed / Video URL</label>
                                <input type="url" class="form-control" name="video_url" placeholder="https://www.youtube.com/embed/xyz">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <label>Caption (Hindi) - Optional</label>
                                <input type="text" class="form-control" name="caption_hi">
                            </div>
                            <div class="col-12 mt-2">
                                <label>Caption (English) - Optional</label>
                                <input type="text" class="form-control" name="caption_en">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Display Order (0 comes first)</label>
                            <input type="number" class="form-control" name="display_order" value="0">
                        </div>

                        <button type="submit" class="btn btn-primary w-100" style="background:#003893">Add to Gallery</button>
                    </form>
                </div>
            </div>
            <script>
                function toggleMediaFields() {
                    const sel = document.getElementById('mediaTypeToggle').value;
                    if (sel === 'video') {
                        document.getElementById('imageFields').style.display = 'none';
                        document.getElementById('videoFields').style.display = 'block';
                    } else {
                        document.getElementById('imageFields').style.display = 'block';
                        document.getElementById('videoFields').style.display = 'none';
                    }
                }
            </script>
        </div>

        <!-- List -->
        <div class="col-md-7">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white">
                    <h5 class="mb-0 text-blue">Gallery Items</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Image/Preview</th>
                                    <th>Type</th>
                                    <th>Caption (EN)</th>
                                    <th>Order</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($items as $item): ?>
                                    <tr>
                                        <td>
                                            <?php if($item['media_type'] == 'image'): ?>
                                                <img src="<?= htmlspecialchars(strpos($item['media_url'], 'http') !== false ? $item['media_url'] : '../'.$item['media_url']) ?>" style="width: 80px; height: 60px; object-fit: cover; border-radius:4px;">
                                            <?php else: ?>
                                                <div style="width: 80px; height: 60px; background:#eee; text-align:center; line-height:60px; border-radius:4px;">
                                                    <i class="fab fa-youtube text-danger fa-2x"></i>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td><span class="badge bg-<?= $item['media_type'] == 'video' ? 'danger' : 'success' ?>"><?= strtoupper($item['media_type']) ?></span></td>
                                        <td><?= htmlspecialchars($item['caption_en']) ?></td>
                                        <td><?= $item['display_order'] ?></td>
                                        <td>
                                            <a href="?delete=<?= $item['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this media item?');"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php if(empty($items)) echo "<tr><td colspan='5' class='text-center py-3'>No gallery items added.</td></tr>"; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
