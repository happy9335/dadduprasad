<?php
require_once 'includes/header.php';

/* ─── DB Fetch ─── */
$tagline    = getSettingVal($pdo, 'hero_tagline');
$intro_row  = getSettingVal($pdo, 'hero_intro');
$about_lead = getSettingVal($pdo, 'about_lead');

$tagline_hi = $tagline['value_hi']  ?: '"सामाजिक न्याय, समता और संवैधानिक अधिकारों की रक्षा ही मेरा संकल्प है।"';
$tagline_en = $tagline['value_en']  ?: '"Committed to Social Justice, Equality and Constitutional Rights"';
$intro_hi   = $intro_row['value_hi']?: 'माननीय श्री दद्दू प्रसाद जी उत्तर प्रदेश सरकार में पूर्व कैबिनेट मंत्री रह चुके हैं।';
$intro_en   = $intro_row['value_en']?: "Hon'ble Shri Daddoo Prasad Ji is a former Cabinet Minister in the Government of Uttar Pradesh.";
$about_hi   = $about_lead['value_hi']?: 'श्री दद्दू प्रसाद जी एक अनुभवी राजनेता एवं सामाजिक चिंतक हैं।';
$about_en   = $about_lead['value_en']?: 'Shri Daddoo Prasad Ji is an experienced politician and social thinker.';

$sliders      = $pdo->query("SELECT * FROM home_slider ORDER BY display_order ASC")->fetchAll();
$pressReleases= $pdo->query("SELECT * FROM press_releases ORDER BY release_date DESC LIMIT 5")->fetchAll();
$achievements = $pdo->query("SELECT * FROM achievements ORDER BY display_order ASC LIMIT 6")->fetchAll();
$journey      = $pdo->query("SELECT * FROM biography ORDER BY display_order ASC")->fetchAll();
$media        = $pdo->query("SELECT * FROM media_gallery WHERE media_type='video' ORDER BY display_order ASC LIMIT 3")->fetchAll();

/* Fallback demo slides */
if (empty($sliders)) {
    $sliders = [
        ['image_url'=>'https://static.toiimg.com/thumb/msid-117165608%2Cwidth-1070%2Cheight-580%2Cimgsize-102798%2Cresizemode-75%2Coverlay-toi_sw%2Cpt-32%2Cy_pad-40/photo.jpg','title_hi'=>$tagline_hi,'title_en'=>$tagline_en],
        ['image_url'=>'https://img-s-msn-com.akamaized.net/tenant/amp/entityid/AA1OVQr7.img?f=jpg&h=580&m=6&q=80&u=t&w=900','title_hi'=>'जन सेवा ही परमो धर्मः','title_en'=>'Service to People is Supreme Duty'],
    ];
}
?>

