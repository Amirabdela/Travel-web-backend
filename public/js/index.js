document.addEventListener('DOMContentLoaded', function() {
    const menuIcon = document.querySelector('.menu-icon');
    const navUl = document.querySelector('nav ul');
    
    menuIcon.addEventListener('click', function() {
        navUl.classList.toggle('active');
    });
    
    // Close menu when a link is clicked (for single page navigation)
    const navLinks = document.querySelectorAll('.nav-links a');
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            if (navUl.classList.contains('active')) {
                navUl.classList.remove('active');
            }
        });
    });
});


