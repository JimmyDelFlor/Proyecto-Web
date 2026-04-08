<?php 
require_once("Controlador/header.php");  
require_once("Controlador/clases/Reproductor.php"); 
require_once("Controlador/clases/InfoVideo.php"); 
require_once("Controlador/clases/Comentario.php"); 
require_once("Controlador/clases/SeccionComent.php");

if(!isset($_GET["id"])) {
  echo "Page not found";
  exit();
}

$video = new Video($con, $_GET["id"], $userLoggedInObj);
$video->incrementViews();
?>

<script src="assets/js/videoPlayerActions.js"></script>
<script src="assets/js/accionesComen.js"></script>

<div class="watchLeftColumn">

  <?php 
    $videoPlayer = new Reproductor($video);
    echo $videoPlayer->create(true);

    $videoInfo = new InfoVideo ($con, $video, $userLoggedInObj);
    echo $videoInfo->create();

    $commentSection = new SeccionComment($con, $video, $userLoggedInObj);
    echo $commentSection->create();
  ?>

</div>

<div class="suggestions">
  <?php
  $videoGrid = new MostrarVideo($con, $userLoggedInObj);
  echo $videoGrid->create(null, null, false);
  ?>
</div>
  
<?php require_once("Controlador/footer.php"); ?>
