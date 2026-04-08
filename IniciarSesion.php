<?php 
require_once("Controlador/config.php"); 
require_once("Controlador/clases/cuenta.php");
require_once("Controlador/clases/MensajesConstantes.php"); 
require_once("Controlador/clases/LimpiarForm.php"); 

$account = new Cuenta($con);

if(isset($_POST["submitButton"])) {

  $username = LimpiarForm::sanitizeFormUsername($_POST["username"]);
  $password = LimpiarForm::sanitizeFormPassword($_POST["password"]);

  $wasSuccessful = $account->login($username, $password);
  
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
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>UCVTube</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
<div>
<div class="signInContainer">
  <div class="column">
    <div class="header">
      <img src="assets/img/icons/UCVTubeLogo.png" title="Logo" alt="Site logo">
      <h3>Inciar Sesion</h3>

    </div>
    <div class="loginForm">

      <form action="IniciarSesion.php" method="POST">
        <?php echo $account->getError(Constants::$loginFailed); ?>
        <input type="text" name="username" placeholder="Username" value="<?php getInputValue('username'); ?>" required autocomplete="off">
        <input type="password" name="password" placeholder="Contraseña" required>
        <input type="submit" name="submitButton" value="Iniciar">
      
      </form>

    </div>
    <a class="signInMessage" href="Registrarse.php">Aún no tines cuenta? Registrese aquí.</a>
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