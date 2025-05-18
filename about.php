<?php 
require_once __DIR__ . '/includes/header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="styles/about.css">
    <link rel=" preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Sono:wght@200..800&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<!-- Header Section -->

<section class="shop-hero">
    <h2 class="shop" style="text-transform: lowercase; font-size: 70px;">about us</h2>
</section>
<!-- Cards Section -->
<section class="about-cards">
    <div class="dis-block">
        <div><img class="the-float" src="assets/float.jpg" alt="logo">
            <p>Welcome to Travel Habesha! We are passionate about showcasing the beauty and culture of Ethiopia and
                beyond. Our mission is to make every journey an unforgettable experience by offering personalized
                travel
                solutions, including car rentals, hotel reservations, and curated holiday packages.

                Whether you're exploring vibrant cities, embarking on cultural adventures, or planning a relaxing
                getaway, Travel Habesha is here to guide you every step of the way. Discover the world with us and
                create memories that last a lifetime.
            </p><br /><br /> At Travel Habesha, we believe travel is more than just visiting places—it's about
            creating
            stories, embracing cultures, and connecting with the world. As your trusted travel partner, we
            specialize in
            offering seamless car rentals, hotel bookings, and tailor-made travel packages for holidays and special
            events.

            Our team is dedicated to turning your travel dreams into reality by providing exceptional service and
            unforgettable experiences. Whether you're traveling solo, with family, or for business, Travel Habesha
            is
            your gateway to adventure and relaxation.</p>
        </div>
        <div class="bg-black">
            <div class="i-wit"><i class="fa-solid fa-location-dot ab-loci"></i>
                <div>
                    <h2>ADDRESS</h2>
                    <h2>ADDIS ABABA</h2>
                </div>
            </div>
            <div class="i-wit"><i class="fa-solid fa-location-dot ab-loci"></i>
                <div>
                    <h2>PHONE</h2>
                    <h2>251-911811899</h2>
                </div>
            </div>
            <div class="i-wit"><i class="fa-solid fa-location-dot ab-loci"></i>
                <div>
                    <h2>Email</h2>
                    <h2>Travelhabesa@gmail.com</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="im-grid">
        <img class="agrid1" src="assets/addis.jpg">
        <img class="agrid2" src="assets/addis.jpg">
        <img class="agrid3" src="assets/addis.jpg">
        <img class="agrid4" src="assets/addis.jpg">
    </div>
    <div class="messag">
        <p>contactus</p>
        <h1>DROP US A LINE</h1>
        <label>Email:</label>
        <input type="text" size="40" maxlength="400" class="Email">
        <br />
        <label>Message</label>
        <div class="textbox-container">
            <input type="text" class="textbox">
            <br>
            <button class="submit-button">Submit</button>
        </div>
    </div>
</section>


<?php include 'footer.php'; ?>
</body>

</html>