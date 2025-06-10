    <?php require APPROOT . '/views/inc/header.php'; ?>

    <div class="container mt-4">
        <h1><?php echo $data['title']; ?></h1>

        <!-- Filter buttons -->
        <div class="mb-4">
            <button class="btn btn-primary" onclick="filterPackages('all')">All</button>
            <?php foreach($data['types'] as $type): ?>
            <button class="btn btn-outline-primary" onclick="filterPackages('<?php echo $type; ?>')">
                <?php echo ucfirst($type); ?>
            </button>
            <?php endforeach; ?>
        </div>

        <!-- Packages grid -->
        <div class="row">
            <?php foreach($data['packages'] as $package): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="<?php echo URLROOT . '/images/packages/' . $package->image_path; ?>" class="card-img-top"
                        alt="<?php echo $package->title; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $package->title; ?></h5>
                        <p class="card-text"><?php echo substr($package->description, 0, 100) . '...'; ?></p>
                        <p class="card-text">
                            <small class="text-muted">
                                Duration: <?php echo $package->duration_days; ?> days
                            </small>
                        </p>
                        <p class="card-text">
                            <strong>Price: $<?php echo number_format($package->price, 2); ?></strong>
                        </p>
                        <a href="<?php echo URLROOT; ?>/packages/show/<?php echo $package->id; ?>"
                            class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php require APPROOT . '/views/inc/footer.php'; ?>
    <script>
function filterPackages(type) {
    // Add your filtering logic here
    console.log('Filtering by:', type);
}
    </script>