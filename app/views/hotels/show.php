<?php require_once APPROOT . '/helpers/session_helper.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title']; ?> - Travel Habesha</title>

    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/pages/hotel.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Poppins&family=Sono&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
    <?php require_once APPROOT . '/views/inc/header.php'; ?>

    <div class="container">
        <div class="hotel-details">
            <h1><?php echo $data['hotel']->name; ?></h1>
            <p class="location"><?php echo $data['hotel']->location; ?></p>

            <div class="hotel-image">
                <img src="<?php echo URLROOT . '/' . $data['hotel']->image; ?>"
                    alt="<?php echo $data['hotel']->name; ?>">
            </div>

            <div class="hotel-info">
                <div class="description">
                    <h2>About</h2>
                    <p><?php echo $data['hotel']->description; ?></p>
                </div>

                <div class="amenities">
                    <h2>Amenities</h2>
                    <ul>
                        <?php 
                        $amenities = explode(',', $data['hotel']->amenities);
                        foreach ($amenities as $amenity): 
                        ?>
                        <li><?php echo trim($amenity); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="booking">
                    <h2>Book Your Stay</h2>
                    <p class="price">$<?php echo number_format($data['hotel']->price_per_night, 2); ?> per night</p>

                    <form method="POST" action="<?php echo URLROOT; ?>/hotels/book/<?php echo $data['hotel']->id; ?>">
                        <div class="form-group">
                            <label for="check-in">Check-in</label>
                            <input type="date" id="check-in" name="check_in" required>
                        </div>

                        <div class="form-group">
                            <label for="check-out">Check-out</label>
                            <input type="date" id="check-out" name="check_out" required>
                        </div>

                        <div class="form-group">
                            <label for="guests">Guests</label>
                            <select id="guests" name="guests">
                                <option value="1">1 Guest</option>
                                <option value="2">2 Guests</option>
                                <option value="3">3 Guests</option>
                                <option value="4">4 Guests</option>
                            </select>
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