<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="auth-section">
    <div class="auth-container">
        <h2>Create an Account</h2>
        <form action="<?php echo URLROOT; ?>/users/register" method="post" class="register-form">
            <div class="form-group">
                <label for="first_name">First Name: <sup>*</sup></label>
                <input type="text" name="first_name" id="first_name" 
                       class="<?php echo (!empty($data['first_name_err'])) ? 'is-invalid' : ''; ?>"
                       value="<?php echo $data['first_name']; ?>">
                <span class="invalid-feedback"><?php echo $data['first_name_err']; ?></span>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name: <sup>*</sup></label>
                <input type="text" name="last_name" id="last_name" 
                       class="<?php echo (!empty($data['last_name_err'])) ? 'is-invalid' : ''; ?>"
                       value="<?php echo $data['last_name']; ?>">
                <span class="invalid-feedback"><?php echo $data['last_name_err']; ?></span>
            </div>
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
                    <span class="password-toggle" onclick="togglePassword('password')">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
                <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password: <sup>*</sup></label>
                <div class="password-wrapper">
                    <input type="password" name="confirm_password" id="confirm_password" 
                           class="<?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>">
                    <span class="password-toggle" onclick="togglePassword('confirm_password')">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
                <span class="invalid-feedback"><?php echo $data['confirm_password_err']; ?></span>
            </div>
            <div class="form-group">
                <button type="submit" class="btn-primary">Register</button>
            </div>
        </form>
        <div class="auth-links">
            <p>Already have an account? <a href="<?php echo URLROOT; ?>/users/login">Login</a></p>
        </div>
        <div class="social-login">
            <p>Or register with</p>
            <div class="social-buttons">
                <button class="social-btn google">
                    <i class="fab fa-google"></i> Google
                </button>
                <button class="social-btn facebook">
                    <i class="fab fa-facebook-f"></i> Facebook
                </button>
                <button class="social-btn twitter">
                    <i class="fab fa-twitter"></i> Twitter
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword(inputId) {
    const passwordInput = document.getElementById(inputId);
    const toggleIcon = passwordInput.nextElementSibling.querySelector('i');
    
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
document.querySelector('.register-form').addEventListener('submit', function(e) {
    const first_name = document.getElementById('first_name').value;
    const last_name = document.getElementById('last_name').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const confirm_password = document.getElementById('confirm_password').value;
    
    if (!first_name || !last_name || !email || !password || !confirm_password) {
        e.preventDefault();
        alert('Please fill in all required fields');
    } else if (password !== confirm_password) {
        e.preventDefault();
        alert('Passwords do not match');
    }
});
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?> 