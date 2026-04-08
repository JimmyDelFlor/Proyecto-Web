<?php
require_once("Controlador/header.php");

if(!usuario::isLoggedIn()) {
  header("Location: IniciarSesion.php");
}

$subscriptionsProvider = new SubscriptionsProvider($con, $userLoggedInObj);

$videos = $subscriptionsProvider->getVideos();

$videoGrid = new MostrarVideo($con, $userLoggedInObj);
?>

<div class="largeVideoGridContainer">
  <?php
  if(sizeof($videos) > 0) {
    echo $videoGrid->createLarge($videos, "Nuevo de tus suscripciones", false);
  } else {
    echo "Ningún video para mostrar";
  }
  ?>
</div>

<?php
require_once("Controlador/footer.php"); 
?>