document.getElementById('logemail').addEventListener('blur', function() {
    var emailInput = this.value;
    var allowedDomains = ['santotomas.cl', 'alumnos.santotomas.cl'];
    var validDomain = false;

    for (var i = 0; i < allowedDomains.length; i++) {
        if (emailInput.endsWith('@' + allowedDomains[i])) {
            validDomain = true;
            break;
        }
    }

    if (validDomain) {
        document.getElementById('email-error').textContent = '';
        this.setCustomValidity('');
    } else {
        document.getElementById('email-error').textContent = ' Solo se puede ingresar con su correo de Santo Tomas';
        this.setCustomValidity('Solo se puede ingresar con su correo de Santo Tomas');
    }
});
