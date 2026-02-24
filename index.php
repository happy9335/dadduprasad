<?php
require_once 'includes/header.php';

// Fetch all data for homepage
$hero_tagline = getSettingVal($pdo, 'hero_tagline');
$hero_intro   = getSettingVal($pdo, 'hero_intro');

$tagline_hi = !empty($hero_tagline['value_hi']) ? $hero_tagline['value_hi'] : '"सामाजिक न्याय, समता और संवैधानिक अधिकारों की रक्षा ही मेरा संकल्प है।"';
$tagline_en = !empty($hero_tagline['value_en']) ? $hero_tagline['value_en'] : '"Committed to Social Justice, Equality and Constitutional Rights"';

$intro_hi = !empty($hero_intro['value_hi']) ? $hero_intro['value_hi'] : 'माननीय श्री दद्दू प्रसाद जी उत्तर प्रदेश सरकार में पूर्व कैबिनेट मंत्री रह चुके हैं। उनका संपूर्ण राजनीतिक जीवन समाज के वंचित वर्गों के उत्थान के लिए समर्पित रहा है।';
$intro_en = !empty($hero_intro['value_en']) ? $hero_intro['value_en'] : "Hon'ble Shri Daddoo Prasad Ji is a former Cabinet Minister in the Government of Uttar Pradesh. His entire political life is dedicated to the upliftment of the deprived sections of society.";

$sliders      = $pdo->query("SELECT * FROM home_slider ORDER BY display_order ASC")->fetchAll();
$pressReleases= $pdo->query("SELECT * FROM press_releases ORDER BY release_date DESC LIMIT 3")->fetchAll();
$achievements = $pdo->query("SELECT * FROM achievements ORDER BY display_order ASC LIMIT 6")->fetchAll();
$journey      = $pdo->query("SELECT * FROM biography ORDER BY display_order ASC")->fetchAll();
$media        = $pdo->query("SELECT * FROM media_gallery WHERE media_type='video' ORDER BY display_order ASC LIMIT 2")->fetchAll();

// Demo images if slider is empty
$demoSlides = [
    ['image_url'=>'https://img-s-msn-com.akamaized.net/tenant/amp/entityid/AA1OVQr7.img?f=jpg&h=580&m=6&q=80&u=t&w=900', 'title_hi'=>'सामाजिक न्याय के प्रति संकल्पित', 'title_en'=>'Committed to Social Justice'],
    ['image_url'=>'https://static.toiimg.com/thumb/msid-117165608,width-1070,height-580,imgsize-102798,resizemode-75,overlay-toi_sw,pt-32,y_pad-40/photo.jpg','title_hi'=>'जन सेवा ही परमो धर्मः','title_en'=>'Service to People is Supreme Duty'],
    ['image_url'=>'https://www.bjp.org/files/photo-gallery/Hon%27ble%20BJP%20National%20President%20Shri%20J.P.%20Nadda%20addressing%20a%20public%20rally%20at%20Highmid%20Ground%20Sonbhadra%20%28Robertsganj%29%20Uttar%20Pradesh%20%284%29.jpg','title_hi'=>'संविधान की रक्षा हमारा संकल्प','title_en'=>'Protecting the Constitution is Our Resolve'],
];
if (empty($sliders)) $sliders = $demoSlides;
?>

