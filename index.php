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
    $media        = $pdo->query("SELECT * FROM media_gallery ORDER BY display_order ASC")->fetchAll();
    $latestBlogs  = $pdo->query("SELECT * FROM blog_posts ORDER BY publish_date DESC LIMIT 3")->fetchAll();

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
    height: 65vh !important;
    min-height: 450px !important;
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
    max-width: 750px;
    padding: 0 40px 0 10vw; /* Increased from 6vw to 10vw to push text further right */
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
    @media (max-width: 992px) { .heroSwiper { height: 60vh; min-height: 400px; } }
    @media (max-width: 768px) {
    .heroSwiper { height: 55vh; min-height: 380px; }
    .hero-slide-content { padding: 0 20px; }
    .hero-title { font-size: 1.6rem; }
    .hero-actions { flex-direction: column; gap: 10px; }
    .hero-strip-inner { flex-direction: column; gap: 6px; text-align: center; }
    }
    @media (max-width: 480px) {
    .heroSwiper { height: 50vh; min-height: 320px; }
    .hero-title { font-size: 1.3rem; }
    .hero-links { gap: 10px; }
    }
    </style>

    <div class="hero-wrap" style="position:relative;overflow:hidden;display:block;width:100%;">
        <div class="swiper heroSwiper" style="width:100%;height:65vh;min-height:450px;display:block;overflow:hidden;">
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
                                <?php if (!empty($sl['button_link'])): ?>
                                    <a href="<?= htmlspecialchars($sl['button_link']) ?>" class="hero-btn-primary" data-hi="और जानें" data-en="Learn More">और जानें</a>
                                <?php else: ?>
                                    <a href="about.php" class="hero-btn-primary" data-hi="परिचय पढ़ें" data-en="Know More">परिचय पढ़ें</a>
                                    <a href="contact.php" class="hero-btn-ghost" data-hi="संपर्क करें" data-en="Contact Us">संपर्क करें</a>
                                <?php endif; ?>
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
         ABOUT SECTION  (supriyassule.in style)
         ═══════════════════════════════════ -->
    <style>
    /* About — SS style */
    .sa-about { background: #fff; padding: 60px 0 0; overflow: hidden; }
    .sa-about-inner { display: flex; align-items: stretch; gap: 0; }

    /* Left text col */
    .sa-text-col {
        flex: 0 0 52%;
        padding: 48px 56px 48px 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .sa-kicker {
        font-size: 0.68rem;
        font-weight: 800;
        letter-spacing: 2.5px;
        text-transform: uppercase;
        color: #D21034;
        margin-bottom: 10px;
    }
    .sa-name {
        font-family: 'Mukta', 'Noto Sans Devanagari', sans-serif;
        font-size: 2.6rem;
        font-weight: 800;
        color: #f97316; /* Orange Section Heading */
        line-height: 1.1;
        margin: 0 0 14px;
    }
    .sa-rule {
        width: 44px; height: 4px;
        background: #D21034;
        border-radius: 2px;
        margin-bottom: 22px;
    }
    .sa-desc {
        font-size: 0.92rem;
        color: #4a5568;
        line-height: 1.85;
        margin-bottom: 22px;
        max-width: 520px;
    }
    /* Big decorative quote */
    .sa-quote-wrap {
        position: relative;
        margin: 4px 0 30px;
        padding: 0 0 0 10px;
    }
    .sa-quote-open {
        font-size: 4rem;
        line-height: 0.5;
        color: #D21034;
        font-family: Georgia, serif;
        display: inline-block;
        vertical-align: top;
        margin-right: 4px;
    }
    .sa-quote-close {
        font-size: 4rem;
        line-height: 0;
        color: #003893;
        font-family: Georgia, serif;
        display: inline-block;
        vertical-align: bottom;
        margin-left: 4px;
    }
    .sa-quote-text {
        font-size: 1.05rem;
        font-weight: 700;
        color: #003893;
        display: inline;
        font-style: normal;
        line-height: 1.55;
    }
    /* Buttons */
    .sa-actions { display: flex; gap: 14px; flex-wrap: wrap; }
    .sa-btn-primary {
        display: inline-flex; align-items: center; gap: 8px;
        background: #003893; color: #fff !important;
        padding: 12px 24px; border-radius: 4px;
        font-weight: 700; font-size: 0.88rem;
        text-decoration: none; border: none;
        transition: background .2s, transform .2s;
        white-space: nowrap;
    }
    .sa-btn-primary:hover { background: #002266; transform: translateY(-2px); }
    .sa-btn-secondary {
        display: inline-flex; align-items: center; gap: 8px;
        background: #003893; color: #fff !important;
        padding: 12px 24px; border-radius: 4px;
        font-weight: 700; font-size: 0.88rem;
        text-decoration: none;
        transition: background .2s, transform .2s;
        white-space: nowrap;
        opacity: 0.85;
    }
    .sa-btn-secondary:hover { background: #002266; opacity: 1; transform: translateY(-2px); }

    /* Right photo col */
    .sa-photo-col {
        flex: 0 0 48%;
        position: relative;
        display: flex;
        align-items: flex-end;
        justify-content: center;
        min-height: 380px;
    }
    .sa-photo {
        max-height: 420px;
        width: auto;
        max-width: 100%;
        object-fit: contain;
        object-position: bottom center;
        display: block;
        filter: drop-shadow(0 4px 24px rgba(0,56,147,0.10));
    }

    /* Responsive */
    @media (max-width: 900px) {
        .sa-about-inner { flex-direction: column-reverse; }
        .sa-text-col { padding: 32px 0 24px; flex: none; }
        .sa-photo-col { flex: none; min-height: 260px; }
        .sa-photo { max-height: 280px; }
        .sa-name { font-size: 2rem; }
    }
    @media (max-width: 576px) {
        .sa-name { font-size: 1.6rem; }
        .sa-actions { flex-direction: column; }
    }
    </style>

    <section class="sa-about">
        <div class="container">
            <div class="sa-about-inner">

                <!-- Left: Text -->
                <div class="sa-text-col">
                    <p class="sa-kicker" data-hi="परिचय" data-en="About">परिचय</p>
                    <h2 class="sa-name" data-hi="दद्दू प्रसाद" data-en="Daddoo Prasad">दद्दू प्रसाद</h2>
                    <div class="sa-rule"></div>

                    <p class="sa-desc"
                       data-hi="<?= htmlspecialchars($about_hi) ?>"
                       data-en="<?= htmlspecialchars($about_en) ?>">
                        <?= nl2br(htmlspecialchars($about_hi)) ?>
                        <?php if (!empty($intro_hi)): ?>
                        <a href="about.php" style="color:#003893;font-weight:600;text-decoration:none;" data-hi="अधिक पढ़ें.." data-en="Read More.."> अधिक पढ़ें..</a>
                        <?php endif; ?>
                    </p>

                    <!-- Big quote like supriyassule.in -->
                    <div class="sa-quote-wrap">
                        <span class="sa-quote-open">&#8220;</span><!--
                        --><span class="sa-quote-text"
                                 data-hi="समाज के अंतिम व्यक्ति तक न्याय पहुँचाना ही मेरा संकल्प है।"
                                 data-en="My resolve is to ensure justice reaches the last person in society.">
                            समाज के अंतिम व्यक्ति तक न्याय पहुँचाना ही मेरा संकल्प है।
                        </span><!--
                        --><span class="sa-quote-close">&#8221;</span>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="sa-actions">
                        <a href="about.php" class="sa-btn-primary" data-hi="पूरा परिचय पढ़ें" data-en="Read Full Bio">
                            <i class="fas fa-user-circle"></i> पूरा परिचय पढ़ें
                        </a>
                        <a href="achievements.php" class="sa-btn-secondary" data-hi="जनसंवाद मासिक कार्यअहवाल" data-en="Achievements">
                            <i class="fas fa-trophy"></i> उपलब्धियाँ
                        </a>
                    </div>
                </div>

                <!-- Right: Standing portrait photo -->
                <div class="sa-photo-col">
                    <img src="https://m.media-amazon.com/images/I/51dQBAlC7rL.jpg"
                         alt="दद्दू प्रसाद"
                         class="sa-photo"
                         data-hi="दद्दू प्रसाद"
                         data-en="Daddoo Prasad">
                </div>

            </div>
        </div>
    </section>

    <!-- ════════════════════════════════════════
         PRESS NOTE  — matches supriyassule.in
         Light-blue bg · 5 horizontal photo cards
         ════════════════════════════════════════ -->
    <style>
    /* ── Press Note ── */
    .sn-press {
        background: #ffffff; /* White Theme Background */
        padding: 52px 0 56px;
    }
    .sn-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 28px;
    }
    .sn-heading {
        font-family: 'Mukta','Noto Sans Devanagari',sans-serif;
        font-size: 2rem; font-weight: 800;
        color: #f97316; /* Orange section heading */
        margin: 0 0 10px;
    }
    .sn-rule { width: 44px; height: 4px; background: #D21034; border-radius: 2px; }
    .sn-viewall {
        display: inline-flex; align-items: center; gap: 6px;
        border: 2px solid #003893; color: #003893;
        padding: 6px 16px; border-radius: 20px;
        font-weight: 700; font-size: .84rem;
        text-decoration: none; transition: all .2s; white-space: nowrap; margin-top: 4px;
    }
    .sn-viewall:hover { background: #003893; color: #fff; }

    /* Horizontal 5-col grid */
    .sn-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 16px;
    }
    .sn-card {
        background: #fff;
        border-radius: 8px;
        overflow: hidden;
        display: block;
        text-decoration: none;
        box-shadow: 0 2px 10px rgba(0,56,147,.1);
        transition: transform .25s, box-shadow .25s;
    }
    .sn-card:hover { transform: translateY(-5px); box-shadow: 0 10px 28px rgba(0,56,147,.18); }

    /* Card photo */
    .sn-card-photo {
        position: relative;
        width: 100%; height: 155px;
        overflow: hidden;
        background: #c5d6f5;
    }
    .sn-card-photo img {
        width: 100%; height: 100%;
        object-fit: cover; display: block;
        transition: transform .4s;
    }
    .sn-card:hover .sn-card-photo img { transform: scale(1.07); }

    /* Date badge overlaid at bottom of photo */
    .sn-date-badge {
        position: absolute; bottom: 0; left: 0; right: 0;
        background: rgba(0,56,147,.80);
        color: #fff; font-size: .72rem; font-weight: 700;
        padding: 5px 10px; text-align: center; letter-spacing: .3px;
    }
    /* Card title below photo */
    .sn-card-title {
        padding: 12px 12px 14px;
        font-size: .86rem; font-weight: 700;
        color: #1a202c; line-height: 1.45; margin: 0;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    @media (max-width: 1024px) { .sn-grid { grid-template-columns: repeat(3,1fr); } }
    @media (max-width: 620px)  { .sn-grid { grid-template-columns: repeat(2,1fr); } }

    /* ── Achievements & Awards ── */
    .sn-ach {
        position: relative;
        padding: 52px 0 56px;
        background: #ffffff; /* White Theme Background */
        overflow: hidden;
    }
    .sn-ach-inner { position: relative; z-index: 1; }
    .sn-ach-heading {
        font-family: 'Mukta','Noto Sans Devanagari',sans-serif;
        font-size: 2rem; font-weight: 800;
        color: #f97316; /* Orange section heading */
        margin: 0 0 10px;
    }
    .sn-ach-rule { width: 44px; height: 4px; background: #D21034; border-radius: 2px; margin-bottom: 28px; }

    /* 6-col grid */
    .sn-ach-grid {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 14px;
    }
    .sn-ach-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px; overflow: hidden;
        text-decoration: none; display: block;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        transition: transform .25s, box-shadow .25s;
    }
    .sn-ach-card:hover { 
        background: #ffffff; 
        transform: translateY(-5px); 
        box-shadow: 0 10px 25px rgba(0,56,147,0.15); 
    }

    .sn-ach-thumb {
        width: 100%; height: 120px; overflow: hidden;
        background: #e2e8f0;
        display: flex; align-items: center; justify-content: center;
    }
    .sn-ach-thumb img { width: 100%; height: 100%; object-fit: cover; transition: transform .4s; }
    .sn-ach-card:hover .sn-ach-thumb img { transform: scale(1.07); }

    .sn-ach-label {
        padding: 9px 10px;
        font-size: .78rem; font-weight: 700;
        color: #003893; /* Dark Blue text */
        line-height: 1.4; text-align: center;
    }

    @media (max-width: 1024px) { .sn-ach-grid { grid-template-columns: repeat(3,1fr); } }
    @media (max-width: 620px)  { .sn-ach-grid { grid-template-columns: repeat(2,1fr); } }
    </style>

    <!-- PRESS NOTE -->
    <section class="sn-press">
        <div class="container">
            <div class="sn-head">
                <div>
                    <h2 class="sn-heading" data-hi="प्रेस नोट" data-en="Press Note">प्रेस नोट</h2>
                    <div class="sn-rule"></div>
                </div>
                <a href="press.php" class="sn-viewall" data-hi="सभी देखें" data-en="View all">
                    View all <i class="fas fa-plus-circle"></i>
                </a>
            </div>

            <div class="sn-grid">
                <?php
                /* Fallback stock images if no image_url in DB */
                $pressImgs = [
                    'https://images.unsplash.com/photo-1529107386315-e1a2ed48a620?w=400&q=80',
                    'https://images.unsplash.com/photo-1569025743873-ea3a9ade89f9?w=400&q=80',
                    'https://images.unsplash.com/photo-1588681664899-f142ff2dc9b1?w=400&q=80',
                    'https://images.unsplash.com/photo-1543269664-56d93c1b41a6?w=400&q=80',
                    'https://images.unsplash.com/photo-1523995462485-3d171b5c8fa9?w=400&q=80',
                ];
                foreach ($pressReleases as $idx => $p):
                    if ($idx >= 5) break;
                    $img = !empty($p['image_url']) ? $p['image_url'] : $pressImgs[$idx % 5];
                ?>
                <a href="press.php" class="sn-card">
                    <div class="sn-card-photo">
                        <img src="<?= htmlspecialchars($img) ?>"
                             alt="<?= htmlspecialchars(mb_substr($p['title_hi'],0,40)) ?>"
                             loading="lazy"
                             onerror="this.src='https://images.unsplash.com/photo-1529107386315-e1a2ed48a620?w=400&q=80'">
                        <div class="sn-date-badge"><?= date('d F Y', strtotime($p['release_date'])) ?></div>
                    </div>
                    <p class="sn-card-title"
                       data-hi="<?= htmlspecialchars($p['title_hi']) ?>"
                       data-en="<?= htmlspecialchars($p['title_en']) ?>">
                        <?= htmlspecialchars($p['title_hi']) ?>
                    </p>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ACHIEVEMENTS & AWARDS -->
    <section class="sn-ach">
        <div class="container sn-ach-inner">
            <div class="sn-head">
                <div>
                    <h2 class="sn-ach-heading" data-hi="उपलब्धियाँ एवं पुरस्कार" data-en="Achievements &amp; Awards">
                        उपलब्धियाँ एवं पुरस्कार
                    </h2>
                    <div class="sn-ach-rule"></div>
                </div>
                <a href="achievements.php" class="sn-viewall" data-hi="सभी देखें" data-en="View all">
                    View all <i class="fas fa-plus-circle"></i>
                </a>
            </div>

            <div class="sn-ach-grid">
                <?php
                $achImgs = [
                    'https://images.unsplash.com/photo-1567427017947-545c5f8d16ad?w=300&q=80',
                    'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?w=300&q=80',
                    'https://images.unsplash.com/photo-1599298585685-e7e37fed22a5?w=300&q=80',
                    'https://images.unsplash.com/photo-1517457373958-b7bdd4587205?w=300&q=80',
                    'https://images.unsplash.com/photo-1529107386315-e1a2ed48a620?w=300&q=80',
                    'https://images.unsplash.com/photo-1588681664899-f142ff2dc9b1?w=300&q=80',
                ];
                foreach ($achievements as $idx => $ach):
                    if ($idx >= 6) break;
                ?>
                <a href="achievements.php" class="sn-ach-card">
                    <div class="sn-ach-thumb">
                        <img src="<?= $achImgs[$idx % 6] ?>"
                             alt="<?= htmlspecialchars($ach['category_hi']) ?>"
                             loading="lazy">
                    </div>
                    <div class="sn-ach-label"
                         data-hi="<?= htmlspecialchars($ach['category_hi']) ?>"
                         data-en="<?= htmlspecialchars($ach['category_en']) ?>">
                        <?= htmlspecialchars(mb_substr($ach['category_hi'], 0, 40)) ?>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>





    <!-- ════════════════════════════════════════════════
         POLITICAL JOURNEY — Premium Vertical Zigzag
         ════════════════════════════════════════════════ -->
    <style>
    /* ── Section wrapper ── */
    .pj2-section {
        padding: 72px 0 80px;
        background: #ffffff; /* White Theme Background */
        position: relative;
        overflow: hidden;
    }
    /* Decorative large circle blob */
    .pj2-section::before {
        content: '';
        position: absolute;
        right: -120px; top: -120px;
        width: 420px; height: 420px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(0,56,147,.04) 0%, transparent 70%);
        pointer-events: none;
    }

    /* Header */
    .pj2-kicker {
        font-size: .68rem; font-weight: 800;
        letter-spacing: 3px; text-transform: uppercase;
        color: #D21034; margin-bottom: 8px;
    }
    .pj2-title {
        font-family: 'Mukta','Noto Sans Devanagari',sans-serif;
        font-size: 2.2rem; font-weight: 800;
        color: #f97316; /* Orange section heading */
        margin: 0 0 10px;
    }
    .pj2-subtitle {
        font-size: .95rem; color: #64748b;
        max-width: 560px; line-height: 1.75; margin-bottom: 56px;
    }

    /* ── Centre vertical line ── */
    .pj2-timeline {
        position: relative;
        padding-bottom: 20px;
    }
    .pj2-timeline::before {
        content: '';
        position: absolute;
        left: 50%; top: 0; bottom: 0;
        width: 3px;
        background: linear-gradient(to bottom, #D21034, #003893);
        border-radius: 4px;
        transform: translateX(-50%);
    }

    /* ── Each milestone row ── */
    .pj2-row {
        display: flex;
        align-items: center;
        margin-bottom: 48px;
        gap: 0;
        position: relative;
    }
    /* Even rows: card LEFT, image RIGHT */
    .pj2-row:nth-child(even) { flex-direction: row-reverse; }

    /* Card half */
    .pj2-card {
        flex: 0 0 42%;
        background: #fff;
        border-radius: 12px;
        padding: 28px 30px 24px;
        box-shadow: 0 4px 20px rgba(0,56,147,.10);
        transition: transform .3s, box-shadow .3s;
        position: relative;
        z-index: 1;
        margin: 0 40px;
    }
    .pj2-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 36px rgba(0,56,147,.18);
    }
    /* Left-pointing arrow on even rows, right on odd */
    .pj2-row:nth-child(odd)  .pj2-card::after {
        content: '';
        position: absolute;
        right: -12px; top: 28px;
        width: 0; height: 0;
        border: 12px solid transparent;
        border-left-color: #fff;
    }
    .pj2-row:nth-child(even) .pj2-card::after {
        content: '';
        position: absolute;
        left: -12px; top: 28px;
        width: 0; height: 0;
        border: 12px solid transparent;
        border-right-color: #fff;
    }

    .pj2-year-badge {
        display: inline-block;
        background: #003893;
        color: #FECB00;
        font-size: .74rem; font-weight: 800;
        padding: 4px 12px; border-radius: 20px;
        margin-bottom: 12px; letter-spacing: .4px;
    }
    .pj2-card-title {
        font-family: 'Mukta','Noto Sans Devanagari',sans-serif;
        font-size: 1.15rem; font-weight: 800;
        color: #003893; margin: 0 0 10px; line-height: 1.3;
    }
    .pj2-card-desc {
        font-size: .87rem; color: #4a5568;
        line-height: 1.75; margin-bottom: 18px;
    }
    .pj2-card-btn {
        display: inline-flex; align-items: center; gap: 6px;
        background: #003893; color: #fff;
        padding: 8px 20px; border-radius: 4px;
        font-size: .82rem; font-weight: 700;
        text-decoration: none;
        border-left: 3px solid #FECB00;
        transition: background .2s, transform .15s;
    }
    .pj2-card-btn:hover { background: #D21034; color: #fff; transform: translateX(3px); }

    /* Centre dot (numbered circle) */
    .pj2-dot {
        flex: 0 0 64px;
        height: 64px;
        border-radius: 50%;
        background: linear-gradient(135deg, #003893 0%, #1565c0 100%);
        border: 4px solid #fff;
        box-shadow: 0 4px 16px rgba(0,56,147,.35);
        display: flex; align-items: center; justify-content: center;
        z-index: 2;
        flex-shrink: 0;
        font-size: 1.3rem; font-weight: 800;
        color: #FECB00;
        font-family: 'Mukta', sans-serif;
    }

    /* Image half */
    .pj2-img-wrap {
        flex: 0 0 calc(42% - 40px);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,.13);
        margin: 0 40px;
        position: relative;
    }
    .pj2-img-wrap img {
        width: 100%; height: 220px;
        object-fit: cover; display: block;
        transition: transform .45s;
    }
    .pj2-row:hover .pj2-img-wrap img { transform: scale(1.06); }
    /* Year label overlay on image */
    .pj2-img-year {
        position: absolute;
        top: 14px; right: 14px;
        background: rgba(0,56,147,.85);
        color: #FECB00;
        font-size: .72rem; font-weight: 800;
        padding: 4px 10px; border-radius: 20px;
        letter-spacing: .4px;
    }

    /* Mobile: stack vertically */
    @media (max-width: 900px) {
        .pj2-timeline::before { left: 28px; }
        .pj2-row, .pj2-row:nth-child(even) {
            flex-direction: column;
            align-items: flex-start;
            padding-left: 64px;
        }
        .pj2-dot {
            position: absolute; left: 0; top: 0;
            width: 52px; height: 52px; font-size: 1rem;
        }
        .pj2-card, .pj2-img-wrap {
            flex: none; width: 100%; margin: 8px 0;
        }
        .pj2-row:nth-child(odd)  .pj2-card::after,
        .pj2-row:nth-child(even) .pj2-card::after { display: none; }
    }
    </style>

    <?php
    $pj2Data = [
        [
            'year'  => 'प्रारंभिक जीवन',
            'year_en' => 'Early Life',
            'img'   => 'https://images.unsplash.com/photo-1529107386315-e1a2ed48a620?w=600&q=80',
        ],
        [
            'year'  => 'शिक्षा — 1980s',
            'year_en' => 'Education — 1980s',
            'img'   => 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?w=600&q=80',
        ],
        [
            'year'  => 'राजनीतिक यात्रा — 1990s',
            'year_en' => 'Political Journey — 1990s',
            'img'   => 'https://images.unsplash.com/photo-1588681664899-f142ff2dc9b1?w=600&q=80',
        ],
        [
            'year'  => 'कैबिनेट मंत्री — 2007–2010',
            'year_en' => 'Cabinet Minister — 2007–2010',
            'img'   => 'https://images.unsplash.com/photo-1543269664-56d93c1b41a6?w=600&q=80',
        ],
        [
            'year'  => 'सामाजिक मिशन — 2010 से अब',
            'year_en' => 'Social Mission — 2010 to Present',
            'img'   => 'https://images.unsplash.com/photo-1567427017947-545c5f8d16ad?w=600&q=80',
        ],
    ];
    foreach ($journey as $i => $item) {
        if (isset($pj2Data[$i])) {
            $pj2Data[$i]['title_hi']   = $item['title_hi']   ?? $pj2Data[$i]['year'];
            $pj2Data[$i]['title_en']   = $item['title_en']   ?? $pj2Data[$i]['year_en'];
            $pj2Data[$i]['content_hi'] = $item['content_hi'] ?? '';
            $pj2Data[$i]['content_en'] = $item['content_en'] ?? '';
        }
    }
    ?>

    <section class="pj2-section">
        <div class="container">
            <!-- Header -->
            <p class="pj2-kicker" data-hi="राजनीतिक सफर" data-en="Political Journey">राजनीतिक सफर</p>
            <h2 class="pj2-title" data-hi="नेतृत्व. अनुभव. मूल्य." data-en="Leadership. Experience. Values.">
                नेतृत्व. अनुभव. मूल्य.
            </h2>
            <p class="pj2-subtitle">
                श्री दद्दू प्रसाद जी ने 30 वर्षों से अधिक के राजनीतिक जीवन में समाज के अंतिम व्यक्ति तक न्याय पहुँचाने का संकल्प लिया है।
            </p>

            <!-- Timeline rows -->
            <div class="pj2-timeline">
                <?php foreach ($pj2Data as $i => $d):
                    $title = $d['title_hi'] ?? $d['year'];
                    $desc  = $d['content_hi'] ?? '';
                ?>
                <div class="pj2-row">
                    <!-- Info card -->
                    <div class="pj2-card">
                        <span class="pj2-year-badge"
                              data-hi="<?= htmlspecialchars($d['year']) ?>"
                              data-en="<?= htmlspecialchars($d['year_en'] ?? $d['year']) ?>">
                            <?= htmlspecialchars($d['year']) ?>
                        </span>
                        <h3 class="pj2-card-title"
                            data-hi="<?= htmlspecialchars($title) ?>"
                            data-en="<?= htmlspecialchars($d['title_en'] ?? $title) ?>">
                            <?= htmlspecialchars($title) ?>
                        </h3>
                        <?php if ($desc): ?>
                        <p class="pj2-card-desc"
                           data-hi="<?= htmlspecialchars($desc) ?>"
                           data-en="<?= htmlspecialchars($d['content_en'] ?? '') ?>">
                            <?= htmlspecialchars(mb_substr($desc, 0, 160)) ?>
                        </p>
                        <?php endif; ?>
                        <a href="about.php" class="pj2-card-btn">
                            <i class="fas fa-arrow-right"></i> विस्तृत पढ़ें
                        </a>
                    </div>

                    <!-- Numbered circle dot -->
                    <div class="pj2-dot"><?= $i + 1 ?></div>

                    <!-- Photo -->
                    <div class="pj2-img-wrap">
                        <img src="<?= htmlspecialchars($d['img']) ?>"
                             alt="<?= htmlspecialchars($title) ?>"
                             loading="lazy">
                        <span class="pj2-img-year"><?= htmlspecialchars($d['year']) ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- View full bio button -->
            <div style="text-align:center;margin-top:16px;">
                <a href="about.php" class="pj2-card-btn" style="font-size:.9rem;padding:12px 32px;">
                    <i class="fas fa-user-circle"></i> पूरी जीवनी पढ़ें
                </a>
            </div>
        </div>
    </section>




   

    <!-- ═══════════════════════════════════
         LATEST BLOGS SECTION
         ═══════════════════════════════════ -->
    <style>
    .hm-blog-bg {
        background: #f8fafc;
        padding: 70px 0;
    }
    .hm-blog-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 30px;
    }
    .hm-blog-title {
        font-family: 'Mukta','Noto Sans Devanagari',sans-serif;
        font-size: 2.2rem; font-weight: 800;
        color: #f97316; margin: 0 0 10px;
    }
    .hm-blog-rule { width: 50px; height: 4px; background: #D21034; border-radius: 2px; }
    .hm-blog-viewall {
        display: inline-flex; align-items: center; gap: 6px;
        border: 2px solid #003893; color: #003893;
        padding: 6px 16px; border-radius: 20px;
        font-weight: 700; font-size: .84rem;
        text-decoration: none; transition: all .2s; white-space: nowrap; margin-top: 4px;
    }
    .hm-blog-viewall:hover { background: #003893; color: #fff; }
    
    .hm-blog-card {
        background: #fff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        transition: transform .3s, box-shadow .3s;
        height: 100%;
        display: flex;
        flex-direction: column;
        text-decoration: none;
        color: inherit;
    }
    .hm-blog-card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,56,147,0.15); }
    .hm-blog-img {
        width: 100%; height: 180px;
        object-fit: cover;
    }
    .hm-blog-body { padding: 20px; flex-grow: 1; display: flex; flex-direction: column; }
    .hm-blog-date {
        font-size: 0.8rem; font-weight: 700; color: #64748b; margin-bottom: 8px;
    }
    .hm-blog-heading {
        font-family: 'Mukta', sans-serif;
        font-size: 1.1rem; font-weight: 700; color: #003893;
        margin-bottom: 10px; line-height: 1.4;
    }
    .hm-blog-excerpt {
        font-size: 0.9rem; color: #4a5568; line-height: 1.6; margin-bottom: 15px; flex-grow: 1;
    }
    .hm-blog-read {
        font-size: 0.85rem; font-weight: 700; color: #D21034;
    }
    </style>

    <section class="hm-blog-bg">
        <div class="container">
            <div class="hm-blog-head">
                <div>
                    <h2 class="hm-blog-title" data-hi="दैनिक विचार एवं ब्लॉग" data-en="Daily Thoughts & Blog">दैनिक विचार एवं ब्लॉग</h2>
                    <div class="hm-blog-rule"></div>
                </div>
                <a href="blog.php" class="hm-blog-viewall" data-hi="सभी पढ़ें" data-en="Read all">
                    Read all <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="row g-4">
                <?php 
                $fallbackBlogImgs = [
                    'https://images.unsplash.com/photo-1543269865-cbf427effbad?w=400&q=80',
                    'https://images.unsplash.com/photo-1555848962-6e79363ec58f?w=400&q=80',
                    'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=400&q=80'
                ];
                foreach ($latestBlogs as $idx => $post): 
                    $title   = $post['title_hi'];
                    $content = $post['content_hi'];
                    $imgUrl  = (!empty($post['image_url'])) ? $post['image_url'] : $fallbackBlogImgs[$idx % 3];
                    $excerpt = mb_substr(strip_tags($content), 0, 100) . '...';
                ?>
                <div class="col-lg-4 col-md-6">
                    <a href="blog_detail.php?id=<?= $post['id'] ?>" class="hm-blog-card">
                        <img src="<?= htmlspecialchars(strpos($imgUrl, 'http') === 0 ? $imgUrl : $imgUrl) ?>" alt="<?= htmlspecialchars($title) ?>" class="hm-blog-img">
                        <div class="hm-blog-body">
                            <div class="hm-blog-date"><i class="far fa-calendar-alt"></i> <?= date('d M Y', strtotime($post['publish_date'])) ?></div>
                            <h3 class="hm-blog-heading"><?= htmlspecialchars($title) ?></h3>
                            <p class="hm-blog-excerpt"><?= htmlspecialchars($excerpt) ?></p>
                            <div class="hm-blog-read">पूरा पढ़ें &rarr;</div>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>

                <?php if (empty($latestBlogs)): ?>
                    <div class="col-12 text-center text-muted">अभी कोई पोस्ट उपलब्ध नहीं है।</div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════
        STAY CONNECTED SECTION
        ═══════════════════════════════════ -->
    <style>
    .sc-section {
        padding: 60px 0;
        background: #ffffff;
        border-top: 1px solid #e2e8f0;
    }
    .sc-header {
        text-align: center;
        margin-bottom: 40px;
    }
    .sc-title {
        font-family: 'Mukta', sans-serif;
        font-size: clamp(1.8rem, 3vw, 2.4rem);
        font-weight: 800;
        color: #f97316; /* Orange section heading */
        margin-bottom: 8px;
    }
    .sc-title-underline {
        height: 3px;
        width: 80px;
        background: #D21034;
        margin: 0 auto;
    }
    .sc-col-header {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }
    .sc-col-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 30px;
        border: 2px solid #003893;
        color: #003893;
        font-weight: 700;
        background: #fff;
        border-radius: 4px;
        text-decoration: none;
        transition: all 0.25s;
    }
    .sc-col-btn.fb { border-color: #003893; color: #003893; }
    .sc-col-btn.tw { border-color: #003893; color: #003893; }
    .sc-col-btn.yt { border-color: #D21034; color: #D21034; }
    .sc-col-btn:hover { background: #f8f9fa; transform: translateY(-2px); box-shadow: 0 4px 10px rgba(0,0,0,0.05); }

    .sc-box {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 0;
        height: 500px;
        overflow-y: auto;
        box-shadow: 0 10px 25px rgba(0,0,0,0.04);
    }
    .sc-yt-vid {
        margin: 15px;
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid #eaeaea;
        background: #000;
    }
    </style>

    <section class="sc-section">
        <div class="container">
            <div class="sc-header">
                <h2 class="sc-title" data-hi="दद्दू प्रसाद जी से जुड़े रहें" data-en="Stay connected with Daddoo Prasad">दद्दू प्रसाद जी से जुड़े रहें</h2>
                <div class="sc-title-underline"></div>
            </div>
            
            <div class="row g-4">
                <!-- Facebook Column -->
                <div class="col-lg-4 col-md-6">
                    <div class="sc-col-header">
                        <a href="https://www.facebook.com/dadduprasadoffice/" target="_blank" class="sc-col-btn fb">
                            <i class="fab fa-facebook" style="color:#1877F2; font-size:1.1rem;"></i> Follow
                        </a>
                    </div>
                    <div class="sc-box text-center" style="display:flex; justify-content:center; align-items:flex-start; padding-top:15px;">
                        <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fdadduprasadoffice%2F&tabs=timeline&width=340&height=470&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true" width="340" height="470" style="border:none;overflow:hidden;max-width:100%;" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                    </div>
                </div>
                
                <!-- Twitter Column -->
                <div class="col-lg-4 col-md-6">
                    <div class="sc-col-header">
                        <a href="https://twitter.com/dadduprasad" target="_blank" class="sc-col-btn tw">
                            <i class="fab fa-x-twitter" style="font-size:1.1rem;"></i> Follow
                        </a>
                    </div>
                    <div class="sc-box" style="padding:15px;">
                        <a class="twitter-timeline" data-height="470" href="https://twitter.com/dadduprasad?ref_src=twsrc%5Etfw">Tweets by dadduprasad</a> 
                        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                    </div>
                </div>
                
                <!-- YouTube Column -->
                <div class="col-lg-4 col-md-12">
                    <div class="sc-col-header">
                        <a href="https://www.youtube.com/@DadduPrasad" target="_blank" class="sc-col-btn yt">
                            <i class="fab fa-youtube text-danger" style="font-size:1.1rem;"></i> Subscribe
                        </a>
                    </div>
                    <div class="sc-box" style="background:#fcfcfc;">
                        <?php 
                        $ytVids = array_filter($media, function($m) { return $m['media_type'] === 'video'; });
                        $ytVids = array_slice(array_values($ytVids), 0, 3);
                        foreach($ytVids as $vid): 
                            preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $vid['media_url'], $matches);
                            $yt_id = $matches[1] ?? '';
                            if($yt_id):
                        ?>
                        <div class="sc-yt-vid">
                            <iframe src="https://www.youtube.com/embed/<?= $yt_id ?>?rel=0" frameborder="0" allowfullscreen style="width:100%; height:200px; display:block;"></iframe>
                        </div>
                        <?php endif; endforeach; ?>
                        
                        <?php if(empty($ytVids)): ?>
                            <div class="text-center text-muted mt-5 pt-5">
                                <i class="fab fa-youtube fa-3x mb-3 text-secondary" style="opacity:0.3"></i>
                                <p data-hi="कोई वीडियो उपलब्ध नहीं" data-en="No videos available">कोई वीडियो उपलब्ध नहीं</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php require_once 'includes/footer.php'; ?>
