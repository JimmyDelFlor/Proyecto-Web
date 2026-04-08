<?php

require_once("../Controlador/config.php");
require_once("../Controlador/clases/usuario.php");
require_once("../Controlador/clases/comentario.php");

if(isset($_POST['commentText']) && isset($_POST['postedBy']) && isset($_POST['videoId'])) {

  $userLoggedInObj = new usuario($con, $_SESSION["userLoggedIn"]);

  $query = $con->prepare("INSERT INTO comments(postedBy, videoId, responseTo, body) VALUES(:postedBy, :videoId, :responseTo, :body)");
  $query->bindParam(":postedBy", $postedBy);
  $query->bindParam(":videoId", $videoId);
  $query->bindParam(":responseTo", $responseTo); 
  $query->bindParam(":body", $commentText);

  $postedBy = $_POST['postedBy'];
  $videoId = $_POST['videoId'];
  $responseTo = isset($_POST['responseTo']) ? $_POST['responseTo'] : 0;
  $commentText = $_POST['commentText'];

  $query->execute();

  $newComment = new comentario($con, $con->lastInsertId(), $userLoggedInObj, $videoId);
  echo $newComment->create();
  
} else {
  echo "Faltan parámetros para publicar el comentario";
}

?>