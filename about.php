<?php
require_once 'includes/header.php';

$about_lead = getSettingVal($pdo, 'about_lead');
$about_desc = getSettingVal($pdo, 'about_desc');

$about_lead_hi = !empty($about_lead['value_hi']) ? $about_lead['value_hi'] : 'श्री दद्दू प्रसाद जी एक अनुभवी राजनेता एवं सामाजिक चिंतक हैं। वे जमीनी स्तर से उठकर प्रदेश की राजनीति में महत्वपूर्ण स्थान तक पहुँचे।';
$about_lead_en = !empty($about_lead['value_en']) ? $about_lead['value_en'] : 'Shri Daddoo Prasad Ji is an experienced politician and social thinker. He rose from the grassroots to a significant position in state politics.';

$about_desc_hi = !empty($about_desc['value_hi']) ? $about_desc['value_hi'] : 'उन्होंने सदैव समाज के अंतिम व्यक्ति तक सरकारी योजनाओं का लाभ पहुँचाने का प्रयास किया।';
$about_desc_en = !empty($about_desc['value_en']) ? $about_desc['value_en'] : 'He always strove to bring the benefits of government schemes to the last person in society.';

// Fetch Biography Items
$stmt = $pdo->query("SELECT * FROM biography ORDER BY display_order ASC");
$biographyItems = $stmt->fetchAll();
?>

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
    transform: translateY(10px); /* slightly push down to sit on border */
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

/* Main Content Typography */
.ref-main-content {
    background-color: #ffffff;
    padding: 60px 0;
    font-family: 'Hind', sans-serif;
}
.ref-lead-text {
    font-size: 1.4rem;
    line-height: 1.8;
    color: #2d3748;
    font-weight: 600;
    margin-bottom: 30px;
    border-left: 4px solid #D21034;
    padding-left: 20px;
}
.ref-desc-text {
    font-size: 1.15rem;
    line-height: 1.9;
    color: #4a5568;
}

/* Floating Image */
.ref-float-img-container {
    padding: 10px;
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    margin: 0 0 20px 30px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
}
.ref-float-img {
    width: 100%;
    max-width: 350px;
    border-radius: 4px;
}
@media (max-width: 768px) {
    .ref-float-img-container {
        float: none !important;
        margin: 0 auto 30px auto;
        text-align: center;
        max-width: 100%;
    }
}

/* Biography / Journey Section */
.ref-journey-section {
    background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);
    padding: 80px 0;
}
.ref-section-title {
    font-family: 'Mukta', sans-serif;
    font-size: 2.5rem;
    font-weight: 800;
    color: #003893;
    text-align: center;
    margin-bottom: 50px;
}
.ref-ribbon-card {
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.06);
    margin-bottom: 40px;
    border: 1px solid #e2e8f0;
}
.ref-ribbon-head {
    padding: 20px;
    text-align: center;
}
.ref-ribbon-head.bg-blue { background-color: #e6eff9; }
.ref-ribbon-head.bg-yellow { background-color: #fffaf0; }
.ref-ribbon-head.bg-red { background-color: #fff5f5; }
.ref-ribbon-head.bg-orange { background-color: #fffaf0; }

.ref-ribbon-title {
    font-family: 'Mukta', sans-serif;
    font-size: 1.5rem;
    font-weight: 700;
    color: #003893;
    margin: 0;
}
.ref-card-body {
    padding: 30px;
}
.ref-card-text {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #4a5568;
    margin-bottom: 20px;
}
.ref-styled-list {
    list-style: none;
    padding: 0;
    margin: 0;
}
.ref-styled-list li {
    font-size: 1.05rem;
    color: #2d3748;
    margin-bottom: 12px;
    display: flex;
    align-items: flex-start;
}
.ref-styled-list li i {
    color: #28a745;
    margin-top: 5px;
    margin-right: 12px;
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
                        <li class="breadcrumb-item active" aria-current="page" data-hi="परिचय" data-en="About">परिचय</li>
                    </ol>
                </nav>
                <h1 class="ref-hero-title mt-3" data-hi="दद्दू प्रसाद जी के बारे में" data-en="About Daddoo Prasad">दद्दू प्रसाद जी के बारे में</h1>
            </div>
            <div class="col-md-5 ref-hero-img-wrap d-none d-md-block">
                <!-- Fallback to a generic photo or the one uploaded via gallery if cutout is missing -->
                <img src="https://img-s-msn-com.akamaized.net/tenant/amp/entityid/AA1OVQr7.img?f=jpg&h=580&m=6&q=80&u=t&w=900" alt="Daddoo Prasad" class="ref-hero-img shadow-lg rounded-circle" style="border: 8px solid white;">
            </div>
        </div>
    </div>
</section>

<!-- Main Text Content -->
<section class="ref-main-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <p class="ref-lead-text" data-hi="<?= htmlspecialchars($about_lead_hi) ?>" data-en="<?= htmlspecialchars($about_lead_en) ?>">
                    <?= htmlspecialchars($about_lead_hi) ?>
                </p>
                
                <div class="clearfix mt-5">
                    <div class="ref-float-img-container float-md-end">
                        <img src="https://static.toiimg.com/thumb/msid-117165608%2Cwidth-1070%2Cheight-580%2Cimgsize-102798%2Cresizemode-75%2Coverlay-toi_sw%2Cpt-32%2Cy_pad-40/photo.jpg" alt="Social Work" class="ref-float-img">
                    </div>
                    
                    <div class="ref-desc-text" data-hi="<?= nl2br(htmlspecialchars($about_desc_hi)) ?>" data-en="<?= nl2br(htmlspecialchars($about_desc_en)) ?>">
                        <?= nl2br(htmlspecialchars($about_desc_hi)) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Political Journey (Biography Ribbon Cards) -->
<section class="ref-journey-section">
    <div class="container">
        <h2 class="ref-section-title" data-hi="राजनीतिक यात्रा एवं योगदान" data-en="Political Journey & Contributions">राजनीतिक यात्रा एवं योगदान</h2>
        
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <?php foreach($biographyItems as $item): ?>
                    <div class="ref-ribbon-card">
                        <!-- Heading matching the reference ribbon style -->
                        <div class="ref-ribbon-head <?= htmlspecialchars($item['bg_color_class'] ?? 'bg-blue') ?>">
                            <h3 class="ref-ribbon-title" data-hi="<?= htmlspecialchars($item['title_hi']) ?>" data-en="<?= htmlspecialchars($item['title_en']) ?>">
                                <?= htmlspecialchars($item['title_hi']) ?>
                            </h3>
                        </div>
                        
                        <div class="ref-card-body">
                            <p class="ref-card-text" data-hi="<?= htmlspecialchars($item['content_hi']) ?>" data-en="<?= htmlspecialchars($item['content_en']) ?>">
                                <?= nl2br(htmlspecialchars($item['content_hi'])) ?>
                            </p>
                            
                            <?php if(!empty($item['list_items_hi'])): 
                                $listHi = explode('|', $item['list_items_hi']);
                                $listEn = explode('|', $item['list_items_en']);
                            ?>
                                <ul class="ref-styled-list mt-4">
                                    <?php foreach($listHi as $index => $li_hi): ?>
                                        <li data-hi="<?= htmlspecialchars(trim($li_hi)) ?>" data-en="<?= htmlspecialchars(trim($listEn[$index] ?? '')) ?>">
                                            <i class="fas fa-arrow-right"></i> <?= htmlspecialchars(trim($li_hi)) ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
