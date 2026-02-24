<?php
require_once 'db.php';

try {
    // 1. Add image_url to press_releases if it doesn't exist
    $pdo->exec("ALTER TABLE press_releases ADD COLUMN image_url VARCHAR(255) NULL AFTER release_date");
    echo "Added image_url to press_releases.\n";
} catch (PDOException $e) {
    // Column might already exist, ignore
    echo "Note on press_releases: " . $e->getMessage() . "\n";
}

try {
    // 2. Create home_slider table
    $pdo->exec("CREATE TABLE IF NOT EXISTS home_slider (
        id INT AUTO_INCREMENT PRIMARY KEY,
        image_url VARCHAR(255) NOT NULL,
        title_hi VARCHAR(255) NULL,
        title_en VARCHAR(255) NULL,
        subtitle_hi VARCHAR(255) NULL,
        subtitle_en VARCHAR(255) NULL,
        button_link VARCHAR(255) NULL,
        display_order INT DEFAULT 0
    )");
    
    // Insert default slider images based on provided URLs from previous prompt
    $stmt = $pdo->query("SELECT COUNT(*) FROM home_slider");
    if ($stmt->fetchColumn() == 0) {
        $slides = [
            [
                'url' => 'https://www.bjp.org/files/photo-gallery/Hon%27ble%20BJP%20National%20President%20Shri%20J.P.%20Nadda%20addressing%20a%20public%20rally%20at%20Highmid%20Ground%20Sonbhadra%20%28Robertsganj%29%20Uttar%20Pradesh%20%284%29.jpg',
                'title_hi' => 'सामाजिक न्याय के प्रति संकल्पित',
                'title_en' => 'Committed to Social Justice'
            ],
            [
                'url' => 'https://img-s-msn-com.akamaized.net/tenant/amp/entityid/AA1OVQr7.img?f=jpg&h=232&m=6&q=60&u=t&w=412',
                'title_hi' => 'निरंतर जनसेवा का प्रयास',
                'title_en' => 'Continuous Effort in Public Service'
            ]
        ];
        
        $insert = $pdo->prepare("INSERT INTO home_slider (image_url, title_hi, title_en) VALUES (?, ?, ?)");
        foreach ($slides as $slide) {
            $insert->execute([$slide['url'], $slide['title_hi'], $slide['title_en']]);
        }
    }
    echo "Created and populated home_slider table.\n";
} catch (PDOException $e) {
    echo "Error on home_slider: " . $e->getMessage() . "\n";
}

// 3. Update database.sql file to include these changes
$db_sql = file_get_contents('database.sql');
if (strpos($db_sql, 'image_url VARCHAR(255) NULL') === false) {
    $db_sql = str_replace(
        "release_date DATE NOT NULL,", 
        "release_date DATE NOT NULL,\n    image_url VARCHAR(255) NULL,", 
        $db_sql
    );
}
if (strpos($db_sql, 'home_slider') === false) {
    $slider_sql = "\n-- 8. Home Slider Table\nCREATE TABLE IF NOT EXISTS home_slider (\n    id INT AUTO_INCREMENT PRIMARY KEY,\n    image_url VARCHAR(255) NOT NULL,\n    title_hi VARCHAR(255) NULL,\n    title_en VARCHAR(255) NULL,\n    subtitle_hi VARCHAR(255) NULL,\n    subtitle_en VARCHAR(255) NULL,\n    button_link VARCHAR(255) NULL,\n    display_order INT DEFAULT 0\n);\n";
    $db_sql .= $slider_sql;
}
file_put_contents('database.sql', $db_sql);
echo "Updated database.sql.\n";

?>
