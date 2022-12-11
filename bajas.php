<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ELIMINAR REGISTRO</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/stylesBajas.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico" />

</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $("#cualBajas").val('');
        $(".borde").hide();
        $("input[type=\"submit\"]").hide();
    });
</script>
<?php
session_start(); //para poder hacer uso de las varaibles sesion 

if (($_SESSION["acceso"]) && $_SESSION["admin"]) {
    include "navbar.php";
    // $servidor = 'localhost:3307';
    $servidor = 'localhost:33065';
    $cuenta = 'root';
    $password = '';
    $bd = 'tienda2';
    $conexion = new mysqli($servidor, $cuenta, $password, $bd);
    if ($conexion->connect_errno) {
        die('Error en la conexion');
    } else {
        if (isset($_POST['eliminar'])) {
            $sql = "SELECT archIMG FROM productos WHERE idProducto=" . $_POST['cualBajas'];
            $resultado = $conexion->query($sql);
            $sql = "DELETE FROM productos WHERE idProducto=" . $_POST['cualBajas'];
            $conexion->query($sql);
            $elimino = 0;
            if ($conexion->affected_rows) {
                $fila = $resultado->fetch_assoc();
                $ARCH = "images/" . $fila['archIMG'];
                if (file_exists($ARCH)) {
                    $file = fopen($ARCH, 'r');
                    fclose($file);
                    unlink($ARCH);
                }
                $elimino++;
            }
            if ($elimino) {
                echo "<script>alert(\"registro eliminado\")</script>";
            } else {
                echo "<script>alert(\"NO SE ELIMINÓ NINGÚN REGISTRO\")</script>";
            }
        }
        $sql = "SELECT * FROM productos";
        $resultado = $conexion->query($sql);
    }
?>

    <body>
        <div class="container1">
            <div id="divBajas">
                <br>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="formBajas">
                    <legend>Eliminar registro</legend>
                    <select name="cualBajas" id="cualBajas" onchange="muestraSelecc(this.selectedIndex)">
                        <?php
                        $cont = 0;
                        $productos = array();
                        while ($fila = $resultado->fetch_assoc()) {
                            array_push($productos, $fila);
                            echo '<option value="' . $fila['idProducto'] . '">'
                                . $fila["nombreProducto"] . '</option>';
                        }
                        ?>
                    </select>
                </form>
                <div class="borde">
                    <table>
                        <tr>
                            <td><span class="titulo">Id: </span><span class="contenido" id="sId"></span></td>
                        </tr>
                        <tr>
                            <td><span class="titulo">Nombre: </span><span class="contenido" id="sNombre"></span></td>
                        </tr>
                        <tr>
                            <td><span class="titulo">Categoría: </span><span class="contenido" id="sCat"></span></td>
                        </tr>
                        <tr>
                            <td><span class="titulo">Descripción: </span><span class="contenido" id="sDesc"></span></td>
                        </tr>
                        <tr>
                            <td><span class="titulo">Existencia: </span><span class="contenido" id="sExis"></span></td>
                        </tr>
                        <tr>
                            <td><span class="titulo">Precio: </span><span class="contenido" id="sPrecio"></span></td>
                        </tr>
                        <tr>
                            <td><span class="titulo">Ventas: </span><span class="contenido" id="sVentas"></span></td>
                        </tr>
                    </table>
                    <img src="" alt="" id="sImg" class="imgProd">
                </div>
                <div class="botones">
                    <button class="regresar btn btn-primary" onclick="document.location='menuAdmin.php'">Regresar</button>
                    <input class="btn btn-danger" type="submit" value="eliminar registro" name="eliminar" form="formBajas" id="eliminar">
                </div>
                <br>
            </div>
        </div>
    </body>

<?php include 'html/footer.html';
} else {
    header("Location:index.php");
}
?>

</html>
<script>
    function muestraSelecc(val) {
        $(document).ready(function() {
            $(".borde").show();
            $("input[type=\"submit\"]").show();
        });
        var productos = <?php echo json_encode($productos); ?>;
        document.getElementById("sId").textContent = productos[val]['idProducto'];
        document.getElementById("sNombre").textContent = productos[val]['nombreProducto'];
        document.getElementById("sCat").textContent = productos[val]['categoria'];
        document.getElementById("sDesc").textContent = productos[val]['descripcion'];
        document.getElementById("sExis").textContent = productos[val]['existencia'];
        document.getElementById("sPrecio").textContent = "$" + productos[val]['precio'];
        document.getElementById("sVentas").textContent = productos[val]['ventas'];
        document.getElementById("sImg").src = "images/" + productos[val]['archIMG'];
        document.getElementById("sImg").alt = productos[val]['nombreProducto'];
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>