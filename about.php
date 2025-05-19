<?php
require_once __DIR__ . '/includes/header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/about.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Sono:wght@200..800&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
    <section class="about-hero">
        <div class="hero-content">
            <h2 class="shop">Our Story</h2>
            <p class="hero-subtitle">Discover the journey of Travel Habesha</p>
        </div>
    </section>

    <section class="mission-vision">
        <div class="container">
            <div class="mission">
                <h3>Our Mission</h3>
                <p>To empower travelers with seamless and personalized experiences, showcasing the rich tapestry of
                    Ethiopia and beyond, fostering cultural understanding and creating lasting memories.</p>
            </div>
            <div class="vision">
                <h3>Our Vision</h3>
                <p>To be the leading travel platform for exploring Ethiopia and select global destinations, recognized
                    for our commitment to quality, authenticity, and sustainable tourism practices.</p>
            </div>
        </div>
    </section>

    <section class="who-we-are">
        <div class="container">
            <div class="image-container">
                <img src="assets/team-work.jpg" alt="Team Working Together">
            </div>
            <div class="content">
                <h3>Who We Are</h3>
                <p>Travel Habesha is more than just a travel company; we are a team of passionate explorers, dedicated
                    storytellers, and meticulous organizers. Rooted in the heart of Addis Ababa, Ethiopia, our journey
                    began with a simple desire: to share the incredible beauty and cultural heritage of our homeland
                    with the world.</p>
                <p>We believe in authentic experiences, connecting travelers with the true essence of each destination.
                    From the bustling markets of Addis Ababa to the ancient wonders of Lalibela and the breathtaking
                    landscapes of the Simien Mountains, we curate journeys that go beyond the typical tourist trail.</p>
            </div>
        </div>
    </section>

    <section class="our-values">
        <div class="container">
            <h3>Our Core Values</h3>
            <div class="values-grid">
                <div class="value">
                    <i class="fas fa-globe"></i>
                    <h4>Authenticity</h4>
                    <p>We strive to provide genuine and culturally rich experiences that reflect the true spirit of each
                        destination.</p>
                </div>
                <div class="value">
                    <i class="fas fa-users"></i>
                    <h4>Customer Focus</h4>
                    <p>Your journey is our priority. We are committed to providing personalized support and exceeding
                        your expectations.</p>
                </div>
                <div class="value">
                    <i class="fas fa-leaf"></i>
                    <h4>Sustainability</h4>
                    <p>We are mindful of our environmental and social impact, promoting responsible and sustainable
                        tourism practices.</p>
                </div>
                <div class="value">
                    <i class="fas fa-handshake"></i>
                    <h4>Integrity</h4>
                    <p>We operate with honesty, transparency, and ethical principles in all our interactions.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="our-team">
        <div class="container">
            <h3>Meet Our Team</h3>
            <p class="team-intro">A group of dedicated individuals passionate about travel and creating exceptional
                experiences.</p>
            <div class="team-grid">
                <div class="team-member">
                    <img src="assets/placeholder-person.jpg" alt="Team Member 1">
                    <h4>John Doe</h4>
                    <p class="role">CEO & Founder</p>
                </div>
                <div class="team-member">
                    <img src="assets/placeholder-person.jpg" alt="Team Member 2">
                    <h4>Jane Smith</h4>
                    <p class="role">Head of Operations</p>
                </div>
                <div class="team-member">
                    <img src="assets/placeholder-person.jpg" alt="Team Member 3">
                    <h4>Peter Jones</h4>
                    <p class="role">Customer Relations Manager</p>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-us-about">
        <div class="container">
            <h3>Ready to Explore with Us?</h3>
            <p>Have questions or want to start planning your Ethiopian adventure? Get in touch!</p>
            <a href="contact.php" class="button">Contact Us</a>
        </div>
    </section>

    <?php include 'footer.php'; ?>
</body>

</html>