<?php
require_once("../Controlador/config.php"); 
require_once("../Controlador/clases/comentario.php"); 
require_once("../Controlador/clases/usuario.php"); 

$username = $_SESSION["userLoggedIn"];
$videoId = $_POST["videoId"];
$commentId = $_POST["commentId"];

$userLoggedInObj = new usuario($con, $username);
$comment = new comentario($con, $commentId, $userLoggedInObj, $videoId);

echo $comment->dislike();

?>