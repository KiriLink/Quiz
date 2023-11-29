document.getElementById('email_txt').addEventListener('blur', function() {
    var emailInput = this.value;
    var allowedDomains = ['outlook.com', 'gmail.com', 'gmail.cl', 'hotmail.com', 'alumnos.santotomas.cl'];
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
        document.getElementById('email-error').textContent = ' El dominio de correo electrónico no es válido';
        this.setCustomValidity('El dominio de correo electrónico no es válido');
    }
});


