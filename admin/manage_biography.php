<?php
require_once 'includes/header.php';

// Handle Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $pdo->prepare("DELETE FROM biography WHERE id = ?")->execute([$id]);
    $_SESSION['success'] = "Biography item deleted.";
    header("Location: manage_biography.php");
    exit;
}

// Handle Add/Edit
$editItem = null;
if (isset($_GET['edit'])) {
    $editItem = $pdo->prepare("SELECT * FROM biography WHERE id = ?");
    $editItem->execute([(int)$_GET['edit']]);
    $editItem = $editItem->fetch();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $icon = $_POST['icon_class'];
    $bg = $_POST['bg_color_class'];
    $title_hi = $_POST['title_hi'];
    $title_en = $_POST['title_en'];
    $content_hi = $_POST['content_hi'];
    $content_en = $_POST['content_en'];
    $list_hi = $_POST['list_items_hi'];
    $list_en = $_POST['list_items_en'];
    $order = (int)$_POST['display_order'];

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $stmt = $pdo->prepare("UPDATE biography SET icon_class=?, bg_color_class=?, title_hi=?, title_en=?, content_hi=?, content_en=?, list_items_hi=?, list_items_en=?, display_order=? WHERE id=?");
        $stmt->execute([$icon, $bg, $title_hi, $title_en, $content_hi, $content_en, $list_hi, $list_en, $order, $_POST['id']]);
        $_SESSION['success'] = "Biography item updated.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO biography (icon_class, bg_color_class, title_hi, title_en, content_hi, content_en, list_items_hi, list_items_en, display_order) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$icon, $bg, $title_hi, $title_en, $content_hi, $content_en, $list_hi, $list_en, $order]);
        $_SESSION['success'] = "Biography item added.";
    }
    header("Location: manage_biography.php");
    exit;
}

$items = $pdo->query("SELECT * FROM biography ORDER BY display_order ASC")->fetchAll();
?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-blue">Manage Biography</h2>
        <?php if($editItem): ?>
            <a href="manage_biography.php" class="btn btn-secondary">Cancel Edit & Add New</a>
        <?php endif; ?>
    </div>

    <div class="row">
        <!-- Form -->
        <div class="col-md-5">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0 text-orange"><?= $editItem ? 'Edit Item' : 'Add New Item' ?></h5>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <?php if($editItem): ?><input type="hidden" name="id" value="<?= $editItem['id'] ?>"><?php endif; ?>
                        
                        <div class="row mb-3">
                            <div class="col-6">
                                <label>Icon Class (FontAwesome)</label>
                                <input type="text" class="form-control" name="icon_class" value="<?= $editItem['icon_class'] ?? 'fas fa-star' ?>" required>
                                <small class="text-muted">e.g. fas fa-graduation-cap</small>
                            </div>
                            <div class="col-6">
                                <label>Background Color Class</label>
                                <select class="form-select" name="bg_color_class">
                                    <option value="bg-blue" <?= ($editItem['bg_color_class']??'') == 'bg-blue' ? 'selected' : '' ?>>Blue</option>
                                    <option value="bg-yellow" <?= ($editItem['bg_color_class']??'') == 'bg-yellow' ? 'selected' : '' ?>>Yellow</option>
                                    <option value="bg-red" <?= ($editItem['bg_color_class']??'') == 'bg-red' ? 'selected' : '' ?>>Red</option>
                                    <option value="bg-orange" <?= ($editItem['bg_color_class']??'') == 'bg-orange' ? 'selected' : '' ?>>Orange</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Display Order</label>
                            <input type="number" class="form-control" name="display_order" value="<?= $editItem['display_order'] ?? 0 ?>">
                        </div>

                        <ul class="nav nav-tabs mb-3" id="langTabs" role="tablist">
                            <li class="nav-item" role="presentation"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#hi" type="button">Hindi</button></li>
                            <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#en" type="button">English</button></li>
                        </ul>
                        <div class="tab-content" id="langTabsContent">
                            <div class="tab-pane fade show active" id="hi" role="tabpanel">
                                <div class="mb-3"><label>Title</label><input type="text" class="form-control" name="title_hi" value="<?= htmlspecialchars($editItem['title_hi'] ?? '') ?>" required></div>
                                <div class="mb-3"><label>Content Paragraph</label><textarea class="form-control" name="content_hi" rows="3" required><?= htmlspecialchars($editItem['content_hi'] ?? '') ?></textarea></div>
                                <div class="mb-3"><label>List Items (Separate with |)</label><textarea class="form-control" name="list_items_hi" rows="2"><?= htmlspecialchars($editItem['list_items_hi'] ?? '') ?></textarea></div>
                            </div>
                            <div class="tab-pane fade" id="en" role="tabpanel">
                                <div class="mb-3"><label>Title</label><input type="text" class="form-control" name="title_en" value="<?= htmlspecialchars($editItem['title_en'] ?? '') ?>" required></div>
                                <div class="mb-3"><label>Content Paragraph</label><textarea class="form-control" name="content_en" rows="3" required><?= htmlspecialchars($editItem['content_en'] ?? '') ?></textarea></div>
                                <div class="mb-3"><label>List Items (Separate with |)</label><textarea class="form-control" name="list_items_en" rows="2"><?= htmlspecialchars($editItem['list_items_en'] ?? '') ?></textarea></div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mt-2" style="background:#003893">Save Bio Item</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- List -->
        <div class="col-md-7">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white">
                    <h5 class="mb-0 text-blue">Existing Items</h5>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Order</th>
                                <th>Icon</th>
                                <th>Title (EN)</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($items as $item): ?>
                                <tr>
                                    <td><?= $item['display_order'] ?></td>
                                    <td><i class="<?= $item['icon_class'] ?> text-primary"></i> <small>(<?= str_replace('bg-','',$item['bg_color_class']) ?>)</small></td>
                                    <td><?= htmlspecialchars($item['title_en']) ?></td>
                                    <td>
                                        <a href="?edit=<?= $item['id'] ?>" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                                        <a href="?delete=<?= $item['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this record?');"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if(empty($items)) echo "<tr><td colspan='4' class='text-center py-3'>No items added.</td></tr>"; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
