<?php
/**
 * Demo Content Seeder
 * Populates all tables with the official Daddoo Prasad website content
 */
require_once 'db.php';

$errors = [];
$success_count = 0;

// ---- SETTINGS ----
$settings = [
    ['key' => 'hero_tagline',    'value_hi' => '\"सामाजिक न्याय, समता और संवैधानिक अधिकारों की रक्षा ही मेरा संकल्प है।\"', 'value_en' => '"Committed to Social Justice, Equality and Constitutional Rights"'],
    ['key' => 'hero_intro',      'value_hi' => 'माननीय श्री दद्दू प्रसाद जी उत्तर प्रदेश सरकार में पूर्व कैबिनेट मंत्री रह चुके हैं। उनका संपूर्ण राजनीतिक जीवन समाज के वंचित, पिछड़े एवं कमजोर वर्गों के उत्थान के लिए समर्पित रहा है।', 'value_en' => "Hon'ble Shri Daddoo Prasad Ji has served as a Former Cabinet Minister in the Government of Uttar Pradesh. His entire political life is dedicated to the upliftment of the deprived, backward and weaker sections of society."],
    ['key' => 'contact_address', 'value_hi' => 'कार्यालय: उत्तर प्रदेश', 'value_en' => 'Office: Uttar Pradesh'],
    ['key' => 'contact_phone',   'value_hi' => '+91-XXXXXXXXXX', 'value_en' => '+91-XXXXXXXXXX'],
    ['key' => 'contact_email',   'value_hi' => 'info@dadduprasad.in', 'value_en' => 'info@dadduprasad.in'],
    ['key' => 'fb_link',         'value_hi' => 'https://www.facebook.com/dadduprasadoffice/', 'value_en' => 'https://www.facebook.com/dadduprasadoffice/'],
    ['key' => 'twitter_link',    'value_hi' => 'https://twitter.com/dadduprasad', 'value_en' => 'https://twitter.com/dadduprasad'],
    ['key' => 'yt_link',         'value_hi' => 'https://www.youtube.com/@DadduPrasad', 'value_en' => 'https://www.youtube.com/@DadduPrasad'],
    ['key' => 'ig_link',         'value_hi' => 'https://instagram.com/daddu.prasad', 'value_en' => 'https://instagram.com/daddu.prasad'],
];
foreach ($settings as $row) {
    try {
        $pdo->prepare("INSERT IGNORE INTO settings (setting_key, value_hi, value_en) VALUES (?, ?, ?)")
            ->execute([$row['key'], $row['value_hi'], $row['value_en']]);
        $success_count++;
    } catch (Exception $e) { $errors[] = "Settings: " . $e->getMessage(); }
}

// ---- SLIDERS ----
$sliders = [
    ['title_hi' => 'सामाजिक न्याय के प्रति संकल्पित', 'title_en' => 'Committed to Social Justice', 'image_url' => 'https://img-s-msn-com.akamaized.net/tenant/amp/entityid/AA1OVQr7.img?f=jpg&h=232&m=6&q=60&u=t&w=412', 'display_order' => 1],
    ['title_hi' => 'जन सेवा ही परमो धर्मः', 'title_en' => 'Service to People is Supreme Duty', 'image_url' => 'https://static.toiimg.com/thumb/msid-117165608%2Cwidth-1070%2Cheight-580%2Cimgsize-102798%2Cresizemode-75%2Coverlay-toi_sw%2Cpt-32%2Cy_pad-40/photo.jpg', 'display_order' => 2],
    ['title_hi' => 'संविधान की रक्षा करना हमारा संकल्प', 'title_en' => 'Protecting the Constitution is Our Resolve', 'image_url' => 'https://www.bjp.org/files/photo-gallery/Hon%27ble%20BJP%20National%20President%20Shri%20J.P.%20Nadda%20addressing%20a%20public%20rally%20at%20Highmid%20Ground%20Sonbhadra%20%28Robertsganj%29%20Uttar%20Pradesh%20%284%29.jpg', 'display_order' => 3],
];
foreach ($sliders as $row) {
    try {
        $pdo->prepare("INSERT IGNORE INTO home_slider (title_hi, title_en, image_url, display_order) VALUES (?, ?, ?, ?)")
            ->execute([$row['title_hi'], $row['title_en'], $row['image_url'], $row['display_order']]);
        $success_count++;
    } catch (Exception $e) { $errors[] = "Sliders: " . $e->getMessage(); }
}

