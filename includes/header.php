<?php
require_once 'db.php';

// Settings helper
function getSettingVal($pdo, $key) {
    static $cache = null;
    if ($cache === null) {
        $stmt = $pdo->query("SELECT setting_key, value_hi, value_en FROM settings");
        $cache = [];
        while ($row = $stmt->fetch()) {
            $cache[$row['setting_key']] = $row;
        }
    }
    return isset($cache[$key]) ? $cache[$key] : ['value_hi' => '', 'value_en' => ''];
}

// YouTube embed URL helper
function getYoutubeEmbedUrl($url) {
    if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $url, $m)) {
        return 'https://www.youtube-nocookie.com/embed/' . $m[1] . '?rel=0&showinfo=0';
    }
    return $url;
}

$contact_phone   = getSettingVal($pdo, 'contact_phone');
$contact_email   = getSettingVal($pdo, 'contact_email');
$contact_address = getSettingVal($pdo, 'contact_address');
$contact_hours   = getSettingVal($pdo, 'contact_hours');
$currentPage     = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="hi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-hi="माननीय दद्दू प्रसाद - पूर्व कैबिनेट मंत्री, उत्तर प्रदेश" data-en="Hon'ble Daddoo Prasad - Former Cabinet Minister, Uttar Pradesh">माननीय दद्दू प्रसाद - पूर्व कैबिनेट मंत्री</title>
    <meta name="description" content="Official website of Hon'ble Daddoo Prasad Ji, Former Cabinet Minister, Government of Uttar Pradesh. National Convenor, Samajik Parivartan Mission, India.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind:wght@400;500;600;700&family=Mukta:wght@400;600;700;800&family=Noto+Sans+Devanagari:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Icon Libraries -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">

    <!-- Bootstrap (layout only) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Site CSS -->
    <link rel="stylesheet" href="<?= strpos($currentPage, 'admin') !== false ? '../style.css' : 'style.css' ?>">

    <style>
    /* ════ HEADER RESET ════ */
    /* Top info bar */
    .site-topbar {
        background: #002266;
        padding: 6px 0;
        font-size: 0.78rem;
        color: rgba(255,255,255,0.8);
    }
    .site-topbar a { color: rgba(255,255,255,0.7); text-decoration: none; margin-right: 18px; }
    .site-topbar a:hover { color: #FECB00; }
    .site-topbar i { color: #FECB00; margin-right: 4px; }
    .topbar-inner { display: flex; justify-content: space-between; align-items: center; }
    .topbar-lang button {
        background: transparent;
        border: 1px solid rgba(255,255,255,0.3);
        color: rgba(255,255,255,0.8);
        padding: 2px 12px;
        border-radius: 3px;
        font-size: 0.78rem;
        cursor: pointer;
        transition: all 0.2s;
    }
    .topbar-lang button:hover { background: #FECB00; color: #002266; border-color: #FECB00; }

    /* Identity bar (name + logo) */
    .site-identity {
        background: #003893;
        padding: 10px 0;
        position: relative;
        overflow: hidden;
    }
    .site-identity::before {
        content: '';
        position: absolute; top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(135deg, #003893 60%, #002266 100%);
        z-index: 0;
    }
    .identity-inner {
        display: flex;
        align-items: center;
        gap: 18px;
        position: relative;
        z-index: 1;
    }
    .identity-flag {
        display: flex;
        gap: 4px;
        align-items: center;
        flex-shrink: 0;
    }
    .identity-flag .flag-stripe {
        width: 6px;
        height: 46px;
        border-radius: 3px;
    }
    .flag-stripe.s1 { background: #FF6F00; }
    .flag-stripe.s2 { background: #f5f5f5; }
    .flag-stripe.s3 { background: #FECB00; }
    .flag-stripe.s4 { background: #003893; }

    .identity-photo {
        width: 52px; height: 52px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #FECB00;
        flex-shrink: 0;
    }
    .identity-text { flex: 1; min-width: 0; }
    .identity-name {
        font-family: 'Mukta', 'Noto Sans Devanagari', sans-serif;
        font-size: 1.5rem;
        font-weight: 800;
        color: #fff;
        margin: 0;
        line-height: 1.2;
        letter-spacing: -0.3px;
    }
    .identity-title {
        font-size: 0.78rem;
        color: rgba(255,255,255,0.75);
        margin: 2px 0 0;
        font-weight: 500;
    }
    .identity-tagline {
        font-size: 0.73rem;
        color: #FECB00;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        margin: 3px 0 0;
    }

    .identity-icons {
        display: flex;
        gap: 8px;
        flex-shrink: 0;
    }
    .identity-icons img {
        width: 44px; height: 44px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid rgba(255,255,255,0.3);
    }

    /* Main navigation */
    .site-nav {
        background: #fff;
        border-bottom: 3px solid #FECB00;
        position: sticky;
        top: 0;
        z-index: 1000;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    }
    .nav-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .nav-links-list {
        display: flex;
        list-style: none;
        margin: 0;
        padding: 0;
        gap: 0;
    }
    .nav-links-list > li > a {
        display: block;
        padding: 14px 18px;
        font-size: 0.88rem;
        font-weight: 600;
        color: #1a202c;
        text-decoration: none;
        position: relative;
        transition: color 0.2s;
        white-space: nowrap;
    }
    .nav-links-list > li > a::after {
        content: '';
        position: absolute;
        bottom: 0; left: 16px; right: 16px;
        height: 3px;
        background: #003893;
        border-radius: 2px 2px 0 0;
        transform: scaleX(0);
        transition: transform 0.25s;
    }
    .nav-links-list > li > a:hover,
    .nav-links-list > li > a.active {
        color: #003893;
    }
    .nav-links-list > li > a:hover::after,
    .nav-links-list > li > a.active::after {
        transform: scaleX(1);
    }
    .nav-links-list > li > a.active {
        color: #003893;
        font-weight: 700;
    }

    /* Hamburger */
    .nav-hamburger {
        display: none;
        background: none;
        border: 1px solid #003893;
        color: #003893;
        padding: 7px 12px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 1.1rem;
    }

    /* Mobile drawer */
    @media (max-width: 900px) {
        .site-topbar .topbar-left { display: none; }
        .identity-icons { display: none; }
        .identity-name { font-size: 1.2rem; }

        .nav-hamburger { display: block; }
        .nav-links-list {
            display: none;
            flex-direction: column;
            position: absolute;
            top: 100%; left: 0; right: 0;
            background: #fff;
            border-top: 3px solid #003893;
            box-shadow: 0 8px 20px rgba(0,0,0,0.12);
            z-index: 999;
            padding: 8px 0;
        }
        .nav-links-list.open { display: flex; }
        .nav-links-list > li > a { padding: 13px 20px; border-bottom: 1px solid #f0f0f0; }
        .nav-links-list > li > a::after { display: none; }
        .site-nav { position: sticky; }
        .nav-inner { position: relative; }
    }
    @media (max-width: 576px) {
        .identity-photo { width: 40px; height: 40px; }
        .identity-name { font-size: 1.05rem; }
        .identity-title { font-size: 0.7rem; }
    }
    </style>
</head>
<body>

<!-- ── Top Info Bar ── -->
<div class="site-topbar d-none d-md-block">
    <div class="container">
        <div class="topbar-inner">
            <div class="topbar-left">
                <a href="tel:<?= htmlspecialchars($contact_phone['value_en'] ?: '') ?>">
                    <i class="fas fa-phone"></i><?= htmlspecialchars($contact_phone['value_hi'] ?: '+91-XXXXXXXXXX') ?>
                </a>
                <a href="mailto:<?= htmlspecialchars($contact_email['value_en'] ?: '') ?>">
                    <i class="fas fa-envelope"></i><?= htmlspecialchars($contact_email['value_hi'] ?: 'info@dadduprasad.in') ?>
                </a>
                <span>
                    <i class="fas fa-clock"></i><?= htmlspecialchars($contact_hours['value_hi'] ?: 'सुबह 10:00 - दोपहर 2:00') ?>
                </span>
            </div>
            <div class="topbar-lang">
                <button id="langToggle" aria-label="Toggle Language">
                    <span class="lang-text">A/अ</span> English
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ── Identity Bar ── -->
<div class="site-identity">
    <div class="container">
        <div class="identity-inner">
            <!-- Buddhist flag stripes -->
            <div class="identity-flag d-none d-md-flex">
                <div class="flag-stripe s1"></div>
                <div class="flag-stripe s2"></div>
                <div class="flag-stripe s3"></div>
                <div class="flag-stripe s4"></div>
            </div>

            <!-- Avatar -->
            <img src="https://ui-avatars.com/api/?name=Daddoo+Prasad&background=003893&color=FECB00&size=100&bold=true" alt="दद्दू प्रसाद" class="identity-photo">

            <!-- Name & Title -->
            <div class="identity-text">
                <h1 class="identity-name" data-hi="दद्दू प्रसाद" data-en="Daddoo Prasad">दद्दू प्रसाद</h1>
                <p class="identity-title" data-hi="पूर्व कैबिनेट मंत्री, उत्तर प्रदेश सरकार | समाजवादी पार्टी वरिष्ठ नेता" data-en="Former Cabinet Minister, Govt. of UP | Senior Samajwadi Party Leader">पूर्व कैबिनेट मंत्री, उत्तर प्रदेश सरकार &nbsp;|&nbsp; समाजवादी पार्टी वरिष्ठ नेता</p>
                <p class="identity-tagline d-none d-md-block" data-hi="राष्ट्रीय संयोजक · सामाजिक परिवर्तन मिशन, भारत" data-en="National Convenor · Samajik Parivartan Mission, India">राष्ट्रीय संयोजक · सामाजिक परिवर्तन मिशन, भारत</p>
            </div>

            <!-- Leader icons — lg only -->
            <div class="identity-icons">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/10/Buddha_in_Sarnath_Museum_%28Dhammajak_Mutra%29.jpg/200px-Buddha_in_Sarnath_Museum_%28Dhammajak_Mutra%29.jpg" alt="Buddha">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c3/Dr._Bhimrao_Ambedkar.jpg/200px-Dr._Bhimrao_Ambedkar.jpg" alt="Dr. Ambedkar">
                <img src="https://upload.wikimedia.org/wikipedia/commons/e/ec/Kanshi_ram.jpg" alt="Kanshi Ram">
            </div>
        </div>
    </div>
</div>

<!-- ── Main Navigation ── -->
<nav class="site-nav">
    <div class="container">
        <div class="nav-inner">
            <ul class="nav-links-list" id="mainNavList">
                <li><a href="index.php"        class="<?= $currentPage=='index.php' ?'active':'' ?>" data-hi="होम"        data-en="Home"         >होम</a></li>
                <li><a href="about.php"         class="<?= $currentPage=='about.php' ?'active':'' ?>" data-hi="परिचय"      data-en="About"        >परिचय</a></li>
                <li><a href="achievements.php"  class="<?= $currentPage=='achievements.php'?'active':'' ?>" data-hi="उपलब्धियां" data-en="Achievements">उपलब्धियां</a></li>
                <li><a href="press.php"         class="<?= $currentPage=='press.php' ?'active':'' ?>" data-hi="प्रेस विज्ञप्ति" data-en="Press Notes" >प्रेस</a></li>
                <li><a href="gallery.php"       class="<?= $currentPage=='gallery.php'?'active':'' ?>" data-hi="गैलरी"      data-en="Media"        >गैलरी</a></li>
                <li><a href="contact.php"       class="<?= $currentPage=='contact.php'?'active':'' ?>" data-hi="संपर्क"     data-en="Contact"      >संपर्क</a></li>
            </ul>

            <button class="nav-hamburger" id="navToggle" aria-label="Menu">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>
</nav>

<script>
// Hamburger toggle
(function() {
    var btn = document.getElementById('navToggle');
    var list = document.getElementById('mainNavList');
    if (btn) btn.addEventListener('click', function() {
        list.classList.toggle('open');
        var icon = btn.querySelector('i');
        icon.className = list.classList.contains('open') ? 'fas fa-times' : 'fas fa-bars';
    });
})();
</script>

<main>
