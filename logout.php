<?php


session_start();


$_SESSION["acceso"]=false;
$_SESSION['usuario']="";
session_destroy();

# Finalmente lo redireccionamos al formulario
header("Location: loginForm.php");
?>
