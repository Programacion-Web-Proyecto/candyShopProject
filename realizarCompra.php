<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realizar compra</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="favicon.ico" />

</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<?php require_once 'estados.php';
$totE = count($mexico);
include 'navbar.php';
if ($_SESSION['acceso']) {
?>

    <body>
        <div class="container1">
            <div class="infoUsuario">
                <form action="carrito.php" method="post">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" required>
                    <label for="nombre">Teléfono</label>
                    <input type="number" name="tel" id="tel" required>
                    <label>Dirección</label>
                    <label for="calle">Calle*</label>
                    <input type="text" name="calle" id="calle" required>
                    <label for="noExt">Numero Exterior*</label>
                    <input type="number" name="noExt" id="noExt" required>
                    <label for="noInt">Numero Interior</label>
                    <input type="number" name="noInt" id="noInt">
                    <label for="estado">Estado</label>
                    <select name="estado" id="estado" required>
                        <?php
                        for ($i = 0; $i < $totE; $i++) {
                            echo "<option value=\"" . $mexico[$i]['estado'] . "\">" . $mexico[$i]['estado'] . "</option>";
                        }
                        ?>
                    </select>
                    <label for="muni">Municipio</label>
                    <select name="muni" id="muni" disabled="disabled" required></select>
                    <label for="CP">Código Postal</label>
                    <input type="number" name="CP" id="CP" required>
                </form>
            </div>
        </div>
    </body>

</html>
<script>
    $(document).ready(function() {
        $("#estado").val('');
        $("#estado").change(function() {
            $("#muni").prop('disabled', false);
            $("#muni").empty();
            const mexico = <?php echo json_encode($mexico); ?>;
            console.log(Array.isArray(mexico));
            console.log(mexico[this.selectedIndex].municipios);
            muni = mexico[this.selectedIndex].municipios;
            var selMuni = document.getElementById('muni');
            for (let i = 0; i < muni.length; i++) {
                const element = muni[i];
                var op = document.createElement("option");
                op.text = element;
                op.value = element;
                selMuni.add(op);
            }
            $("#muni").val('');
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
<?php
} else {
    header("Location:loginForm.php");
}
include 'html/footer.html';
?>