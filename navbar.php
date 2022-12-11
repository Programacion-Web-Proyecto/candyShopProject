<head>
  <link rel="stylesheet" href="css/style1.css" />
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" /> -->

  <script src="https://kit.fontawesome.com/5d84975004.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">


</head>
<?php
error_reporting(E_ERROR);
session_start(); //para poder hacer uso de las varaibles sesion 
$contCarrito = isset($_SESSION['carrito']) ? count($_SESSION['carrito']) : 0;
?>

<body>
  <nav class="navbar navbar-expand-lg sticky-top navprin" style="background: #6C0000;">

    <a class="navbar-brand aNav" href=""><img style="width: 50px;" src="media/logo.jpeg" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span><i class="fa-solid fa-bars" style="color: #fff;"></i></span>
    </button>

    <div class="collapse navbar-collapse colorNav" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto colorNav">
        <li class="nav-item ">
          <a class="nav-link" href="index.php">INICIO</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="consultas.php">TIENDA</a>
        </li>
        <div class="carritoIcon">
          <i class="fa-solid fa-cart-shopping" onclick="document.location='carrito.php'" id="carritoIcon"></i>
          <div class="numeroElementos">
            <?php echo $contCarrito ?>
          </div>
        </div>
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
          // echo '<li class="nav-item"><a class="nav-link" href="#">INFORMACION USUARIOS</a></li>';
          echo '<li class="nav-item"><a class="nav-link" href="menuAdmin.php">ADMIN</a></li>';
        }
        if (!($_SESSION["acceso"])) {

          echo '<li class="nav-item"><a class="nav-link" href="loginForm.php">MI CUENTA</a></li>';
        } else {
          echo '<li class="nav-item "><a class="nav-link" href="logout.php"> <i class="fa-sharp fa-solid fa-right-from-bracket" style="color:#fff;"></i> CERRAR SESION</a></li>';
        }
        ?>
      </ul>
        <?php
        if (($_SESSION["acceso"])) {
          include "saludo.php";
        }
        ?>
      <!-- <form class="form-inline my-2 my-lg-0">
      </form> -->
    </div>
  </nav>
</body>