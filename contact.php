<?php
require_once 'includes/header.php';

// Fetch dynamic contact data from settings (assuming the header already provides getSettingVal and it was fetched in header or index)
// If not, we fetch it here directly:
$contact_address = getSettingVal($pdo, 'contact_address');
$contact_phone = getSettingVal($pdo, 'contact_phone');
$contact_email = getSettingVal($pdo, 'contact_email');
$contact_hours = getSettingVal($pdo, 'contact_hours');
$fb_link = getSettingVal($pdo, 'fb_link');
$twitter_link = getSettingVal($pdo, 'twitter_link');
$ig_link = getSettingVal($pdo, 'ig_link');
$yt_link = getSettingVal($pdo, 'yt_link');
?>

<style>
/* Hero Section (Matching other inner pages) */
.ref-hero {
    background: linear-gradient(135deg, #e6eff9 0%, #ffffff 100%);
    padding: 80px 0 0 0;
    position: relative;
    overflow: hidden;
    border-bottom: 2px solid #eaeaea;
}
.ref-hero-title {
    font-family: 'Mukta', sans-serif;
    font-size: clamp(2.5rem, 5vw, 4rem);
    font-weight: 800;
    color: #003893;
    line-height: 1.2;
    margin-bottom: 20px;
}
.ref-hero-img-wrap {
    text-align: right;
    position: relative;
}
.ref-hero-img {
    max-width: 100%;
    height: auto;
    max-height: 450px;
    object-fit: contain;
    position: relative;
    z-index: 2;
    transform: translateY(10px);
}

/* Breadcrumb */
.ref-breadcrumb {
    background: transparent;
    padding: 0;
    margin-bottom: 0;
    font-size: 1rem;
    font-weight: 500;
}
.ref-breadcrumb a {
    color: #4a5568;
    text-decoration: none;
    transition: color 0.2s;
}
.ref-breadcrumb a:hover {
    color: #D21034;
}
.ref-breadcrumb .breadcrumb-item.active {
    color: #003893;
}

/* Page Background */
.contact-page-body {
    background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);
    padding: 80px 0 100px;
    position: relative;
}

/* Contact Grid */
.contact-gridbox {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0;
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 20px 50px rgba(0,56,147,0.1);
    overflow: hidden;
    border: 1px solid #e2e8f0;
}

/* Left Panel - Dynamic Details */
.contact-left-panel {
    background: linear-gradient(135deg, #003893 0%, #00235c 100%);
    color: #ffffff;
    padding: 50px;
    position: relative;
    overflow: hidden;
}
/* Background pattern for left panel */
.contact-left-panel::before {
    content: '';
    position: absolute;
    top: -50px; left: -50px;
    width: 200px; height: 200px;
    border-radius: 50%;
    background: rgba(255,255,255,0.05);
}
.contact-left-panel::after {
    content: '';
    position: absolute;
    bottom: -80px; right: -80px;
    width: 300px; height: 300px;
    border-radius: 50%;
    background: rgba(255,255,255,0.05);
}

.c-left-title {
    font-family: 'Mukta', sans-serif;
    font-size: 2.2rem;
    font-weight: 800;
    margin-bottom: 10px;
    position: relative;
    z-index: 2;
}
.c-left-subtitle {
    font-size: 1.1rem;
    color: #a0c4ff;
    margin-bottom: 40px;
    position: relative;
    z-index: 2;
}

.c-info-list {
    list-style: none;
    padding: 0;
    margin: 0;
    position: relative;
    z-index: 2;
}
.c-info-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 30px;
}
.c-info-icon {
    width: 50px;
    height: 50px;
    background: rgba(255,255,255,0.1);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
    color: #FECB00;
    margin-right: 20px;
    flex-shrink: 0;
}
.c-info-text {
    flex-grow: 1;
}
.c-info-label {
    display: block;
    font-size: 0.85rem;
    color: #a0c4ff;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 5px;
}
.c-info-value {
    font-size: 1.1rem;
    font-weight: 600;
    line-height: 1.5;
}

