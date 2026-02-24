<?php
require_once 'db.php';

// Settings helper (cached, won't duplicate from db.php)
if (!function_exists('getSettingVal')) {
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
    <title>माननीय दद्दू प्रसाद - पूर्व कैबिनेट मंत्री, उत्तर प्रदेश</title>
    <meta name="description" content="Official website of Hon'ble Daddoo Prasad Ji, Former Cabinet Minister, UP. National Convenor, Samajik Parivartan Mission, India.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind:wght@400;500;600;700&family=Mukta:wght@400;600;700;800&family=Noto+Sans+Devanagari:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">

    <!-- Bootstrap grid only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Site CSS -->
    <link rel="stylesheet" href="style.css">

    <style>
    /* ─── SS HEADER STYLE (matching supriyassule.in) ─── */

    * { box-sizing: border-box; }
    body {
        font-family: 'Hind', 'Mukta', 'Noto Sans Devanagari', sans-serif;
        margin: 0; padding: 0;
        background: #fff;
        color: #1a202c;
    }

    /* White top nav bar */
    .ss-header {
        background: #fff;
        border-bottom: 1px solid #e8edf3;
        position: sticky;
        top: 0;
        z-index: 1000;
        box-shadow: 0 2px 8px rgba(0,0,0,0.07);
    }
    .ss-header-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0;
        height: 70px;
    }

    /* Logo */
    .ss-logo {
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
        flex-shrink: 0;
    }
    .ss-logo-img {
        width: 52px; height: 52px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #003893;
    }
    .ss-logo-text strong {
        display: block;
        font-family: 'Mukta', sans-serif;
        font-size: 1.15rem;
        font-weight: 800;
        color: #003893;
        line-height: 1.2;
    }
    .ss-logo-text span {
        display: block;
        font-size: 0.7rem;
        color: #64748b;
        font-weight: 500;
    }

    /* Nav links */
    .ss-nav-list {
        display: flex;
        list-style: none;
        margin: 0; padding: 0;
        height: 70px;
        align-items: stretch;
    }
    .ss-nav-list > li { display: flex; align-items: stretch; }
    .ss-nav-list > li > a {
        display: flex;
        align-items: center;
        padding: 0 16px;
        font-size: 0.88rem;
        font-weight: 600;
        color: #1a202c;
        text-decoration: none;
        position: relative;
        white-space: nowrap;
        transition: color 0.2s;
    }
    .ss-nav-list > li > a::after {
        content: '';
        position: absolute;
        bottom: 0; left: 10px; right: 10px;
        height: 3px;
        background: #003893;
        border-radius: 2px 2px 0 0;
        transform: scaleX(0);
        transition: transform 0.25s;
    }
    .ss-nav-list > li > a:hover { color: #003893; }
    .ss-nav-list > li > a:hover::after,
    .ss-nav-list > li > a.active::after { transform: scaleX(1); }
    .ss-nav-list > li > a.active { color: #003893; font-weight: 700; }

    /* CTA Button */
    .ss-nav-cta {
        background: #003893;
        color: #fff !important;
        padding: 10px 20px !important;
        border-radius: 4px !important;
        margin-left: 12px;
        align-self: center !important;
        font-size: 0.82rem !important;
        transition: background 0.2s !important;
    }
    .ss-nav-cta:hover { background: #002266 !important; color: #fff !important; }
    .ss-nav-cta::after { display: none !important; }

    /* Lang toggle */
    .ss-lang-btn {
        background: none;
        border: 1px solid #d1d5db;
        color: #6b7280;
        padding: 6px 14px;
        border-radius: 4px;
        font-size: 0.8rem;
        font-weight: 600;
        cursor: pointer;
        margin-left: 8px;
        transition: all 0.2s;
        white-space: nowrap;
    }
    .ss-lang-btn:hover { border-color: #003893; color: #003893; }

    /* Hamburger for mobile */
    .ss-hamburger {
        display: none;
        background: none;
        border: 1px solid #003893;
        color: #003893;
        padding: 8px 12px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 1rem;
    }

    /* Left Social Sidebar (like supriyassule.in) */
    .ss-side-social {
        position: fixed;
        left: 0; top: 50%;
        transform: translateY(-50%);
        z-index: 999;
        display: flex;
        flex-direction: column;
        gap: 6px;
        padding: 10px 8px;
    }
    .ss-side-social a {
        width: 38px; height: 38px;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        color: inherit;
        text-decoration: none;
        border: 2px solid currentColor;
        font-size: 0.9rem;
        transition: all 0.2s;
        background: #fff;
    }
    .ss-side-social a:hover { transform: scale(1.1); }
    .ss-side-social a.fb  { color: #1877F2; }
    .ss-side-social a.tw  { color: #1DA1F2; }
    .ss-side-social a.ig  { color: #E1306C; }
    .ss-side-social a.yt  { color: #FF0000; }

    /* Buddhist Flag stripe (thin, below header) */
    .ss-flag-bar {
        height: 5px;
        display: flex;
    }
    .ss-flag-bar span {
        flex: 1;
        display: block;
    }

    /* Mobile nav */
    @media (max-width: 900px) {
        .ss-hamburger { display: block; }
        .ss-nav-list {
            display: none;
            position: absolute;
            top: 70px; left: 0; right: 0;
            background: #fff;
            flex-direction: column;
            border-top: 3px solid #003893;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            height: auto;
            z-index: 999;
            padding: 8px 0;
        }
        .ss-nav-list.open { display: flex; }
        .ss-nav-list > li { height: 46px; }
        .ss-nav-list > li > a { padding: 0 20px; border-bottom: 1px solid #f0f4f8; font-size: 0.95rem; }
        .ss-nav-list > li > a::after { display: none; }
        .ss-nav-cta { display: none; }
        .ss-side-social { display: none; }
    }
    @media (max-width: 576px) {
        .ss-logo-text span { display: none; }
        .ss-logo-text strong { font-size: 1rem; }
    }
    </style>
</head>
<body>

<!-- ── Left Social Sidebar ── -->
<div class="ss-side-social d-none d-xl-flex">
    <a href="https://www.facebook.com/dadduprasadoffice/" class="fb" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
    <a href="https://twitter.com/dadduprasad" class="tw" target="_blank" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
    <a href="https://instagram.com/daddu.prasad" class="ig" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
    <a href="https://www.youtube.com/@DadduPrasad" class="yt" target="_blank" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
</div>

<!-- ── Sticky Top Navigation ── -->
<header class="ss-header">
    <div class="container">
        <div class="ss-header-inner">

            <!-- Logo -->
            <a href="index.php" class="ss-logo">
                <img src="https://ui-avatars.com/api/?name=DP&background=003893&color=FECB00&size=100&bold=true&font-size=0.45" alt="दद्दू प्रसाद" class="ss-logo-img">
                <div class="ss-logo-text">
                    <strong data-hi="दद्दू प्रसाद" data-en="Daddoo Prasad">दद्दू प्रसाद</strong>
                    <span data-hi="पूर्व कैबिनेट मंत्री" data-en="Former Cabinet Minister">पूर्व कैबिनेट मंत्री</span>
                </div>
            </a>

            <!-- Navigation + CTA -->
            <nav>
                <ul class="ss-nav-list" id="mainNavList">
                    <li><a href="index.php"       class="<?= $currentPage=='index.php'?'active':'' ?>" data-hi="होम"         data-en="Home"        >होम</a></li>
                    <li><a href="about.php"        class="<?= $currentPage=='about.php'?'active':'' ?>" data-hi="परिचय"       data-en="About"       >परिचय</a></li>
                    <li><a href="achievements.php" class="<?= $currentPage=='achievements.php'?'active':'' ?>" data-hi="उपलब्धियां" data-en="Achievements">उपलब्धियां</a></li>
                    <li><a href="press.php"        class="<?= $currentPage=='press.php'?'active':'' ?>" data-hi="प्रेस"        data-en="Press"       >प्रेस</a></li>
                    <li><a href="gallery.php"      class="<?= $currentPage=='gallery.php'?'active':'' ?>" data-hi="गैलरी"       data-en="Gallery"     >गैलरी</a></li>
                    <li><a href="contact.php"      class="<?= $currentPage=='contact.php'?'active':'' ?>" data-hi="संपर्क"      data-en="Contact"     >संपर्क</a></li>
                    <li><a href="contact.php" class="ss-nav-cta" data-hi="#जुड़ें" data-en="#Connect">#जुड़ें</a></li>
                </ul>
            </nav>

            <!-- Right side -->
            <div class="d-flex align-items-center">
                <button id="langToggle" class="ss-lang-btn" aria-label="Toggle Language">
                    <i class="fas fa-language me-1"></i>EN
                </button>
                <button class="ss-hamburger ms-2" id="navToggle" aria-label="Menu">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </div>
</header>

<!-- Buddhist Flag Stripe Bar -->
<div class="ss-flag-bar">
    <span style="background:#FF6F00"></span>
    <span style="background:#ffffff;border-top:1px solid #e8edf3"></span>
    <span style="background:#FECB00"></span>
    <span style="background:#003893"></span>
</div>

<script>
// Hamburger
(function(){
    var btn = document.getElementById('navToggle');
    var list = document.getElementById('mainNavList');
    if(btn) btn.addEventListener('click', function(){
        list.classList.toggle('open');
        btn.querySelector('i').className = list.classList.contains('open') ? 'fas fa-times' : 'fas fa-bars';
    });
    // Close on outside click
    document.addEventListener('click', function(e){
        if(btn && list && !btn.contains(e.target) && !list.contains(e.target)){
            list.classList.remove('open');
            btn.querySelector('i').className = 'fas fa-bars';
        }
    });
})();
</script>

<main>
