<link rel="stylesheet" href="css/style2.css">
<?php

# Iniciar sesión para usar $_SESSION
session_start();

date_default_timezone_set('America/Mexico_City'); 
$bienvenida="";
if (date("G")>5 && date("G")<12){
    $bienvenida="Buenos dias! ". $_SESSION["usuario"]; 
}elseif (date("G")>=12 &&date("G")<18){
    $bienvenida="Buenas tardes! <br> ". $_SESSION["usuario"]; 
}else{
    $bienvenida="Buenas noches!  <br>". $_SESSION["usuario"]; 
}

echo '<li class="nav-item  " style="text-align: left; color: #fff; font-size:20px; padding-right: 100px;">'.$bienvenida. '</li>';
?>