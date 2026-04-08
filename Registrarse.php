<?php 
require_once("Controlador/config.php"); 
require_once("Controlador/clases/Cuenta.php");
require_once("Controlador/clases/MensajesConstantes.php"); 
require_once("Controlador/clases/LimpiarForm.php"); 

$account = new Cuenta($con);

if(isset($_POST["submitButton"])) {
    $firstName = LimpiarForm::sanitizeFormString($_POST["firstName"]);
    $lastName = LimpiarForm::sanitizeFormString($_POST["lastName"]);

    $username = LimpiarForm::sanitizeFormUsername($_POST["username"]);

    $email = LimpiarForm::sanitizeFormEmail($_POST["email"]);
    $email2 = LimpiarForm::sanitizeFormEmail($_POST["email2"]);

    $password = LimpiarForm::sanitizeFormPassword($_POST["password"]);
    $password2 = LimpiarForm::sanitizeFormPassword($_POST["password2"]);
    
    $wasSuccessful = $account->register($firstName, $lastName, $username, $email, $email2, $password, $password2);

    if($wasSuccessful) {
        $_SESSION["userLoggedIn"] = $username;
        header("Location: index.php");
    }
}

function getInputValue($name) {
    if(isset($_POST[$name])) {
        echo $_POST[$name];
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>UCVTUBE</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 

</head>
<body>

    <div class="signInContainer">

        <div class="column">

            <div class="header">
                <img src="assets/img/icons/UCVTubeLogo.png" title="logo" alt="Site logo">
                <h3>Registrese</h3>
                <span>para poder continuar</span>
            </div>

            <div class="loginForm">

            <form action="Registrarse.php" method="POST">
                    
                <?php echo $account->getError(Constants::$firstNameCharacters); ?>
                <input type="text" name="firstName" placeholder="Nombres" value="<?php getInputValue('firstName'); ?>" autocomplete="off" required>

                <?php echo $account->getError(Constants::$lastNameCharacters); ?>
                <input type="text" name="lastName" placeholder="Apellidos" autocomplete="off" value="<?php getInputValue('lastName'); ?>" required>

                <?php echo $account->getError(Constants::$usernameCharacters); ?>
                <?php echo $account->getError(Constants::$usernameTaken); ?>
                <input type="text" name="username" placeholder="Username" autocomplete="off" value="<?php getInputValue('username'); ?>" required>

                <?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
                <?php echo $account->getError(Constants::$emailInvalid); ?>
                <?php echo $account->getError(Constants::$emailTaken); ?>
                <input type="email" name="email" placeholder="Email" autocomplete="off" value="<?php getInputValue('email'); ?>" required>
                <input type="email" name="email2" placeholder="Confirmar email" autocomplete="off" value="<?php getInputValue('email2'); ?>" required>
                
                <?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>
                <?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
                <?php echo $account->getError(Constants::$passwordLength); ?>
                <input type="password" name="password" placeholder="Contraseña" autocomplete="off" required>
                <input type="password" name="password2" placeholder="Confirmar Contraseña" autocomplete="off" required>

                <input type="submit" name="submitButton" value="Registrar">

                
                </form>
            </div>
            <a class="signInMessage" href="IniciarSesion.php">Ya tienes una cuenta? Inicia Sesión aquí</a>       
        </div>    
    </div>
    <div class="burbujas">
        <div class="burbuja"></div>
        <div class="burbuja"></div>
        <div class="burbuja"></div>
        <div class="burbuja"></div>
        <div class="burbuja"></div>
        <div class="burbuja"></div>
        <div class="burbuja"></div>
        <div class="burbuja"></div>
        <div class="burbuja"></div>
        <div class="burbuja"></div>
    </div>
</body>
</html>