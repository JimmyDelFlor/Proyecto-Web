function validarFormulario() {
    var correoInput = document.getElementById("email");
    var correo = correoInput.value;

    // Expresión regular para verificar el formato del correo electrónico
    var regexCorreo = /^[^\s@]+@[^\s@]+\.ucvvirtual\.edu\.pe$/;


    // Verifica si el correo electrónico coincide con la expresión regular
    if (!regexCorreo.test(correo)) {
        echo("Por favor, ingresa un correo electrónico válido.");
        correoInput.focus();
        return false; // Evita que se envíe el formulario
    }
   

    return true; // Permite enviar el formulario si la validación pasa
}

