    <?php
    require_once 'includes/header.php';

    /* ═══ DB FETCH — All sections ═══ */
    $tagline    = getSettingVal($pdo, 'hero_tagline');
    $intro_row  = getSettingVal($pdo, 'hero_intro');
    $about_lead = getSettingVal($pdo, 'about_lead');

    $tagline_hi = $tagline['value_hi']  ?: '"सामाजिक न्याय, समता और संवैधानिक अधिकारों की रक्षा ही मेरा संकल्प है।"';
    $tagline_en = $tagline['value_en']  ?: '"Committed to Social Justice, Equality and Constitutional Rights"';
    $intro_hi   = $intro_row['value_hi']?: 'माननीय श्री दद्दू प्रसाद जी उत्तर प्रदेश सरकार में पूर्व कैबिनेट मंत्री रह चुके हैं।';
    $intro_en   = $intro_row['value_en']?: "Hon'ble Shri Daddoo Prasad Ji is a former Cabinet Minister in the Government of Uttar Pradesh.";
    $about_hi   = $about_lead['value_hi']?: 'श्री दद्दू प्रसाद जी एक अनुभवी राजनेता एवं सामाजिक चिंतक हैं।';
    $about_en   = $about_lead['value_en']?: 'Shri Daddoo Prasad Ji is an experienced politician and social thinker.';

    $sliders      = $pdo->query("SELECT * FROM home_slider       ORDER BY display_order ASC")->fetchAll();
    $pressReleases= $pdo->query("SELECT * FROM press_releases    ORDER BY release_date  DESC LIMIT 5")->fetchAll();
    $achievements = $pdo->query("SELECT * FROM achievements      ORDER BY display_order  ASC  LIMIT 6")->fetchAll();
    $journey      = $pdo->query("SELECT * FROM biography         ORDER BY display_order  ASC")->fetchAll();
    $media        = $pdo->query("SELECT * FROM media_gallery WHERE media_type='video' ORDER BY display_order ASC LIMIT 3")->fetchAll();

    /* Fallback demo — DB rows from your SQL */
    if (empty($sliders)) {
        $sliders = [
            ['image_url'=>'https://www.bjp.org/files/photo-gallery/Hon%27ble%20BJP%20National%20President%20Shri%20J.P.%20Nadda%20addressing%20a%20public%20rally%20at%20Highmid%20Ground%20Sonbhadra%20%28Robertsganj%29%20Uttar%20Pradesh%20%284%29.jpg','title_hi'=>'सामाजिक न्याय के प्रति संकल्पित','title_en'=>'Committed to Social Justice'],
            ['image_url'=>'https://img-s-msn-com.akamaized.net/tenant/amp/entityid/AA1OVQr7.img?f=jpg&h=580&m=6&q=80&u=t&w=900','title_hi'=>'निरंतर जनसेवा का प्रयास','title_en'=>'Continuous Effort in Public Service'],
            ['image_url'=>'https://static.toiimg.com/thumb/msid-117165608%2Cwidth-1070%2Cheight-580%2Cimgsize-102798%2Cresizemode-75%2Coverlay-toi_sw%2Cpt-32%2Cy_pad-40/photo.jpg','title_hi'=>'जन सेवा ही परमो धर्मः','title_en'=>'Service to People is Supreme Duty'],
        ];
    }
    if (empty($pressReleases)) {
        $pressReleases = [
            ['title_hi'=>'सामाजिक न्याय सम्मेलन में संबोधन','title_en'=>'Addressed Social Justice Conference','release_date'=>'2026-02-24','image_url'=>'','location_hi'=>'लखनऊ'],
            ['title_hi'=>'ग्रामीण विकास योजनाओं का शुभारंभ','title_en'=>'Rural Development Schemes Launch','release_date'=>'2026-02-20','image_url'=>'','location_hi'=>'लखनऊ'],
            ['title_hi'=>'युवाओं के लिए रोजगार सृजन अभियान','title_en'=>'Employment Drive for Youth','release_date'=>'2026-02-15','image_url'=>'','location_hi'=>'लखनऊ'],
            ['title_hi'=>'संविधान जागरूकता अभियान का शुभारंभ','title_en'=>'Constitution Awareness Campaign','release_date'=>'2026-02-10','image_url'=>'','location_hi'=>'प्रयागराज'],
        ];
    }
    ?>
    <!-- ═══════════════════════════════════
        HERO SECTION  (Full-screen slider)
        ═══════════════════════════════════ -->
    <style>
    /* ═══ HERO OVERRIDES — beats everything in style.css ═══ */
    .hero-wrap {
    position: relative !important;
    overflow: hidden !important;
    display: block !important;
    width: 100% !important;
    }
    /* Force Swiper to take height */
    .heroSwiper {
    width: 100% !important;
    height: 88vh !important;
    min-height: 540px !important;
    display: block !important;
    }
    .heroSwiper .swiper-wrapper {
    height: 100% !important;
    }
    .heroSwiper .swiper-slide {
    position: relative !important;
    width: 100% !important;
    height: 100% !important;
    overflow: hidden !important;
    display: block !important;   /* Swiper needs block, not flex */
    }

    /* Background image that fills each slide */
    .hero-slide-bg {
    position: absolute;
    inset: 0;
    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;
    transition: transform 8s ease;
    transform: scale(1.05);
    }
    .swiper-slide-active .hero-slide-bg { transform: scale(1.0); }

    /* Left gradient overlay so text is readable */
    .hero-slide-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        100deg,
        rgba(0, 34, 100, 0.85) 0%,
        rgba(0, 56, 147, 0.70) 40%,
        rgba(0, 0, 0, 0.10) 100%
    );
    z-index: 1;
    }

    /* Text block */
    .hero-slide-body {
    position: absolute;
    inset: 0;
    z-index: 2;
    display: flex;
    align-items: center;
    padding: 0 0 80px;   /* pull up, leave room for bottom strip */
    }
    .hero-slide-content {
    max-width: 640px;
    padding: 0 40px;
    }

    .hero-kicker {
    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 2.5px;
    text-transform: uppercase;
    color: #FECB00;
    margin: 0 0 14px;
    }
    .hero-title {
    font-family: 'Mukta', 'Noto Sans Devanagari', sans-serif;
    font-size: clamp(1.8rem, 4vw, 3.2rem);
    font-weight: 800;
    color: #fff;
    line-height: 1.2;
    margin: 0 0 28px;
    text-shadow: 0 2px 12px rgba(0,0,0,0.3);
    }
    .hero-title .orange-word { color: #FECB00; }

    .hero-actions { display: flex; gap: 14px; flex-wrap: wrap; margin-bottom: 28px; }
    .hero-btn-primary {
    background: #fff;
    color: #003893 !important;
    padding: 13px 30px;
    border-radius: 4px;
    text-decoration: none;
    font-weight: 700;
    font-size: 0.9rem;
    transition: all .25s;
    display: inline-block;
    }
    .hero-btn-primary:hover { background: #FECB00; color: #003893 !important; transform: translateY(-2px); }
    .hero-btn-ghost {
    border: 2px solid rgba(255,255,255,0.7);
    color: #fff !important;
    padding: 11px 28px;
    border-radius: 4px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    transition: all .25s;
    display: inline-block;
    }
    .hero-btn-ghost:hover { border-color: #fff; background: rgba(255,255,255,0.12); }

    .hero-links { display: flex; gap: 20px; flex-wrap: wrap; }
    .hero-links a {
    color: rgba(255,255,255,0.8);
    text-decoration: none;
    font-size: 0.82rem;
    font-weight: 600;
    display: flex; align-items: center; gap: 6px;
    border-bottom: 1px solid rgba(255,255,255,0.25);
    padding-bottom: 2px;
    transition: color .2s, border-color .2s;
    }
    .hero-links a i { color: #FECB00; }
    .hero-links a:hover { color: #fff; border-color: #FECB00; }

    /* Swiper controls */
    .heroSwiper .swiper-button-prev,
    .heroSwiper .swiper-button-next {
    color: #fff !important;
    background: rgba(0,56,147,0.65) !important;
    width: 46px !important; height: 46px !important;
    border-radius: 50% !important;
    transition: background .2s !important;
    }
    .heroSwiper .swiper-button-prev:hover,
    .heroSwiper .swiper-button-next:hover { background: #003893 !important; }
    .heroSwiper .swiper-button-prev::after,
    .heroSwiper .swiper-button-next::after { font-size: 0.9rem !important; font-weight: 900; }

    .heroSwiper .swiper-pagination-bullet {
    background: rgba(255,255,255,0.5);
    width: 28px; height: 4px;
    border-radius: 2px;
    margin: 0 3px !important;
    }
    .heroSwiper .swiper-pagination-bullet-active {
    background: #FECB00;
    width: 44px;
    }

    /* Bottom strip */
    .hero-bottom-strip {
    background: linear-gradient(90deg, #003893 0%, #D21034 100%);
    padding: 13px 0;
    }
    .hero-strip-inner {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    }
    .hero-strip-inner p {
    color: rgba(255,255,255,0.9);
    font-size: 0.87rem;
    margin: 0;
    flex: 1;
    }
    .hero-strip-inner a {
    color: #FECB00;
    font-weight: 700;
    text-decoration: none;
    font-size: 0.88rem;
    white-space: nowrap;
    }

    /* Responsive */
    @media (max-width: 992px) { .heroSwiper { height: 78vh; min-height: 420px; } }
    @media (max-width: 768px) {
    .heroSwiper { height: 72vh; min-height: 380px; }
    .hero-slide-content { padding: 0 20px; }
    .hero-title { font-size: 1.6rem; }
    .hero-actions { flex-direction: column; gap: 10px; }
    .hero-strip-inner { flex-direction: column; gap: 6px; text-align: center; }
    }
    @media (max-width: 480px) {
    .heroSwiper { height: 65vh; min-height: 320px; }
    .hero-title { font-size: 1.3rem; }
    .hero-links { gap: 10px; }
    }
    </style>

    <div class="hero-wrap" style="position:relative;overflow:hidden;display:block;width:100%;">
        <div class="swiper heroSwiper" style="width:100%;height:88vh;min-height:540px;display:block;overflow:hidden;">
            <div class="swiper-wrapper" style="height:100%;">
                <?php foreach ($sliders as $sl): ?>
                <div class="swiper-slide" style="position:relative;width:100%;height:100%;overflow:hidden;">
                    <!-- BG photo fills full slide -->
                    <div class="hero-slide-bg" style="background-image:url('<?= htmlspecialchars($sl['image_url']) ?>')"></div>
                    <!-- Dark left gradient overlay -->
                    <div class="hero-slide-overlay"></div>
                    <!-- Text content LEFT-ALIGNED -->
                    <div class="hero-slide-body">
                        <div class="hero-slide-content">
                            <p class="hero-kicker" data-hi="पूर्व कैबिनेट मंत्री · उत्तर प्रदेश सरकार" data-en="Former Cabinet Minister · Govt. of Uttar Pradesh">
                                पूर्व कैबिनेट मंत्री · उत्तर प्रदेश सरकार
                            </p>
                            <h1 class="hero-title"
                                data-hi="<?= htmlspecialchars($sl['title_hi'] ?? $tagline_hi) ?>"
                                data-en="<?= htmlspecialchars($sl['title_en'] ?? $tagline_en) ?>">
                                <?= htmlspecialchars($sl['title_hi'] ?? $tagline_hi) ?>
                            </h1>
                            <div class="hero-actions">
                                <a href="about.php" class="hero-btn-primary" data-hi="परिचय पढ़ें" data-en="Know More">परिचय पढ़ें</a>
                                <a href="contact.php" class="hero-btn-ghost" data-hi="संपर्क करें" data-en="Contact Us">संपर्क करें</a>
                            </div>
                            <div class="hero-links">
                                <a href="press.php"><i class="fas fa-newspaper"></i><span data-hi="प्रेस विज्ञप्ति" data-en="Press Notes">प्रेस विज्ञप्ति</span></a>
                                <a href="gallery.php"><i class="fas fa-images"></i><span data-hi="गैलरी" data-en="Gallery">गैलरी</span></a>
                                <a href="contact.php"><i class="fas fa-calendar-alt"></i><span data-hi="जनसुनवाई" data-en="Hearings">जनसुनवाई</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
        <!-- Bottom strip -->
        <div class="hero-bottom-strip">
            <div class="container">
                <div class="hero-strip-inner">
                    <p data-hi="<?= htmlspecialchars($tagline_hi) ?>" data-en="<?= htmlspecialchars($tagline_en) ?>">
                        <?= htmlspecialchars(mb_substr($tagline_hi, 0, 90)) ?>...
                    </p>
                    <a href="about.php" data-hi="अधिक जानें →" data-en="Know More →">अधिक जानें →</a>
                </div>
            </div>
        </div>
    </div>




    <!-- ═══════════════════════════════════
        ABOUT SECTION
        ═══════════════════════════════════ -->
    <section class="ss-section ss-about">
        <div class="container">
            <div class="row align-items-center g-0">
                <!-- Portrait column -->
                <div class="col-lg-4 col-md-5">
                    <div class="ss-portrait-wrap">
                        <img src="https://m.media-amazon.com/images/I/51dQBAlC7rL.jpg" alt="दद्दू प्रसाद" class="ss-portrait">
                        <div class="ss-portrait-label">
                            <span data-hi="दद्दू प्रसाद" data-en="Daddoo Prasad">दद्दू प्रसाद</span>
                            <small data-hi="पूर्व कैबिनेट मंत्री" data-en="Former Cabinet Minister">पूर्व कैबिनेट मंत्री</small>
                        </div>
                        <div class="ss-portrait-stats">
                            <div class="ss-stat"><strong>30+</strong><span data-hi="वर्ष सेवा" data-en="Yrs Service">वर्ष सेवा</span></div>
                            <div class="ss-stat"><strong>SP</strong><span data-hi="वरिष्ठ नेता" data-en="Sr. Leader">वरिष्ठ नेता</span></div>
                            <div class="ss-stat"><strong>UP</strong><span data-hi="कैबिनेट मंत्री" data-en="Cabinet Min.">कैबिनेट मंत्री</span></div>
                        </div>
                    </div>
                </div>

                <!-- Text column -->
                <div class="col-lg-8 col-md-7 ps-md-5 pt-4 pt-md-0">
                    <p class="ss-section-kicker" data-hi="परिचय" data-en="About">परिचय</p>
                    <h2 class="ss-section-heading" data-hi="दद्दू प्रसाद" data-en="Daddoo Prasad">दद्दू प्रसाद</h2>
                    <div class="ss-rule"></div>
                    <p class="ss-about-text mb-4" data-hi="<?= htmlspecialchars($about_hi) ?>" data-en="<?= htmlspecialchars($about_en) ?>">
                        <?= nl2br(htmlspecialchars($about_hi)) ?>
                    </p>
                    <p class="ss-about-text" data-hi="<?= htmlspecialchars($intro_hi) ?>" data-en="<?= htmlspecialchars($intro_en) ?>">
                        <?= nl2br(htmlspecialchars($intro_hi)) ?>
                    </p>
                    <blockquote class="ss-blockquote">
                        <p data-hi="&quot;मेरा लक्ष्य है कि समाज का हर व्यक्ति सम्मान और अधिकार के साथ जीवन जी सके।&quot;" data-en="&quot;My goal is that every person in society can live with dignity and rights.&quot;">
                            "मेरा लक्ष्य है कि समाज का हर व्यक्ति सम्मान और अधिकार के साथ जीवन जी सके।"
                        </p>
                        <footer>— दद्दू प्रसाद</footer>
                    </blockquote>
                    <div class="mt-4 d-flex gap-3 flex-wrap">
                        <a href="about.php" class="ss-btn-primary" data-hi="पूरा परिचय पढ़ें" data-en="Read More">पूरा परिचय पढ़ें</a>
                        <a href="achievements.php" class="ss-btn-ghost" data-hi="उपलब्धियाँ" data-en="Achievements">उपलब्धियाँ</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════
        PRESS RELEASES
        ═══════════════════════════════════ -->
    <section class="ss-section ss-press">
        <div class="container">
            <div class="ss-section-top">
                <div>
                    <p class="ss-section-kicker" data-hi="मीडिया" data-en="Media">मीडिया</p>
                    <h2 class="ss-section-heading" data-hi="प्रेस विज्ञप्ति" data-en="Press Releases">प्रेस विज्ञप्ति</h2>
                    <div class="ss-rule"></div>
                </div>
                <a href="press.php" class="ss-link-more" data-hi="सभी देखें →" data-en="View All →">सभी देखें →</a>
            </div>
            <div class="row g-0">
                <!-- Featured -->
                <?php $feat = $pressReleases[0]; ?>
                <div class="col-md-5">
                    <a href="press.php" class="ss-press-big">
                        <div class="ss-press-big-img" style="background-image:url('<?= !empty($feat['image_url']) ? htmlspecialchars($feat['image_url']) : 'https://via.placeholder.com/600x400/003893/FECB00?text=Press' ?>')"></div>
                        <div class="ss-press-big-body">
                            <span class="ss-press-date"><?= date('d M Y', strtotime($feat['release_date'])) ?></span>
                            <h3 class="ss-press-big-title" data-hi="<?= htmlspecialchars($feat['title_hi']) ?>" data-en="<?= htmlspecialchars($feat['title_en']) ?>">
                                <?= htmlspecialchars($feat['title_hi']) ?>
                            </h3>
                            <?php if (!empty($feat['location_hi'])): ?>
                            <p style="color:rgba(255,255,255,.7);font-size:.8rem;margin:6px 0 0;">
                                <i class="fas fa-map-marker-alt me-1"></i><?= htmlspecialchars($feat['location_hi']) ?>
                            </p>
                            <?php endif; ?>
                        </div>
                    </a>
                </div>
                <!-- List -->
                <div class="col-md-7">
                    <ul class="ss-press-list">
                        <?php for ($i=1; $i < count($pressReleases) && $i < 5; $i++): $p = $pressReleases[$i]; ?>
                        <li class="ss-press-item">
                            <a href="press.php" class="ss-press-item-link">
                                <span class="ss-press-item-date"><?= date('d M Y', strtotime($p['release_date'])) ?></span>
                                <span class="ss-press-item-title" data-hi="<?= htmlspecialchars($p['title_hi']) ?>" data-en="<?= htmlspecialchars($p['title_en']) ?>">
                                    <?= htmlspecialchars(mb_substr($p['title_hi'], 0, 80)) ?>
                                </span>
                                <i class="fas fa-chevron-right ss-list-icon"></i>
                            </a>
                        </li>
                        <?php endfor; ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════
        ACHIEVEMENTS (dark section)
        ═══════════════════════════════════ -->
    <section class="ss-section ss-ach">
        <div class="container">
            <div class="ss-section-top">
                <div>
                    <p class="ss-section-kicker kicker-light" data-hi="मील के पत्थर" data-en="Milestones">मील के पत्थर</p>
                    <h2 class="ss-section-heading text-white" data-hi="उपलब्धियाँ एवं पुरस्कार" data-en="Achievements & Awards">उपलब्धियाँ एवं पुरस्कार</h2>
                    <div class="ss-rule" style="background:var(--ss-yellow,#FECB00)"></div>
                </div>
                <a href="achievements.php" class="ss-link-more" style="color:rgba(255,255,255,0.65);" data-hi="सभी देखें →" data-en="View All →">सभी देखें →</a>
            </div>
            <div class="row g-4">
                <?php
                $achIcons = ['fas fa-balance-scale','fas fa-graduation-cap','fas fa-home','fas fa-shield-alt','fas fa-book-open','fas fa-users'];
                foreach ($achievements as $i => $ach): if ($i >= 6) break; ?>
                <div class="col-md-4 col-6">
                    <div class="ss-ach-card">
                        <i class="<?= $achIcons[$i % 6] ?> ss-ach-icon"></i>
                        <p class="ss-ach-text" data-hi="<?= htmlspecialchars($ach['category_hi']) ?>" data-en="<?= htmlspecialchars($ach['category_en']) ?>">
                            <?= htmlspecialchars($ach['category_hi']) ?>
                        </p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════
        POLITICAL JOURNEY (Timeline)
        ═══════════════════════════════════ -->
    <section class="ss-section ss-journey">
        <div class="container">
            <div class="row align-items-start g-5">
                <!-- Sticky left intro -->
                <div class="col-lg-4">
                    <div class="ss-journey-intro sticky-top" style="top:90px">
                        <p class="ss-section-kicker" data-hi="राजनीतिक सफर" data-en="Political Journey">राजनीतिक सफर</p>
                        <h2 class="ss-section-heading" data-hi="नेतृत्व. अनुभव. मूल्य." data-en="Leadership. Experience. Values.">नेतृत्व.<br>अनुभव.<br>मूल्य.</h2>
                        <div class="ss-rule"></div>
                        <p class="ss-journey-desc">पिछले 30 वर्षों में दद्दू प्रसाद जी ने समाजवादी पार्टी के वरिष्ठ नेता और सामाजिक परिवर्तन मिशन के राष्ट्रीय संयोजक के रूप में खुद को स्थापित किया है।</p>
                        <a href="about.php" class="ss-btn-primary mt-3">पूरी जीवनी पढ़ें →</a>
                    </div>
                </div>
                <!-- Timeline -->
                <div class="col-lg-8">
                    <div class="ss-timeline">
                        <?php foreach ($journey as $idx => $item): ?>
                        <div class="ss-tl-item">
                            <div class="ss-tl-dot"></div>
                            <div class="ss-tl-card">
                                <div class="ss-tl-year">0<?= $idx+1 ?></div>
                                <h4 class="ss-tl-title" data-hi="<?= htmlspecialchars($item['title_hi']) ?>" data-en="<?= htmlspecialchars($item['title_en']) ?>">
                                    <?= htmlspecialchars($item['title_hi']) ?>
                                </h4>
                                <p class="ss-tl-desc" data-hi="<?= htmlspecialchars($item['content_hi']) ?>" data-en="<?= htmlspecialchars($item['content_en']) ?>">
                                    <?= htmlspecialchars($item['content_hi']) ?>
                                </p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════
        NEWS + SOCIAL MEDIA
        ═══════════════════════════════════ -->
    <section class="ss-section ss-news-social">
        <div class="container">
            <div class="row g-5">
                <!-- Latest News -->
                <div class="col-lg-7">
                    <p class="ss-section-kicker" data-hi="ताज़ा खबरें" data-en="Latest News">ताज़ा खबरें</p>
                    <h2 class="ss-section-heading" data-hi="नवीनतम समाचार" data-en="Latest News">नवीनतम समाचार</h2>
                    <div class="ss-rule"></div>
                    <ul class="ss-news-list">
                        <?php foreach ($pressReleases as $i => $p): if ($i >= 5) break; ?>
                        <li class="ss-news-item">
                            <a href="press.php" class="ss-news-link">
                                <div class="ss-news-date">
                                    <span class="ss-news-day"><?= date('d', strtotime($p['release_date'])) ?></span>
                                    <span class="ss-news-mon"><?= date('M Y', strtotime($p['release_date'])) ?></span>
                                </div>
                                <div class="ss-news-body">
                                    <p class="ss-news-title"
                                    data-hi="<?= htmlspecialchars($p['title_hi']) ?>"
                                    data-en="<?= htmlspecialchars($p['title_en']) ?>">
                                        <?= htmlspecialchars(mb_substr($p['title_hi'], 0, 100)) ?>
                                    </p>
                                    <span class="ss-news-cta" data-hi="आगे पढ़ें →" data-en="Read More →">आगे पढ़ें →</span>
                                </div>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Social Connect -->
                <div class="col-lg-5">
                    <p class="ss-section-kicker" data-hi="सोशल मीडिया" data-en="Social Media">सोशल मीडिया</p>
                    <h2 class="ss-section-heading" data-hi="जुड़े रहें" data-en="Stay Connected">जुड़े रहें</h2>
                    <div class="ss-rule"></div>

                    <?php
                    $fbLink  = getSettingVal($pdo, 'fb_link')['value_en']  ?: 'https://www.facebook.com/dadduprasadoffice/';
                    $twLink  = getSettingVal($pdo, 'twitter_link')['value_en']?: 'https://twitter.com/dadduprasad';
                    $igLink  = getSettingVal($pdo, 'ig_link')['value_en']   ?: 'https://instagram.com/daddu.prasad';
                    $ytLink  = getSettingVal($pdo, 'yt_link')['value_en']   ?: 'https://www.youtube.com/@DadduPrasad';
                    ?>
                    <div class="ss-socials">
                        <a href="<?= htmlspecialchars($fbLink) ?>" target="_blank" class="ss-social-btn fb"><i class="fab fa-facebook-f"></i> Facebook पर फॉलो करें</a>
                        <a href="<?= htmlspecialchars($twLink) ?>" target="_blank" class="ss-social-btn tw"><i class="fab fa-twitter"></i> Twitter पर फॉलो करें</a>
                        <a href="<?= htmlspecialchars($igLink) ?>" target="_blank" class="ss-social-btn ig"><i class="fab fa-instagram"></i> Instagram पर फॉलो करें</a>
                        <a href="<?= htmlspecialchars($ytLink) ?>" target="_blank" class="ss-social-btn yt"><i class="fab fa-youtube"></i> YouTube सब्सक्राइब करें</a>
                    </div>

                    <?php if (!empty($media)): ?>
                    <div class="mt-4">
                        <?php foreach ($media as $vid): ?>
                        <div class="ss-yt-wrap mb-3">
                            <iframe src="<?= htmlspecialchars(getYoutubeEmbedUrl($vid['media_url'])) ?>" frameborder="0" allowfullscreen width="100%" height="200" loading="lazy"></iframe>
                            <?php if (!empty($vid['caption_hi'])): ?>
                            <p class="ss-yt-caption mt-1"><?= htmlspecialchars($vid['caption_hi']) ?></p>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php else: ?>
                    <div class="ss-yt-placeholder mt-4">
                        <i class="fab fa-youtube fa-3x text-danger mb-3 d-block"></i>
                        <p data-hi="यूट्यूब चैनल देखें" data-en="Watch on YouTube">यूट्यूब चैनल देखें</p>
                        <a href="<?= htmlspecialchars($ytLink) ?>" target="_blank" class="ss-btn-primary mt-2">Subscribe Now</a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════
        CONTACT STRIP
        ═══════════════════════════════════ -->
    <section class="ss-contact-strip">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-md-8">
                    <h3 class="ss-contact-title" data-hi="हमसे संपर्क करें" data-en="Get in Touch">हमसे संपर्क करें</h3>
                    <?php
                    $addr  = getSettingVal($pdo, 'contact_address');
                    $phone = getSettingVal($pdo, 'contact_phone');
                    $email = getSettingVal($pdo, 'contact_email');
                    $hours = getSettingVal($pdo, 'contact_hours');
                    ?>
                    <div class="ss-contact-details">
                        <span><i class="fas fa-map-marker-alt me-2"></i><?= htmlspecialchars($addr['value_hi'] ?: 'लखनऊ, उत्तर प्रदेश') ?></span>
                        <span><i class="fas fa-phone me-2"></i><a href="tel:<?= htmlspecialchars($phone['value_en']) ?>"><?= htmlspecialchars($phone['value_hi'] ?: '+91 XXXXXXXXXX') ?></a></span>
                        <span><i class="fas fa-envelope me-2"></i><a href="mailto:<?= htmlspecialchars($email['value_en']) ?>"><?= htmlspecialchars($email['value_hi'] ?: 'info@dadduprasad.in') ?></a></span>
                        <span><i class="fas fa-clock me-2"></i><?= htmlspecialchars($hours['value_hi'] ?: 'सुबह 10:00 - दोपहर 2:00') ?></span>
                    </div>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="contact.php" class="ss-btn-primary" data-hi="संदेश भेजें" data-en="Send Message">संदेश भेजें <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>
    </section>

    <?php require_once 'includes/footer.php'; ?>
