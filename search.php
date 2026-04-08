<?php
require_once("Controlador/header.php");
require_once("Controlador/clases/SearchResultsProvider.php");

if(!isset($_GET["term"]) || $_GET["term"] == "") {
  echo "Debes ingresar un término de búsqueda";
  exit();
}

$term = $_GET["term"];

if(!isset($_GET["orderBy"]) || $_GET["orderBy"] == "views") {
  $orderBy = "views";
} else {
  $orderBy = "uploadDate";
}

$searchResultsProvider = new SearchResultsProvider($con, $userLoggedInObj);
$videos = $searchResultsProvider->getVideos($term, $orderBy);

$videoGrid = new MostrarVideo($con, $userLoggedInObj);
?>

<div class="largeVideoGridContainer">
  <?php

  if(sizeof($videos) > 0) {
    echo $videoGrid->createLarge($videos, sizeof($videos) . " resultados encontrados", true);
  } else {
    echo "No se han encontrado resultados";
  }

  ?>
</div>


<?php
require_once("Controlador/footer.php");
?>