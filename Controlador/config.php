<?php
  ob_start(); // Activa el almacenamiento en búfer de salida
  session_start();
  // Agrega tu zona horaria
  date_default_timezone_set('America/Lima'); // Cambia a la zona horaria de Lima, Perú

  try {
    // Agrega tu información de conexión
    $con = new PDO('mysql:host=localhost:3307;dbname=ucvtube', 'root', '');
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  } catch (PDOException $e) {
    echo "La conexión falló: " . $e->getMessage();
  }
?>
