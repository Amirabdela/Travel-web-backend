<?php require_once APPROOT . '/helpers/session_helper.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title']; ?> - Travel Habesha</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/pages/cars.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Poppins&family=Sono&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
    <?php require_once APPROOT . '/views/inc/header.php'; ?>

    <div class="container">
        <div class="car-details">
            <h1><?php echo $data['car']->model; ?></h1>
            <p class="type"><?php echo $data['car']->type; ?></p>

            <div class="car-image">
                <img src="<?php echo URLROOT . '/' . $data['car']->image; ?>" alt="<?php echo $data['car']->model; ?>">
            </div>

            <div class="car-info">
                <div class="description">
                    <h2>About</h2>
                    <p><?php echo $data['car']->description; ?></p>
                </div>

                <div class="specifications">
                    <h2>Specifications</h2>
                    <ul>
                        <li><strong>Transmission:</strong> <?php echo $data['car']->transmission ?? 'Not specified'; ?>
                        </li>
                        <li><strong>Seats:</strong> <?php echo $data['car']->seats ?? 'Not specified'; ?></li>
                        <li><strong>Luggage:</strong> <?php echo $data['car']->luggage ?? 'Not specified'; ?></li>
                        <li><strong>Air Conditioning:</strong>
                            <?php echo isset($data['car']->air_conditioning) ? ($data['car']->air_conditioning ? 'Yes' : 'No') : 'Not specified'; ?>
                        </li>
                    </ul>
                </div>

                <div class="booking">
                    <h2>Book This Car</h2>
                    <p class="price">$<?php echo number_format($data['car']->price_per_day, 2); ?> per day</p>

                    <form method="POST" action="<?php echo URLROOT; ?>/cars/book/<?php echo $data['car']->id; ?>">
                        <div class="form-group">
                            <label for="start-date">Start Date</label>
                            <input type="date" id="start-date" name="start_date" required>
                        </div>

                        <div class="form-group">
                            <label for="end-date">End Date</label>
                            <input type="date" id="end-date" name="end_date" required>
                        </div>

                        <button type="submit" class="btn-book">Book Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php require_once APPROOT . '/views/inc/footer.php'; ?>
</body>

</html>