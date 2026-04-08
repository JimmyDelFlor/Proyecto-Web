<?php 
require_once("botones.php"); 
class ControlesComen {

  private $con, $comment, $userLoggedInObj;

  public function __construct($con, $comment, $userLoggedInObj) {
    $this->con = $con;
    $this->comment = $comment;
    $this->userLoggedInObj = $userLoggedInObj;
  }

  public function create() {

    $replyButton = $this->createReplyButton();
    $likesCount = $this->createLikesCount();
    $likeButton = $this->createLikeButton();
    $dislikeButton = $this->createDislikeButton();
    $replySection = $this->createReplySection();

    return "<div class='controls'>
              $replyButton 
              $likesCount
              $likeButton
              $dislikeButton
            </div>
            $replySection";
  }

  private function createReplyButton() {
    $text = "RESPONDER";
    $action = "toggleReply(this)";
    return botones::createButton($text, null, $action, null);
  }

  private function createLikesCount() {
    $text = $this->comment->getLikes();

    if($text == 0) $text = "";
    return "<span class='likesCount'>$text</span>";
  }

  private function createReplySection() {
    $postedBy = $this->userLoggedInObj->getUsername();
    $videoId = $this->comment->getVideoId();
    $commentId = $this->comment->getId();

    $profileButton = botones::createUserProfileButton($this->con, $postedBy);

    $cancelButtonAction = "toggleReply(this)";
    $cancelButton = botones::createButton("CANCELAR", null, $cancelButtonAction, "cancelComment");

    $postButtonAction = "postComment(this, \"$postedBy\", $videoId, $commentId, \"repliesSection\")";
    $postButton = botones::createButton("RESPONDER", null, $postButtonAction, "postComment");


    return " <div class='commentForm hidden'>
                $profileButton
                
                <textarea class='commentBodyClass' placeholder='Escribe una respuesta'></textarea>
                $cancelButton
                $postButton
              </div>";
  }

  private function createLikeButton() {
    $commentId = $this->comment->getId();
    $videoId = $this->comment->getVideoId();
    $action = "likeComment($commentId, this, $videoId)";
    $class = "likeButton";
    $imageSrc = "assets/img/icons/thumb-up.png";
    
    if($this->comment->wasLikedBy()) {
      $imageSrc = "assets/img/icons/thumb-up-active.png";
    }
    return botones::createButton("", $imageSrc, $action, $class);
  }

  private function createDislikeButton() {
    $commentId = $this->comment->getId();
    $videoId = $this->comment->getVideoId();
    $action = "dislikeComment($commentId, this, $videoId)";
    $class = "dislikeButton";
    $imageSrc = "assets/img/icons/thumb-down.png";
    
    if($this->comment->wasDislikedBy()) {
      $imageSrc = "assets/img/icons/thumb-down-active.png";
    }

    return botones::createButton("", $imageSrc, $action, $class);
  }
}

?>