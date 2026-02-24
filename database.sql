-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2026 at 04:17 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `daddoo_prasad_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `achievements`
--

CREATE TABLE `achievements` (
  `id` int(11) NOT NULL,
  `category_hi` varchar(100) NOT NULL,
  `category_en` varchar(100) NOT NULL,
  `description_hi` text NOT NULL,
  `description_en` text NOT NULL,
  `display_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `achievements`
--

INSERT INTO `achievements` (`id`, `category_hi`, `category_en`, `description_hi`, `description_en`, `display_order`) VALUES
(1, 'सामाजिक न्याय योजनाओं का प्रभावी क्रियान्वयन', 'Effective implementation of Social Justice Schemes', '', '', 1),
(2, 'छात्रवृत्ति एवं कल्याणकारी योजनाओं का विस्तार', 'Expansion of Scholarship & Welfare Schemes', '', '', 2),
(3, 'ग्रामीण विकास कार्यक्रमों को बढ़ावा', 'Promotion of Rural Development Programs', '', '', 3),
(4, 'कमजोर वर्गों के अधिकारों की रक्षा', 'Protection of Rights of Weaker Sections', '', '', 4),
(5, 'संविधान जागरूकता अभियान', 'Constitution Awareness Campaign', '', '', 5),
(6, 'युवाओं को राजनीतिक भागीदारी के लिए प्रेरित', 'Inspiring Youth for Political Participation', '', '', 6);

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password_hash`, `created_at`) VALUES
(1, 'admin', '$2y$10$MfwynMItD8t214BN4ePrJuc5A1/zCdtENkv2gHPlSkm9abLpkxRd2', '2026-02-24 13:56:48');

-- --------------------------------------------------------

--
-- Table structure for table `biography`
--

CREATE TABLE `biography` (
  `id` int(11) NOT NULL,
  `icon_class` varchar(50) NOT NULL,
  `bg_color_class` varchar(50) NOT NULL,
  `title_hi` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `content_hi` text NOT NULL,
  `content_en` text NOT NULL,
  `list_items_hi` text DEFAULT NULL,
  `list_items_en` text DEFAULT NULL,
  `display_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `biography`
--

INSERT INTO `biography` (`id`, `icon_class`, `bg_color_class`, `title_hi`, `title_en`, `content_hi`, `content_en`, `list_items_hi`, `list_items_en`, `display_order`) VALUES
(1, '', '', 'प्रारंभिक जीवन', 'Early Life', 'उत्तर प्रदेश के एक साधारण परिवार में जन्मे श्री दद्दू प्रसाद जी ने संघर्षपूर्ण परिस्थितियों में शिक्षा प्राप्त की। बचपन से ही सामाजिक असमानता और भेदभाव को करीब से देखने के कारण उन्होंने समाज सेवा का मार्ग चुना।', 'Born in a humble family in Uttar Pradesh, Shri Daddoo Prasad Ji received his education in difficult circumstances. Witnessing social inequality and discrimination from an early age, he chose the path of social service.', NULL, NULL, 1),
(2, '', '', 'शिक्षा', 'Education', 'उन्होंने स्नातक एवं उच्च शिक्षा प्राप्त कर सामाजिक और राजनीतिक विषयों में गहरी रुचि विकसित की। शिक्षा के दौरान वे छात्र आंदोलनों में सक्रिय रहे।', 'He completed his graduation and higher education, developing a deep interest in social and political subjects. During his education, he was active in student movements.', NULL, NULL, 2),
(3, '', '', 'राजनीतिक यात्रा', 'Political Journey', 'सामाजिक आंदोलनों से राजनीतिक जीवन की शुरुआत करते हुए जनता की समस्याओं को विधानसभा तक पहुँचाया। उत्तर प्रदेश सरकार में कैबिनेट मंत्री के रूप में उत्कृष्ट कार्य किया।', 'Starting his political life from social movements, he brought the problems of the people to the legislature. He worked excellently as a Cabinet Minister in the Government of Uttar Pradesh.', NULL, NULL, 3),
(4, '', '', 'मंत्रिमंडल में कार्य', 'Work in Cabinet', 'सामाजिक न्याय एवं अधिकारिता से जुड़े विभागों की जिम्मेदारी संभाली। वंचित वर्गों के लिए अनेक योजनाएं क्रियान्वित कीं।', 'Handled the responsibilities of departments related to social justice and empowerment. Implemented many schemes for the underprivileged sections.', NULL, NULL, 4),
(5, '', '', 'सामाजिक योगदान', 'Social Contribution', 'संविधान जागरूकता अभियान, युवाओं को राजनीतिक भागीदारी के लिए प्रेरित करना और सामाजिक समरसता के लिए निरंतर प्रयासरत।', 'Continuously striving for Constitution awareness campaign, inspiring youth for political participation, and social harmony.', NULL, NULL, 5);

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `sender_name` varchar(100) NOT NULL,
  `sender_mobile` varchar(20) NOT NULL,
  `sender_email` varchar(100) DEFAULT NULL,
  `message` text NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `home_slider`