<!-- ══════════ HERO (Supriya Sule Style: Split Light/Photo) ══════════ -->
<section class="ss-hero-v2">
    <div class="swiper ss-swiper">
        <div class="swiper-wrapper">
            <?php foreach($sliders as $idx => $sl): ?>
            <div class="swiper-slide ss-slide-v2">
                <!-- Left: light gradient with text -->
                <div class="ss-slide-left">
                    <div class="ss-slide-content">
                        <p class="ss-slide-label" data-hi="पूर्व कैबिनेट मंत्री · उत्तर प्रदेश" data-en="Former Cabinet Minister · Uttar Pradesh">
                            पूर्व कैबिनेट मंत्री · उत्तर प्रदेश
                        </p>
                        <h1 class="ss-slide-heading" data-hi="<?= htmlspecialchars($sl['title_hi'] ?? $tagline_hi) ?>" data-en="<?= htmlspecialchars($sl['title_en'] ?? $tagline_en) ?>">
                            <?= htmlspecialchars(mb_substr($sl['title_hi'] ?? $tagline_hi, 0, 40)) ?>
                            <span><?= htmlspecialchars(mb_substr($sl['title_hi'] ?? $tagline_hi, 40)) ?></span>
                        </h1>
                        <div class="ss-slide-actions">
                            <a href="about.php" class="ss-btn-slide-primary" data-hi="परिचय पढ़ें" data-en="Read More">परिचय पढ़ें</a>
                            <a href="contact.php" class="ss-btn-slide-ghost" data-hi="संपर्क करें" data-en="Contact Us">संपर्क करें</a>
                        </div>
                        <div class="ss-slide-links">
                            <a href="press.php"><i class="fas fa-newspaper"></i> <span data-hi="प्रेस" data-en="Press">प्रेस</span></a>
                            <a href="gallery.php"><i class="fas fa-images"></i> <span data-hi="गैलरी" data-en="Gallery">गैलरी</span></a>
                            <a href="contact.php"><i class="fas fa-calendar-alt"></i> <span data-hi="जनसुनवाई" data-en="Public Hearing">जनसुनवाई</span></a>
                        </div>
                    </div>
                </div>
                <!-- Right: Big photo -->
                <div class="ss-slide-right" style="background-image:url('<?= htmlspecialchars($sl['image_url']) ?>')"></div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="swiper-pagination ss-dots-v2"></div>
        <div class="swiper-button-prev ss-prev-v2"></div>
        <div class="swiper-button-next ss-next-v2"></div>
    </div>

    <!-- Bottom info strip -->
    <div class="ss-hero-strip">
        <div class="container">
            <div class="ss-hero-strip-inner">
                <p data-hi="<?= htmlspecialchars($tagline_hi) ?>" data-en="<?= htmlspecialchars($tagline_en) ?>"><?= htmlspecialchars(mb_substr($tagline_hi,0,80)) ?>...</p>
                <a href="about.php" data-hi="अधिक जानें →" data-en="Know More →">अधिक जानें →</a>
            </div>
        </div>
    </div>
</section>

<!-- ══════════ ABOUT ══════════ -->
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
                        <div class="ss-stat"><strong>30+</strong><span data-hi="वर्ष सेवा" data-en="Years Service">वर्ष सेवा</span></div>
                        <div class="ss-stat"><strong>SP</strong><span data-hi="वरिष्ठ नेता" data-en="Senior Leader">वरिष्ठ नेता</span></div>
                        <div class="ss-stat"><strong>UP</strong><span data-hi="कैबिनेट मंत्री" data-en="Cabinet Minister">कैबिनेट मंत्री</span></div>
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
                    <p data-hi="मेरा लक्ष्य है कि समाज का हर व्यक्ति सम्मान और अधिकार के साथ जीवन जी सके। लोकतंत्र की सच्ची शक्ति जनता में है।" data-en="My goal is that every person in society can live with dignity and rights.">
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

