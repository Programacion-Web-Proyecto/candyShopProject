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
<script src="https://kit.fontawesome.com/b5e2972857.js" crossorigin="anonymous"></script>
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
    $sql = "SELECT idProducto,existencia FROM productos";
    $resultado = $conexion->query($sql);
    while ($fila = $resultado->fetch_assoc()) { //para actualizar la existencia de los productos
        for ($i = 0; $i < count($_SESSION['carrito']); $i++) {
            if ($_SESSION['carrito'][$i][0] == $fila['idProducto']) {
                $_SESSION['carrito'][$i][5] = $fila['existencia'];
            }
        }
    }
    if (isset($_POST['quitarCarrito'])) {
        $i = $_POST['quitarCarrito'];
        unset($_SESSION['carrito'][$i]);
        $aux = array_values($_SESSION['carrito']);
        unset($_SESSION['carrito']);
        $_SESSION['carrito'] = array_values($aux);
    }
?>
<?php
    echo "<div class=\"container\">";
    echo "<div><button onclick=\"document.location='consultas.php'\">regresar a ver productos</button></div>";
    echo "<legend>Elementos en el carrito</legend>";
    if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
        echo "<div class=\"consulta\">";
        for ($i = 0; $i < count($_SESSION['carrito']); $i++) {
            echo "<div class=\"producto\">";
            echo "<form action=\"" . htmlspecialchars($_SERVER["PHP_SELF"]) . "\" method=\"post\">";
            echo "<input type=\"hidden\" name=\"quitarCarrito\" value=\"" . $i . "\">";
            echo "<button type=\"submit\" class=\"quitar tooltip\"><i class=\"fa-regular fa-trash-can\"><span class=\"tooltiptext\">Quitar del carrito</span></i></button></form>";
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
            echo "<tr><td><span class=\"titulo " . "\">Cantidad </span><button>-</button><span class=\"conten\">" . $_SESSION['carrito'][$i][8] . "</span><button>+</button></tr></td>";
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