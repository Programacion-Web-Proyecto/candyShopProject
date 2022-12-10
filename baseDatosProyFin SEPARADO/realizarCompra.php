<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realizar compra</title>
</head>


<body>
    <div class="container">
        <div class="infoUsuario">
            <form action="carrito.php" method="post">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" required>
                <label>Dirección</label>
                <label for="calle">Calle*</label>
                <input type="text" name="calle" id="calle" required>
                <label for="noExt">Numero Exterior*</label>
                <input type="number" name="noExt" id="noExt" required>
                <label for="noInt">Numero Interior</label>
                <input type="number" name="noInt" id="noInt">
                <label for="estado">Estado</label>
                <select name="estado" id="estado" onchange="muni(this.options[this.selectedIndex].text)">
                    <?php
                    $i = 0;
                    foreach ($mexico as $estado => $municipios) {
                        echo "<option value=\"$i++\">$estado</option>";
                    }
                    ?>
                </select>
                <select name="muni" id="muni" disabled="disabled"></select>
            </form>
        </div>
    </div>
</body>

</html>
<script>
    function muni(estado){

    }
</script>