<!-- ========== HERO SECTION ========== -->
<section id="home" class="dp-hero">
    <div class="dpswiper swiper">
        <div class="swiper-wrapper">
            <?php foreach($sliders as $slide): ?>
            <div class="swiper-slide dp-slide">
                <div class="dp-slide-bg" style="background-image: url('<?= htmlspecialchars($slide['image_url']) ?>')"></div>
                <div class="dp-slide-overlay"></div>
                <div class="container dp-slide-content">
                    <div class="dp-tagline-wrap">
                        <div class="dp-tagline-bar"></div>
                        <h1 class="dp-slide-title" data-hi="<?= htmlspecialchars($slide['title_hi'] ?? $tagline_hi) ?>" data-en="<?= htmlspecialchars($slide['title_en'] ?? $tagline_en) ?>">
                            <?= nl2br(htmlspecialchars($slide['title_hi'] ?? $tagline_hi)) ?>
                        </h1>
                        <p class="dp-slide-sub" data-hi="सामाजिक न्याय | संवैधानिक अधिकार | जनसेवा" data-en="Social Justice | Constitutional Rights | Public Service">
                            सामाजिक न्याय &nbsp;|&nbsp; संवैधानिक अधिकार &nbsp;|&nbsp; जनसेवा
                        </p>
                        <div class="d-flex gap-3 flex-wrap mt-4">
                            <a href="about.php" class="dp-btn-primary" data-hi="हमारे बारे में" data-en="About Us">हमारे बारे में</a>
                            <a href="contact.php" class="dp-btn-outline" data-hi="संपर्क करें" data-en="Contact Us">संपर्क करें</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="swiper-pagination dp-pagination"></div>
        <div class="swiper-button-next dp-arrow-next"></div>
        <div class="swiper-button-prev dp-arrow-prev"></div>
    </div>

    <!-- Floating Info Bar -->
    <div class="dp-info-bar">
        <div class="container">
            <div class="dp-info-bar-inner">
                <div class="dp-info-items">
                    <a href="#" class="dp-info-item" data-hi="संसद में कार्य" data-en="In Parliament"><i class="fas fa-landmark"></i> <span>संसद में कार्य</span></a>
                    <a href="press.php" class="dp-info-item" data-hi="प्रेस विज्ञप्ति" data-en="Press Notes"><i class="fas fa-newspaper"></i> <span>प्रेस विज्ञप्ति</span></a>
                    <a href="gallery.php" class="dp-info-item" data-hi="फोटो गैलरी" data-en="Photo Gallery"><i class="fas fa-images"></i> <span>फोटो गैलरी</span></a>
                </div>
                <a href="contact.php" class="dp-info-cta" data-hi="अधिक जानें →" data-en="Know More →">अधिक जानें →</a>
            </div>
        </div>
    </div>
</section>

<!-- ========== ABOUT SECTION ========== -->
<section id="about" class="dp-section dp-about">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="dp-about-img-wrap">
                    <img src="https://m.media-amazon.com/images/I/51dQBAlC7rL.jpg" alt="दद्दू प्रसाद" class="dp-about-photo">
                    <div class="dp-about-badge">
                        <i class="fas fa-star"></i><br>
                        <span>पूर्व<br>कैबिनेट<br>मंत्री</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="dp-section-label" data-hi="परिचय" data-en="About">परिचय</div>
                <h2 class="dp-section-title" data-hi="दद्दू प्रसाद" data-en="Daddoo Prasad">दद्दू प्रसाद</h2>
                <div class="dp-title-line"></div>
                <p class="dp-about-lead" data-hi="<?= htmlspecialchars($intro_hi) ?>" data-en="<?= htmlspecialchars($intro_en) ?>">
                    <?= nl2br(htmlspecialchars($intro_hi)) ?>
                </p>
                <div class="dp-highlight-box">
                    <i class="fas fa-quote-left"></i>
                    <strong data-hi="मेरा लक्ष्य है कि समाज का हर व्यक्ति सम्मान और अधिकार के साथ जीवन जी सके।" data-en="My goal is that every person in society can live with dignity and rights.">
                        "मेरा लक्ष्य है कि समाज का हर व्यक्ति सम्मान और अधिकार के साथ जीवन जी सके।"
                    </strong>
                </div>
                <div class="dp-feature-list">
                    <div class="dp-feat"><i class="fas fa-check-circle"></i> <span data-hi="सामाजिक न्याय के पक्षधर" data-en="Champion of Social Justice">सामाजिक न्याय के पक्षधर</span></div>
                    <div class="dp-feat"><i class="fas fa-check-circle"></i> <span data-hi="पारदर्शी एवं जवाबदेह नेतृत्व" data-en="Transparent & Accountable Leadership">पारदर्शी एवं जवाबदेह नेतृत्व</span></div>
                    <div class="dp-feat"><i class="fas fa-check-circle"></i> <span data-hi="जनसेवा के प्रति समर्पण" data-en="Dedicated to Public Service">जनसेवा के प्रति समर्पण</span></div>
                </div>
                <div class="mt-4 d-flex gap-3 flex-wrap">
                    <a href="about.php" class="dp-btn-primary" data-hi="पूरा परिचय पढ़ें" data-en="Read Full Bio">पूरा परिचय पढ़ें</a>
                    <a href="gallery.php" class="dp-btn-outline" data-hi="गैलरी देखें" data-en="View Gallery">गैलरी देखें</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========== PRESS NOTES SECTION ========== -->
