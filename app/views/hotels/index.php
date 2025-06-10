<?php require_once APPROOT . '/helpers/session_helper.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title']; ?> - Travel Habesha</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/pages/hotels.css">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Poppins&family=Sono&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
    <?php require_once APPROOT . '/views/inc/header.php'; ?>

    <div class="container">
        <h1>Hotels</h1>

        <!-- Hotel List -->
        <div class="hotels-grid">
            <?php foreach ($data['hotels'] as $hotel): ?>
            <div class="hotel-card">
                <h2><?php echo $hotel->name; ?></h2>
                <p><?php echo $hotel->description; ?></p>
                <p>Location: <?php echo $hotel->location; ?></p>
                <p>Price: $<?php echo $hotel->price_per_night; ?> per night</p>
                <a href="<?php echo URLROOT; ?>/hotels/show/<?php echo $hotel->id; ?>" class="btn">View Details</a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php require_once APPROOT . '/views/inc/footer.php'; ?>
</body>

</html>