<!-- ══════════ PRESS NOTES ══════════ -->
<section class="ss-section ss-press">
    <div class="container">
        <div class="ss-section-top">
            <div>
                <p class="ss-section-kicker" data-hi="मीडिया" data-en="Media">मीडिया</p>
                <h2 class="ss-section-heading" data-hi="प्रेस विज्ञप्ति" data-en="Press Note">प्रेस विज्ञप्ति</h2>
                <div class="ss-rule"></div>
            </div>
            <a href="press.php" class="ss-link-more" data-hi="सभी देखें →" data-en="View All →">सभी देखें →</a>
        </div>

        <div class="row g-0">
            <!-- Featured (big) -->
            <?php
            $demoPress = [
                ['title_hi'=>'माननीय दद्दू प्रसाद जी ने सामाजिक न्याय सम्मेलन को संबोधित किया','title_en'=>'Daddoo Prasad Ji addressed Social Justice Conference','image_url'=>'https://img-s-msn-com.akamaized.net/tenant/amp/entityid/AA1OVQr7.img?f=jpg&h=232&m=6&q=60&u=t&w=412','release_date'=>'2025-01-15'],
                ['title_hi'=>'ग्रामीण विकास के लिए नई योजनाओं का शुभारंभ','title_en'=>'New Schemes for Rural Development Launched','image_url'=>'https://static.toiimg.com/thumb/msid-117165608%2Cwidth-1070%2Cheight-580%2Cimgsize-102798%2Cresizemode-75%2Coverlay-toi_sw%2Cpt-32%2Cy_pad-40/photo.jpg','release_date'=>'2025-02-20'],
                ['title_hi'=>'युवाओं के लिए रोजगार सृजन अभियान','title_en'=>'Employment Generation Drive for Youth','image_url'=>'https://m.media-amazon.com/images/I/51dQBAlC7rL.jpg','release_date'=>'2025-03-10'],
                ['title_hi'=>'संविधान जागरूकता अभियान का शुभारंभ','title_en'=>'Constitution Awareness Campaign Launch','image_url'=>'https://www.bjp.org/files/photo-gallery/Hon%27ble%20BJP%20National%20President%20Shri%20J.P.%20Nadda%20addressing%20a%20public%20rally%20at%20Highmid%20Ground%20Sonbhadra%20%28Robertsganj%29%20Uttar%20Pradesh%20%284%29.jpg','release_date'=>'2025-04-05'],
                ['title_hi'=>'समाजिक समरसता कार्यक्रम में सहभागिता','title_en'=>'Participated in Social Harmony Program','image_url'=>'https://img-s-msn-com.akamaized.net/tenant/amp/entityid/AA1OVQr7.img?f=jpg&h=232&m=6&q=60&u=t&w=412','release_date'=>'2025-05-01'],
            ];
            $dp = empty($pressReleases) ? $demoPress : $pressReleases;
            $feat = $dp[0];
            ?>
            <div class="col-md-5">
                <a href="press.php" class="ss-press-big">
                    <div class="ss-press-big-img" style="background-image:url('<?= htmlspecialchars($feat['image_url'] ?? '') ?>')"></div>
                    <div class="ss-press-big-body">
                        <span class="ss-press-date"><?= date('d M Y', strtotime($feat['release_date'])) ?></span>
                        <h3 class="ss-press-big-title" data-hi="<?= htmlspecialchars($feat['title_hi']) ?>" data-en="<?= htmlspecialchars($feat['title_en'] ?? '') ?>">
                            <?= htmlspecialchars($feat['title_hi']) ?>
                        </h3>
                    </div>
                </a>
            </div>
            <!-- List column -->
            <div class="col-md-7">
                <ul class="ss-press-list">
                    <?php for($i=1; $i<count($dp) && $i<5; $i++): $p = $dp[$i]; ?>
                    <li class="ss-press-item">
                        <a href="press.php" class="ss-press-item-link">
                            <span class="ss-press-item-date"><?= date('d M Y', strtotime($p['release_date'])) ?></span>
                            <span class="ss-press-item-title" data-hi="<?= htmlspecialchars($p['title_hi']) ?>" data-en="<?= htmlspecialchars($p['title_en'] ?? '') ?>">
                                <?= htmlspecialchars(mb_substr($p['title_hi'], 0, 90)) ?>...
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