<section class="dp-section dp-press-section">
    <div class="container">
        <div class="dp-section-head">
            <div>
                <div class="dp-section-label" data-hi="समाचार" data-en="News">समाचार</div>
                <h2 class="dp-section-title" data-hi="प्रेस विज्ञप्ति" data-en="Press Notes">प्रेस विज्ञप्ति</h2>
                <div class="dp-title-line"></div>
            </div>
            <a href="press.php" class="dp-view-all" data-hi="सभी देखें →" data-en="View All →">सभी देखें →</a>
        </div>

        <div class="row g-4">
            <?php
            // Use demo press if DB is empty
            $demoPressItems = [
                ['title_hi'=>'माननीय दद्दू प्रसाद जी ने सामाजिक न्याय सम्मेलन को संबोधित किया','title_en'=>'Daddoo Prasad Ji addressed Social Justice Conference','image_url'=>'https://img-s-msn-com.akamaized.net/tenant/amp/entityid/AA1OVQr7.img?f=jpg&h=232&m=6&q=60&u=t&w=412','release_date'=>'2025-01-15'],
                ['title_hi'=>'ग्रामीण विकास के लिए नई योजनाओं का शुभारंभ','title_en'=>'Launch of New Rural Development Schemes','image_url'=>'https://static.toiimg.com/thumb/msid-117165608%2Cwidth-1070%2Cheight-580%2Cimgsize-102798%2Cresizemode-75%2Coverlay-toi_sw%2Cpt-32%2Cy_pad-40/photo.jpg','release_date'=>'2025-02-20'],
                ['title_hi'=>'युवाओं के लिए रोजगार सृजन अभियान का आगाज','title_en'=>'Employment Generation Drive launched for Youth','image_url'=>'https://m.media-amazon.com/images/I/51dQBAlC7rL.jpg','release_date'=>'2025-03-10'],
            ];
            $displayPress = empty($pressReleases) ? $demoPressItems : $pressReleases;
            foreach($displayPress as $idx => $press): if($idx >= 3) break;
            ?>
            <div class="col-md-4">
                <div class="dp-press-card">
                    <div class="dp-press-img-wrap">
                        <?php if(!empty($press['image_url'])): ?>
                            <img src="<?= htmlspecialchars($press['image_url']) ?>" alt="Press" class="dp-press-img">
                        <?php else: ?>
                            <div class="dp-press-img-placeholder"><i class="fas fa-newspaper fa-3x"></i></div>
                        <?php endif; ?>
                        <div class="dp-press-date-badge"><?= date('d M Y', strtotime($press['release_date'])) ?></div>
                    </div>
                    <div class="dp-press-body">
                        <h4 class="dp-press-title" data-hi="<?= htmlspecialchars($press['title_hi']) ?>" data-en="<?= htmlspecialchars($press['title_en'] ?? '') ?>">
                            <?= htmlspecialchars(mb_substr($press['title_hi'], 0, 80)) ?>...
                        </h4>
                        <a href="press.php" class="dp-read-more" data-hi="पूरा पढ़ें →" data-en="Read More →">पूरा पढ़ें →</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ========== ACHIEVEMENTS SECTION ========== -->
<section class="dp-section dp-achievements">
    <div class="container">
        <div class="text-center mb-5">
            <div class="dp-section-label-light" data-hi="उपलब्धियाँ" data-en="Milestones">उपलब्धियाँ</div>
            <h2 class="dp-section-title text-white" data-hi="उपलब्धियाँ एवं पुरस्कार" data-en="Achievements & Awards">उपलब्धियाँ एवं पुरस्कार</h2>
            <div class="dp-title-line mx-auto"></div>
        </div>
        <div class="row g-4">
            <?php
            $achIcons = ['fas fa-balance-scale','fas fa-graduation-cap','fas fa-home','fas fa-shield-alt','fas fa-book-open','fas fa-users'];
            $demoAch = [
                ['category_hi'=>'सामाजिक न्याय योजनाओं का क्रियान्वयन','category_en'=>'Social Justice Scheme Implementation'],
                ['category_hi'=>'छात्रवृत्ति एवं कल्याण विस्तार','category_en'=>'Scholarship & Welfare Expansion'],
                ['category_hi'=>'ग्रामीण विकास कार्यक्रम','category_en'=>'Rural Development Programs'],
                ['category_hi'=>'कमजोर वर्गों के अधिकारों की रक्षा','category_en'=>'Protection of Weaker Sections'],
                ['category_hi'=>'संविधान जागरूकता अभियान','category_en'=>'Constitution Awareness Campaign'],
                ['category_hi'=>'युवा राजनीतिक भागीदारी','category_en'=>'Youth Political Participation'],
            ];
            $displayAch = empty($achievements) ? $demoAch : $achievements;
            foreach($displayAch as $i => $ach): if($i>=6) break;
            ?>
            <div class="col-md-4 col-6">
                <div class="dp-ach-card">
                    <div class="dp-ach-icon">
                        <i class="<?= $achIcons[$i % count($achIcons)] ?>"></i>
                    </div>
                    <p class="dp-ach-label" data-hi="<?= htmlspecialchars($ach['category_hi']) ?>" data-en="<?= htmlspecialchars($ach['category_en'] ?? '') ?>">
                        <?= htmlspecialchars($ach['category_hi']) ?>
                    </p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ========== POLITICAL JOURNEY (TIMELINE) ========== -->
