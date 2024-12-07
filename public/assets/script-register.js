document.addEventListener('DOMContentLoaded', function () {
    const emailInput = document.getElementById('email');
    const nameInput = document.getElementById('name');
    const apellidoInput = document.getElementById('apellido');
    const tipoDocumentoInput = document.getElementById('tipo_documento');
    const numeroDocumentoInput = document.getElementById('numero_documento');
    const numeroTelefonicoInput = document.getElementById('numero_telefonico');

    const emailError = document.getElementById('emailError');
    const nameError = document.getElementById('nameError');
    const apellidoError = document.getElementById('apellidoError');
    const tipoDocumentoError = document.getElementById('tipoDocumentoError');
    const numeroDocumentoError = document.getElementById('numeroDocumentoError');
    const numeroTelefonicoError = document.getElementById('numeroTelefonicoError');

    emailInput.addEventListener('input', function () {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        emailError.textContent = emailPattern.test(emailInput.value) ? '' : 'Por favor, ingrese un correo electrónico válido.';
    });


    nameInput.addEventListener('input', function () {
        const namePattern = /^[A-Za-z\s]+$/;
        if (nameInput.value.trim() === '') {
            nameError.textContent = 'El nombre es requerido.';
        } else if (!namePattern.test(nameInput.value)) {
            nameError.textContent = 'El nombre solo puede contener letras y espacios.';
        } else {
            nameError.textContent = '';
        }
    });

    apellidoInput.addEventListener('input', function () {
        const apellidoPattern = /^[A-Za-z\s]+$/;
        if (apellidoInput.value.trim() === '') {
            apellidoError.textContent = 'El apellido es requerido.';
        } else if (!apellidoPattern.test(apellidoInput.value)) {
            apellidoError.textContent = 'El apellido solo puede contener letras y espacios.';
        } else {
            apellidoError.textContent = '';
        }
    });

    tipoDocumentoInput.addEventListener('change', function () {
        tipoDocumentoError.textContent = tipoDocumentoInput.value ? '' : 'Seleccione un tipo de documento.';
    });

    numeroDocumentoInput.addEventListener('input', function () {
        const numeroDocumentoPattern = /^[0-9]+$/;
        if (numeroDocumentoInput.value.trim() === '') {
            numeroDocumentoError.textContent = 'El número de documento es requerido.';
        } else if (!numeroDocumentoPattern.test(numeroDocumentoInput.value)) {
            numeroDocumentoError.textContent = 'El número de documento solo puede contener números.';
        } else {
            numeroDocumentoError.textContent = '';
        }
    });

    numeroTelefonicoInput.addEventListener('input', function () {
        const numeroTelefonicoPattern = /^[0-9]+$/;
        if (numeroTelefonicoInput.value.trim() === '') {
            numeroTelefonicoError.textContent = 'El número telefónico es requerido.';
        } else if (!numeroTelefonicoPattern.test(numeroTelefonicoInput.value)) {
            numeroTelefonicoError.textContent = 'El número telefónico solo puede contener números.';
        } else {
            numeroTelefonicoError.textContent = '';
        }
    });

   
});
