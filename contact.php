<?php
require_once 'includes/header.php';
?>

<!-- Contact Section -->
<section id="contact-page" class="section bg-light text-center">
    <div class="container">
        <h2 class="section-title text-blue" data-hi="संपर्क विवरण" data-en="Contact Details">संपर्क विवरण</h2>
        <div class="title-underline mb-5"></div>
        
        <p style="font-size: 1.2rem; max-width: 600px; margin: 0 auto 40px;" data-hi="कृपया नीचे दिए गए फॉर्म का उपयोग करके हमें अपने विचार, सुझाव या समस्याएँ भेजें।" data-en="Please use the form below to send us your thoughts, suggestions, or issues.">
            कृपया नीचे दिए गए फॉर्म का उपयोग करके हमें अपने विचार, सुझाव या समस्याएँ भेजें।
        </p>
        
        <div style="max-width: 600px; margin: 0 auto; background: white; padding: 40px; border-radius: 8px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); border-top: 5px solid var(--orange);">
            <form id="contactForm" class="contact-form-page" action="process_contact.php" method="POST">
                <div class="form-group mb-3">
                    <input type="text" name="name" required class="form-control p-3" data-hi="आपका नाम" data-en="Your Name" placeholder="आपका नाम">
                </div>
                <div class="form-group mb-3">
                    <input type="tel" name="mobile" required class="form-control p-3" data-hi="मोबाइल नंबर" data-en="Mobile Number" placeholder="मोबाइल नंबर">
                </div>
                <div class="form-group mb-3">
                    <input type="email" name="email" class="form-control p-3" data-hi="ईमेल (वैकल्पिक)" data-en="Email (Optional)" placeholder="ईमेल (वैकल्पिक)">
                </div>
                <div class="form-group mb-4">
                    <textarea name="message" rows="5" required class="form-control p-3" data-hi="अपना संदेश यहाँ लिखें..." data-en="Write your message here..." placeholder="अपना संदेश यहाँ लिखें..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100 p-3 fs-5" data-hi="संदेश भेजें" data-en="Send Message">संदेश भेजें</button>
                <div id="formResponse" class="form-response mt-3"></div>
            </form>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
