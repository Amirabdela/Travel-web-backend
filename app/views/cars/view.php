<?php require APPROOT . '/views/inc/header.php'; ?>

<!-- Car Details Section -->
<section class="car-details-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="car-gallery">
                    <img src="<?php echo URLROOT . '/img/cars/' . $data['car']->image; ?>"
                        alt="<?php echo $data['car']->model; ?>" class="main-image">
                </div>
                <div class="car-info mt-4">
                    <h1><?php echo $data['car']->model; ?></h1>
                    <div class="car-meta">
                        <span class="type"><?php echo ucfirst($data['car']->type); ?></span>
                        <span class="rating">
                            <?php for($i = 0; $i < $data['car']->rating; $i++): ?>
                            <i class="fas fa-star"></i>
                            <?php endfor; ?>
                        </span>
                    </div>
                    <div class="car-features mt-4">
                        <div class="feature">
                            <i class="fas fa-user"></i>
                            <span><?php echo $data['car']->seats; ?> Seats</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-cog"></i>
                            <span><?php echo $data['car']->transmission; ?></span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-gas-pump"></i>
                            <span><?php echo $data['car']->fuel_type; ?></span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-luggage-cart"></i>
                            <span><?php echo $data['car']->luggage; ?> Bags</span>
                        </div>
                    </div>
                    <div class="car-description mt-4">
                        <h3>Description</h3>
                        <p><?php echo $data['car']->description; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="booking-card">
                    <div class="price-tag">
                        <span class="price">$<?php echo $data['car']->price_per_day; ?></span>
                        <span class="per-day">per day</span>
                    </div>
                    <form action="<?php echo URLROOT; ?>/cars/book/<?php echo $data['car']->id; ?>" method="POST"
                        class="booking-form">
                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input type="date" name="start_date" id="start_date"
                                class="form-control <?php echo (!empty($data['start_date_err'])) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $data['start_date']; ?>">
                            <span class="invalid-feedback"><?php echo $data['start_date_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input type="date" name="end_date" id="end_date"
                                class="form-control <?php echo (!empty($data['end_date_err'])) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $data['end_date']; ?>">
                            <span class="invalid-feedback"><?php echo $data['end_date_err']; ?></span>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Book Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const startDate = document.getElementById('start_date');
    const endDate = document.getElementById('end_date');

    // Set minimum date to today
    const today = new Date().toISOString().split('T')[0];
    startDate.min = today;

    // Update end date minimum when start date changes
    startDate.addEventListener('change', function() {
        endDate.min = this.value;
        if (endDate.value && endDate.value < this.value) {
            endDate.value = this.value;
        }
    });
});
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>