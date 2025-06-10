<?php require APPROOT . '/views/inc/header.php'; ?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <h1>Rental Cars</h1>
        <p>Find the perfect car for your journey</p>
    </div>
</section>

<!-- Search Filters -->
<section class="filters-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="filters-wrapper">
                    <div class="filter-group">
                        <label>Car Type:</label>
                        <select id="type-filter" class="form-control">
                            <option value="">All Types</option>
                            <?php foreach($data['types'] as $type): ?>
                                <option value="<?php echo $type->type; ?>"><?php echo ucfirst($type->type); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label>Price Range:</label>
                        <select id="price-filter" class="form-control">
                            <option value="">All Prices</option>
                            <option value="0-50">$0 - $50</option>
                            <option value="51-100">$51 - $100</option>
                            <option value="101-200">$101 - $200</option>
                            <option value="201+">$201+</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Cars Grid -->
<section class="cars-grid py-5">
    <div class="container">
        <div class="row" id="cars-container">
            <?php foreach($data['cars'] as $car): ?>
                <div class="col-md-4 mb-4">
                    <div class="car-card">
                        <img src="<?php echo URLROOT . '/img/cars/' . $car->image; ?>" alt="<?php echo $car->model; ?>" class="car-image">
                        <div class="car-details">
                            <h3><?php echo $car->model; ?></h3>
                            <p class="car-type"><?php echo ucfirst($car->type); ?></p>
                            <div class="car-features">
                                <span><i class="fas fa-user"></i> <?php echo $car->seats; ?> Seats</span>
                                <span><i class="fas fa-cog"></i> <?php echo $car->transmission; ?></span>
                                <span><i class="fas fa-gas-pump"></i> <?php echo $car->fuel_type; ?></span>
                            </div>
                            <div class="car-price">
                                <span class="price">$<?php echo $car->price_per_day; ?></span>
                                <span class="per-day">per day</span>
                            </div>
                            <a href="<?php echo URLROOT; ?>/cars/show/<?php echo $car->id; ?>" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const typeFilter = document.getElementById('type-filter');
    const priceFilter = document.getElementById('price-filter');
    const carsContainer = document.getElementById('cars-container');

    function filterCars() {
        const selectedType = typeFilter.value;
        const selectedPrice = priceFilter.value;
        const cars = document.querySelectorAll('.car-card');

        cars.forEach(car => {
            const type = car.querySelector('.car-type').textContent.toLowerCase();
            const price = parseInt(car.querySelector('.price').textContent.replace('$', ''));

            let typeMatch = !selectedType || type === selectedType.toLowerCase();
            let priceMatch = true;

            if (selectedPrice) {
                const [min, max] = selectedPrice.split('-').map(Number);
                if (max) {
                    priceMatch = price >= min && price <= max;
                } else {
                    priceMatch = price >= min;
                }
            }

            car.closest('.col-md-4').style.display = typeMatch && priceMatch ? 'block' : 'none';
        });
    }

    typeFilter.addEventListener('change', filterCars);
    priceFilter.addEventListener('change', filterCars);
});
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?> 