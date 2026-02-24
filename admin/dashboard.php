<?php
require_once 'includes/header.php';

// Get some basic stats
try {
    $stats = [];
    
    $stmt = $pdo->query("SELECT COUNT(*) FROM contact_messages");
    $stats['messages'] = $stmt->fetchColumn();

    $stmt = $pdo->query("SELECT COUNT(*) FROM press_releases");
    $stats['press'] = $stmt->fetchColumn();

    $stmt = $pdo->query("SELECT COUNT(*) FROM media_gallery");
    $stats['gallery'] = $stmt->fetchColumn();
    
    $stmt = $pdo->query("SELECT COUNT(*) FROM achievements");
    $stats['achievements'] = $stmt->fetchColumn();

} catch (PDOException $e) {
    echo "<div class='alert alert-danger'>Database Error: " . $e->getMessage() . "</div>";
    $stats = ['messages'=>0, 'press'=>0, 'gallery'=>0, 'achievements'=>0];
}
?>

<div class="container-fluid">
    <h2 class="mb-4 text-blue">Dashboard Overview</h2>
    
    <div class="row">
        <!-- Stats Card -->
        <div class="col-md-3">
            <div class="card card-stats mb-4" style="border-left-color: #003893;">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted text-uppercase mb-2">Contact Messages</h6>
                        <h3 class="mb-0 text-blue"><?= $stats['messages'] ?></h3>
                    </div>
                    <i class="fas fa-envelope fa-3x text-blue opacity-50"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-stats mb-4" style="border-left-color: #D21034;">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted text-uppercase mb-2">Press Releases</h6>
                        <h3 class="mb-0 text-red"><?= $stats['press'] ?></h3>
                    </div>
                    <i class="fas fa-newspaper fa-3x text-red opacity-50"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-stats mb-4" style="border-left-color: #FF6F00;">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted text-uppercase mb-2">Gallery Items</h6>
                        <h3 class="mb-0 text-orange"><?= $stats['gallery'] ?></h3>
                    </div>
                    <i class="fas fa-images fa-3x text-orange opacity-50"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-stats mb-4" style="border-left-color: #FECB00;">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted text-uppercase mb-2">Achievements</h6>
                        <h3 class="mb-0 text-yellow"><?= $stats['achievements'] ?></h3>
                    </div>
                    <i class="fas fa-star fa-3x text-yellow opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <a href="manage_press.php" class="list-group-item list-group-item-action"><i class="fas fa-plus text-success me-2"></i> Add New Press Release</a>
                        <a href="manage_gallery.php" class="list-group-item list-group-item-action"><i class="fas fa-upload text-primary me-2"></i> Upload Media</a>
                        <a href="manage_settings.php" class="list-group-item list-group-item-action"><i class="fas fa-edit text-warning me-2"></i> Update Contact Info</a>
                        <a href="manage_messages.php" class="list-group-item list-group-item-action"><i class="fas fa-eye text-info me-2"></i> View Recent Messages</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Website Preview Info</h5>
                </div>
                <div class="card-body">
                    <p>The frontend website dynamically loads data from the database.</p>
                    <p>Ensure that all required fields in the English and Hindi tabs are filled for proper display on the dual-language site.</p>
                    <a href="../" target="_blank" class="btn btn-outline-primary"><i class="fas fa-external-link-alt"></i> Open Website</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
