<?php
require_once APPROOT . '/helpers/session_helper.php';

$name = $email = $message = '';
$nameErr = $emailErr = $messageErr = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate name
    if (empty($_POST['name'])) {
        $nameErr = 'Name is required';
    } else {
        $name = cleanInput($_POST['name']);
    }
    
    // Validate email
    if (empty($_POST['email'])) {
        $emailErr = 'Email is required';
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $emailErr = 'Invalid email format';
    } else {
        $email = cleanInput($_POST['email']);
    }
    
    // Validate message
    if (empty($_POST['message'])) {
        $messageErr = 'Message is required';
    } else {
        $message = cleanInput($_POST['message']);
    }
    
    // If no errors, save to database
    if (empty($nameErr) && empty($emailErr) && empty($messageErr)) {
        $contact = new Contact();
        if($contact->addMessage($name, $email, $message)) {
            $success = 'Thank you for your message! We will get back to you soon.';
            $name = $email = $message = ''; // Clear form
        } else {
            $error = 'Failed to send message. Please try again later.';
        }
    }
}

// If user is logged in, pre-fill name and email
if (isLoggedIn()) {
    $user = new User();
    $userData = $user->getUserById($_SESSION['user_id']);
    if ($userData) {
        $name = $userData->full_name;
        $email = $userData->email;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Travel Habesha</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/styles/base.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/styles/header.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/styles/footer.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/pages/contact.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
    <?php require_once APPROOT . '/views/inc/header.php'; ?>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="contact-container">
            <div class="contact-info">
                <h2>Contact Information</h2>
                <div class="info-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <div>
                        <h3>Address</h3>
                        <p>Addis Ababa, Ethiopia</p>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-phone"></i>
                    <div>
                        <h3>Phone</h3>
                        <p>+251 911 811 899</p>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-envelope"></i>
                    <div>
                        <h3>Email</h3>
                        <p>travelhabesha@gmail.com</p>
                    </div>
                </div>
                <div class="social-media">
                    <h3>Follow Us</h3>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-pinterest-p"></i></a>
                    </div>
                </div>
            </div>

            <div class="contact-form">
                <h2>Send Us a Message</h2>

                <?php if ($success): ?>
                <div class="alert success"><?php echo $success; ?></div>
                <?php elseif (isset($error)): ?>
                <div class="alert error"><?php echo $error; ?></div>
                <?php endif; ?>

                <form method="POST" action="<?php echo URLROOT; ?>/pages/contact">
                    <div class="form-group">
                        <label for="name">Your Name</label>
                        <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>
                        <?php if ($nameErr): ?>
                        <span class="error"><?php echo $nameErr; ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="email">Your Email</label>
                        <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>
                        <?php if ($emailErr): ?>
                        <span class="error"><?php echo $emailErr; ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="message">Your Message</label>
                        <textarea id="message" name="message" rows="5" required><?php echo $message; ?></textarea>
                        <?php if ($messageErr): ?>
                        <span class="error"><?php echo $messageErr; ?></span>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn-primary">Send Message</button>
                </form>
            </div>
        </div>
    </section>

    <?php require_once APPROOT . '/views/inc/footer.php'; ?>
</body>

</html>