<?php
require_once 'includes/header.php';

$stmt = $pdo->query("SELECT * FROM achievements ORDER BY display_order ASC");
$achievements = $stmt->fetchAll();
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

/* ── Achievements & Awards ── */
.sn-ach-page {
    position: relative;
    padding: 80px 0 100px;
    overflow: hidden;
    min-height: 60vh;
    background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);
}
.sn-ach-inner { position: relative; z-index: 1; }

.sn-ach-grid-page {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}
.sn-ach-card-page {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px; overflow: hidden;
    text-decoration: none; display: block;
    box-shadow: 0 10px 30px rgba(0,0,0,0.06);
    transition: transform .25s, box-shadow .25s;
    height: 100%;
    display: flex;
    flex-direction: column;
}
.sn-ach-card-page:hover { 
    transform: translateY(-8px); 
    box-shadow: 0 15px 35px rgba(0,56,147,0.12);
}

.sn-ach-thumb-page {
    width: 100%; height: 220px; overflow: hidden;
    background: #f1f5f9;
    display: flex; align-items: center; justify-content: center;
}
.sn-ach-thumb-page img { width: 100%; height: 100%; object-fit: cover; transition: transform .5s ease; }
.sn-ach-card-page:hover .sn-ach-thumb-page img { transform: scale(1.08); }

.sn-ach-body-page {
    padding: 25px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.sn-ach-label-page {
    font-size: 1.25rem; font-weight: 800;
    color: #003893;
    line-height: 1.4;
    margin-bottom: 15px;
    border-bottom: 2px solid #eaeaea;
    padding-bottom: 12px;
}

.sn-ach-desc-page {
    color: #4a5568;
    font-size: 1rem;
    line-height: 1.6;
    margin-bottom: 0;
}

@media (max-width: 992px) { .sn-ach-grid-page { grid-template-columns: repeat(2,1fr); } }
@media (max-width: 620px)  { .sn-ach-grid-page { grid-template-columns: 1fr; } }
</style>

<!-- Hero Section -->
<section class="ref-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-7 pb-5">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb ref-breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php" data-hi="होम" data-en="Home">होम</a></li>
                        <li class="breadcrumb-item active" aria-current="page" data-hi="उपलब्धियां" data-en="Achievements">उपलब्धियां</li>
                    </ol>
                </nav>
                <h1 class="ref-hero-title mt-3" data-hi="उपलब्धियाँ एवं पुरस्कार" data-en="Achievements & Awards">उपलब्धियाँ एवं पुरस्कार</h1>
            </div>
            <div class="col-md-5 ref-hero-img-wrap d-none d-md-block">
                <!-- Fallback to a generic photo -->
                <img src="https://img-s-msn-com.akamaized.net/tenant/amp/entityid/AA1OVQr7.img?f=jpg&h=580&m=6&q=80&u=t&w=900" alt="Daddoo Prasad" class="ref-hero-img shadow-lg rounded-circle" style="border: 8px solid white;">
            </div>
        </div>
    </div>
</section>

<!-- ACHIEVEMENTS & AWARDS CONTENT -->
<section class="sn-ach-page">
    <div class="container sn-ach-inner">
        <div class="sn-ach-grid-page">
            <?php
            // Using the same placeholder images as index.php
            $achImgs = [
                'https://images.unsplash.com/photo-1567427017947-545c5f8d16ad?w=600&q=80',
                'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?w=600&q=80',
                'https://images.unsplash.com/photo-1599298585685-e7e37fed22a5?w=600&q=80',
                'https://images.unsplash.com/photo-1517457373958-b7bdd4587205?w=600&q=80',
                'https://images.unsplash.com/photo-1529107386315-e1a2ed48a620?w=600&q=80',
                'https://images.unsplash.com/photo-1588681664899-f142ff2dc9b1?w=600&q=80',
            ];
            foreach ($achievements as $idx => $ach):
            ?>
            <div class="sn-ach-card-page">
                <div class="sn-ach-thumb-page">
                    <img src="<?= $achImgs[$idx % 6] ?>"
                         alt="<?= htmlspecialchars($ach['category_hi']) ?>"
                         loading="lazy">
                </div>
                <div class="sn-ach-body-page">
                    <div class="sn-ach-label-page"
                         data-hi="<?= htmlspecialchars($ach['category_hi']) ?>"
                         data-en="<?= htmlspecialchars($ach['category_en']) ?>">
                        <?= htmlspecialchars($ach['category_hi']) ?>
                    </div>
                    <div class="sn-ach-desc-page"
                         data-hi="<?= nl2br(htmlspecialchars($ach['description_hi'])) ?>"
                         data-en="<?= nl2br(htmlspecialchars($ach['description_en'])) ?>">
                        <?= nl2br(htmlspecialchars($ach['description_hi'])) ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            
            <?php if(empty($achievements)): ?>
            <div class="col-12 text-center text-white py-5">
                <i class="fas fa-trophy fa-3x mb-3 text-white-50"></i>
                <h4 data-hi="कोई उपलब्धि उपलब्ध नहीं" data-en="No achievements available">कोई उपलब्धि उपलब्ध नहीं</h4>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
