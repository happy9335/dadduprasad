<?php
/**
 * seed_all_data.php
 * Run ONCE: inserts / updates ALL hardcoded data into the database
 * Visit: http://localhost/DADDU%20PRASAD/seed_all_data.php
 */
require_once 'db.php';

$errors = [];
$done   = [];

function tryRun($pdo, $sql, $label, &$done, &$errors) {
    try {
        $pdo->exec($sql);
        $done[] = $label;
    } catch (PDOException $e) {
        $errors[] = "$label: " . $e->getMessage();
    }
}

/* ══ 1. Settings ══ */
$settings = [
    ['hero_tagline',   '"सामाजिक न्याय, समता और संवैधानिक अधिकारों की रक्षा ही मेरा संकल्प है।"',
                       '"Social justice, equality, and protection of constitutional rights is my resolve."'],
    ['hero_intro',     'माननीय श्री दद्दू प्रसाद जी उत्तर प्रदेश सरकार में पूर्व कैबिनेट मंत्री रह चुके हैं। उनका संपूर्ण राजनीतिक जीवन समाज के वंचित, पिछड़े एवं कमजोर वर्गों के उत्थान के लिए समर्पित रहा है।',
                       "Hon'ble Shri Daddoo Prasad Ji is a former Cabinet Minister in the Government of Uttar Pradesh. His entire political life has been dedicated to the upliftment of the deprived, backward, and weaker sections of the society."],
    ['about_lead',     'श्री दद्दू प्रसाद जी एक अनुभवी राजनेता एवं सामाजिक चिंतक हैं। वे जमीनी स्तर से उठकर प्रदेश की राजनीति में महत्वपूर्ण स्थान तक पहुँचे।',
                       'Shri Daddoo Prasad Ji is an experienced politician and social thinker. He rose from the grassroots to a significant position in state politics.'],
    ['about_desc',     'उन्होंने सदैव समाज के अंतिम व्यक्ति तक सरकारी योजनाओं का लाभ पहुँचाने का प्रयास किया।',
                       'He always strove to bring the benefits of government schemes to the last person in society.'],
    ['contact_address','लखनऊ, उत्तर प्रदेश', 'Lucknow, Uttar Pradesh'],
    ['contact_phone',  '+91 9876543210',       '+91 9876543210'],
    ['contact_email',  'contact@daddooprasad.in', 'contact@daddooprasad.in'],
    ['contact_hours',  'सुबह 10:00 बजे से दोपहर 2:00 बजे तक', '10:00 AM to 2:00 PM'],
    ['fb_link',        'https://www.facebook.com/dadduprasadoffice/', 'https://www.facebook.com/dadduprasadoffice/'],
    ['twitter_link',   'https://twitter.com/dadduprasad', 'https://twitter.com/dadduprasad'],
    ['yt_link',        'https://www.youtube.com/@DadduPrasad', 'https://www.youtube.com/@DadduPrasad'],
    ['ig_link',        'https://instagram.com/daddu.prasad', 'https://instagram.com/daddu.prasad'],
];
$stmt = $pdo->prepare("INSERT INTO settings (setting_key, value_hi, value_en)
    VALUES (?, ?, ?)
    ON DUPLICATE KEY UPDATE value_hi=VALUES(value_hi), value_en=VALUES(value_en)");
foreach ($settings as $s) {
    try { $stmt->execute($s); $done[] = "Setting: {$s[0]}"; }
    catch (PDOException $e) { $errors[] = "Setting {$s[0]}: " . $e->getMessage(); }
}

/* ══ 2. Home Slider ══ */
$pdo->exec("DELETE FROM home_slider");
$sliders = [
    ['https://www.bjp.org/files/photo-gallery/Hon%27ble%20BJP%20National%20President%20Shri%20J.P.%20Nadda%20addressing%20a%20public%20rally%20at%20Highmid%20Ground%20Sonbhadra%20%28Robertsganj%29%20Uttar%20Pradesh%20%284%29.jpg',
     'सामाजिक न्याय के प्रति संकल्पित', 'Committed to Social Justice', 1],
    ['https://img-s-msn-com.akamaized.net/tenant/amp/entityid/AA1OVQr7.img?f=jpg&h=580&m=6&q=80&u=t&w=900',
     'निरंतर जनसेवा का प्रयास', 'Continuous Effort in Public Service', 2],
    ['https://static.toiimg.com/thumb/msid-117165608%2Cwidth-1070%2Cheight-580%2Cimgsize-102798%2Cresizemode-75%2Coverlay-toi_sw%2Cpt-32%2Cy_pad-40/photo.jpg',
     'जन सेवा ही परमो धर्मः', 'Service to People is Supreme Duty', 3],
    ['https://www.bjp.org/files/photo-gallery/Hon%27ble%20BJP%20National%20President%20Shri%20J.P.%20Nadda%20addressing%20a%20public%20rally%20at%20Highmid%20Ground%20Sonbhadra%20%28Robertsganj%29%20Uttar%20Pradesh%20%284%29.jpg',
     'संविधान की रक्षा करना हमारा संकल्प', 'Protecting the Constitution is Our Resolve', 4],
    ['https://img-s-msn-com.akamaized.net/tenant/amp/entityid/AA1OVQr7.img?f=jpg&h=580&m=6&q=80&u=t&w=900',
     'समाज के अंतिम व्यक्ति तक न्याय पहुँचाना हमारा लक्ष्य', 'Justice for Every Person is Our Goal', 5],
];
$stmt = $pdo->prepare("INSERT INTO home_slider (image_url, title_hi, title_en, display_order) VALUES (?, ?, ?, ?)");
foreach ($sliders as $s) {
    try { $stmt->execute($s); $done[] = "Slider: {$s[1]}"; }
    catch (PDOException $e) { $errors[] = "Slider: " . $e->getMessage(); }
}

/* ══ 3. Achievements ══ */
$pdo->exec("DELETE FROM achievements");
$achs = [
    ['सामाजिक न्याय योजनाओं का प्रभावी क्रियान्वयन', 'Effective implementation of Social Justice Schemes',
     'उत्तर प्रदेश सरकार में मंत्री रहते हुए सामाजिक न्याय योजनाओं को प्रभावी ढंग से लागू किया।',
     'Effectively implemented social justice schemes as a Minister in the Govt. of Uttar Pradesh.', 1],
    ['छात्रवृत्ति एवं कल्याणकारी योजनाओं का विस्तार', 'Expansion of Scholarship & Welfare Schemes',
     'वंचित वर्गों के छात्रों के लिए छात्रवृत्ति और कल्याणकारी योजनाओं का विस्तार किया।',
     'Expanded scholarships and welfare schemes for students from underprivileged sections.', 2],
    ['ग्रामीण विकास कार्यक्रमों को बढ़ावा', 'Promotion of Rural Development Programs',
     'ग्रामीण क्षेत्रों में बुनियादी सुविधाओं के विकास के लिए विशेष कार्यक्रम चलाए।',
     'Conducted special programs for development of basic facilities in rural areas.', 3],
    ['कमजोर वर्गों के अधिकारों की रक्षा', 'Protection of Rights of Weaker Sections',
     'अनुसूचित जाति, जनजाति और अन्य पिछड़े वर्गों के संवैधानिक अधिकारों की रक्षा की।',
     'Protected constitutional rights of SC, ST and other backward classes.', 4],
    ['संविधान जागरूकता अभियान', 'Constitution Awareness Campaign',
     'देश भर में संविधान के प्रति जागरूकता फैलाने के लिए व्यापक अभियान चलाया।',
     'Conducted extensive campaigns to spread awareness about the Constitution across the country.', 5],
    ['युवाओं को राजनीतिक भागीदारी के लिए प्रेरित', 'Inspiring Youth for Political Participation',
     'युवाओं को लोकतांत्रिक प्रक्रिया में भाग लेने और राजनीतिक जागरूकता के लिए प्रेरित किया।',
     'Inspired youth to participate in democratic processes and raise political awareness.', 6],
];
$stmt = $pdo->prepare("INSERT INTO achievements (category_hi, category_en, description_hi, description_en, display_order) VALUES (?, ?, ?, ?, ?)");
foreach ($achs as $a) {
    try { $stmt->execute($a); $done[] = "Achievement: {$a[0]}"; }
    catch (PDOException $e) { $errors[] = "Ach: " . $e->getMessage(); }
}

/* ══ 4. Biography / Timeline ══ */
$pdo->exec("DELETE FROM biography");
$bios = [
    ['प्रारंभिक जीवन', 'Early Life',
     'उत्तर प्रदेश के एक साधारण परिवार में जन्मे श्री दद्दू प्रसाद जी ने संघर्षपूर्ण परिस्थितियों में शिक्षा प्राप्त की। बचपन से ही सामाजिक असमानता और भेदभाव को करीब से देखने के कारण उन्होंने समाज सेवा का मार्ग चुना।',
     'Born in a humble family in Uttar Pradesh, Shri Daddoo Prasad Ji received his education in difficult circumstances. Witnessing social inequality from an early age, he chose the path of social service.', 1],
    ['शिक्षा', 'Education',
     'उन्होंने स्नातक एवं उच्च शिक्षा प्राप्त कर सामाजिक और राजनीतिक विषयों में गहरी रुचि विकसित की। शिक्षा के दौरान वे छात्र आंदोलनों में सक्रिय रहे।',
     'He completed his graduation and higher education, developing a deep interest in social and political subjects. He was active in student movements during his education.', 2],
    ['राजनीतिक यात्रा आरंभ', 'Beginning of Political Journey',
     'समाजवादी पार्टी के साथ जुड़कर जनता की आवाज को विधानसभा तक पहुँचाया। वे समाज के वंचित वर्गों के अधिकारों के लिए निरंतर संघर्ष करते रहे।',
     'Joining the Samajwadi Party, he brought the voice of the people to the legislature. He continuously fought for the rights of the underprivileged sections of society.', 3],
    ['मंत्रिमंडल में कार्य', 'Work in Cabinet',
     'उत्तर प्रदेश सरकार में कैबिनेट मंत्री के रूप में सामाजिक न्याय एवं अधिकारिता विभाग की जिम्मेदारी सँभाली। वंचित वर्गों के लिए अनेक योजनाएं सफलतापूर्वक क्रियान्वित कीं।',
     'As Cabinet Minister in the Govt. of UP, he handled the Department of Social Justice & Empowerment. He successfully implemented many schemes for the underprivileged.', 4],
    ['सामाजिक योगदान एवं वर्तमान', 'Social Contribution & Present',
     'संविधान जागरूकता अभियान चलाते हुए युवाओं को राजनीतिक भागीदारी के लिए प्रेरित कर रहे हैं। सामाजिक परिवर्तन मिशन के राष्ट्रीय संयोजक के रूप में कार्यरत हैं।',
     'Running Constitution awareness campaigns and inspiring youth for political participation. Currently serving as National Convenor of the Social Change Mission.', 5],
];
$stmt = $pdo->prepare("INSERT INTO biography (title_hi, title_en, content_hi, content_en, display_order) VALUES (?, ?, ?, ?, ?)");
foreach ($bios as $b) {
    try { $stmt->execute($b); $done[] = "Bio: {$b[0]}"; }
    catch (PDOException $e) { $errors[] = "Bio: " . $e->getMessage(); }
}

/* ══ 5. Press Releases ══ */
// Keep existing, add more if only 1 exists
$count = $pdo->query("SELECT COUNT(*) FROM press_releases")->fetchColumn();
if ($count < 4) {
    $prs = [
        ['2026-02-20', '', 'लखनऊ', 'Lucknow',
         'ग्रामीण विकास योजनाओं का शुभारंभ', 'Rural Development Schemes Launched',
         'श्री दद्दू प्रसाद जी ने ग्रामीण क्षेत्रों में नई विकास योजनाओं का शुभारंभ किया।',
         'Shri Daddoo Prasad Ji launched new development schemes in rural areas.'],
        ['2026-02-15', '', 'प्रयागराज', 'Prayagraj',
         'संविधान जागरूकता अभियान का आयोजन', 'Constitution Awareness Program Held',
         'संविधान जागरूकता अभियान के तहत प्रयागराज में एक विशाल जनसभा का आयोजन किया गया।',
         'A large public meeting was organized in Prayagraj under the Constitution Awareness Campaign.'],
        ['2026-02-10', '', 'वाराणसी', 'Varanasi',
         'युवाओं के लिए रोजगार सृजन कार्यक्रम', 'Employment Generation Program for Youth',
         'युवाओं को रोजगार के अवसर प्रदान करने हेतु विशेष कौशल विकास कार्यक्रम का आयोजन।',
         'A special skill development program was organized to provide employment opportunities to youth.'],
        ['2026-02-05', '', 'आगरा', 'Agra',
         'छात्रवृत्ति वितरण समारोह', 'Scholarship Distribution Ceremony',
         'वंचित वर्ग के मेधावी छात्रों को छात्रवृत्ति वितरण समारोह का आयोजन किया।',
         'A scholarship distribution ceremony was organized for meritorious students from underprivileged sections.'],
    ];
    $stmt = $pdo->prepare("INSERT INTO press_releases (release_date, image_url, location_hi, location_en, title_hi, title_en, content_hi, content_en) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    foreach ($prs as $p) {
        try { $stmt->execute($p); $done[] = "Press: {$p[4]}"; }
        catch (PDOException $e) { $errors[] = "Press: " . $e->getMessage(); }
    }
}

/* ══ 6. Media Gallery ══ */
$mc = $pdo->query("SELECT COUNT(*) FROM media_gallery WHERE media_type='video'")->fetchColumn();
if ($mc < 2) {
    $vids = [
        ['video', 'भाषण', 'Speech', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'दद्दू प्रसाद जी का संदेश', 'Message from Daddoo Prasad Ji', 1],
        ['video', 'जनसभा', 'Public Rally', 'https://www.youtube.com/watch?v=9bZkp7q19f0', 'जनसभा 2025', 'Public Rally 2025', 2],
    ];
    $stmt = $pdo->prepare("INSERT INTO media_gallery (media_type, category_hi, category_en, media_url, caption_hi, caption_en, display_order) VALUES (?, ?, ?, ?, ?, ?, ?)");
    foreach ($vids as $v) {
        try { $stmt->execute($v); $done[] = "Video: {$v[4]}"; }
        catch (PDOException $e) { $errors[] = "Video: " . $e->getMessage(); }
    }
}
?>
<!DOCTYPE html>
<html lang="hi">
<head>
<meta charset="UTF-8">
<title>Database Seed — Daddoo Prasad</title>
<style>
body { font-family: sans-serif; max-width: 800px; margin: 40px auto; padding: 20px; background: #f0f4f8; }
h1 { color: #003893; }
.ok { background: #d4edda; border: 1px solid #c3e6cb; border-radius: 6px; padding: 10px 14px; margin: 4px 0; color: #155724; font-size: .88rem; }
.err { background: #f8d7da; border: 1px solid #f5c6cb; border-radius: 6px; padding: 10px 14px; margin: 4px 0; color: #721c24; font-size: .88rem; }
.summary { font-size: 1.1rem; font-weight: bold; margin: 20px 0 10px; }
a.btn { display:inline-block; margin-top:20px; padding:12px 24px; background:#003893; color:#fff; border-radius:6px; text-decoration:none; font-weight:600; }
</style>
</head>
<body>
<h1>🌱 Database Seed — Daddoo Prasad Website</h1>
<p>All hardcoded data inserted/updated into the database.</p>

<div class="summary">✅ Completed (<?= count($done) ?> operations):</div>
<?php foreach ($done as $d): ?>
<div class="ok">✓ <?= htmlspecialchars($d) ?></div>
<?php endforeach; ?>

<?php if (!empty($errors)): ?>
<div class="summary" style="color:#721c24">❌ Errors (<?= count($errors) ?>):</div>
<?php foreach ($errors as $err): ?>
<div class="err">✗ <?= htmlspecialchars($err) ?></div>
<?php endforeach; ?>
<?php endif; ?>

<a href="index.php" class="btn">🏠 View Website</a>
<a href="seed_all_data.php" class="btn" style="background:#28a745;margin-left:10px">🔄 Run Again</a>
</body>
</html>