// ---- ACHIEVEMENTS ----
$achievements = [
    ['category_hi' => 'सामाजिक न्याय योजनाओं का प्रभावी क्रियान्वयन', 'category_en' => 'Effective implementation of Social Justice Schemes', 'display_order' => 1],
    ['category_hi' => 'छात्रवृत्ति एवं कल्याणकारी योजनाओं का विस्तार', 'category_en' => 'Expansion of Scholarship & Welfare Schemes', 'display_order' => 2],
    ['category_hi' => 'ग्रामीण विकास कार्यक्रमों को बढ़ावा', 'category_en' => 'Promotion of Rural Development Programs', 'display_order' => 3],
    ['category_hi' => 'कमजोर वर्गों के अधिकारों की रक्षा', 'category_en' => 'Protection of Rights of Weaker Sections', 'display_order' => 4],
    ['category_hi' => 'संविधान जागरूकता अभियान', 'category_en' => 'Constitution Awareness Campaign', 'display_order' => 5],
    ['category_hi' => 'युवाओं को राजनीतिक भागीदारी के लिए प्रेरित', 'category_en' => 'Inspiring Youth for Political Participation', 'display_order' => 6],
];
foreach ($achievements as $row) {
    try {
        $pdo->prepare("INSERT IGNORE INTO achievements (category_hi, category_en, display_order) VALUES (?, ?, ?)")
            ->execute([$row['category_hi'], $row['category_en'], $row['display_order']]);
        $success_count++;
    } catch (Exception $e) { $errors[] = "Achievements: " . $e->getMessage(); }
}

// ---- BIOGRAPHY (Journey) ----
$journey = [
    ['title_hi' => 'प्रारंभिक जीवन', 'title_en' => 'Early Life', 'content_hi' => 'उत्तर प्रदेश के एक साधारण परिवार में जन्मे श्री दद्दू प्रसाद जी ने संघर्षपूर्ण परिस्थितियों में शिक्षा प्राप्त की। बचपन से ही सामाजिक असमानता और भेदभाव को करीब से देखने के कारण उन्होंने समाज सेवा का मार्ग चुना।', 'content_en' => 'Born in a humble family in Uttar Pradesh, Shri Daddoo Prasad Ji received his education in difficult circumstances. Witnessing social inequality and discrimination from an early age, he chose the path of social service.', 'display_order' => 1],
    ['title_hi' => 'शिक्षा', 'title_en' => 'Education', 'content_hi' => 'उन्होंने स्नातक एवं उच्च शिक्षा प्राप्त कर सामाजिक और राजनीतिक विषयों में गहरी रुचि विकसित की। शिक्षा के दौरान वे छात्र आंदोलनों में सक्रिय रहे।', 'content_en' => 'He completed his graduation and higher education, developing a deep interest in social and political subjects. During his education, he was active in student movements.', 'display_order' => 2],
    ['title_hi' => 'राजनीतिक यात्रा', 'title_en' => 'Political Journey', 'content_hi' => 'सामाजिक आंदोलनों से राजनीतिक जीवन की शुरुआत करते हुए जनता की समस्याओं को विधानसभा तक पहुँचाया। उत्तर प्रदेश सरकार में कैबिनेट मंत्री के रूप में उत्कृष्ट कार्य किया।', 'content_en' => 'Starting his political life from social movements, he brought the problems of the people to the legislature. He worked excellently as a Cabinet Minister in the Government of Uttar Pradesh.', 'display_order' => 3],
    ['title_hi' => 'मंत्रिमंडल में कार्य', 'title_en' => 'Work in Cabinet', 'content_hi' => 'सामाजिक न्याय एवं अधिकारिता से जुड़े विभागों की जिम्मेदारी संभाली। वंचित वर्गों के लिए अनेक योजनाएं क्रियान्वित कीं।', 'content_en' => 'Handled the responsibilities of departments related to social justice and empowerment. Implemented many schemes for the underprivileged sections.', 'display_order' => 4],
    ['title_hi' => 'सामाजिक योगदान', 'title_en' => 'Social Contribution', 'content_hi' => 'संविधान जागरूकता अभियान, युवाओं को राजनीतिक भागीदारी के लिए प्रेरित करना और सामाजिक समरसता के लिए निरंतर प्रयासरत।', 'content_en' => 'Continuously striving for Constitution awareness campaign, inspiring youth for political participation, and social harmony.', 'display_order' => 5],
];
foreach ($journey as $row) {
    try {
        $pdo->prepare("INSERT IGNORE INTO biography (title_hi, title_en, content_hi, content_en, display_order) VALUES (?, ?, ?, ?, ?)")
            ->execute([$row['title_hi'], $row['title_en'], $row['content_hi'], $row['content_en'], $row['display_order']]);
        $success_count++;
    } catch (Exception $e) { $errors[] = "Biography: " . $e->getMessage(); }
}

