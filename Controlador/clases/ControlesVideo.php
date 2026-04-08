<?php 
require_once("Controlador/clases/InfoVideo.php"); 
class ControlesVideo {
  private $video, $userLoggedInObj;
  // Takes an object of the Video class in Video.php
  public function __construct($video, $userLoggedInObj) {
    $this->video = $video;
    $this->userLoggedInObj = $userLoggedInObj;
  }

  public function create() {
    $likeButton = $this->createLikeButton();
    $dislikeButton = $this->createDislikeButton();

    return "<div class='controls'>
              $likeButton
              $dislikeButton
            </div>";
  }

  private function createLikeButton() {
    $text = $this->video->getLikes();
    $videoId = $this->video->getId();
    $action = "likeVideo(this, $videoId)";
    $class = "likeButton";
    $imageSrc = "assets/img/icons/thumb-up.png";
    
    if($this->video->wasLikedBy()) {
      $imageSrc = "assets/img/icons/thumb-up-active.png";
    }
    return botones::createButton($text, $imageSrc, $action, $class);
  }

  private function createDislikeButton() {
    $text = $this->video->getDislikes();
    $videoId = $this->video->getId();
    $action = "dislikeVideo(this, $videoId)";
    $class = "dislikeButton";
    $imageSrc = "assets/img/icons/thumb-down.png";
    
    if($this->video->wasDislikedBy()) {
      $imageSrc = "assets/img/icons/thumb-down-active.png";
    }

    return botones::createButton($text, $imageSrc, $action, $class);
  }
}

?>