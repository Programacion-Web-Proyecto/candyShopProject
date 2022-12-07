<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONSULTAS</title>
    <link rel="stylesheet" href="css/stylesConsultas.css">
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
    $sql = "SELECT * FROM productos";
    $resultado = $conexion->query($sql);
    $res = $conexion->query($sql);
    $contCarrito = isset($_SESSION['carrito']) ? count($_SESSION['carrito']) : 0;
?>
    <div class="container">
        <div class="carrito">
            <button onclick="document.location='index.php'">regresar</button>
            <div class="carritoIcon">
                <i class="fa-solid fa-cart-shopping" onclick="document.location='carrito.php'" id="carritoIcon"></i>
                <div class="numeroElementos">
                    <p><?php echo $contCarrito ?></p>
                </div>
            </div>
        </div>
        <div class="consulta">
            <?php
            $cont = -1;
            while ($fila = $res->fetch_assoc()) {
                $cont++;
            }
            $random = rand(0, $cont);
            $cont = 0;
            $descuento = 0.9;
            while ($fila = $resultado->fetch_assoc()) {
                echo "<div class=\"producto\">";
                echo "<form action=\"carrito.php\" method=\"post\">";
                if ($cont == $random)
                    echo "<input type=\"hidden\" name=\"oferta\" value=\"" . $fila['precio'] * $descuento . "\">";
                echo "<input type=\"hidden\" name=\"carrito\" value=\"" . $fila['idProducto'] . "\">";
                echo "<button type=\"submit\" class=\"agregar tooltip\"><i class=\"fa-solid fa-cart-plus\"><span class=\"tooltiptext\">Agregar al carrito</span></i></button></form>";
                echo "<img src=\"images/" . $fila['archIMG'] . "\" alt=\"" . $fila['nombreProducto'] . "\">";
                echo "<table>";
                echo "<tr><td><span class=\"titulo " . "\">Nombre: </span><span class=\"conten\">" . $fila['nombreProducto'] . "</span></tr></td>";
                echo "<tr><td><span class=\"titulo\">Descripción: </span><span class=\"conten\">" . $fila['descripcion'] . "</span></td></tr>";
                if ($cont++ == $random) { //OFERTA
                    echo "<tr><td><span class=\"noOferta\">Precio: $" . $fila['precio'] . "</span></td></tr>";
                    echo "<tr><td><span class=\"oferta\">Oferta: </span><span class=\"conten\">$" . $fila['precio'] * $descuento . "</span></td></tr>";
                } else                    //PRECIO NORMAL
                    echo "<tr><td><span class=\"titulo\">Precio: </span><span class=\"conten\">$" . $fila['precio'] . "</span></td></tr>";
                echo "<tr><td><span class=\"titulo\">Existencia: </span><span class=\"conten\">" . $fila['existencia'] . "</span></td></tr>";
                echo "</table></div>";
            } ?>
        </div>
    </div>
    </div>

<?php
} ?>

<body>

</body>

</html>