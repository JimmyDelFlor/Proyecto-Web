<?php
require_once("Controlador/header.php");
require_once("Controlador/clases/VideoPlayer.php");
require_once("Controlador/clases/VideoDetailsFormProvider.php");
require_once("Controlador/clases/VideoUploadData.php");
require_once("Controlador/clases/SelectThumbnail.php");

if(!usuario::isLoggedIn()) {
  header("Location: IniciarSesion.php");
}

if(!isset($_GET["videoId"])) {
  echo "Video no seleccionado";
  exit();
}

$video = new video($con, $_GET["videoId"], $userLoggedInObj);
if($video->getUploadedBy() != $userLoggedInObj->getUsername()) {
  echo "¡No puedes editar un video que no subiste!";
  exit();
}

$detailsMessage = "";

if(isset($_POST["saveButton"])) {
  $videoData = new VideoUploadData(
    null,
    $_POST["titleInput"],
    $_POST["descriptionInput"],
    $_POST["privacyInput"],
    $_POST["categoryInput"],
    $userLoggedInObj->getUsername()
  );

  if($videoData->updateDetails($con, $video->getId())) {
    $detailsMessage = "<div class='alert alert-success'>
                            <strong>SUCCESS!</strong> ¡Datos actualizados exitosamente!
                        </div>";
                        
    $video = new video($con, $_GET["videoId"], $userLoggedInObj);
  }
  else {
      $detailsMessage = "<div class='alert alert-danger'>
                              <strong>ERROR!</strong> Something went wrong
                          </div>";
  }
}
?>
<script src="assets/js/editVideoActions.js"></script>
<div class="editVideoContainer column">
  <div class="message">
    <?php echo $detailsMessage; ?>
  </div>
  <div class="topSection">
    <?php
      $videoPlayer = new VideoPlayer($video);
      echo $videoPlayer->create(false);

      $selectThumbnail = new SelectThumbnail($con, $video);
      echo $selectThumbnail->create();
    ?>
  </div>
  <div class="bottomSection">
  <?php
    $formProvider = new VideoDetailsFormProvider($con);
    echo $formProvider->createEditDetailsForm($video);

  ?>
  </div>
</div>