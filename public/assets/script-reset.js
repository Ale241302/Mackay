document.addEventListener('DOMContentLoaded', function () {
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('password_confirmation');
    const togglePassword1 = document.getElementById('togglePassword1');
    const togglePassword2 = document.getElementById('togglePassword2');

    const emailError = document.getElementById('emailError');
    const passwordError = document.getElementById('passwordError');
    const confirmPasswordError = document.getElementById('confirmPasswordError');

    emailInput.addEventListener('input', function () {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        emailError.textContent = emailPattern.test(emailInput.value) ? '' : 'Por favor, ingrese un correo electrónico válido.';
    });

    confirmPasswordInput.addEventListener('input', function () {
        confirmPasswordError.textContent = passwordInput.value === confirmPasswordInput.value ? '' : 'Las contraseñas no coinciden.';
    });

    passwordInput.addEventListener('input', function () {
        passwordError.textContent = passwordInput.value.length >= 6 ? '' : 'La contraseña debe tener al menos 6 caracteres.';
    });

    togglePassword1.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });

    togglePassword2.addEventListener('click', function () {
        const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPasswordInput.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
});