<?php
// Get current year for copyright
$currentYear = date('Y');
?>

<footer class="site-footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-section">
                <h3>About Travel Habesha</h3>
                <p>Your trusted partner for exploring the beauty and culture of Ethiopia. We provide exceptional travel experiences with a focus on sustainability and local engagement.</p>
                <div class="social-links">
                    <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>

            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="<?php echo URLROOT; ?>">Home</a></li>
                    <li><a href="<?php echo URLROOT; ?>/packages">Travel Packages</a></li>
                    <li><a href="<?php echo URLROOT; ?>/hotels">Hotels</a></li>
                    <li><a href="<?php echo URLROOT; ?>/cars">Car Rental</a></li>
                    <li><a href="<?php echo URLROOT; ?>/destinations">Destinations</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Contact Info</h3>
                <ul class="contact-info">
                    <li><i class="fas fa-map-marker-alt"></i> 123 Travel Street, Addis Ababa, Ethiopia</li>
                    <li><i class="fas fa-phone"></i> +251 91 234 5678</li>
                    <li><i class="fas fa-envelope"></i> info@travelhabesha.com</li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Newsletter</h3>
                <p>Subscribe to our newsletter for travel updates and special offers.</p>
                <form action="<?php echo URLROOT; ?>/newsletter/subscribe" method="POST" class="newsletter-form">
                    <input type="email" name="email" placeholder="Enter your email" required>
                    <button type="submit" class="btn-primary">Subscribe</button>
                </form>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; <?php echo $currentYear; ?> Travel Habesha. All rights reserved.</p>
            <ul class="footer-links">
                <li><a href="<?php echo URLROOT; ?>/pages/privacy">Privacy Policy</a></li>
                <li><a href="<?php echo URLROOT; ?>/pages/terms">Terms & Conditions</a></li>
                <li><a href="<?php echo URLROOT; ?>/pages/sitemap">Sitemap</a></li>
            </ul>
        </div>
    </div>
</footer>

<script>
// Add any footer-specific JavaScript here
document.addEventListener('DOMContentLoaded', function() {
    // Newsletter form submission
    const newsletterForm = document.querySelector('.newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[type="email"]').value;
            // Add your newsletter subscription logic here
            alert('Thank you for subscribing to our newsletter!');
            this.reset();
        });
    }
});
</script> 