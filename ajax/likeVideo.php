<?php
require_once("../Controlador/config.php"); 
require_once("../Controlador/clases/video.php"); 
require_once("../Controlador/clases/usuario.php"); 

$username = $_SESSION["userLoggedIn"];
$videoId = $_POST["videoId"];

$userLoggedInObj = new usuario($con, $username);
$video = new video($con, $videoId, $userLoggedInObj);

echo $video->like();

?>