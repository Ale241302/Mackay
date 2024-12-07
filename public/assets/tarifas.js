// public/assets/nombre.js

document.addEventListener('DOMContentLoaded', function() {
    var createNameInput = document.getElementById('nombre');
    var createNameError = document.getElementById('nameError');
    var editNameInput = document.getElementById('edit_name');
    var editNameError = document.getElementById('editNameError');
    var editName2Input = document.getElementById('edit_name2');
    var editName2Error = document.getElementById('editName2Error');
    var porcentajeInput = document.getElementById('porcentaje');
    var porcentajeError = document.getElementById('porcentajeError');

    createNameInput.addEventListener('input', function() {
        validateName2(this.value.trim(), createNameError);
    });

    editNameInput.addEventListener('input', function() {
        validateName2(this.value.trim(), editNameError);
    });
    editName2Input.addEventListener('input', function() {
        validateName2(this.value.trim(), editName2Error);
    });
    porcentajeInput.addEventListener('input', function() {
        validatePorcentaje(this.value.trim(), porcentajeError);
    });

    
    function validateName2(value, errorElement) {
        // Permitir letras, números, espacios, comas y el símbolo de porcentaje
        var regex = /^[a-zA-Z0-9\s,%]*$/;
    
        if (!regex.test(value)) {
            errorElement.textContent = 'El nombre solo puede contener letras, números, espacios, comas y el símbolo de porcentaje.';
        } else {
            errorElement.textContent = '';
        }
    }
    
    function validatePorcentaje(value, errorElement) {
        // Permitir números con coma como separador decimal
        var regex = /^[0-9]+(,[0-9]{1,2})?$/;

        if (!regex.test(value)) {
            errorElement.textContent = 'El porcentaje debe ser un número válido con hasta 2 decimales, usando solo coma como separador decimal.';
        } else {
            errorElement.textContent = '';
        }
    }
});
