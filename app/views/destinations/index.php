<?php require_once APPROOT . '/helpers/session_helper.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title']; ?> - Travel Habesha</title>

    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/pages/destinations.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Poppins&family=Sono&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
    <?php require_once APPROOT . '/views/inc/header.php'; ?>

    <!-- Hero Section -->
    <section class="destinations-hero">
        <div class="container">
            <h1>Discover Ethiopia</h1>
            <p>Explore our amazing destinations and plan your next adventure</p>
        </div>
    </section>

    <!-- Destinations Grid -->
    <section class="destinations-grid">
        <div class="container">
            <div class="filter-buttons">
                <button class="filter-btn active" data-filter="all">All Destinations</button>
                <button class="filter-btn" data-filter="cultural">Cultural</button>
                <button class="filter-btn" data-filter="natural">Natural</button>
                <button class="filter-btn" data-filter="historical">Historical</button>
                <button class="filter-btn" data-filter="religious">Religious</button>
            </div>

            <div class="destinations-container">
                <?php foreach ($data['destinations'] as $destination): ?>
                <div class="destination-card" data-category="<?php echo $destination->category; ?>">
                    <div class="destination-image">
                        <img src="<?php echo URLROOT . '/' . $destination->image; ?>"
                            alt="<?php echo $destination->name; ?>">
                    </div>
                    <div class="destination-info">
                        <h3><?php echo $destination->name; ?></h3>
                        <p class="location">
                            <i class="fas fa-map-marker-alt"></i>
                            <?php echo $destination->location; ?>
                        </p>
                        <p class="description"><?php echo substr($destination->description, 0, 100) . '...'; ?></p>
                        <div class="destination-footer">
                            <span class="category"><?php echo ucfirst($destination->category); ?></span>
                            <a href="<?php echo URLROOT; ?>/destinations/show/<?php echo $destination->id; ?>"
                                class="btn-explore">Explore</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php require_once APPROOT . '/views/inc/footer.php'; ?>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.filter-btn');
        const destinationCards = document.querySelectorAll('.destination-card');

        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Remove active class from all buttons
                filterButtons.forEach(btn => btn.classList.remove('active'));
                // Add active class to clicked button
                button.classList.add('active');

                const filter = button.getAttribute('data-filter');

                destinationCards.forEach(card => {
                    if (filter === 'all' || card.getAttribute('data-category') ===
                        filter) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    });
    </script>
</body>

</html>