<!-- ══════════ ACHIEVEMENTS ══════════ -->
<section class="ss-section ss-ach">
    <div class="container">
        <div class="ss-section-top">
            <div>
                <p class="ss-section-kicker kicker-light" data-hi="मील के पत्थर" data-en="Milestones">मील के पत्थर</p>
                <h2 class="ss-section-heading text-white" data-hi="उपलब्धियाँ एवं पुरस्कार" data-en="Achievements & Awards">उपलब्धियाँ एवं पुरस्कार</h2>
                <div class="ss-rule" style="background:var(--dp-yellow)"></div>
            </div>
            <a href="achievements.php" class="ss-link-more" style="color:rgba(255,255,255,0.7);" data-hi="सभी देखें →" data-en="View All →">सभी देखें →</a>
        </div>
        <div class="row g-4">
            <?php
            $achIcons = ['fas fa-balance-scale','fas fa-graduation-cap','fas fa-home','fas fa-shield-alt','fas fa-book-open','fas fa-users'];
            $demoAch = [
                ['category_hi'=>'सामाजिक न्याय योजनाओं का प्रभावी क्रियान्वयन','category_en'=>'Effective Implementation of Social Justice Schemes'],
                ['category_hi'=>'छात्रवृत्ति एवं कल्याणकारी योजनाओं का विस्तार','category_en'=>'Expansion of Scholarship & Welfare Schemes'],
                ['category_hi'=>'ग्रामीण विकास कार्यक्रमों को बढ़ावा','category_en'=>'Promotion of Rural Development Programs'],
                ['category_hi'=>'कमजोर वर्गों के अधिकारों की रक्षा','category_en'=>'Protection of Rights of Weaker Sections'],
                ['category_hi'=>'संविधान जागरूकता अभियान','category_en'=>'Constitution Awareness Campaign'],
                ['category_hi'=>'युवाओं को राजनीतिक भागीदारी के लिए प्रेरित','category_en'=>'Inspiring Youth for Political Participation'],
            ];
            $da = empty($achievements) ? $demoAch : $achievements;
            foreach($da as $i=>$ach): if($i>=6) break;
            ?>
            <div class="col-md-4 col-6">
                <div class="ss-ach-card">
                    <i class="<?= $achIcons[$i % 6] ?> ss-ach-icon"></i>
                    <p class="ss-ach-text" data-hi="<?= htmlspecialchars($ach['category_hi']) ?>" data-en="<?= htmlspecialchars($ach['category_en'] ?? '') ?>">
                        <?= htmlspecialchars($ach['category_hi']) ?>
                    </p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ══════════ POLITICAL JOURNEY ══════════ -->
<section class="ss-section ss-journey">
    <div class="container">
        <div class="row align-items-start g-5">
            <!-- Left: Title block -->
            <div class="col-lg-4">
                <div class="ss-journey-intro sticky-top" style="top: 100px;">
                    <p class="ss-section-kicker" data-hi="राजनीतिक सफर" data-en="Political Journey">राजनीतिक सफर</p>
                    <h2 class="ss-section-heading" data-hi="नेतृत्व.<br>अनुभव.<br>मूल्य." data-en="Leadership.<br>Experience.<br>Values.">नेतृत्व.<br>अनुभव.<br>मूल्य.</h2>
                    <div class="ss-rule"></div>
                    <p class="ss-journey-desc" data-hi="पिछले 30 वर्षों में दद्दू प्रसाद जी ने समाजवादी पार्टी के वरिष्ठ नेता और सामाजिक परिवर्तन मिशन के राष्ट्रीय संयोजक के रूप में खुद को स्थापित किया है।" data-en="Over the past 30 years, Daddoo Prasad Ji has established himself as a senior Samajwadi Party leader and the National Convenor of Samajik Parivartan Mission, India.">
                        पिछले 30 वर्षों में दद्दू प्रसाद जी ने समाजवादी पार्टी के वरिष्ठ नेता और सामाजिक परिवर्तन मिशन के राष्ट्रीय संयोजक के रूप में खुद को स्थापित किया है।
                    </p>
                    <a href="about.php" class="ss-btn-primary mt-3" data-hi="पूरी जीवनी पढ़ें →" data-en="Read Full Biography →">पूरी जीवनी पढ़ें →</a>
                </div>
            </div>
            <!-- Right: Timeline -->
            <div class="col-lg-8">
                <div class="ss-timeline">
                    <?php
                    $demoJourney = [
                        ['title_hi'=>'प्रारंभिक जीवन','title_en'=>'Early Life','content_hi'=>'उत्तर प्रदेश के एक साधारण परिवार में जन्मे, संघर्षपूर्ण परिस्थितियों में शिक्षा प्राप्त की। सामाजिक असमानता और भेदभाव को करीब से देखने के कारण समाज सेवा का मार्ग चुना।','content_en'=>'Born in a humble family in Uttar Pradesh. Witnessed social inequality firsthand, leading to choosing the path of social service.'],
                        ['title_hi'=>'शिक्षा एवं छात्र जीवन','title_en'=>'Education & Student Life','content_hi'=>'स्नातक एवं उच्च शिक्षा प्राप्त कर सामाजिक और राजनीतिक विषयों में गहरी रुचि विकसित की। शिक्षा के दौरान छात्र आंदोलनों में सक्रिय रहे।','content_en'=>'Completed graduation and higher education, developing deep interest in social and political subjects. Active in student movements.'],
                        ['title_hi'=>'राजनीतिक जीवन की शुरुआत','title_en'=>'Beginning of Political Life','content_hi'=>'सामाजिक आंदोलनों से राजनीतिक जीवन की शुरुआत। जनता की समस्याओं को विधानसभा तक पहुँचाया। समाजवादी पार्टी से जुड़कर जन नेतृत्व किया।','content_en'=>'Started political life from social movements. Brought people\'s problems to the legislature. Led public leadership through the Samajwadi Party.'],
                        ['title_hi'=>'कैबिनेट मंत्री — उत्तर प्रदेश सरकार','title_en'=>'Cabinet Minister — UP Government','content_hi'=>'उत्तर प्रदेश सरकार में कैबिनेट मंत्री के रूप में सामाजिक न्याय एवं अधिकारिता विभागों का कुशलतापूर्वक संचालन किया। वंचित वर्गों के लिए अनेक योजनाएं लागू कीं।','content_en'=>'Efficiently managed Social Justice & Empowerment departments as Cabinet Minister in UP Government. Implemented many schemes for the deprived sections.'],
                        ['title_hi'=>'राष्ट्रीय संयोजक — सामाजिक परिवर्तन मिशन','title_en'=>'National Convenor — Samajik Parivartan Mission','content_hi'=>'सामाजिक परिवर्तन मिशन, भारत के राष्ट्रीय संयोजक के रूप में देशभर में सामाजिक न्याय और समता की अलख जगाने का काम कर रहे हैं।','content_en'=>'Working as National Convenor of Samajik Parivartan Mission, India, spreading the message of social justice and equality across the country.'],
                    ];
                    $dj = empty($journey) ? $demoJourney : $journey;
                    foreach($dj as $idx=>$item):
                    ?>
                    <div class="ss-tl-item">
                        <div class="ss-tl-dot"></div>
                        <div class="ss-tl-line"></div>
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

