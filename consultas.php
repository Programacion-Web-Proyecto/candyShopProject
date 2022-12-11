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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/stylesConsultas.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico" />

</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<?php
// $servidor = 'localhost:3307';
$servidor = 'localhost:33065';
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
        $sql = "SELECT idProducto,existencia FROM productos";
        $resultado = $conexion->query($sql);
        while ($fila = $resultado->fetch_assoc()) { //para actualizar la existencia de los productos
            for ($i = 0; $i < count($_SESSION['carrito']); $i++) {
                if ($_SESSION['carrito'][$i][0] == $fila['idProducto']) {
                    $_SESSION['carrito'][$i][5] = $fila['existencia'];
                    //para que la cantidad de compra del producto no sobrepase la existencia del mismo
                    if ($_SESSION['carrito'][$i][5] < $_SESSION['carrito'][$i][8]) $_SESSION['carrito'][$i][8] = $_SESSION['carrito'][$i][5];
                }
            }
        }
        $sql = "SELECT * FROM productos WHERE idProducto=" . $carrito . ";";
        $resultado = $conexion->query($sql);
        $yaHay = false;
        if ($fila = $resultado->fetch_assoc()) {
            for ($i = 0; $i < count($_SESSION['carrito']); $i++) {
                if ($_SESSION['carrito'][$i][0] == $carrito && $_SESSION['carrito'][$i][7] == $oferta) {
                    $_SESSION['carrito'][$i][8]++;
                    //para que la cantidad de compra del producto no sobrepase la existencia del mismo
                    if ($_SESSION['carrito'][$i][5] < $_SESSION['carrito'][$i][8]) $_SESSION['carrito'][$i][8] = $_SESSION['carrito'][$i][5];
                    $yaHay = true;
                    break;
                }
            }
            if (!$yaHay) {              //0                     //1                     //2                 //3                 //4                 //5             //6                 //7   //8
                array_push($prodCar, $fila['idProducto'], $fila['nombreProducto'], $fila['categoria'], $fila['descripcion'], $fila['precio'], $fila['existencia'], $fila['archIMG'], $oferta, 1);
                array_push($_SESSION['carrito'], $prodCar);
            }
        }
    }
    include 'navbar.php';
    $sql = "SELECT categoria FROM productos GROUP BY categoria";
    $catres = $conexion->query($sql); //diferentes categorias existentes
    $filtroCat = (isset($_POST['filtro'])) ? $_POST['filtro'] : 1;
    $sql = "SELECT * FROM productos WHERE " . $filtroCat;
    $resultado = $conexion->query($sql);
    $res = $conexion->query($sql);
    $contCarrito = isset($_SESSION['carrito']) ? count($_SESSION['carrito']) : 0;
?>
    <script>
        var seleccion = <?php echo json_encode($filtroCat); ?>;
        $(document).ready(function() {
            $("#filtro").val(seleccion); //al recargar la página establecemos como selección la opción anteriormente seleccionada
        });
    </script>
    <div class="container1">
        <div class="carrito">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group busquedaBarra">
                    <select name="filtro" class="form-control" id="filtro" onchange="this.form.submit()">
                        <option value="1">Todos los productos</option>
                        <?php
                        while ($fila = $catres->fetch_assoc()) {
                            echo "<option value=\"categoria='" .  $fila['categoria'] . "'\">"
                                . $fila['categoria'] . "</option>";
                        }
                        ?>
                    </select>
                </div>


            </form>
            <br><br>
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
                echo "<form class=\"formProd\" action=\"" . htmlspecialchars($_SERVER["PHP_SELF"]) . "\" method=\"post\">";
                if ($cont == $random)
                    echo "<input type=\"hidden\" name=\"oferta\" value=\"" . $fila['precio'] * $descuento . "\">";
                echo "<input type=\"hidden\" name=\"carrito\" value=\"" . $fila['idProducto'] . "\">";
                echo "<input type=\"hidden\" name=\"filtro\" value=\"" . $filtroCat . "\">";
                echo "<button type=\"submit\" class=\"agregar tooltip1000\"><i class=\"fa-solid fa-cart-plus\"><span class=\"tooltiptext1000\">Agregar al carrito</span></i></button></form>";
                echo "<img class=\"imagProd\" src=\"images/" . $fila['archIMG'] . "\" alt=\"" . $fila['nombreProducto'] . "\">";
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

<?php
}
include 'html/footer.html';
?>

<body>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</body>

</html>