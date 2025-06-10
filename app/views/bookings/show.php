<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container">
    <div class="booking-details">
        <h1 class="page-title">Booking Details</h1>
        <div class="booking-card">
            <img src="<?php echo $data['booking']->package_image; ?>" alt="<?php echo $data['booking']->package_title; ?>" class="booking-image">
            <div class="booking-info">
                <h3><?php echo $data['booking']->package_title; ?></h3>
                <p>Destination: <?php echo $data['booking']->destination_name; ?></p>
                <p>Start Date: <?php echo date('M d, Y', strtotime($data['booking']->start_date)); ?></p>
                <p>End Date: <?php echo date('M d, Y', strtotime($data['booking']->end_date)); ?></p>
                <p>Status: <span class="status-<?php echo $data['booking']->status; ?>"><?php echo ucfirst($data['booking']->status); ?></span></p>
                <?php if ($data['booking']->status == 'pending'): ?>
                    <a href="<?php echo URLROOT; ?>/bookings/cancel/<?php echo $data['booking']->id; ?>" class="btn-cancel">Cancel Booking</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?> 