<!-- ══════════ NEWS + SOCIAL (2-column) ══════════ -->
<section class="ss-section ss-news-social">
    <div class="container">
        <div class="row g-5">
            <!-- Latest News -->
            <div class="col-lg-7">
                <p class="ss-section-kicker" data-hi="ताज़ा खबरें" data-en="Latest News">ताज़ा खबरें</p>
                <h2 class="ss-section-heading" data-hi="नवीनतम समाचार" data-en="Latest News">नवीनतम समाचार</h2>
                <div class="ss-rule"></div>
                <ul class="ss-news-list">
                    <?php foreach($dp as $i => $p): if($i>=5) break; ?>
                    <li class="ss-news-item">
                        <a href="press.php" class="ss-news-link">
                            <div class="ss-news-date">
                                <span class="ss-news-day"><?= date('d', strtotime($p['release_date'])) ?></span>
                                <span class="ss-news-mon"><?= date('M Y', strtotime($p['release_date'])) ?></span>
                            </div>
                            <div class="ss-news-body">
                                <p class="ss-news-title" data-hi="<?= htmlspecialchars($p['title_hi']) ?>" data-en="<?= htmlspecialchars($p['title_en'] ?? '') ?>">
                                    <?= htmlspecialchars(mb_substr($p['title_hi'], 0, 100)) ?>...
                                </p>
                                <span class="ss-news-cta" data-hi="आगे पढ़ें →" data-en="Read More →">आगे पढ़ें →</span>
                            </div>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Stay Connected -->
            <div class="col-lg-5">
                <p class="ss-section-kicker" data-hi="सोशल मीडिया" data-en="Social Media">सोशल मीडिया</p>
                <h2 class="ss-section-heading" data-hi="जुड़े रहें" data-en="Stay Connected">जुड़े रहें</h2>
                <div class="ss-rule"></div>

                <!-- Social Follow Buttons -->
                <div class="ss-socials">
                    <a href="https://www.facebook.com/dadduprasadoffice/" target="_blank" class="ss-social-btn fb">
                        <i class="fab fa-facebook-f"></i> Facebook पर फॉलो करें
                    </a>
                    <a href="https://twitter.com/dadduprasad" target="_blank" class="ss-social-btn tw">
                        <i class="fab fa-twitter"></i> Twitter पर फॉलो करें
                    </a>
                    <a href="https://instagram.com/daddu.prasad" target="_blank" class="ss-social-btn ig">
                        <i class="fab fa-instagram"></i> Instagram पर फॉलो करें
                    </a>
                    <a href="https://www.youtube.com/@DadduPrasad" target="_blank" class="ss-social-btn yt">
                        <i class="fab fa-youtube"></i> YouTube सब्सक्राइब करें
                    </a>
                </div>

                <!-- YouTube Embeds -->
                <?php if(!empty($media)): ?>
                <div class="mt-4">
                    <?php foreach($media as $vid): ?>
                    <div class="ss-yt-wrap mb-3">
                        <iframe src="<?= htmlspecialchars(getYoutubeEmbedUrl($vid['media_url'])) ?>" frameborder="0" allowfullscreen width="100%" height="200"></iframe>
                        <p class="ss-yt-caption mt-1" data-hi="<?= htmlspecialchars($vid['caption_hi']??'') ?>" data-en="<?= htmlspecialchars($vid['caption_en']??'') ?>"><?= htmlspecialchars($vid['caption_hi']??'') ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                <div class="ss-yt-placeholder mt-4">
                    <i class="fab fa-youtube fa-3x text-danger mb-3"></i>
                    <p data-hi="यूट्यूब चैनल पर सब्सक्राइब करें" data-en="Subscribe to YouTube Channel">यूट्यूब चैनल पर सब्सक्राइब करें</p>
                    <a href="https://www.youtube.com/@DadduPrasad" target="_blank" class="ss-btn-primary">Subscribe Now</a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- ══════════ CONTACT STRIP ══════════ -->
