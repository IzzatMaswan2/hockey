const wrapper = document.querySelector('.wrapper');
const loginLink = document.querySelector('.login-link');
const registerLink = document.querySelector('.register-link');

registerLink.addEventListener ('click', ()=> {
    wrapper.classList.add('active');
});

loginLink.addEventListener ('click', ()=> {
    wrapper.classList.remove('active');
});



document.addEventListener('DOMContentLoaded', function() {
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirm-password');
    const confirmIcon = document.getElementById('confirm-icon');

    function checkPasswordsMatch() {
        if (password.value === confirmPassword.value && confirmPassword.value !== '') {
            confirmIcon.classList.add('match');
        } else {
            confirmIcon.classList.remove('match');
        }
    }

    // Check on input event for both fields
    password.addEventListener('input', checkPasswordsMatch);
    confirmPassword.addEventListener('input', checkPasswordsMatch);
});

