<?php
require_once 'db.php';

try {
    $sql = "CREATE TABLE IF NOT EXISTS blog_posts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title_hi VARCHAR(255) NOT NULL,
        title_en VARCHAR(255) NOT NULL,
        content_hi TEXT NOT NULL,
        content_en TEXT NOT NULL,
        image_url VARCHAR(500) DEFAULT NULL,
        publish_date DATE NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
    
    $pdo->exec($sql);
    echo "Successfully created blog_posts table!";
} catch (PDOException $e) {
    echo "Error creating table: " . $e->getMessage();
}
?>
