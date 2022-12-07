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
    <link rel="stylesheet" href="css/stylesCarrito.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<?php
$servidor = 'localhost:3307';
$cuenta = 'root';
$password = '';
$bd = 'tienda2';
$conexion = new mysqli($servidor, $cuenta, $password, $bd);
if ($conexion->connect_errno) {
    die('Error en la conexion');
} else {
    if (isset($_POST['carrito'])) {
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = array();
        }
        $carrito = $_POST['carrito'];
        $oferta = (isset($_POST['oferta'])) ? $_POST['oferta'] : 0;
        $prodCar = array();
        $sql = "SELECT * FROM productos WHERE idProducto=" . $carrito . ";";
        $resultado = $conexion->query($sql);
        if ($fila = $resultado->fetch_assoc()) {
            array_push($prodCar, $fila['idProducto'], $fila['nombreProducto'], $fila['categoria'], $fila['descripcion'], $fila['precio'], $fila['existencia'], $fila['archIMG'], $oferta);
            array_push($_SESSION['carrito'], $prodCar);
        }
    }
?>
<?php
    echo "<div class=\"container\">";
    echo "<legend>Elementos en el carrito</legend>";
    if (isset($_SESSION['carrito'])) {
        echo "<div class=\"consulta\">";
        for ($i = 0; $i < count($_SESSION['carrito']); $i++) {
            echo "<div class=\"producto\">";
            echo "<img src=\"images/" . $_SESSION['carrito'][$i][6] . "\" alt=\"" . $_SESSION['carrito'][$i][1] . "\">";
            echo "<table>";
            echo "<tr><td><span class=\"titulo " . "\">Nombre: </span><span class=\"conten\">" . $_SESSION['carrito'][$i][1] . "</span></tr></td>";
            echo "<tr><td><span class=\"titulo " . "\">Descripción: </span><span class=\"conten\">" . $_SESSION['carrito'][$i][3] . "</span></tr></td>";
            if ($_SESSION['carrito'][$i][7]) {
                echo "<tr><td><span class=\"noOferta\">Precio: $" . $_SESSION['carrito'][$i][4] . "</span></td></tr>";
                echo "<tr><td><span class=\"oferta\">Oferta: </span><span class=\"conten\">$" . $_SESSION['carrito'][$i][7] . "</span></td></tr>";
            } else
                echo "<tr><td><span class=\"titulo " . "\">Precio: </span><span class=\"conten\">$" . $_SESSION['carrito'][$i][4] . "</span></tr></td>";
            echo "<tr><td><span class=\"titulo " . "\">Existencia: </span><span class=\"conten\">" . $_SESSION['carrito'][$i][5] . "</span></tr></td>";
            echo "</table></div>";
        }
        echo "</div>";
    } else {
        echo "<legend style=\"color: gray;\">Carrito vacío</legend>";
    }
    echo "</div>";
}
?>

<body>
</body>

</html>