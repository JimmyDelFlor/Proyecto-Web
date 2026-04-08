<?php 
require_once("Controlador/header.php");
require_once("Controlador/clases/SubirVideo.php");
require_once("Controlador/clases/ProcesoSubida.php");

if(!isset($_POST["uploadButton"])) {
    echo "Ningún archivo por subir";
    exit();
}

// Debug: mostrar datos de entrada cuando se necesite
// echo "<pre>";
// var_dump(
//     [
//         'POST' => $_POST,
//         'FILES' => $_FILES
//     ]
// );
// echo "</pre>";

$videoUploadData = new SubirVideo(
    $_FILES["fileInput"], 
    $_POST["titleInput"],
    $_POST["descriptionInput"],
    $_POST["privacyInput"],
    $_POST["categoryInput"],
    $userLoggedInObj->getUsername()   
);

$videoProcessor = new ProcesoSubida($con);
$wasSuccessful = $videoProcessor->upload($videoUploadData);

if($wasSuccessful) {
    echo "Se subio exitosamente";
}
?>