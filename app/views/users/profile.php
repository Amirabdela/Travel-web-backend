<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="profile-container">
    <div class="profile-sidebar">
        <div class="profile-avatar">
            <img src="<?php echo !empty($user->avatar) ? $user->avatar : URLROOT . '/public/images/default-avatar.png'; ?>" 
                 alt="Profile Picture">
        </div>
        <h2><?php echo $user->first_name . ' ' . $user->last_name; ?></h2>
        <p><i class="fas fa-envelope"></i> <?php echo $user->email; ?></p>
        <p><i class="fas fa-user-tag"></i> <?php echo $user->role_name; ?></p>
        <p><i class="fas fa-calendar-alt"></i> Member since <?php echo date('F Y', strtotime($user->created_at)); ?></p>
    </div>

    <div class="profile-content">
        <h1>My Profile</h1>
        <?php flash('profile_message'); ?>

        <div class="profile-form">
            <h3>Personal Information</h3>
            <form action="<?php echo URLROOT; ?>/users/edit" method="post">
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" id="first_name" 
                           value="<?php echo $user->first_name; ?>" 
                           class="<?php echo (!empty($data['first_name_err'])) ? 'is-invalid' : ''; ?>">
                    <span class="invalid-feedback"><?php echo $data['first_name_err']; ?></span>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" id="last_name" 
                           value="<?php echo $user->last_name; ?>"
                           class="<?php echo (!empty($data['last_name_err'])) ? 'is-invalid' : ''; ?>">
                    <span class="invalid-feedback"><?php echo $data['last_name_err']; ?></span>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" 
                           value="<?php echo $user->email; ?>"
                           class="<?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>">
                    <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                </div>
                <button type="submit" class="btn-primary">Update Profile</button>
            </form>
        </div>

        <div class="profile-bookings">
            <h2>My Bookings</h2>
            <?php if(empty($bookings)): ?>
                <div class="no-bookings">
                    <i class="fas fa-calendar-times"></i>
                    <p>You haven't made any bookings yet.</p>
                    <a href="<?php echo URLROOT; ?>/packages" class="btn-primary">Explore Packages</a>
                </div>
            <?php else: ?>
                <?php foreach($bookings as $booking): ?>
                    <div class="booking-card">
                        <div class="booking-image">
                            <img src="<?php echo $booking->package_image; ?>" alt="<?php echo $booking->package_title; ?>">
                        </div>
                        <div class="booking-details">
                            <h3><?php echo $booking->package_title; ?> 
                                <small class="status-<?php echo strtolower($booking->status); ?>">
                                    <?php echo $booking->status; ?>
                                </small>
                            </h3>
                            <p><i class="fas fa-calendar"></i> <?php echo date('F j, Y', strtotime($booking->booking_date)); ?></p>
                            <p><i class="fas fa-users"></i> <?php echo $booking->guests; ?> Guests</p>
                            <p><i class="fas fa-dollar-sign"></i> Total: $<?php echo number_format($booking->total_amount, 2); ?></p>
                            <?php if($booking->status === 'Pending'): ?>
                                <a href="<?php echo URLROOT; ?>/bookings/cancel/<?php echo $booking->id; ?>" 
                                   class="btn-small btn-danger">Cancel Booking</a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?> 