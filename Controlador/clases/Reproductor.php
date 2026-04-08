<?php 
class Reproductor {

  private $video;
  // Takes an object of the Video class in Video.php
  public function __construct($video) {
    $this->video = $video;
  }

  public function create($autoPlay) {
    if($autoPlay) {
      $autoPlay = "autoplay";
    } else {
      $autoPlay = "";
    }
    $filePath = $this->video->getFilePath();
    return "<video class='videoPlayer' controls $autoPlay>
              <source src='$filePath' type='video/mp4'>
              Tu navegador no soporta este tipo de vídeo.
            </video>";
  }

}
?>