<section class="dp-section dp-journey">
    <div class="container">
        <div class="text-center mb-5">
            <div class="dp-section-label" data-hi="राजनीतिक सफर" data-en="Political Journey">राजनीतिक सफर</div>
            <h2 class="dp-section-title" data-hi="नेतृत्व. अनुभव. मूल्य." data-en="Leadership. Experience. Values.">नेतृत्व. अनुभव. मूल्य.</h2>
            <div class="dp-title-line mx-auto"></div>
            <p class="dp-journey-lead mx-auto mt-4" data-hi="पिछले 30 वर्षों में दद्दू प्रसाद जी ने समाजवादी पार्टी के वरिष्ठ नेता और सामाजिक परिवर्तन मिशन, भारत के राष्ट्रीय संयोजक के रूप में खुद को स्थापित किया है।" data-en="Over the past 30 years, Daddoo Prasad Ji has established himself as a senior Samajwadi Party leader and the National Convenor of Samajik Parivartan Mission, India.">
                पिछले 30 वर्षों में दद्दू प्रसाद जी ने समाजवादी पार्टी के वरिष्ठ नेता और सामाजिक परिवर्तन मिशन, भारत के राष्ट्रीय संयोजक के रूप में खुद को स्थापित किया है।
            </p>
        </div>

        <div class="dp-timeline">
            <?php
            $demoJourney = [
                ['title_hi'=>'प्रारंभिक जीवन','title_en'=>'Early Life','content_hi'=>'उत्तर प्रदेश के एक साधारण परिवार में जन्मे, संघर्षपूर्ण परिस्थितियों में शिक्षा प्राप्त की। सामाजिक असमानता देखकर समाज सेवा का मार्ग चुना।','content_en'=>'Born in a humble family in Uttar Pradesh, received education in difficult circumstances. Chose the path of social service witnessing social inequality.'],
                ['title_hi'=>'शिक्षा','title_en'=>'Education','content_hi'=>'स्नातक एवं उच्च शिक्षा प्राप्त कर सामाजिक और राजनीतिक विषयों में गहरी रुचि विकसित की। छात्र आंदोलनों में सक्रिय रहे।','content_en'=>'Completed graduation and higher education, developing deep interest in social and political subjects. Active in student movements.'],
                ['title_hi'=>'राजनीतिक यात्रा','title_en'=>'Political Journey','content_hi'=>'सामाजिक आंदोलनों से राजनीतिक जीवन शुरू करते हुए जनता की समस्याओं को विधानसभा तक पहुँचाया।','content_en'=>'Starting from social movements, brought the problems of the people to the legislature.'],
                ['title_hi'=>'कैबिनेट मंत्री','title_en'=>'Cabinet Minister','content_hi'=>'उत्तर प्रदेश सरकार में कैबिनेट मंत्री के रूप में सामाजिक न्याय एवं अधिकारिता विभागों की जिम्मेदारी निभाई।','content_en'=>'Handled the responsibilities of Social Justice & Empowerment departments as Cabinet Minister in UP Government.'],
                ['title_hi'=>'सामाजिक योगदान','title_en'=>'Social Contribution','content_hi'=>'संविधान जागरूकता अभियान, युवाओं को राजनीतिक भागीदारी के लिए प्रेरित और सामाजिक समरसता के लिए निरंतर प्रयासरत।','content_en'=>'Constitution awareness campaign, inspiring youth for political participation and continuous efforts for social harmony.'],
            ];
            $displayJourney = empty($journey) ? $demoJourney : $journey;
            foreach($displayJourney as $index => $item):
            ?>
            <div class="dp-timeline-item <?= $index % 2 == 0 ? 'left' : 'right' ?>">
                <div class="dp-timeline-dot"></div>
                <div class="dp-timeline-card">
                    <h4 data-hi="<?= htmlspecialchars($item['title_hi']) ?>" data-en="<?= htmlspecialchars($item['title_en']) ?>"><?= htmlspecialchars($item['title_hi']) ?></h4>
                    <p data-hi="<?= htmlspecialchars($item['content_hi']) ?>" data-en="<?= htmlspecialchars($item['content_en']) ?>"><?= htmlspecialchars($item['content_hi']) ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ========== NEWSLETTER ========== -->
