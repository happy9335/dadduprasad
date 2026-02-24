<?php
require_once 'includes/header.php';

// Fetch native gallery items (Images and Videos)
$stmt = $pdo->query("SELECT * FROM media_gallery ORDER BY display_order ASC");
$galleryItemsRaw = $stmt->fetchAll();

// Fetch Press Releases that have an image
$stmtPress = $pdo->query("SELECT * FROM press_releases WHERE image_url IS NOT NULL AND image_url != '' ORDER BY release_date DESC");
$pressReleasesRaw = $stmtPress->fetchAll();

// Combine everything into a single array for easier rendering
$allMedia = [];

// Helper to extract YouTube ID for thumbnail
function getYoutubeThumb($url) {
    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i', $url, $match);
    $videoId = $match[1] ?? null;
    return $videoId ? "https://img.youtube.com/vi/{$videoId}/hqdefault.jpg" : '';
}

foreach ($galleryItemsRaw as $item) {
    $type = $item['media_type']; // 'image' or 'video'
    $url = $item['media_url'];
    // Ensure relative image paths are absolute relative to domain
    if ($type === 'image' && strpos($url, 'http') !== 0) {
        $url = $url; 
    }
    
    $thumb = ($type === 'video') ? getYoutubeThumb($url) : $url;
    
    $allMedia[] = [
        'type' => $type,
        'url' => $url,
        'thumb' => $thumb,
        'caption_hi' => $item['caption_hi'],
        'caption_en' => $item['caption_en'],
        'date' => '' // Gallery items don't strictly have a visible date in the old UI, but we can leave empty
    ];
}

foreach ($pressReleasesRaw as $press) {
    $url = $press['image_url'];
    if (strpos($url, 'http') !== 0) {
        $url = $url;
    }
    
    $allMedia[] = [
        'type' => 'press',
        'url' => $url,
        'thumb' => $url,
        'caption_hi' => $press['title_hi'] . (!empty($press['location_hi']) ? ' - ' . $press['location_hi'] : ''),
        'caption_en' => $press['title_en'] . (!empty($press['location_en']) ? ' - ' . $press['location_en'] : ''),
        'date' => date('d M Y', strtotime($press['release_date']))
    ];
}
?>

<!-- Include Fancybox CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />

<style>
/* Hero Section (Matching About & Achievements) */
.ref-hero {
    background: linear-gradient(135deg, #e6eff9 0%, #ffffff 100%);
    padding: 80px 0 0 0;
    position: relative;
    overflow: hidden;
    border-bottom: 2px solid #eaeaea;
}
.ref-hero-title {
    font-family: 'Mukta', sans-serif;
    font-size: clamp(2.5rem, 5vw, 4rem);
    font-weight: 800;
    color: #003893;
    line-height: 1.2;
    margin-bottom: 20px;
}
.ref-hero-img-wrap {
    text-align: right;
    position: relative;
}
.ref-hero-img {
    max-width: 100%;
    height: auto;
    max-height: 450px;
    object-fit: contain;
    position: relative;
    z-index: 2;
    transform: translateY(10px);
}

/* Breadcrumb */
.ref-breadcrumb {
    background: transparent;
    padding: 0;
    margin-bottom: 0;
    font-size: 1rem;
    font-weight: 500;
}
.ref-breadcrumb a {
    color: #4a5568;
    text-decoration: none;
    transition: color 0.2s;
}
.ref-breadcrumb a:hover {
    color: #D21034;
}
.ref-breadcrumb .breadcrumb-item.active {
    color: #003893;
}

/* Page Background */
.gallery-page-body {
    background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);
    padding: 60px 0 100px;
}

/* Modern Filters */
.modern-filters {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-bottom: 40px;
    flex-wrap: wrap;
}
.modern-filter-btn {
    background: #fff;
    border: 2px solid #e2e8f0;
    color: #4a5568;
    padding: 10px 25px;
    border-radius: 30px;
    font-weight: 700;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 6px rgba(0,0,0,0.02);
}
.modern-filter-btn:hover {
    border-color: #003893;
    color: #003893;
}
.modern-filter-btn.active {
    background: #003893;
    border-color: #003893;
    color: #fff;
    box-shadow: 0 6px 15px rgba(0,56,147,0.2);
}