--

CREATE TABLE `home_slider` (
  `id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `title_hi` varchar(255) DEFAULT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `subtitle_hi` varchar(255) DEFAULT NULL,
  `subtitle_en` varchar(255) DEFAULT NULL,
  `button_link` varchar(255) DEFAULT NULL,
  `display_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `home_slider`
--

INSERT INTO `home_slider` (`id`, `image_url`, `title_hi`, `title_en`, `subtitle_hi`, `subtitle_en`, `button_link`, `display_order`) VALUES
(1, 'https://www.bjp.org/files/photo-gallery/Hon%27ble%20BJP%20National%20President%20Shri%20J.P.%20Nadda%20addressing%20a%20public%20rally%20at%20Highmid%20Ground%20Sonbhadra%20%28Robertsganj%29%20Uttar%20Pradesh%20%284%29.jpg', 'सामाजिक न्याय के प्रति संकल्पित', 'Committed to Social Justice', NULL, NULL, NULL, 0),
(2, 'https://img-s-msn-com.akamaized.net/tenant/amp/entityid/AA1OVQr7.img?f=jpg&h=232&m=6&q=60&u=t&w=412', 'निरंतर जनसेवा का प्रयास', 'Continuous Effort in Public Service', NULL, NULL, NULL, 0),
(3, 'https://img-s-msn-com.akamaized.net/tenant/amp/entityid/AA1OVQr7.img?f=jpg&h=232&m=6&q=60&u=t&w=412', 'सामाजिक न्याय के प्रति संकल्पित', 'Committed to Social Justice', NULL, NULL, NULL, 1),
(4, 'https://static.toiimg.com/thumb/msid-117165608%2Cwidth-1070%2Cheight-580%2Cimgsize-102798%2Cresizemode-75%2Coverlay-toi_sw%2Cpt-32%2Cy_pad-40/photo.jpg', 'जन सेवा ही परमो धर्मः', 'Service to People is Supreme Duty', NULL, NULL, NULL, 2),
(5, 'https://www.bjp.org/files/photo-gallery/Hon%27ble%20BJP%20National%20President%20Shri%20J.P.%20Nadda%20addressing%20a%20public%20rally%20at%20Highmid%20Ground%20Sonbhadra%20%28Robertsganj%29%20Uttar%20Pradesh%20%284%29.jpg', 'संविधान की रक्षा करना हमारा संकल्प', 'Protecting the Constitution is Our Resolve', NULL, NULL, NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `media_gallery`
--

CREATE TABLE `media_gallery` (
  `id` int(11) NOT NULL,
  `media_type` enum('image','video') NOT NULL DEFAULT 'image',
  `category_hi` varchar(100) NOT NULL,
  `category_en` varchar(100) NOT NULL,
  `media_url` varchar(255) NOT NULL,
  `thumbnail_url` varchar(255) DEFAULT NULL,
  `caption_hi` varchar(255) DEFAULT NULL,
  `caption_en` varchar(255) DEFAULT NULL,
  `display_order` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `media_gallery`
--

INSERT INTO `media_gallery` (`id`, `media_type`, `category_hi`, `category_en`, `media_url`, `thumbnail_url`, `caption_hi`, `caption_en`, `display_order`, `created_at`) VALUES
(1, 'video', '', '', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', NULL, 'दद्दू प्रसाद जी का संदेश', 'Message from Daddoo Prasad Ji', 1, '2026-02-24 14:49:26'),
(2, 'video', '', '', 'https://www.youtube.com/watch?v=9bZkp7q19f0', NULL, 'जनसभा 2025', 'Public Rally 2025', 2, '2026-02-24 14:49:26');

-- --------------------------------------------------------

--
-- Table structure for table `press_releases`
--

CREATE TABLE `press_releases` (
  `id` int(11) NOT NULL,
  `release_date` date NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `location_hi` varchar(100) NOT NULL,
  `location_en` varchar(100) NOT NULL,
  `title_hi` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `content_hi` text NOT NULL,
  `content_en` text NOT NULL,
  `contact_phone` varchar(20) DEFAULT NULL,
  `contact_email` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `press_releases`
--

INSERT INTO `press_releases` (`id`, `release_date`, `image_url`, `location_hi`, `location_en`, `title_hi`, `title_en`, `content_hi`, `content_en`, `contact_phone`, `contact_email`, `created_at`) VALUES
(1, '2026-02-24', 'uploads/press_699db36bc3c3e.jpg', 'लखनऊ ', 'lucknow', 'समजवादी पार्टी ', 'समजवादी पार्टी ', 'समजवादी पार्टी ', 'समजवादी पार्टी ', NULL, NULL, '2026-02-24 14:19:23');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `setting_key` varchar(100) NOT NULL,
  `value_hi` text DEFAULT NULL,
  `value_en` text DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `setting_key`, `value_hi`, `value_en`, `updated_at`) VALUES
(1, 'hero_tagline', '“सामाजिक न्याय, समता और संवैधानिक अधिकारों की रक्षा ही मेरा संकल्प है।”', '“Social justice, equality, and protection of constitutional rights is my resolve.”', '2026-02-24 13:53:22'),
(2, 'hero_intro', 'माननीय श्री दद्दू प्रसाद जी उत्तर प्रदेश सरकार में पूर्व कैबिनेट मंत्री रह चुके हैं। उनका संपूर्ण राजनीतिक जीवन समाज के वंचित, पिछड़े एवं कमजोर वर्गों के उत्थान के लिए समर्पित रहा है।', 'Hon\'ble Shri Daddoo Prasad Ji is a former Cabinet Minister in the Government of Uttar Pradesh. His entire political life has been dedicated to the upliftment of the deprived, backward, and weaker sections of the society.', '2026-02-24 13:53:22'),
(3, 'about_lead', 'श्री दद्दू प्रसाद जी एक अनुभवी राजनेता एवं सामाजिक चिंतक हैं। वे जमीनी स्तर से उठकर प्रदेश की राजनीति में महत्वपूर्ण स्थान तक पहुँचे।', 'Shri Daddoo Prasad Ji is an experienced politician and social thinker. He rose from the grassroots to a significant position in state politics.', '2026-02-24 13:53:22'),
(4, 'about_desc', 'उन्होंने सदैव समाज के अंतिम व्यक्ति तक सरकारी योजनाओं का लाभ पहुँचाने का प्रयास किया।', 'He always strove to bring the benefits of government schemes to the last person in society.', '2026-02-24 13:53:22'),
(5, 'contact_address', 'लखनऊ, उत्तर प्रदेश', 'Lucknow, Uttar Pradesh', '2026-02-24 13:53:22'),
(6, 'contact_phone', '+91 9876543210', '+91 9876543210', '2026-02-24 13:53:22'),
(7, 'contact_email', 'contact@daddooprasad.in', 'contact@daddooprasad.in', '2026-02-24 13:53:22'),
(8, 'contact_hours', 'सुबह 10:00 बजे से दोपहर 2:00 बजे तक', '10:00 AM to 2:00 PM', '2026-02-24 13:53:22'),
(22, 'fb_link', 'https://www.facebook.com/dadduprasadoffice/', 'https://www.facebook.com/dadduprasadoffice/', '2026-02-24 14:49:26'),
(23, 'twitter_link', 'https://twitter.com/dadduprasad', 'https://twitter.com/dadduprasad', '2026-02-24 14:49:26'),
(24, 'yt_link', 'https://www.youtube.com/@DadduPrasad', 'https://www.youtube.com/@DadduPrasad', '2026-02-24 14:49:26'),
(25, 'ig_link', 'https://instagram.com/daddu.prasad', 'https://instagram.com/daddu.prasad', '2026-02-24 14:49:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achievements`
--
ALTER TABLE `achievements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `biography`
--
ALTER TABLE `biography`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_slider`
--
ALTER TABLE `home_slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media_gallery`
--
ALTER TABLE `media_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `press_releases`
--
ALTER TABLE `press_releases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `setting_key` (`setting_key`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `achievements`
--
ALTER TABLE `achievements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `biography`
--
ALTER TABLE `biography`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `home_slider`
--
ALTER TABLE `home_slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `media_gallery`
--
ALTER TABLE `media_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `press_releases`
--
ALTER TABLE `press_releases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