.c-social-links {
    margin-top: 50px;
    position: relative;
    z-index: 2;
}
.c-social-label {
    font-size: 0.9rem;
    color: #a0c4ff;
    margin-bottom: 15px;
}
.c-social-icons {
    display: flex;
    gap: 15px;
}
.c-social-icons a {
    width: 45px;
    height: 45px;
    background: rgba(255,255,255,0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 1.2rem;
    text-decoration: none;
    transition: all 0.3s;
}
.c-social-icons a:hover {
    background: #FECB00;
    color: #003893;
    transform: translateY(-3px);
}

/* Right Panel - The Form ("Get in Touch") */
.contact-right-panel {
    padding: 50px;
    background: #ffffff;
}

.c-right-title {
    font-family: 'Mukta', sans-serif;
    font-size: 2.2rem;
    font-weight: 800;
    color: #003893;
    margin-bottom: 10px;
}
.c-right-subtitle {
    font-size: 1rem;
    color: #4a5568;
    margin-bottom: 35px;
}

/* Premium Form Styling */
.premium-form .form-group {
    position: relative;
    margin-bottom: 25px;
}
.premium-form .form-control {
    width: 100%;
    padding: 16px 20px;
    font-size: 1rem;
    color: #2d3748;
    background: #f8fafc;
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    transition: all 0.3s;
}
.premium-form .form-control:focus {
    outline: none;
    background: #ffffff;
    border-color: #003893;
    box-shadow: 0 0 0 4px rgba(0,56,147,0.1);
}
.premium-form textarea.form-control {
    resize: vertical;
    min-height: 120px;
}
.premium-form label {
    position: absolute;
    top: 50%;
    left: 20px;
    transform: translateY(-50%);
    font-size: 1rem;
    color: #a0aec0;
    pointer-events: none;
    transition: all 0.3s;
}
.premium-form textarea ~ label {
    top: 20px;
    transform: none;
}
/* Floating label effect */
.premium-form .form-control:focus ~ label,
.premium-form .form-control:not(:placeholder-shown) ~ label {
    top: -10px;
    left: 15px;
    font-size: 0.8rem;
    background: #fff;
    padding: 0 5px;
    color: #003893;
    font-weight: 600;
}

.premium-submit-btn {
    background: #D21034;
    color: #fff;
    border: none;
    width: 100%;
    padding: 16px;
    font-size: 1.1rem;
    font-weight: 700;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
}
.premium-submit-btn:hover {
    background: #003893;
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(0,56,147,0.2);
}

@media (max-width: 992px) {
    .contact-gridbox {
        grid-template-columns: 1fr;
    }
}
@media (max-width: 576px) {
    .contact-left-panel, .contact-right-panel {
        padding: 30px 20px;
    }
    .c-left-title, .c-right-title {
        font-size: 1.8rem;
    }
}
</style>

<!-- Hero Section -->
<section class="ref-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-7 pb-5">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb ref-breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php" data-hi="होम" data-en="Home">होम</a></li>
                        <li class="breadcrumb-item active" aria-current="page" data-hi="संपर्क" data-en="Contact">संपर्क</li>
                    </ol>
                </nav>
                <h1 class="ref-hero-title mt-3" data-hi="संपर्क करें" data-en="Contact Us">संपर्क करें</h1>
            </div>
            <div class="col-md-5 ref-hero-img-wrap d-none d-md-block">
                <img src="https://img-s-msn-com.akamaized.net/tenant/amp/entityid/AA1OVQr7.img?f=jpg&h=580&m=6&q=80&u=t&w=900" alt="Daddoo Prasad" class="ref-hero-img shadow-lg rounded-circle" style="border: 8px solid white;">
            </div>
        </div>
    </div>
</section>

<!-- Contact Form Section -->
<section class="contact-page-body">
    <div class="container">
        <div class="contact-gridbox">
            
            <!-- LEFT PANEL: DYNAMIC DETAILS -->
            <div class="contact-left-panel">
                <h2 class="c-left-title" data-hi="संपर्क विवरण" data-en="Contact Information">संपर्क विवरण</h2>
                <p class="c-left-subtitle" data-hi="कार्यालय एवं जनसुनवाई से सम्बंधित जानकारी।" data-en="Information regarding office and public hearings.">कार्यालय एवं जनसुनवाई से सम्बंधित जानकारी।</p>
                
                <ul class="c-info-list">
                    <?php if(!empty($contact_phone['value_hi'])): ?>
                    <li class="c-info-item">
                        <div class="c-info-icon"><i class="fas fa-phone-alt"></i></div>
                        <div class="c-info-text">
                            <span class="c-info-label" data-hi="मोबाइल नंबर" data-en="Phone Number">मोबाइल नंबर</span>
                            <span class="c-info-value"><?= htmlspecialchars($contact_phone['value_hi']) ?></span>
                        </div>
                    </li>
                    <?php endif; ?>
                    
                    <?php if(!empty($contact_email['value_hi'])): ?>
                    <li class="c-info-item">
                        <div class="c-info-icon"><i class="fas fa-envelope"></i></div>
                        <div class="c-info-text">
                            <span class="c-info-label" data-hi="ईमेल आईडी" data-en="Email Address">ईमेल आईडी</span>
                            <span class="c-info-value"><?= htmlspecialchars($contact_email['value_hi']) ?></span>
                        </div>
                    </li>
                    <?php endif; ?>
                    
                    <?php if(!empty($contact_address['value_hi']) || !empty($contact_address['value_en'])): ?>
                    <li class="c-info-item">
                        <div class="c-info-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div class="c-info-text">
                            <span class="c-info-label" data-hi="कार्यालय का पता" data-en="Office Address">कार्यालय का पता</span>
                            <span class="c-info-value" data-hi="<?= nl2br(htmlspecialchars($contact_address['value_hi'])) ?>" data-en="<?= nl2br(htmlspecialchars($contact_address['value_en'])) ?>">
                                <?= nl2br(htmlspecialchars($contact_address['value_hi'])) ?>
                            </span>
                        </div>
                    </li>
                    <?php endif; ?>
                    
                    <?php if(!empty($contact_hours['value_hi']) || !empty($contact_hours['value_en'])): ?>
                    <li class="c-info-item">
                        <div class="c-info-icon"><i class="fas fa-clock"></i></div>
                        <div class="c-info-text">
                            <span class="c-info-label" data-hi="जनसुनवाई समय" data-en="Public Hearing Hours">जनसुनवाई समय</span>
                            <span class="c-info-value" data-hi="<?= htmlspecialchars($contact_hours['value_hi']) ?>" data-en="<?= htmlspecialchars($contact_hours['value_en']) ?>">
                                <?= htmlspecialchars($contact_hours['value_hi']) ?>
                            </span>
                        </div>
                    </li>
                    <?php endif; ?>
                </ul>
                
                <div class="c-social-links">
                    <div class="c-social-label" data-hi="सोशल मीडिया पर जुड़ें:" data-en="Connect on Social Media:">सोशल मीडिया पर जुड़ें:</div>
                    <div class="c-social-icons">
                        <?php if(!empty($fb_link['value_hi'])): ?>
                            <a href="<?= htmlspecialchars($fb_link['value_hi']) ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <?php endif; ?>
                        
                        <?php if(!empty($twitter_link['value_hi'])): ?>
                            <a href="<?= htmlspecialchars($twitter_link['value_hi']) ?>" target="_blank"><i class="fab fa-twitter"></i></a>
                        <?php endif; ?>
                        
                        <?php if(!empty($ig_link['value_hi'])): ?>
                            <a href="<?= htmlspecialchars($ig_link['value_hi']) ?>" target="_blank"><i class="fab fa-instagram"></i></a>
                        <?php endif; ?>
                        
                        <?php if(!empty($yt_link['value_hi'])): ?>
                            <a href="<?= htmlspecialchars($yt_link['value_hi']) ?>" target="_blank"><i class="fab fa-youtube"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <!-- RIGHT PANEL: PREMIUM FORM -->
            <div class="contact-right-panel">
                <h2 class="c-right-title" data-hi="संदेश भेजें" data-en="Get in Touch">संदेश भेजें</h2>
                <p class="c-right-subtitle" data-hi="कृपया नीचे दिए गए फॉर्म का उपयोग करके हमें अपने विचार, सुझाव या समस्याएँ भेजें।" data-en="Please use the form below to send us your thoughts, suggestions, or issues.">
                    कृपया नीचे दिए गए फॉर्म का उपयोग करके हमें अपने विचार, सुझाव या समस्याएँ भेजें।
                </p>
                
                <form id="contactForm" class="premium-form" action="process_contact.php" method="POST">
                    <div class="form-group">
                        <!-- Space as placeholder to activate the :not(:placeholder-shown) logic -->
                        <input type="text" name="name" id="c_name" required class="form-control" placeholder=" ">
                        <label for="c_name" data-hi="आपका नाम" data-en="Your Name">आपका नाम</label>
                    </div>
                    
                    <div class="form-group">
                        <input type="tel" name="mobile" id="c_mobile" required class="form-control" placeholder=" ">
                        <label for="c_mobile" data-hi="मोबाइल नंबर" data-en="Mobile Number">मोबाइल नंबर</label>
                    </div>
                    
                    <div class="form-group">
                        <input type="email" name="email" id="c_email" class="form-control" placeholder=" ">
                        <label for="c_email" data-hi="ईमेल (वैकल्पिक)" data-en="Email Address (Optional)">ईमेल (वैकल्पिक)</label>
                    </div>
                    
                    <div class="form-group">
                        <textarea name="message" id="c_message" required class="form-control" placeholder=" "></textarea>
                        <label for="c_message" data-hi="अपना संदेश यहाँ विस्तार से लिखें..." data-en="Write your message in detail here...">अपना संदेश यहाँ विस्तार से लिखें...</label>
                    </div>
                    
                    <button type="submit" class="premium-submit-btn">
                        <span data-hi="संदेश भेजें" data-en="Send Message">संदेश भेजें</span>
                        <i class="fas fa-paper-plane"></i>
                    </button>
                    
                    <div id="formResponse" class="form-response mt-3 text-center fw-bold"></div>
                </form>
            </div>
            
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