<section class="dp-newsletter">
    <div class="container">
        <div class="dp-newsletter-inner">
            <div>
                <h3 data-hi="न्यूज़लेटर सब्सक्राइब करें" data-en="Subscribe to Newsletter">न्यूज़लेटर सब्सक्राइब करें</h3>
                <p data-hi="हमारी गतिविधियों और समाचारों पर अपडेट रहें।" data-en="Stay updated on our activities and news.">हमारी गतिविधियों और समाचारों पर अपडेट रहें।</p>
            </div>
            <form class="dp-newsletter-form" onsubmit="return false;">
                <input type="email" placeholder="आपका ईमेल पता" class="dp-nl-input">
                <button type="submit" class="dp-btn-primary" data-hi="सब्सक्राइब" data-en="Subscribe">सब्सक्राइब</button>
            </form>
        </div>
    </div>
</section>

<!-- ========== STAY CONNECTED ========== -->
<section class="dp-section dp-social">
    <div class="container">
        <div class="text-center mb-5">
            <div class="dp-section-label" data-hi="सोशल मीडिया" data-en="Social Media">सोशल मीडिया</div>
            <h2 class="dp-section-title" data-hi="जुड़े रहें" data-en="Stay Connected">जुड़े रहें</h2>
            <div class="dp-title-line mx-auto"></div>
        </div>
        <div class="row g-4 justify-content-center">
            <!-- Facebook -->
            <div class="col-md-3 col-6">
                <div class="dp-social-card" style="--sc:#1877F2;">
                    <div class="dp-social-icon"><i class="fab fa-facebook-f fa-2x"></i></div>
                    <h5>Facebook</h5>
                    <p class="small text-muted">dadduprasadoffice</p>
                    <a href="https://www.facebook.com/dadduprasadoffice/" target="_blank" class="dp-social-btn" style="background:#1877F2;" data-hi="फॉलो करें" data-en="Follow Us">फॉलो करें</a>
                </div>
            </div>
            <!-- Twitter -->
            <div class="col-md-3 col-6">
                <div class="dp-social-card" style="--sc:#1DA1F2;">
                    <div class="dp-social-icon"><i class="fab fa-twitter fa-2x"></i></div>
                    <h5>Twitter / X</h5>
                    <p class="small text-muted">@dadduprasad</p>
                    <a href="https://twitter.com/dadduprasad" target="_blank" class="dp-social-btn" style="background:#1DA1F2;" data-hi="फॉलो करें" data-en="Follow Us">फॉलो करें</a>
                </div>
            </div>
            <!-- Instagram -->
            <div class="col-md-3 col-6">
                <div class="dp-social-card" style="--sc:#E1306C;">
                    <div class="dp-social-icon"><i class="fab fa-instagram fa-2x"></i></div>
                    <h5>Instagram</h5>
                    <p class="small text-muted">daddu.prasad</p>
                    <a href="https://instagram.com/daddu.prasad" target="_blank" class="dp-social-btn" style="background:radial-gradient(circle at 30% 107%,#fdf497 0%,#fdf497 5%,#fd5949 45%,#d6249f 60%,#285AEB 90%);" data-hi="फॉलो करें" data-en="Follow Us">फॉलो करें</a>
                </div>
            </div>
            <!-- YouTube -->
            <div class="col-md-3 col-6">
                <div class="dp-social-card" style="--sc:#FF0000;">
                    <div class="dp-social-icon"><i class="fab fa-youtube fa-2x"></i></div>
                    <h5>YouTube</h5>
                    <p class="small text-muted">@DadduPrasad</p>
                    <?php if(!empty($media)): ?>
                        <?php foreach($media as $vid): ?>
                        <div class="dp-yt-embed mb-2">
                            <iframe src="<?= htmlspecialchars(getYoutubeEmbedUrl($vid['media_url'])) ?>" width="100%" height="120" frameborder="0" allowfullscreen></iframe>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <a href="https://www.youtube.com/@DadduPrasad" target="_blank" class="dp-social-btn" style="background:#FF0000;" data-hi="सब्सक्राइब करें" data-en="Subscribe">सब्सक्राइब करें</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
