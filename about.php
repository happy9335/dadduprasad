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

<!-- About Section -->
<section id="about" class="section about-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title" data-hi="हमारे बारे में" data-en="About Us">हमारे बारे में</h2>
            <div class="title-underline"></div>
        </div>
        <div class="about-content">
            <p class="lead-text" data-hi="<?= htmlspecialchars($about_lead_hi) ?>" data-en="<?= htmlspecialchars($about_lead_en) ?>">
                <?= htmlspecialchars($about_lead_hi) ?>
            </p>
            <p data-hi="<?= htmlspecialchars($about_desc_hi) ?>" data-en="<?= htmlspecialchars($about_desc_en) ?>">
                <?= htmlspecialchars($about_desc_hi) ?>
            </p>
        </div>
    </div>
</section>

<!-- Biography Section -->
<section id="biography" class="section biography-section bg-light">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title" data-hi="विस्तृत जीवन परिचय" data-en="Political Journey">विस्तृत जीवन परिचय</h2>
            <div class="title-underline"></div>
        </div>
        
        <div class="bio-timeline">
            <?php foreach($biographyItems as $item): ?>
                <div class="bio-item">
                    <div class="bio-icon <?= htmlspecialchars($item['bg_color_class']) ?>"><i class="<?= htmlspecialchars($item['icon_class']) ?>"></i></div>
                    <div class="bio-text">
                        <h3 data-hi="<?= htmlspecialchars($item['title_hi']) ?>" data-en="<?= htmlspecialchars($item['title_en']) ?>"><?= htmlspecialchars($item['title_hi']) ?></h3>
                        <p data-hi="<?= htmlspecialchars($item['content_hi']) ?>" data-en="<?= htmlspecialchars($item['content_en']) ?>"><?= htmlspecialchars($item['content_hi']) ?></p>
                        
                        <?php if(!empty($item['list_items_hi'])): 
                            $listHi = explode('|', $item['list_items_hi']);
                            $listEn = explode('|', $item['list_items_en']);
                        ?>
                            <ul class="styled-list mt-2">
                                <?php foreach($listHi as $index => $li_hi): ?>
                                    <li data-hi="<?= htmlspecialchars(trim($li_hi)) ?>" data-en="<?= htmlspecialchars(trim($listEn[$index] ?? '')) ?>"><?= htmlspecialchars(trim($li_hi)) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
