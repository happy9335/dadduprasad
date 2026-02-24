<?php
require_once 'includes/header.php';

// Handle Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $pdo->prepare("DELETE FROM achievements WHERE id = ?")->execute([$id]);
    $_SESSION['success'] = "Achievement deleted.";
    header("Location: manage_achievements.php");
    exit;
}

// Handle Add/Edit
$editItem = null;
if (isset($_GET['edit'])) {
    $editItem = $pdo->prepare("SELECT * FROM achievements WHERE id = ?");
    $editItem->execute([(int)$_GET['edit']]);
    $editItem = $editItem->fetch();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cat_hi = $_POST['category_hi'];
    $cat_en = $_POST['category_en'];
    $desc_hi = $_POST['description_hi'];
    $desc_en = $_POST['description_en'];
    $order = (int)$_POST['display_order'];

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $stmt = $pdo->prepare("UPDATE achievements SET category_hi=?, category_en=?, description_hi=?, description_en=?, display_order=? WHERE id=?");
        $stmt->execute([$cat_hi, $cat_en, $desc_hi, $desc_en, $order, $_POST['id']]);
        $_SESSION['success'] = "Achievement updated.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO achievements (category_hi, category_en, description_hi, description_en, display_order) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$cat_hi, $cat_en, $desc_hi, $desc_en, $order]);
        $_SESSION['success'] = "Achievement added.";
    }
    header("Location: manage_achievements.php");
    exit;
}

$items = $pdo->query("SELECT * FROM achievements ORDER BY display_order ASC")->fetchAll();
?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-blue">Manage Achievements</h2>
        <?php if($editItem): ?>
            <a href="manage_achievements.php" class="btn btn-secondary">Cancel Edit & Add New</a>
        <?php endif; ?>
    </div>

    <div class="row">
        <!-- Form -->
        <div class="col-md-5">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0 text-orange"><?= $editItem ? 'Edit Achievement' : 'Add New Achievement' ?></h5>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <?php if($editItem): ?><input type="hidden" name="id" value="<?= $editItem['id'] ?>"><?php endif; ?>
                        
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
                                <div class="mb-3"><label>Category Title</label><input type="text" class="form-control" name="category_hi" value="<?= htmlspecialchars($editItem['category_hi'] ?? '') ?>" required></div>
                                <div class="mb-3"><label>Description / List items</label><textarea class="form-control" name="description_hi" rows="5" required><?= htmlspecialchars($editItem['description_hi'] ?? '') ?></textarea></div>
                            </div>
                            <div class="tab-pane fade" id="en" role="tabpanel">
                                <div class="mb-3"><label>Category Title</label><input type="text" class="form-control" name="category_en" value="<?= htmlspecialchars($editItem['category_en'] ?? '') ?>" required></div>
                                <div class="mb-3"><label>Description / List items</label><textarea class="form-control" name="description_en" rows="5" required><?= htmlspecialchars($editItem['description_en'] ?? '') ?></textarea></div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mt-2" style="background:#003893">Save Achievement</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- List -->
        <div class="col-md-7">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white">
                    <h5 class="mb-0 text-blue">Existing Achievements</h5>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Order</th>
                                <th>Category (EN)</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($items as $item): ?>
                                <tr>
                                    <td><?= $item['display_order'] ?></td>
                                    <td><?= htmlspecialchars($item['category_en']) ?></td>
                                    <td>
                                        <a href="?edit=<?= $item['id'] ?>" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                                        <a href="?delete=<?= $item['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this record?');"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if(empty($items)) echo "<tr><td colspan='3' class='text-center py-3'>No achievements added.</td></tr>"; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
