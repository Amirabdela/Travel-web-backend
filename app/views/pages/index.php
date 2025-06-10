<?php require_once APPROOT . '/views/inc/header.php'; ?>

<!-- Hero Section -->
<div class="hero">
    <div class="hero-content">
        <h1>Discover Ethiopia</h1>
        <p>Experience the beauty and culture of Ethiopia</p>
        <a href="<?php echo URLROOT; ?>/packages" class="btn btn-primary">Explore Packages</a>
    </div>
</div>

<!-- Destinations Section -->
<section class="destinations-section">
    <div class="container">
        <div class="section-header">
            <h2>Popular Destinations</h2>
            <p>Explore our most popular destinations in Ethiopia</p>
        </div>

        <div class="destinations-grid">
            <?php foreach($data['featuredDestinations'] as $destination): ?>
            <div class="destination-card">
                <div class="destination-image">
                    <img src="<?php echo URLROOT . '/' . $destination->image; ?>" alt="<?php echo $destination->name; ?>">
                    <span class="destination-badge"><?php echo $destination->category; ?></span>
                </div>
                <div class="destination-content">
                    <h3><?php echo $destination->name; ?></h3>
                    <div class="destination-location">
                        <i class="fas fa-map-marker-alt"></i>
                        <span><?php echo $destination->location; ?></span>
                    </div>
                    <p class="destination-description">
                        <?php echo substr($destination->description, 0, 150) . '...'; ?>
                    </p>
                    <div class="destination-features">
                        <?php 
                        $features = explode(',', $destination->features);
                        foreach($features as $feature): 
                        ?>
                        <span class="feature"><?php echo trim($feature); ?></span>
                        <?php endforeach; ?>
                    </div>
                    <a href="<?php echo URLROOT; ?>/destinations/show/<?php echo $destination->id; ?>" class="btn">Learn More</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Other sections of your home page -->
<?php require_once APPROOT . '/views/inc/footer.php'; ?>