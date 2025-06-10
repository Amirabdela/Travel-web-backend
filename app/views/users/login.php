<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="auth-section">
    <div class="auth-container">
        <h2>Login to Your Account</h2>
        <?php flash('register_success'); ?>
        <?php flash('login_success'); ?>
        <form action="<?php echo URLROOT; ?>/users/login" method="post" class="login-form">
            <div class="form-group">
                <label for="email">Email: <sup>*</sup></label>
                <input type="email" name="email" id="email" 
                       class="<?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>"
                       value="<?php echo $data['email']; ?>">
                <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
            </div>
            <div class="form-group">
                <label for="password">Password: <sup>*</sup></label>
                <div class="password-wrapper">
                    <input type="password" name="password" id="password" 
                           class="<?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>">
                    <span class="password-toggle" onclick="togglePassword()">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
                <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
            </div>
            <div class="form-group">
                <button type="submit" class="btn-primary">Login</button>
            </div>
        </form>
        <div class="auth-links">
            <p>Don't have an account? <a href="<?php echo URLROOT; ?>/users/register">Register</a></p>
        </div>
        <div class="social-login">
            <p>Or login with</p>
            <div class="social-buttons">
                <button type="button" class="social-btn google">
                    <i class="fab fa-google"></i> Google
                </button>
                <button type="button" class="social-btn facebook">
                    <i class="fab fa-facebook-f"></i> Facebook
                </button>
                <button type="button" class="social-btn twitter">
                    <i class="fab fa-twitter"></i> Twitter
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.querySelector('.password-toggle i');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}

// Add form submission handling
document.querySelector('.login-form').addEventListener('submit', function(e) {
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    
    if (!email || !password) {
        e.preventDefault();
        alert('Please fill in all required fields');
    }
});
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?> 