// ---- PRESS RELEASES ----
$press = [
    ['title_hi' => 'माननीय दद्दू प्रसाद जी ने सामाजिक न्याय सम्मेलन को संबोधित किया', 'title_en' => 'Hon. Daddoo Prasad Ji addressed the Social Justice Conference', 'content_hi' => 'आज आयोजित कार्यक्रम में श्री दद्दू प्रसाद जी ने सामाजिक न्याय, समान अवसर और लोकतांत्रिक मूल्यों पर प्रकाश डाला।', 'content_en' => 'At the event organized today, Shri Daddoo Prasad Ji highlighted social justice, equal opportunities and democratic values.', 'source' => 'Official Press Release', 'image_url' => 'https://img-s-msn-com.akamaized.net/tenant/amp/entityid/AA1OVQr7.img?f=jpg&h=232&m=6&q=60&u=t&w=412', 'release_date' => '2025-01-15'],
    ['title_hi' => 'ग्रामीण विकास के लिए नई योजनाओं का शुभारंभ', 'title_en' => 'Launch of New Schemes for Rural Development', 'content_hi' => 'श्री दद्दू प्रसाद जी ने ग्रामीण क्षेत्रों में विकास कार्यों को गति देने के लिए नई योजनाओं का शुभारंभ किया।', 'content_en' => 'Shri Daddoo Prasad Ji launched new schemes to accelerate development work in rural areas.', 'source' => 'Press Conference', 'image_url' => 'https://static.toiimg.com/thumb/msid-117165608%2Cwidth-1070%2Cheight-580%2Cimgsize-102798%2Cresizemode-75%2Coverlay-toi_sw%2Cpt-32%2Cy_pad-40/photo.jpg', 'release_date' => '2025-02-20'],
    ['title_hi' => 'युवाओं के लिए रोजगार सृजन अभियान का आगाज', 'title_en' => 'Launch of Employment Generation Drive for Youth', 'content_hi' => 'माननीय श्री दद्दू प्रसाद जी ने प्रदेश के युवाओं को रोजगार के अवसर प्रदान करने के लिए विशेष अभियान की शुरुआत की।', 'content_en' => 'Hon. Shri Daddoo Prasad Ji started a special campaign to provide employment opportunities to the youth of the state.', 'source' => 'Press Release', 'image_url' => 'https://m.media-amazon.com/images/I/51dQBAlC7rL.jpg', 'release_date' => '2025-03-10'],
];
foreach ($press as $row) {
    try {
        $pdo->prepare("INSERT IGNORE INTO press_releases (title_hi, title_en, content_hi, content_en, source, image_url, release_date) VALUES (?, ?, ?, ?, ?, ?, ?)")
            ->execute([$row['title_hi'], $row['title_en'], $row['content_hi'], $row['content_en'], $row['source'], $row['image_url'], $row['release_date']]);
        $success_count++;
    } catch (Exception $e) { $errors[] = "Press: " . $e->getMessage(); }
}

// ---- MEDIA GALLERY (Videos) ----
$media = [
    ['caption_hi' => 'दद्दू प्रसाद जी का संदेश', 'caption_en' => 'Message from Daddoo Prasad Ji', 'media_type' => 'video', 'media_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'display_order' => 1],
    ['caption_hi' => 'जनसभा 2025', 'caption_en' => 'Public Rally 2025', 'media_type' => 'video', 'media_url' => 'https://www.youtube.com/watch?v=9bZkp7q19f0', 'display_order' => 2],
];
foreach ($media as $row) {
    try {
        $pdo->prepare("INSERT IGNORE INTO media_gallery (caption_hi, caption_en, media_type, media_url, display_order) VALUES (?, ?, ?, ?, ?)")
            ->execute([$row['caption_hi'], $row['caption_en'], $row['media_type'], $row['media_url'], $row['display_order']]);
        $success_count++;
    } catch (Exception $e) { $errors[] = "Media: " . $e->getMessage(); }
}

echo "<div style='font-family:monospace; padding:20px; background:#0f172a; color:#e2e8f0; min-height:100vh;'>";
echo "<h2 style='color:#22d3ee;'>🚀 Demo Content Seeder</h2>";
echo "<p style='color:#86efac;'>✅ Successfully inserted: <strong style='color:#4ade80;'>{$success_count}</strong> records</p>";
if (!empty($errors)) {
    echo "<p style='color:#f87171;'>⚠️ Errors:</p><ul>";
    foreach ($errors as $e) echo "<li style='color:#fca5a5;'>{$e}</li>";
    echo "</ul>";
}
echo "<hr style='border-color:#334155; margin:20px 0;'>";
echo "<p>Categories seeded: <strong>Settings, Sliders, Achievements, Biography, Press Releases, Media</strong></p>";
echo "<a href='index.php' style='background:#2563eb; color:white; padding:12px 30px; text-decoration:none; border-radius:6px; display:inline-block; margin-top:15px;'>✨ View Website</a>";
echo "</div>";
?>
