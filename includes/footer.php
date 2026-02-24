    </main>

    <!-- Contact & Footer -->
    <footer class="main-footer" id="contact">
        <div class="container">
            <div class="footer-grid">
                <!-- Contact Info -->
                <div class="footer-col info-col">
                    <div class="footer-logo">
                        <h2 data-hi="दद्दू प्रसाद" data-en="Daddoo Prasad">दद्दू प्रसाद</h2>
                        <span data-hi="पूर्व कैबिनेट मंत्री" data-en="Former Cabinet Minister">पूर्व कैबिनेट मंत्री</span>
                    </div>
                    <p class="footer-quote" data-hi="लोकतंत्र की सच्ची शक्ति जनता में है।" data-en="The true power of democracy lies in the people.">लोकतंत्र की सच्ची शक्ति जनता में है।</p>
                    
                    <ul class="contact-details">
                        <li><i class="fas fa-map-marker-alt"></i> <span data-hi="<?= htmlspecialchars($contact_address['value_hi'] ?? '') ?>" data-en="<?= htmlspecialchars($contact_address['value_en'] ?? '') ?>"><?= htmlspecialchars($contact_address['value_hi'] ?? '') ?></span></li>
                        <li><i class="fas fa-phone"></i> <span><?= htmlspecialchars($contact_phone['value_hi'] ?? '') ?></span></li>
                        <li><i class="fas fa-envelope"></i> <span><?= htmlspecialchars($contact_email['value_hi'] ?? '') ?></span></li>
                        <li><i class="fas fa-clock"></i> <span data-hi="जनसुनवाई समय: <?= htmlspecialchars($contact_hours['value_hi'] ?? '') ?>" data-en="Public Hearing Time: <?= htmlspecialchars($contact_hours['value_en'] ?? '') ?>">जनसुनवाई समय: <?= htmlspecialchars($contact_hours['value_hi'] ?? '') ?></span></li>
                    </ul>

                    <div class="social-links">
                        <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="footer-col form-col">
                    <h3 class="form-title" data-hi="हमसे संपर्क करें" data-en="Contact Us">हमसे संपर्क करें</h3>
                    <form id="contactForm" class="contact-form" action="process_contact.php" method="POST">
                        <div class="form-group">
                            <input type="text" name="name" required class="form-control" data-hi="आपका नाम" data-en="Your Name" placeholder="आपका नाम">
                        </div>
                        <div class="form-group">
                            <input type="tel" name="mobile" required class="form-control" data-hi="मोबाइल नंबर" data-en="Mobile Number" placeholder="मोबाइल नंबर">
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" data-hi="ईमेल (वैकल्पिक)" data-en="Email (Optional)" placeholder="ईमेल (वैकल्पिक)">
                        </div>
                        <div class="form-group">
                            <textarea name="message" rows="4" required class="form-control" data-hi="अपना संदेश यहाँ लिखें..." data-en="Write your message here..." placeholder="अपना संदेश यहाँ लिखें..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-secondary w-100" data-hi="संदेश भेजें" data-en="Send Message">संदेश भेजें</button>
                        <div id="formResponse" class="form-response mt-2"></div>
                    </form>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p data-hi="&copy; 2026 माननीय दद्दू प्रसाद कार्यालय. सर्वाधिकार सुरक्षित।" data-en="&copy; 2026 Hon'ble Daddoo Prasad Office. All Rights Reserved.">&copy; 2026 माननीय दद्दू प्रसाद कार्यालय. सर्वाधिकार सुरक्षित।</p>
            </div>
        </div>
    </footer>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <!-- Custom script -->
    <script src="main.js"></script>
</body>
</html>
