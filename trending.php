<?php
require_once("Controlador/header.php"); 
require_once("Controlador/clases/TrendingProvider.php"); 

$trendingProvider = new TrendingProvider($con, $userLoggedInObj);

$videos = $trendingProvider->getVideos();

$videoGrid = new MostrarVideo($con, $userLoggedInObj);
?>

<div class="largeVideoGridContainer">
  <?php
  if(sizeof($videos) > 0) {
    echo $videoGrid->createLarge($videos, "Vídeos populares subidos de esta semana", false);
  } else {
    echo "No hay videos populares para mostrar";
  }
  ?>
</div>

<?php
require_once("Controlador/footer.php"); 
?>