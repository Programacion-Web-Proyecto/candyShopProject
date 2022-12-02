<?php
    error_reporting(E_ERROR);
    include "navbar.php";
    date_default_timezone_set('America/Mexico_City');
    echo "Ultima actualizacion: " . date("F d Y H:i:s.", filemtime(__FILE__));
    include "contacto.html";
    include "html/footer.html";

?>
