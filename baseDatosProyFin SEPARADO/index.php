<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/stylesMenu.css">
    <title>ABC</title>
</head>
   <!-- 
 <body>
    <div class="container">
        <legend>MENU</legend>
        <button onclick="document.location='altas.php'">alta de registro</button>
        <button onclick="document.location='bajas.php'">baja de registro</button>
        <button onclick="document.location='modif.php'">modificación de registro</button>
        <button onclick="document.location='consultas.php'">consulta</button>
    </div>
</body>
-->

<nav class="menu">
   <input type="checkbox" href="#" class="menu-open" name="menu-open" id="menu-open" />
   <label class="menu-open-button" for="menu-open">
    <span class="lines line-1"></span>
    <span class="lines line-2"></span>
    <span class="lines line-3"></span>
  </label>

   <a href="altas.php" class="menu-item colores"> ALTAS </a>
   <a href="bajas.php" class="menu-item colores"> BAJAS </a>
   <a href="modif.php" class="menu-item colores"> CAMBIOS </a>
   <a href="consultas.php" class="menu-item colores"> CONSULTAS </a>
</nav>

</html>
