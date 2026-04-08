<?php 
// Iniciar la sesión (si aún no se ha iniciado)
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['userLoggedIn'])) {
    // Si el usuario no ha iniciado sesión, redirigirlo a la página de inicio de sesión
    header("Location: IniciarSesion.php"); // Cambia "login.php" al archivo de inicio de sesión de tu aplicación
    exit(); // Asegúrate de que el script se detenga después de la redirección
}
require_once("Controlador/header.php"); 
?>

<div class="videoSection">
  <?php

  $subscriptionsProvider = new sqlSuscrip($con, $userLoggedInObj);
  $subscriptionVideos = $subscriptionsProvider->getVideos();

  $videoGrid = new MostrarVideo($con, $userLoggedInObj->getUsername());

  if(usuario::isLoggedIn() && sizeof($subscriptionVideos) > 0) {
    echo $videoGrid->create($subscriptionVideos, "Suscripciones", false);
  }

  echo $videoGrid->create(null, "Recomendados", false);

  ?>
</div>

<?php require_once("Controlador/footer.php"); ?>
