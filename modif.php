<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MODIFICAR REGISTRO</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/stylesModif.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico" />

</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $("#cualBajas").val('');
        $(".borde").hide();
        $("input[type=\"submit\"]").hide();
        $('#fileButton').on('click', function() {
            $('#fileName').trigger('click');
        });
        $(".regresar").click(function() {
            $(".altas").removeAttr('required');
        });
        $("input[type=\"number\"]").keydown(function(event) {
            if (!(event.keyCode <= 57 && event.keyCode >= 48) && !(event.keyCode == 8 || event.keyCode == 9)) {
                return false;
            }
        });
        $("#id").keydown(function(event) {
            if (this.value.length >= 6 && !(event.keyCode == 8 || event.keyCode == 9)) {
                return false;
            }
        });
        $(".tresD").keydown(function(event) {
            if (this.value.length >= 3 && !(event.keyCode == 8 || event.keyCode == 9)) {
                return false;
            }
        });
    });
</script>
<?php
session_start(); //para poder hacer uso de las varaibles sesion 

if (($_SESSION["acceso"]) && $_SESSION["admin"]) {
    include 'navbar.php';

    // $servidor = 'localhost:3307';
    $servidor = 'localhost:33065';
    $cuenta = 'root';
    $password = '';
    $bd = 'tienda2';
    $conexion = new mysqli($servidor, $cuenta, $password, $bd);
    if ($conexion->connect_errno) {
        die('Error en la conexion');
    } else {
        if (isset($_POST['modificar'])) {
            $sql = "SELECT archIMG FROM productos WHERE idProducto=" . $_POST['id'];
            $resultado = $conexion->query($sql);
            $sql = "UPDATE productos SET 
        idProducto=" . $_POST['id'] . ",
        nombreProducto='" . $_POST['nombre'] . "',
        categoria='" . $_POST['cat'] . "',
        descripcion='" . $_POST['desc'] . "',
        existencia=" . $_POST['exis'] . ",
        precio=" . $_POST['precio'] . ",
        archIMG='" . $_FILES['fileName']['name'] . "',
        ventas=" . $_POST['ventas'] . "
        WHERE idProducto=" . $_POST['id'] . ";";
            $conexion->query($sql);
            if ($conexion->affected_rows) {
                while ($fila = $resultado->fetch_assoc()) {
                    $ARCH = "images/" . $fila['archIMG'];
                    if (file_exists($ARCH)) {
                        $file = fopen($ARCH, 'r');
                        fclose($file);
                        unlink($ARCH);
                    }
                }
                move_uploaded_file($_FILES['fileName']['tmp_name'], "images/" . $_FILES['fileName']['name']);
                echo "<script>alert(\"registro modificado\")</script>";
            } else {
                echo "<script>alert(\"NO SE MODIFICÓ NINGÚN REGISTRO\")</script>";
            }
        }
        $sql = "SELECT * FROM productos";
        $resultado = $conexion->query($sql);
    }
?>

    <body>
        <div class="container1">
            <div id="divModif">
                <br>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="formAltas" method="post" enctype="multipart/form-data">
                    <legend>Modificar registro</legend>
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
                    <div class="borde">
                        <label for="id">Id</label>
                        <input type="number" name="id" id="id" class="altas" min="1" max="999999" required>
                        <label for="nombre">Nombre</label>
                        <input type="text" class="altas" name="nombre" id="nombre" required>
                        <label for="cat">Categoría</label>
                        <input type="text" class="altas" name="cat" id="cat" required>
                        <label for="desc">Descripción</label>
                        <textarea name="desc" id="desc" cols="30" rows="10" class="altas" s required></textarea>
                        <label for="exis">Existencia</label>
                        <input type="number" name="exis" id="exis" class="altas tresD" min="1" max="999" required>
                        <label for="precio">Precio</label>
                        <input type="number" name="precio" id="precio" class="altas tresD" min="1" max="999" required>
                        <label for="ventas">Ventas</label>
                        <input type="number" name="ventas" id="ventas" class="altas tresD" min="1" max="999" required>
                        <button class="btn btn-info" id="fileButton" type="button">Seleccionar archivo</button>
                        <input type="file" name="fileName" id="fileName" class="altas" accept="image/*" style="display: none;" required>
                    </div>
                </form>
                <div class="botones">
                    <button class="regresar btn btn-danger" onclick="document.location='menuAdmin.php'">Regresar</button>
                    <input class="btn btn-success" type="submit" value="modificar registro" class="altas" name="modificar" form="formAltas" id="guardar">
                </div>
                <br>
            </div>
        </div>
    </body>
<?php include 'html/footer.html';
} else {
    header("Location:index.php");
} ?>

</html>
<script>
    function muestraSelecc(val) {
        $(document).ready(function() {
            $(".borde").show();
            $("input[type=\"submit\"]").show();
        });
        var productos = <?php echo json_encode($productos); ?>;
        document.getElementById("id").value = productos[val]['idProducto'];
        document.getElementById("nombre").value = productos[val]['nombreProducto'];
        document.getElementById("cat").value = productos[val]['categoria'];
        document.getElementById("desc").value = productos[val]['descripcion'];
        document.getElementById("exis").value = productos[val]['existencia'];
        document.getElementById("precio").value = productos[val]['precio'];
        document.getElementById("ventas").value = productos[val]['ventas'];
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>