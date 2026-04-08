<?php 
require_once("Controlador/header.php"); 
require_once("Controlador/clases/detallesVideo.php"); 
?>

<div class="column">
  <?php
    $formProvider = new detallesVideo($con);
    echo $formProvider->createUploadForm();
  ?>
</div>


<script>
  $("form").submit(function() {
    $("#loadingModal").modal("show");
  });
</script>


<div class="modal fade" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="loadingModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">      
      <div class="modal-body">
       Espere por favor. Esto podría tomar un tiempo.
        <img src="assets/img/icons/loading-spinner.gif">
      </div>
    </div>
  </div>
</div>


      
<?php require_once("Controlador/footer.php"); ?>
