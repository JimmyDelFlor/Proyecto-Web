<?php 
require_once("botones.php");
require_once("ControlesComen.php");
class comentario {

  private $con, $sqlData, $userLoggedInObj, $videoId;

  public function __construct($con, $input, $userLoggedInObj, $videoId) {
    

    if(!is_array($input)) {
      $query = $con->prepare("SELECT * FROM comments WHERE id=:id");
      $query->bindParam(":id", $input);
      $query->execute();

      $input = $query->fetch(PDO::FETCH_ASSOC);
    }
    
    $this->sqlData = $input;
    $this->con = $con;
    $this->userLoggedInObj = $userLoggedInObj;
    $this->videoId = $videoId;
  }

  public function create() {
    $id = $this->sqlData["id"];
    $videoId = $this->getVideoId();
    $body = $this->sqlData["body"];
    $postedBy = $this->sqlData["postedBy"];
    $profileButton = botones::createUserProfileButton($this->con, $postedBy);
    $timespan = $this->time_elapsed_string($this->sqlData["datePosted"]);

    $commentControlsObj = new ControlesComen($this->con, $this, $this->userLoggedInObj);
    $commentControls = $commentControlsObj->create();

    $numResponses = $this->getNumberOfReplies();

    if($numResponses > 0) {
      $viewRepliesText = "<span class='repliesSection viewReplies' onClick='getReplies($id, this, $videoId)'>
      Ver las $numResponses respuestas</span>";
    }
    else {
      $viewRepliesText = "<div class='repliesSection'></div>";
    }

    return "<div class='itemContainer'>
              <div class='comment'>
                $profileButton

                <div class='mainContainer'>
                  <div class='commentHeader'>
                    <a href='perfil.php?username=$postedBy'>
                      <span class='username'>$postedBy</span>
                    </a>
                    <span class='timestamp'>$timespan</span>
                  </div>

                  <div class='body'>
                    $body
                  </div>
                </div>

              </div>     
              $commentControls  
              $viewRepliesText  
            </div>";
  }

  public function getNumberOfReplies() {
    $query = $this->con->prepare("SELECT count(*) FROM comments WHERE responseTo=:responseTo");
    $query->bindParam(":responseTo", $id);
    $id = $this->sqlData["id"];
    $query->execute();

    return $query->fetchColumn();
  }

  function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'año',
        'm' => 'mes',
        'w' => 'semana',
        'd' => 'día',
        'h' => 'hora',
        'i' => 'minuto',
        's' => 'segundo',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? ($v == 'mes' ? 'es' : 's') : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? 'hace ' . implode(', ', $string) : 'justo ahora';
}

  public function getId() { 
    return $this->sqlData["id"];
  }

  public function getVideoId() { 
    return $this->videoId;
  }

  public function wasLikedBy() {
    $query = $this->con->prepare("SELECT * FROM likes WHERE username=:username AND commentId=:commentId");
    $query->bindParam(":username", $username);
    $query->bindParam(":commentId", $id);

    $id = $this->getId();

    $username = $this->userLoggedInObj->getUsername();
    $query->execute();

    return $query->rowCount() > 0;
  }

  public function wasDislikedBy() {
    $query = $this->con->prepare("SELECT * FROM dislikes WHERE username=:username AND commentId=:commentId");
    $query->bindParam(":username", $username);
    $query->bindParam(":commentId", $id);

    $id = $this->getId();

    $username = $this->userLoggedInObj->getUsername();
    $query->execute();

    return $query->rowCount() > 0;
  }

  public function getLikes() {
    $query = $this->con->prepare("SELECT count(*) as 'count' FROM likes WHERE commentId=:commentId");
    $query->bindParam(":commentId", $commentId);
    $commentId = $this->getId();
    $query->execute();

    $data = $query->fetch(PDO::FETCH_ASSOC);
    $numLikes = $data["count"];

    $query = $this->con->prepare("SELECT count(*) as 'count' FROM dislikes WHERE commentId=:commentId");
    $query->bindParam(":commentId", $commentId);
    $query->execute();

    $data = $query->fetch(PDO::FETCH_ASSOC);
    $numDisikes = $data["count"];

    return $numLikes - $numDisikes;
  }

  public function like() {
    $id = $this->getId();
    $username = $this->userLoggedInObj->getUsername();

    // Check if User has already liked this video
    if($this->wasLikedBy()) {
      $query = $this->con->prepare("DELETE FROM likes WHERE username=:username AND commentId=:commentId");
      $query->bindParam(":username", $username);
      $query->bindParam(":commentId", $id);
      $query->execute();

      return -1;

    } 
    else {
      $query = $this->con->prepare("DELETE FROM dislikes WHERE username=:username AND commentId=:commentId");
      $query->bindParam(":username", $username);
      $query->bindParam(":commentId", $id);
      $query->execute();
      $count = $query->rowCount();


      $query = $this->con->prepare("INSERT INTO likes(username, commentId) VALUES(:username, :commentId)");
      $query->bindParam(":username", $username);
      $query->bindParam(":commentId", $id);
      $query->execute();

      return 1 + $count;
    }
  }

  public function dislike() {
    $id = $this->getId();
    $username = $this->userLoggedInObj->getUsername();

    if($this->wasDislikedBy()) {
      $query = $this->con->prepare("DELETE FROM dislikes WHERE username=:username AND commentId=:commentId");
      $query->bindParam(":username", $username);
      $query->bindParam(":commentId", $id);
      $query->execute();

      return 1;
    } 
    else {
      $query = $this->con->prepare("DELETE FROM likes WHERE username=:username AND commentId=:commentId");
      $query->bindParam(":username", $username);
      $query->bindParam(":commentId", $id);
      $query->execute();
      $count = $query->rowCount();

      $query = $this->con->prepare("INSERT INTO dislikes(username, commentId) VALUES(:username, :commentId)");
      $query->bindParam(":username", $username);
      $query->bindParam(":commentId", $id);
      $query->execute();

      return -1 - $count;
    }
  }

  public function getReplies() {
    $query = $this->con->prepare("SELECT * FROM comments WHERE responseTo=:commentId ORDER BY datePosted ASC");
    $query->bindParam(":commentId", $id);

    $id = $this->getId();

    $query->execute();

    $comments = "";

    $videoId = $this->getVideoId();

    while($row = $query->fetch(PDO::FETCH_ASSOC)) {
      $comment = new comentario($this->con, $row, $this->userLoggedInObj, $videoId);
      $comments .= $comment->create();
    }

    return $comments;
  }
}
?>