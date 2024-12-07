// public/assets/nombre.js

document.addEventListener('DOMContentLoaded', function() {
    var createNameInput = document.getElementById('name');
    var createNameError = document.getElementById('nameError');
    var editNameInput = document.getElementById('edit_name');
    var editNameError = document.getElementById('editNameError');
    var editName2Input = document.getElementById('edit_name2');
    var editName2Error = document.getElementById('editName2Error');

    createNameInput.addEventListener('input', function() {
        validateName(this.value.trim(), createNameError);
    });

    editNameInput.addEventListener('input', function() {
        validateName2(this.value.trim(), editNameError);
    });
    editName2Input.addEventListener('input', function() {
        validateName2(this.value.trim(), editName2Error);
    });

    function validateName(value, errorElement) {
        var regex = /^[a-zA-Z0-9\s]*$/;

        if (!regex.test(value)) {
            errorElement.textContent = 'El nombre solo puede contener letras, números y espacios.';
        } else {
            errorElement.textContent = '';
        }
    }

    function validateName2(value, errorElement) {
        var regex = /^[a-zA-Z0-9\s]*$/;

        if (!regex.test(value)) {
            errorElement.textContent = 'El nombre solo puede contener letras, números y espacios.';
        } else {
            errorElement.textContent = '';
        }
    }
});
