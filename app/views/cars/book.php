<?php require APPROOT . '/views/inc/header.php'; ?>

<!-- Booking Confirmation Section -->
<section class="booking-confirmation py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="booking-card">
                    <h2 class="text-center mb-4">Book <?php echo $data['car']->model; ?></h2>
                    
                    <div class="car-summary mb-4">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="<?php echo URLROOT . '/img/cars/' . $data['car']->image; ?>" alt="<?php echo $data['car']->model; ?>" class="img-fluid">
                            </div>
                            <div class="col-md-8">
                                <h3><?php echo $data['car']->model; ?></h3>
                                <p class="car-type"><?php echo ucfirst($data['car']->type); ?></p>
                                <div class="car-features">
                                    <span><i class="fas fa-user"></i> <?php echo $data['car']->seats; ?> Seats</span>
                                    <span><i class="fas fa-cog"></i> <?php echo $data['car']->transmission; ?></span>
                                    <span><i class="fas fa-gas-pump"></i> <?php echo $data['car']->fuel_type; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form action="<?php echo URLROOT; ?>/cars/book/<?php echo $data['car']->id; ?>" method="POST" class="booking-form">
                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input type="date" name="start_date" id="start_date" class="form-control <?php echo (!empty($data['start_date_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['start_date']; ?>">
                            <span class="invalid-feedback"><?php echo $data['start_date_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input type="date" name="end_date" id="end_date" class="form-control <?php echo (!empty($data['end_date_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['end_date']; ?>">
                            <span class="invalid-feedback"><?php echo $data['end_date_err']; ?></span>
                        </div>

                        <div class="booking-summary mt-4">
                            <h4>Booking Summary</h4>
                            <div class="summary-item">
                                <span>Price per day:</span>
                                <span>$<?php echo $data['car']->price_per_day; ?></span>
                            </div>
                            <div class="summary-item">
                                <span>Number of days:</span>
                                <span id="days-count">0</span>
                            </div>
                            <div class="summary-item total">
                                <span>Total price:</span>
                                <span id="total-price">$0</span>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block mt-4">Confirm Booking</button>
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
    const daysCount = document.getElementById('days-count');
    const totalPrice = document.getElementById('total-price');
    const pricePerDay = <?php echo $data['car']->price_per_day; ?>;
    
    // Set minimum date to today
    const today = new Date().toISOString().split('T')[0];
    startDate.min = today;
    
    function calculateTotal() {
        if(startDate.value && endDate.value) {
            const start = new Date(startDate.value);
            const end = new Date(endDate.value);
            const days = Math.ceil((end - start) / (1000 * 60 * 60 * 24)) + 1;
            
            if(days > 0) {
                daysCount.textContent = days;
                totalPrice.textContent = '$' + (days * pricePerDay);
            } else {
                daysCount.textContent = '0';
                totalPrice.textContent = '$0';
            }
        }
    }
    
    // Update end date minimum when start date changes
    startDate.addEventListener('change', function() {
        endDate.min = this.value;
        if(endDate.value && endDate.value < this.value) {
            endDate.value = this.value;
        }
        calculateTotal();
    });
    
    endDate.addEventListener('change', calculateTotal);
});
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?> 