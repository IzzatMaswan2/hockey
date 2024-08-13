document.addEventListener('DOMContentLoaded', function() {
    const toggleButton = document.querySelector('.nav__toggle');
    const navLinks = document.querySelector('.nav__link');
    
    toggleButton.addEventListener('click', function() {
        navLinks.classList.toggle('active');
    });
});

