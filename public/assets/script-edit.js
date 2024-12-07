// script-edit.js

// Función para validar que un campo solo contenga letras y espacios
function validarLetrasYEspacios(campo) {
    const regex = /^[a-zA-Z\s]*$/;
    return regex.test(campo);
}

// Función para validar que un campo solo contenga números
function validarNumeros(campo) {
    const regex = /^[0-9]*$/;
    return regex.test(campo);
}

// Función para validar que un campo sea un correo electrónico válido
function validarCorreo(campo) {
    const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return regex.test(campo);
}

// Función para mostrar u ocultar la contraseña
function togglePassword(eyeIcon, passwordInput) {
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        eyeIcon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Seleccionar los elementos del formulario
    const nameInput = document.getElementById('name2');
    const apellidoInput = document.getElementById('apellido2');
    const numeroDocumentoInput = document.getElementById('numero_documento2');
    const numeroTelefonicoInput = document.getElementById('numero_telefonico2');
    const emailInput = document.getElementById('email2');
    

    // Elementos para mostrar errores
    const nameError = document.getElementById('nameError');
    const apellidoError = document.getElementById('apellidoError');
    const numeroDocumentoError = document.getElementById('numeroDocumentoError');
    const numeroTelefonicoError = document.getElementById('numeroTelefonicoError');
    const emailError = document.getElementById('emailError');
   ;

    // Agregar eventos de validación a los campos del formulario
    nameInput.addEventListener('input', function() {
        if (!validarLetrasYEspacios(nameInput.value)) {
            nameInput.classList.add('is-invalid');
            nameError.textContent = 'El nombre solo puede contener letras y espacios.';
        } else {
            nameInput.classList.remove('is-invalid');
            nameError.textContent = '';
        }
    });

    apellidoInput.addEventListener('input', function() {
        if (!validarLetrasYEspacios(apellidoInput.value)) {
            apellidoInput.classList.add('is-invalid');
            apellidoError.textContent = 'El apellido solo puede contener letras y espacios.';
        } else {
            apellidoInput.classList.remove('is-invalid');
            apellidoError.textContent = '';
        }
    });

    numeroDocumentoInput.addEventListener('input', function() {
        if (!validarNumeros(numeroDocumentoInput.value)) {
            numeroDocumentoInput.classList.add('is-invalid');
            numeroDocumentoError.textContent = 'El número de documento solo puede contener números.';
        } else {
            numeroDocumentoInput.classList.remove('is-invalid');
            numeroDocumentoError.textContent = '';
        }
    });

    numeroTelefonicoInput.addEventListener('input', function() {
        if (!validarNumeros(numeroTelefonicoInput.value)) {
            numeroTelefonicoInput.classList.add('is-invalid');
            numeroTelefonicoError.textContent = 'El número telefónico solo puede contener números.';
        } else {
            numeroTelefonicoInput.classList.remove('is-invalid');
            numeroTelefonicoError.textContent = '';
        }
    });

    emailInput.addEventListener('input', function() {
        if (!validarCorreo(emailInput.value)) {
            emailInput.classList.add('is-invalid');
            emailError.textContent = 'Por favor, ingrese un correo electrónico válido.';
        } else {
            emailInput.classList.remove('is-invalid');
            emailError.textContent = '';
        }
    });

    
});
