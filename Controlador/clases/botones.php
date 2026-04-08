<?php
class botones {
  public static $signInFunction = "notSignedIn()";

  public static function createLink($link) {
    return usuario::isLoggedIn() ? $link : botones::$signInFunction;
  }
  public static function createButton($text, $imageSrc, $action, $class) {
    $image = ($imageSrc == null) ? "" : "<img src='$imageSrc'>";
    $action = botones::createLink($action);
    return "<button class='$class' onclick='$action'>
              $image
              <span class='text'>$text</span>
            </button>";
  }

  public static function createHyperlinkButton($text, $imageSrc, $href, $class) {
    $image = ($imageSrc == null) ? "" : "<img src='$imageSrc'>";

    return "<a href='$href'>
              <button class='$class'>
                $image
                <span class='text'>$text</span>
              </button>
            </a>";
  }

  public static function createUserProfileButton($con, $username) {
    $userObj = new usuario($con, $username);
    $profilePic = $userObj->getProfilePic();
    $link = "perfil.php?username=$username";

    return "<a href='$link'>
              <img src='$profilePic' class='profilePicture'>
            </a>";
  }

  public static function createEditVideoButton($videoId) {
    $href = "editVideo.php?videoId=$videoId";
    $button = botones::createHyperlinkButton("EDITAR VIDEO", null, $href, "edit button");
    return "<div class='editVideoButtonContainer'>
              $button
            </div>";
  }

  public static function createSubscriberButton($con, $userToObj, $userLoggedInObj) {
    $userTo = $userToObj->getUsername();
    $userLoggedIn = $userLoggedInObj->getUsername();

    $isSubscribedTo = $userLoggedInObj->isSubscribedTo($userTo);
    $buttonText = $isSubscribedTo ? "SUSCRITO" : "SUSCRIBETE";
    $buttonText .= " " . $userToObj->getSubscriberCount();

    $buttonClass = $isSubscribedTo ? "unsubscribe button" : "subscribe button";
    $action = "subscribe(\"$userTo\", \"$userLoggedIn\", this)";

    $button = botones::createButton($buttonText, null, $action, $buttonClass);

    return "<div class='subscribeButtonContainer'>
              $button
            </div>";
  }
   
  public static function createUserProfileNavigationButton($con, $username) {
    if(usuario::isLoggedIn()) {
      return botones::createUserProfileButton($con, $username);
    } else {
      return "<a href='IniciarSesion.php'>
                <span class='signInLink'>Iniciar Sesión</span>
              </a>";
    }
  }
}
?>