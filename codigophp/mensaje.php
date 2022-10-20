<?php
//Archivo que muestra el mensaje que se captura en $_SESSION haciendo uso de Bootstrap
if(isset($_SESSION["mensaje"])) :
 ?>

 <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <?= $_SESSION["mensaje"]; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
 </div>

<?php
unset($_SESSION["mensaje"]);
endif
 ?>