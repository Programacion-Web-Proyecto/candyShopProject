<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CARRITO DE COMPRA</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/stylesCarrito.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico" />

</head>
<script src="https://kit.fontawesome.com/b5e2972857.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<?php

include 'navbar.php';
$servidor = 'localhost:3307';
// $servidor = 'localhost:33065';
$cuenta = 'root';
$password = '';
$bd = 'tienda2';
$conexion = new mysqli($servidor, $cuenta, $password, $bd);
if ($conexion->connect_errno) {
    die('Error en la conexion');
} else {
    if (isset($_POST['quitarCarrito'])) {
        $i = $_POST['quitarCarrito'];
        unset($_SESSION['carrito'][$i]);
        $aux = array_values($_SESSION['carrito']);
        unset($_SESSION['carrito']);
        $_SESSION['carrito'] = array_values($aux);
    } elseif (isset($_POST['resta'])) {
        $i = $_POST['cual'];
        $_SESSION['carrito'][$i][2]--;
        if ($_SESSION['carrito'][$i][2] < 1) {
            unset($_SESSION['carrito'][$i]);
            $aux = array_values($_SESSION['carrito']);
            unset($_SESSION['carrito']);
            $_SESSION['carrito'] = array_values($aux);
        }
    } elseif (isset($_POST['suma'])) {
        $cual = $_POST['cual'];
        $id = $_POST['id'];
        $sql = "SELECT existencia FROM productos WHERE idProducto='" . $id . "';";
        $resultado = $conexion->query($sql);
        $suma = 0;
        for ($i = 0; $i < count($_SESSION['carrito']); $i++) {
            if ($_SESSION['carrito'][$i][0] == $id) $suma += $_SESSION['carrito'][$i][2];
        }
        if ($fila = $resultado->fetch_assoc()) {
            //para que la cantidad de compra del producto no sobrepase la existencia del mismo
            if ($suma < $fila['existencia']) $_SESSION['carrito'][$cual][2]++;
        }
    }
?>
<?php
    echo "<div class=\"container1\">";
    echo "<legend>Elementos en el carrito</legend>";
    if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
        echo "<div class=\"consulta\">";
        $totalPagar = 0;
        $sql = "SELECT * FROM productos";
        for ($i = 0; $i < count($_SESSION['carrito']); $i++) {
            $sql = "SELECT * FROM productos WHERE idProducto=" . $_SESSION['carrito'][$i][0];
            $resultado = $conexion->query($sql);
            if ($fila = $resultado->fetch_assoc()) {
                echo "<div class=\"producto\">";
                echo "<form class=\"formProd\" action=\"" . htmlspecialchars($_SERVER["PHP_SELF"]) . "\" method=\"post\">";
                echo "<input type=\"hidden\" name=\"quitarCarrito\" value=\"" . $i . "\">";
                echo "<button type=\"submit\" class=\"quitar tooltip1000\"><i class=\"fa-regular fa-trash-can\"><span class=\"tooltiptext1000\">Quitar del carrito</span></i></button></form>";
                echo "<img class=\"imgProd\" src=\"images/" . $fila['archIMG'] . "\" alt=\"" . $fila['nombreProducto'] . "\">";
                echo "<table>";
                echo "<tr><td><span class=\"titulo " . "\">Nombre: </span><span class=\"conten\">" . $fila['nombreProducto'] . "</span></tr></td>";
                echo "<tr><td><span class=\"titulo " . "\">Descripción: </span><span class=\"conten\">" . $fila['descripcion'] . "</span></tr></td>";
                if ($_SESSION['carrito'][$i][1]) {
                    echo "<tr><td><span class=\"noOferta\">Precio: $" . $fila['precio'] . "</span></td></tr>";
                    echo "<tr><td><span class=\"oferta\">Oferta: </span><span class=\"conten\">$" . $_SESSION['carrito'][$i][1] . "</span></td></tr>";
                } else
                    echo "<tr><td><span class=\"titulo " . "\">Precio: </span><span class=\"conten\">$" . $fila['precio'] . "</span></tr></td>";
                echo "<tr><td><span class=\"titulo " . "\">Existencia: </span><span class=\"conten\">" . $fila['existencia'] . "</span></tr></td>";
                echo "<tr><td><span class=\"titulo " . "\">Cantidad </span>
                <form class=\"formProd\" action=\"" . htmlspecialchars($_SERVER["PHP_SELF"]) . "\" method=\"post\">
                <button class=\"sumres\" type=\"submit\" name=\"resta\">-</button>
                <input type=\"hidden\" name=\"cual\" value=\"" . $i . "\">
                <input type=\"hidden\" name=\"id\" value=\"" . $_SESSION['carrito'][$i][0] . "\">
                <span class=\"conten\">" . $_SESSION['carrito'][$i][2] . "</span>
                <button class=\"sumres\" type=\"submit\" name=\"suma\">+</button>
                </form></tr></td>";
                echo "</table></div>";
                if ($_SESSION['carrito'][$i][1])
                    $totalPagar += ($_SESSION['carrito'][$i][2] * $_SESSION['carrito'][$i][1]);
                else
                    $totalPagar += ($_SESSION['carrito'][$i][2] * $fila['precio']);
            }
        }
        echo "</div>";
        echo "<div class=\"compra\">
        <label class=\"totPagar\">TOTAL A PAGAR: $" . $totalPagar . "</label>
        <form action=\"realizarCompra.php\" method=\"post\">
        <input type=\"hidden\" name=\"totPagar\" value=\"" . $totalPagar . "\">";
        echo "<input type=\"submit\" value=\"Realizar compra\" class=\"btn btn-danger btn-lg\" name=\"realizarCompra\">";
        echo "</form></div>";
    } else {
        echo "<legend style=\"color: gray; text-align:center; background-color: #151515\"><i class=\"fa-solid fa-triangle-exclamation\" style=\"font-size:350px;\"></i><br>Carrito vacío</legend>";
    }
    echo "</div>";
}
include 'html/footer.html';

?>

<body>
</body>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>

</html>