<section class="ss-contact-strip">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-md-8">
                <h3 class="ss-contact-title" data-hi="हमसे संपर्क करें" data-en="Get in Touch">हमसे संपर्क करें</h3>
                <div class="ss-contact-details">
                    <?php
                    $addr  = getSettingVal($pdo, 'contact_address');
                    $phone = getSettingVal($pdo, 'contact_phone');
                    $email = getSettingVal($pdo, 'contact_email');
                    $hours = getSettingVal($pdo, 'contact_hours');
                    ?>
                    <span><i class="fas fa-map-marker-alt me-2"></i>
                        <span data-hi="<?= htmlspecialchars($addr['value_hi']) ?>" data-en="<?= htmlspecialchars($addr['value_en']) ?>"><?= htmlspecialchars($addr['value_hi'] ?: 'लखनऊ, उत्तर प्रदेश') ?></span>
                    </span>
                    <span><i class="fas fa-phone me-2"></i>
                        <a href="tel:<?= htmlspecialchars($phone['value_en'] ?: '+91-XXXXXXXXXX') ?>"><?= htmlspecialchars($phone['value_hi'] ?: '+91-XXXXXXXXXX') ?></a>
                    </span>
                    <span><i class="fas fa-envelope me-2"></i>
                        <a href="mailto:<?= htmlspecialchars($email['value_en'] ?: 'info@dadduprasad.in') ?>"><?= htmlspecialchars($email['value_hi'] ?: 'info@dadduprasad.in') ?></a>
                    </span>
                    <span><i class="fas fa-clock me-2"></i>
                        <span data-hi="<?= htmlspecialchars($hours['value_hi']) ?>" data-en="<?= htmlspecialchars($hours['value_en']) ?>"><?= htmlspecialchars($hours['value_hi'] ?: 'सुबह 10:00 - दोपहर 2:00') ?></span>
                    </span>
                </div>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="contact.php" class="ss-btn-primary" data-hi="संदेश भेजें" data-en="Send Message">संदेश भेजें <i class="fas fa-arrow-right ms-2"></i></a>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
