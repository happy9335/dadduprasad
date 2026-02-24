<?php
require_once 'db.php';

// Fetch settings
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

$contact_address = getSettingVal($pdo, 'contact_address');
$contact_phone = getSettingVal($pdo, 'contact_phone');
$contact_email = getSettingVal($pdo, 'contact_email');
$contact_hours = getSettingVal($pdo, 'contact_hours');

$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="hi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-hi="माननीय दद्दू प्रसाद - पूर्व कैबिनेट मंत्री" data-en="Hon'ble Daddoo Prasad - Former Cabinet Minister">माननीय दद्दू प्रसाद - पूर्व कैबिनेट मंत्री</title>
    
    <meta name="description" content="Official website of Hon'ble Daddoo Prasad, Former Cabinet Minister, Uttar Pradesh. Dedicated to social justice, equality, and constitutional values.">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind:wght@400;500;600;700&family=Mukta:wght@400;500;600;700&family=Noto+Sans+Devanagari:wght@400;500;600;700&family=Open+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Custom Banner Header -->
    <div class="top-custom-banner">
        <div class="banner-stripes">
            <div class="stripe orange"></div>
            <div class="stripe white"></div>
            <div class="stripe yellow"></div>
            <div class="stripe blue"></div>
        </div>
        <div class="container banner-content-wrapper pb-0 pt-2 position-relative h-100">
            <div class="d-flex w-100 h-100 align-items-end justify-content-between">
                <div class="banner-left h-100">
                    <img src="https://ui-avatars.com/api/?name=Daddoo+Prasad&background=FF6F00&color=fff&size=200" alt="Daddoo Prasad" class="banner-main-img img-fluid rounded-circle shadow" style="border: 5px solid white; max-height:120px; object-fit:cover; margin-bottom: 5px;">
                </div>
                
                <div class="banner-center text-center pb-2">
                    <h1 class="banner-title text-white fw-bold mb-1" style="text-shadow: 2px 2px 5px rgba(0,0,0,0.8), -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;">दद्दू प्रसाद</h1>
                    <p class="banner-subtitle text-white fw-bold mb-0 px-3 py-1 rounded shadow-sm" style="background-color: var(--blue); font-size: 0.95rem;">
                        पूर्व कैबिनेट मंत्री, U.P. Gov., समाजवादी पार्टी नेता और राष्ट्रीय संयोजक, सामाजिक परिवर्तन मिशन, भारत
                    </p>
                </div>

                <div class="banner-right pb-2 d-none d-lg-flex gap-3">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/10/Buddha_in_Sarnath_Museum_%28Dhammajak_Mutra%29.jpg/200px-Buddha_in_Sarnath_Museum_%28Dhammajak_Mutra%29.jpg" alt="Buddha" class="circle-icon rounded-circle shadow border border-3 border-white" style="width: 80px; height: 80px; object-fit: cover;">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c3/Dr._Bhimrao_Ambedkar.jpg/200px-Dr._Bhimrao_Ambedkar.jpg" alt="Dr Ambedkar" class="circle-icon rounded-circle shadow border border-3 border-white" style="width: 80px; height: 80px; object-fit: cover;">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/e/ec/Kanshi_ram.jpg" alt="Kanshi Ram" class="circle-icon rounded-circle shadow border border-3 border-white" style="width: 80px; height: 80px; object-fit: cover;">
                </div>
            </div>
        </div>
    </div>

    <!-- Header & Navigation -->
    <header class="main-header sticky-header shadow-sm" style="background: white;">
        <div class="container header-container">
            <button class="mobile-menu-toggle d-md-none" aria-label="Toggle Menu">
                <i class="fas fa-bars"></i>
            </button>
            <nav class="main-nav w-100 d-flex justify-content-between align-items-center">
                <ul class="nav-links mb-0 w-100 justify-content-center">
                    <li><a href="index.php" class="nav-link <?= $currentPage == 'index.php' ? 'active' : '' ?>" data-hi="होम" data-en="Home">होम</a></li>
                    <li><a href="about.php" class="nav-link <?= $currentPage == 'about.php' ? 'active' : '' ?>" data-hi="परिचय" data-en="About">परिचय</a></li>
                    <li><a href="achievements.php" class="nav-link <?= $currentPage == 'achievements.php' ? 'active' : '' ?>" data-hi="उपलब्धियां" data-en="Achievements">उपलब्धियां</a></li>
                    <li><a href="gallery.php" class="nav-link <?= $currentPage == 'gallery.php' ? 'active' : '' ?>" data-hi="गैलरी" data-en="Media Gallery">गैलरी</a></li>
                    <li><a href="press.php" class="nav-link <?= $currentPage == 'press.php' ? 'active' : '' ?>" data-hi="प्रेस" data-en="Press">प्रेस</a></li>
                    <li><a href="contact.php" class="nav-link <?= $currentPage == 'contact.php' ? 'active' : '' ?>" data-hi="संपर्क" data-en="Contact">संपर्क</a></li>
                </ul>
                <div class="lang-toggle-container ms-auto">
                    <button id="langToggle" class="btn btn-outline-primary btn-sm" aria-label="Toggle Language">
                        <span class="lang-text">A/अ</span> English
                    </button>
                </div>
            </nav>
        </div>
    </header>

    <main>