/* Media Grid */
.modern-media-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 30px;
}

/* Media Card */
.media-card {
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.06);
    border: 1px solid #e2e8f0;
    position: relative;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.media-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 35px rgba(0,56,147,0.12);
}

.media-thumb-wrap {
    position: relative;
    width: 100%;
    height: 250px;
    background: #f1f5f9;
    overflow: hidden;
    display: block;
}
.media-thumb-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}
.media-card:hover .media-thumb-wrap img {
    transform: scale(1.08); /* slight zoom on hover */
}

/* Play Icon Overlay for Videos */
.video-play-icon {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 60px;
    height: 60px;
    background: rgba(210, 16, 52, 0.9); /* Red */
    color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    padding-left: 5px; /* visually center play triangle */
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    transition: transform 0.3s;
}
.media-card:hover .video-play-icon {
    transform: translate(-50%, -50%) scale(1.1);
}

/* Hover overlay zoom icon for images/press */
.zoom-icon-overlay {
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0,56,147,0.4);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 2rem;
    opacity: 0;
    transition: opacity 0.3s;
    pointer-events: none;
}
.media-thumb-wrap:hover .zoom-icon-overlay {
    opacity: 1;
}

/* Tags/Badges */
.media-type-badge {
    position: absolute;
    top: 15px;
    left: 15px;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 800;
    text-transform: uppercase;
    color: #fff;
    z-index: 2;
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
}
.badge-image { background: #003893; }
.badge-video { background: #D21034; }
.badge-press { background: #28a745; }

/* Content Below Image */
.media-caption {
    padding: 20px;
    font-size: 1.05rem;
    font-weight: 700;
    color: #2d3748;
    line-height: 1.5;
    background: #fff;
    border-top: 1px solid #e2e8f0;
}
.media-date {
    display: block;
    font-size: 0.85rem;
    color: #718096;
    margin-top: 8px;
    font-weight: 400;
}
</style>

<!-- Hero Section -->
<section class="ref-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-7 pb-5">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb ref-breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php" data-hi="होम" data-en="Home">होम</a></li>
                        <li class="breadcrumb-item active" aria-current="page" data-hi="गैलरी" data-en="Gallery">गैलरी</li>
                    </ol>
                </nav>
                <h1 class="ref-hero-title mt-3" data-hi="मीडिया एवं गैलरी" data-en="Media & Gallery">मीडिया एवं गैलरी</h1>
            </div>
            <div class="col-md-5 ref-hero-img-wrap d-none d-md-block">
                <img src="https://img-s-msn-com.akamaized.net/tenant/amp/entityid/AA1OVQr7.img?f=jpg&h=580&m=6&q=80&u=t&w=900" alt="Daddoo Prasad" class="ref-hero-img shadow-lg rounded-circle" style="border: 8px solid white;">
            </div>
        </div>
    </div>
</section>

<!-- Gallery Content -->
<section class="gallery-page-body">
    <div class="container">
        
        <!-- Filters -->
        <div class="modern-filters" id="galleryFilters">
            <button class="modern-filter-btn active" data-filter="all" data-hi="सभी" data-en="All">सभी</button>
            <button class="modern-filter-btn" data-filter="image" data-hi="तस्वीरें" data-en="Photos">तस्वीरें</button>
            <button class="modern-filter-btn" data-filter="video" data-hi="वीडियो" data-en="Videos">वीडियो</button>
            <button class="modern-filter-btn" data-filter="press" data-hi="प्रेस विज्ञप्ति" data-en="Press Releases">प्रेस विज्ञप्ति</button>
        </div>

        <!-- Grid -->
        <div class="modern-media-grid" id="galleryGrid">
            <?php foreach($allMedia as $media): 
                $typeClass = "filter-" . $media['type'];
                
                // Badge info
                $badgeClass = "badge-" . $media['type'];
                $badgeHi = ''; $badgeEn = '';
                if($media['type'] == 'image') { $badgeHi = 'तस्वीर'; $badgeEn = 'Photo'; }
                else if($media['type'] == 'video') { $badgeHi = 'वीडियो'; $badgeEn = 'Video'; }
                else if($media['type'] == 'press') { $badgeHi = 'प्रेस'; $badgeEn = 'Press'; }
                
                // Link for Fancybox
                $fbLink = htmlspecialchars($media['url']);
            ?>
                <div class="media-card <?= $typeClass ?>">
                    <a href="<?= $fbLink ?>" 
                       data-fancybox="unified-gallery" 
                       data-caption="<?= htmlspecialchars($media['caption_hi']) ?>"
                       class="media-thumb-wrap">
                        
                        <span class="media-type-badge <?= $badgeClass ?>" data-hi="<?= $badgeHi ?>" data-en="<?= $badgeEn ?>"><?= $badgeHi ?></span>
                        
                        <!-- Thumbnail -->
                        <img src="<?= htmlspecialchars($media['thumb']) ?>" loading="lazy" alt="<?= htmlspecialchars($media['caption_hi']) ?>">
                        
                        <?php if($media['type'] === 'video'): ?>
                            <div class="video-play-icon"><i class="fas fa-play"></i></div>
                        <?php else: ?>
                            <div class="zoom-icon-overlay"><i class="fas fa-search-plus"></i></div>
                        <?php endif; ?>
                    </a>
                    
                    <div class="media-caption">
                        <span data-hi="<?= htmlspecialchars($media['caption_hi']) ?>" data-en="<?= htmlspecialchars($media['caption_en']) ?>">
                            <?= htmlspecialchars($media['caption_hi']) ?>
                        </span>
                        <?php if(!empty($media['date'])): ?>
                            <span class="media-date"><i class="far fa-calendar-alt"></i> <?= htmlspecialchars($media['date']) ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
            
            <?php if(empty($allMedia)): ?>
                <div class="col-12 text-center text-muted py-5" style="grid-column: 1 / -1;">
                    <i class="fas fa-images fa-3x mb-3 text-secondary"></i>
                    <h4 data-hi="कोई मीडिया उपलब्ध नहीं" data-en="No media available">कोई मीडिया उपलब्ध नहीं</h4>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Include Fancybox JS -->
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Fancybox
    Fancybox.bind('[data-fancybox="unified-gallery"]', {
        Toolbar: {
            display: {
                left: ["infobar"],
                middle: ["zoomIn", "zoomOut", "toggle1to1"],
                right: ["slideshow", "thumbs", "close"],
            },
        },
    });

    // Gallery Filtering
    const filterBtns = document.querySelectorAll('.modern-filter-btn');
    const galleryCards = document.querySelectorAll('.media-card');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            // Remove active class from all buttons
            filterBtns.forEach(b => b.classList.remove('active'));
            // Add active class to clicked button
            btn.classList.add('active');

            const filterValue = btn.getAttribute('data-filter');

            galleryCards.forEach(card => {
                if (filterValue === 'all') {
                    card.style.display = 'flex';
                    // Re-enable fancybox for all
                    card.querySelector('a').setAttribute('data-fancybox', 'unified-gallery');
                } else {
                    if (card.classList.contains('filter-' + filterValue)) {
                        card.style.display = 'flex';
                        // Keep fancybox group for visible items only to make sliding accurate
                        card.querySelector('a').setAttribute('data-fancybox', 'unified-gallery-' + filterValue);
                    } else {
                        card.style.display = 'none';
                        // Remove from fancybox group when hidden
                        card.querySelector('a').removeAttribute('data-fancybox');
                    }
                }
            });
        });
    });
});
</script>

<?php require_once 'includes/footer.php'; ?>
