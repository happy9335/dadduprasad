<?php
require_once 'includes/header.php';

$stmt = $pdo->query("SELECT * FROM press_releases ORDER BY release_date DESC");
$pressReleases = $stmt->fetchAll();
?>

<!-- Include Fancybox CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />

<style>
/* Hero Section */
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

/* Main Content Area */
.press-page-body {
    background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);
    padding: 80px 0;
}

/* Press Grid styling (modern card layout) */
.press-grid-modern {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}

.press-card-modern {
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.06);
    border: 1px solid #e2e8f0;
    transition: transform 0.3s, box-shadow 0.3s;
    display: flex;
    flex-direction: column;
}
.press-card-modern:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 35px rgba(0,56,147,0.12);
}

.press-img-wrap {
    position: relative;
    width: 100%;
    height: 240px;
    background: #f1f5f9;
    overflow: hidden;
    cursor: zoom-in; /* Indicate it's clickable for gallery */
    display: block;  /* Make the fancybox link a block */
}
.press-img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}
.press-card-modern:hover .press-img-wrap img {
    transform: scale(1.08);
}

.press-date-badge {
    position: absolute;
    bottom: 0;
    left: 0;
    background: rgba(0, 56, 147, 0.9);
    color: #fff;
    padding: 8px 15px;
    font-size: 0.85rem;
    font-weight: 700;
    border-top-right-radius: 12px;
}
.press-gallery-icon {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: rgba(0,0,0,0.5);
    color: white;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    opacity: 0;
    transition: opacity 0.3s;
    pointer-events: none;
}
.press-card-modern:hover .press-gallery-icon {
    opacity: 1;
}

.press-body-wrap {
    padding: 25px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.press-card-title {
    font-size: 1.25rem;
    font-weight: 800;
    color: #003893;
    line-height: 1.4;
    margin-bottom: 12px;
}
.press-card-loc {
    font-size: 0.9rem;
    color: #d21034;
    font-weight: 600;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 6px;
}
.press-card-desc {
    color: #4a5568;
    font-size: 1rem;
    line-height: 1.6;
    margin-bottom: 0;
}

@media (max-width: 992px) { .press-grid-modern { grid-template-columns: repeat(2,1fr); } }
@media (max-width: 768px) { .press-grid-modern { grid-template-columns: 1fr; } }
</style>

<!-- Hero Section -->
<section class="ref-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-7 pb-5">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb ref-breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php" data-hi="होम" data-en="Home">होम</a></li>
                        <li class="breadcrumb-item active" aria-current="page" data-hi="प्रेस विज्ञप्ति" data-en="Press Release">प्रेस विज्ञप्ति</li>
                    </ol>
                </nav>
                <h1 class="ref-hero-title mt-3" data-hi="प्रेस विज्ञप्ति" data-en="Press Releases">प्रेस विज्ञप्ति</h1>
            </div>
            <div class="col-md-5 ref-hero-img-wrap d-none d-md-block">
                <!-- Fallback to a generic photo -->
                <img src="https://img-s-msn-com.akamaized.net/tenant/amp/entityid/AA1OVQr7.img?f=jpg&h=580&m=6&q=80&u=t&w=900" alt="Daddoo Prasad" class="ref-hero-img shadow-lg rounded-circle" style="border: 8px solid white;">
            </div>
        </div>
    </div>
</section>

<!-- Main Press Content -->
<section class="press-page-body">
    <div class="container">
        <div class="press-grid-modern">
            <?php foreach($pressReleases as $press): 
                $imgUrl = !empty($press['image_url']) ? $press['image_url'] : 'https://images.unsplash.com/photo-1529107386315-e1a2ed48a620?w=800&q=80';
            ?>
                <div class="press-card-modern">
                    <!-- Fancybox Link wrapping the image -->
                    <a href="<?= htmlspecialchars($imgUrl) ?>" 
                       data-fancybox="press-gallery" 
                       data-caption="<?= htmlspecialchars($press['title_hi']) ?> - <?= htmlspecialchars($press['location_hi']) ?>"
                       class="press-img-wrap">
                        
                        <img src="<?= htmlspecialchars($imgUrl) ?>" alt="<?= htmlspecialchars($press['title_hi']) ?>">
                        <div class="press-date-badge">
                            <i class="far fa-calendar-alt me-1"></i> <?= date('d M, Y', strtotime($press['release_date'])) ?>
                        </div>
                        <div class="press-gallery-icon">
                            <i class="fas fa-search-plus"></i>
                        </div>
                    </a>
                    
                    <div class="press-body-wrap">
                        <h3 class="press-card-title" data-hi="<?= htmlspecialchars($press['title_hi']) ?>" data-en="<?= htmlspecialchars($press['title_en']) ?>">
                            <?= htmlspecialchars($press['title_hi']) ?>
                        </h3>
                        <?php if(!empty($press['location_hi'])): ?>
                        <div class="press-card-loc" data-hi="<?= htmlspecialchars($press['location_hi']) ?>" data-en="<?= htmlspecialchars($press['location_en']) ?>">
                            <i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($press['location_hi']) ?>
                        </div>
                        <?php endif; ?>
                        
                        <p class="press-card-desc" data-hi="<?= nl2br(htmlspecialchars($press['content_hi'])) ?>" data-en="<?= nl2br(htmlspecialchars($press['content_en'])) ?>">
                            <?= nl2br(htmlspecialchars($press['content_hi'])) ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
            
            <?php if(empty($pressReleases)): ?>
            <div class="col-12 text-center text-muted py-5" style="grid-column: 1 / -1;">
                <i class="fas fa-newspaper fa-3x mb-3 text-secondary"></i>
                <h4 data-hi="कोई प्रेस विज्ञप्ति उपलब्ध नहीं" data-en="No press releases available">कोई प्रेस विज्ञप्ति उपलब्ध नहीं</h4>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Include Fancybox JS -->
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script>
    Fancybox.bind('[data-fancybox="press-gallery"]', {
        // Options for Fancybox
        Toolbar: {
            display: {
                left: ["infobar"],
                middle: [
                    "zoomIn",
                    "zoomOut",
                    "toggle1to1",
                    "rotateCCW",
                    "rotateCW",
                    "flipX",
                    "flipY",
                ],
                right: ["slideshow", "thumbs", "close"],
            },
        },
    });
</script>

<?php require_once 'includes/footer.php'; ?>
