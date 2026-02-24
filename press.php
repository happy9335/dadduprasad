<?php
require_once 'includes/header.php';

$stmt = $pdo->query("SELECT * FROM press_releases ORDER BY release_date DESC");
$pressReleases = $stmt->fetchAll();
?>

<!-- Press Release Section -->
<section id="press" class="section press-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title" data-hi="प्रेस विज्ञप्ति" data-en="Press Note">प्रेस विज्ञप्ति</h2>
            <div class="title-underline"></div>
        </div>

        <div class="press-grid">
            <?php foreach($pressReleases as $press): ?>
                <div class="press-card new-style">
                    <div class="press-image-wrapper">
                        <?php if (!empty($press['image_url'])): ?>
                            <img src="<?= htmlspecialchars((strpos($press['image_url'], 'http') === 0) ? $press['image_url'] : $press['image_url']) ?>" alt="Press Image" class="press-image">
                        <?php else: ?>
                            <div class="press-image-placeholder">
                                <i class="fas fa-newspaper fa-3x"></i>
                            </div>
                        <?php endif; ?>
                        <div class="press-date-overlay">
                            <?= date('d F Y', strtotime($press['release_date'])) ?>
                        </div>
                    </div>
                    
                    <div class="press-content-wrapper">
                        <h3 class="press-title" data-hi="<?= htmlspecialchars($press['title_hi']) ?>" data-en="<?= htmlspecialchars($press['title_en']) ?>">
                            <?= htmlspecialchars($press['title_hi']) ?>
                        </h3>
                        <p class="press-meta" data-hi="स्थान: <?= htmlspecialchars($press['location_hi']) ?>" data-en="Location: <?= htmlspecialchars($press['location_en']) ?>">
                            स्थान: <?= htmlspecialchars($press['location_hi']) ?>
                        </p>
                        <p class="press-content" data-hi="<?= nl2br(htmlspecialchars($press['content_hi'])) ?>" data-en="<?= nl2br(htmlspecialchars($press['content_en'])) ?>">
                            <?= nl2br(htmlspecialchars($press['content_hi'])) ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
