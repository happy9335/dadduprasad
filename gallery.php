<?php
require_once 'includes/header.php';

$stmt = $pdo->query("SELECT * FROM media_gallery ORDER BY display_order ASC");
$galleryItems = $stmt->fetchAll();
?>

<!-- Media Gallery Section -->
<section id="gallery" class="section gallery-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title" data-hi="मीडिया गैलरी" data-en="Media Gallery">मीडिया गैलरी</h2>
            <div class="title-underline"></div>
        </div>

        <div class="gallery-filters">
            <button class="filter-btn active" data-filter="all" data-hi="सभी" data-en="All">सभी</button>
            <button class="filter-btn" data-filter="image" data-hi="तस्वीरें" data-en="Photos">तस्वीरें</button>
            <button class="filter-btn" data-filter="video" data-hi="वीडियो" data-en="Videos">वीडियो</button>
        </div>

        <div class="gallery-grid">
            <?php foreach($galleryItems as $item): ?>
                <div class="gallery-item filter-<?= $item['media_type'] ?>">
                    <?php if($item['media_type'] === 'video'): ?>
                        <div class="video-wrapper">
                            <iframe src="<?= htmlspecialchars(getYoutubeEmbedUrl($item['media_url'])) ?>" frameborder="0" allowfullscreen></iframe>
                        </div>
                    <?php else: ?>
                        <img src="<?= htmlspecialchars(strpos($item['media_url'], 'http') !== false ? $item['media_url'] : $item['media_url']) ?>" alt="Gallery Image" class="gallery-img">
                    <?php endif; ?>
                    <div class="gallery-caption" data-hi="<?= htmlspecialchars($item['caption_hi'] ?? '') ?>" data-en="<?= htmlspecialchars($item['caption_en'] ?? '') ?>">
                        <?= htmlspecialchars($item['caption_hi'] ?? '') ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
