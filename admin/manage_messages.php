<?php
require_once 'includes/header.php';

// Handle Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $pdo->prepare("DELETE FROM contact_messages WHERE id = ?")->execute([$id]);
    $_SESSION['success'] = "Message deleted.";
    header("Location: manage_messages.php");
    exit;
}

$items = $pdo->query("SELECT * FROM contact_messages ORDER BY submitted_at DESC")->fetchAll();
?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-blue">Contact Messages</h2>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white">
            <h5 class="mb-0 text-orange"><i class="fas fa-inbox me-2"></i> Inbox</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($items as $item): ?>
                            <tr>
                                <td style="white-space:nowrap;"><?= date('d M Y, h:i A', strtotime($item['submitted_at'])) ?></td>
                                <td><strong><?= htmlspecialchars($item['sender_name']) ?></strong></td>
                                <td><a href="tel:<?= htmlspecialchars($item['sender_mobile']) ?>"><?= htmlspecialchars($item['sender_mobile']) ?></a></td>
                                <td>
                                    <?php if(!empty($item['sender_email'])): ?>
                                        <a href="mailto:<?= htmlspecialchars($item['sender_email']) ?>"><?= htmlspecialchars($item['sender_email']) ?></a>
                                    <?php else: ?>
                                        <span class="text-muted">N/A</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= nl2br(htmlspecialchars($item['message'])) ?></td>
                                <td>
                                    <a href="?delete=<?= $item['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this message?');"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if(empty($items)) echo "<tr><td colspan='6' class='text-center py-4 text-muted'>No messages received yet.</td></tr>"; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
