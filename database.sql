-- Database Schema for Daddoo Prasad Website
-- Run this script in your MySQL server to set up the database

CREATE DATABASE IF NOT EXISTS daddoo_prasad_db DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE daddoo_prasad_db;

-- 1. Settings Table (For single-value items like tagline, email, phone)
CREATE TABLE IF NOT EXISTS settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) UNIQUE NOT NULL,
    value_hi TEXT,
    value_en TEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 2. Biography Timeline Table
CREATE TABLE IF NOT EXISTS biography (
    id INT AUTO_INCREMENT PRIMARY KEY,
    icon_class VARCHAR(50) NOT NULL,
    bg_color_class VARCHAR(50) NOT NULL,
    title_hi VARCHAR(255) NOT NULL,
    title_en VARCHAR(255) NOT NULL,
    content_hi TEXT NOT NULL,
    content_en TEXT NOT NULL,
    list_items_hi TEXT NULL, -- Stored as JSON or separated string
    list_items_en TEXT NULL,
    display_order INT DEFAULT 0
);

-- 3. Achievements Table
CREATE TABLE IF NOT EXISTS achievements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_hi VARCHAR(100) NOT NULL,
    category_en VARCHAR(100) NOT NULL,
    description_hi TEXT NOT NULL,
    description_en TEXT NOT NULL,
    display_order INT DEFAULT 0
);

-- 4. Press Releases Table
CREATE TABLE IF NOT EXISTS press_releases (
    id INT AUTO_INCREMENT PRIMARY KEY,
    release_date DATE NOT NULL,
    image_url VARCHAR(255) NULL,
    location_hi VARCHAR(100) NOT NULL,
    location_en VARCHAR(100) NOT NULL,
    title_hi VARCHAR(255) NOT NULL,
    title_en VARCHAR(255) NOT NULL,
    content_hi TEXT NOT NULL,
    content_en TEXT NOT NULL,
    contact_phone VARCHAR(20) NULL,
    contact_email VARCHAR(100) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 5. Media Gallery Table
CREATE TABLE IF NOT EXISTS media_gallery (
    id INT AUTO_INCREMENT PRIMARY KEY,
    media_type ENUM('image', 'video') NOT NULL DEFAULT 'image',
    category_hi VARCHAR(100) NOT NULL,
    category_en VARCHAR(100) NOT NULL,
    media_url VARCHAR(255) NOT NULL,
    thumbnail_url VARCHAR(255) NULL,
    caption_hi VARCHAR(255) NULL,
    caption_en VARCHAR(255) NULL,
    display_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 6. Contact Messages Table (For form submissions)
CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sender_name VARCHAR(100) NOT NULL,
    sender_mobile VARCHAR(20) NOT NULL,
    sender_email VARCHAR(100) NULL,
    message TEXT NOT NULL,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert initial values for settings
INSERT INTO settings (setting_key, value_hi, value_en) VALUES
('hero_tagline', '“सामाजिक न्याय, समता और संवैधानिक अधिकारों की रक्षा ही मेरा संकल्प है।”', '“Social justice, equality, and protection of constitutional rights is my resolve.”'),
('hero_intro', 'माननीय श्री दद्दू प्रसाद जी उत्तर प्रदेश सरकार में पूर्व कैबिनेट मंत्री रह चुके हैं। उनका संपूर्ण राजनीतिक जीवन समाज के वंचित, पिछड़े एवं कमजोर वर्गों के उत्थान के लिए समर्पित रहा है।', 'Hon\'ble Shri Daddoo Prasad Ji is a former Cabinet Minister in the Government of Uttar Pradesh. His entire political life has been dedicated to the upliftment of the deprived, backward, and weaker sections of the society.'),
('about_lead', 'श्री दद्दू प्रसाद जी एक अनुभवी राजनेता एवं सामाजिक चिंतक हैं। वे जमीनी स्तर से उठकर प्रदेश की राजनीति में महत्वपूर्ण स्थान तक पहुँचे।', 'Shri Daddoo Prasad Ji is an experienced politician and social thinker. He rose from the grassroots to a significant position in state politics.'),
('about_desc', 'उन्होंने सदैव समाज के अंतिम व्यक्ति तक सरकारी योजनाओं का लाभ पहुँचाने का प्रयास किया।', 'He always strove to bring the benefits of government schemes to the last person in society.'),
('contact_address', 'लखनऊ, उत्तर प्रदेश', 'Lucknow, Uttar Pradesh'),
('contact_phone', '+91 9876543210', '+91 9876543210'),
('contact_email', 'contact@daddooprasad.in', 'contact@daddooprasad.in'),
('contact_hours', 'सुबह 10:00 बजे से दोपहर 2:00 बजे तक', '10:00 AM to 2:00 PM')
ON DUPLICATE KEY UPDATE setting_key=setting_key;

-- 7. Admins Table
CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert default admin (username: admin, password: password123)
-- Password hash generated using PHP password_hash('password123', PASSWORD_DEFAULT)
INSERT IGNORE INTO admins (username, password_hash) VALUES
('admin', '$2y$10$w81oXq1FqRY2.1l7.K5q/ehG.Tj1x9ZQqI1j1v5K4J.sZ9gQ5Y.Uq');

-- 8. Home Slider Table
CREATE TABLE IF NOT EXISTS home_slider (
    id INT AUTO_INCREMENT PRIMARY KEY,
    image_url VARCHAR(255) NOT NULL,
    title_hi VARCHAR(255) NULL,
    title_en VARCHAR(255) NULL,
    subtitle_hi VARCHAR(255) NULL,
    subtitle_en VARCHAR(255) NULL,
    button_link VARCHAR(255) NULL,
    display_order INT DEFAULT 0
);
