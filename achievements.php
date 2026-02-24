<?php
require_once 'includes/header.php';

$stmt = $pdo->query("SELECT * FROM achievements ORDER BY display_order ASC");
$achievements = $stmt->fetchAll();
?>

<!-- Achievements Section -->
<section id="achievements" class="section achievements-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title" data-hi="प्रमुख उपलब्धियाँ" data-en="Achievements & Awards">प्रमुख उपलब्धियाँ</h2>
            <div class="title-underline"></div>
        </div>

        <div class="achievements-grid">
            <?php foreach($achievements as $ach): ?>
                <div class="achievement-card">
                    <div class="card-icon bg-blue"><i class="fas fa-star" style="color:var(--yellow)"></i></div>
                    <h3 data-hi="<?= htmlspecialchars($ach['category_hi']) ?>" data-en="<?= htmlspecialchars($ach['category_en']) ?>">
                        <?= htmlspecialchars($ach['category_hi']) ?>
                    </h3>
                    <p data-hi="<?= nl2br(htmlspecialchars($ach['description_hi'])) ?>" data-en="<?= nl2br(htmlspecialchars($ach['description_en'])) ?>">
                        <?= nl2br(htmlspecialchars($ach['description_hi'])) ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
