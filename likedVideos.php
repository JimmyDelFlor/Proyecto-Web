<?php
require_once("Controlador/header.php");
require_once("Controlador/clases/LikedVideosProvider.php");

if(!usuario::isLoggedIn()) {
  header("Location: IniciarSesion.php");
}

$likedVideosProvider = new LikedVideosProvider($con, $userLoggedInObj);

$videos = $likedVideosProvider->getVideos();

$videoGrid = new MostrarVideo($con, $userLoggedInObj);
?>

<div class="largeVideoGridContainer">
  <?php
  if(sizeof($videos) > 0) {
    echo $videoGrid->createLarge($videos, "Vídeos que te gustan", false);
  } else {
    echo "No hay vídeos para mostrar";
  }
  ?>
</div>

<?php
require_once("Controlador/footer.php"); 
?>