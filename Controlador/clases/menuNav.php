<?php
class menuNav {

  private $con, $userLoggedInObj;

  public function __construct($con, $userLoggedInObj) {
    $this->con = $con;
    $this->userLoggedInObj = $userLoggedInObj;
  }

  public function create() {
    $menuHtml = $this->createNavItem("Inicio", "assets/img/icons/home.png", "index.php");
    $menuHtml .= $this->createNavItem("Tendencias", "assets/img/icons/trending.png", "trending.php");
    $menuHtml .= $this->createNavItem("Suscripciones", "assets/img/icons/subscriptions.png", "subscriptions.php");
    $menuHtml .= $this->createNavItem("Videos que me gustan", "assets/img/icons/thumb-up.png", "likedVideos.php");

    if(usuario::isLoggedIn()) {
      $menuHtml .= $this->createNavItem("Ajustes", "assets/img/icons/settings.png", "settings.php");
      $menuHtml .= $this->createNavItem("Salir", "assets/img/icons/logout.png", "logout.php");

      $menuHtml .= $this->createSubscriptionsSection();
    }

    return "<div class='navigationItems'>
              $menuHtml
            </div>";
  }

  private function createNavItem($text, $icon, $link) {
    return "<div class='navigationItem'>
              <a href='$link'>
                <img src='$icon'>
                <span>$text</span>
              </a>
            </div>";
  }

  private function createSubscriptionsSection() {
    $subscriptions = $this->userLoggedInObj->getSubscriptions();

    $html = "<span class='heading'>Suscripciones</span>";
    foreach($subscriptions as $sub) {
      $subUsername = $sub->getUsername();
        $html .= $this->createNavItem($subUsername, $sub->getProfilePic(), "perfil.php?username=$subUsername");
    }
    return $html;
  }
}

?>