<head>
  <link rel="stylesheet" href="css/style1.css" />

  <script src="https://kit.fontawesome.com/5d84975004.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">


</head>
<?php
error_reporting(E_ERROR);
session_start(); //para poder hacer uso de las varaibles sesion 
?>

<body>
  <nav class="navbar navbar-expand-lg sticky-top" style="background: #6C0000;">

    <a class="navbar-brand aNav" href=""><img style="width: 50px;" src="media/logo.jpeg" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span><i class="fa-solid fa-bars" style="color: #fff;"></i></span>
    </button>

    <div class="collapse navbar-collapse colorNav" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto colorNav">
        <li class="nav-item ">
          <a class="nav-link" href="index.php">INICIO</a>
        </li>
        <li class="nav-item dropdown ">
          <a class="dropdown-toggle" href="" role="button" data-toggle="dropdown" aria-expanded="false">
          <i class="fa-solid fa-cart-shopping"></i>
          </a>
          <div class="dropdown-menu submenu">
            <a class="dropdown-item" href="#">ACIDOS</a>
            <a class="dropdown-item" href="#">PICOSOS</a>
            <a class="dropdown-item" href="#">CHOCOLATES</a>

        </li>
        <li class="nav-item ">
          <a class="nav-link" href="acercaDe.php">ACERCA DE</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contacto.php">CONTACTO</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="ayuda.php">AYUDA</a>
        </li>
        <?php
        if (($_SESSION["acceso"]) && $_SESSION["admin"]) {
          echo '<li class="nav-item"><a class="nav-link" href="#">INFORMACION USUARIOS</a></li>';
        }
        if (!($_SESSION["acceso"])) {

          echo '<li class="nav-item"><a class="nav-link" href="loginForm.php">MI CUENTA</a></li>';
        } else {
          echo '<li class="nav-item "><a class="nav-link" href="logout.php"> <i class="fa-sharp fa-solid fa-right-from-bracket" style="color:#fff;"></i> CERRAR SESION</a></li>';
        }
        ?>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <?php
        if (($_SESSION["acceso"])) {
          include "saludo.php";
        }
        ?>
      </form>
    </div>
  </nav>
</body>