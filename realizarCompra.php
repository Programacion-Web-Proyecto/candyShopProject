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
    <link href="css/style7.css" media="all" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato|Liu+Jian+Mao+Cao&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style6.css">

</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<?php
include 'navbar.php';
if ($_SESSION['acceso']) {
    if (isset($_POST['realizarCompra'])) {

?>

        <body>
            <div class="container1">
                <div class="infoUsuario">
                    <form action="compra.php" method="post">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" required>
                        <label for="tel">Teléfono</label>
                        <input type="number" name="tel" id="tel" required>
                        <label for="email">Correo Electrónico</label>
                        <input type="text" name="email" id="email" required>
                        <label>Dirección</label>
                        <label for="calle">Calle</label>
                        <input type="text" name="calle" id="calle" required>
                        <label for="noExt">Numero Exterior</label>
                        <input type="number" name="noExt" id="noExt" required>
                        <label for="pais">País</label>
                        <select name="pais" id="pais" required>
                            <option value="mx">México</option>
                            <option value="us">Estados Unidos</option>
                        </select>
                        <label for="estado">Estado</label>
                        <select name="estado" id="estado" disabled="disabled" required></select>
                        <label for="muni">Municipio</label>
                        <select name="muni" id="muni" disabled="disabled" required></select>
                        <label for="CP">Código Postal</label>
                        <input type="number" name="CP" id="CP" required>
                        <label for="CP">Agregar cupón de descuento</label>
                        <input type="text" name="cupon" id="cupon">
                        <label for="metodo">Método de pago</label>
                        <input type="radio" name="metodo" id="oxxo" value="OXXO">
                        <label for="oxxo">OXXO</label>
                        <input type="radio" name="metodo" id="tarjeta" value="Tarjeta">
                        <label for="tarjeta">Tarjeta</label>
                        <div class="opps">
                            <div class="opps-header">
                                <div class="opps-reminder">Ficha digital. No es necesario imprimir.</div>
                                <div class="opps-info">
                                    <div class="opps-brand"><img src="media/oxxoimg.png" alt="OXXOPay"></div>
                                    <div class="opps-ammount">
                                        <h3>Monto a pagar</h3>
                                        <h2>$ 0,000.00 <sup>MXN</sup></h2>
                                        <p>OXXO cobrará una comisión adicional al momento de realizar el pago.</p>
                                    </div>
                                </div>
                                <div class="opps-reference">
                                    <h3>Referencia</h3>
                                    <h1><?php
                                        $a = mt_rand(1000, 9999);
                                        $b = mt_rand(1000, 9999);
                                        $c = mt_rand(1000, 9999);
                                        $d = mt_rand(10, 99);
                                        echo $a, "-", $b, "-", $c, "-", $d; ?></h1>
                                </div>
                            </div>
                            <div class="opps-instructions">
                                <h3>Instrucciones</h3>
                                <ol>
                                    <li>Acude a la tienda OXXO más cercana. <a href="https://www.google.com.mx/maps/search/oxxo/" target="_blank">Encuéntrala aquí</a>.</li>
                                    <li>Indica en caja que quieres realizar un pago de servicio<strong></strong>.</li>
                                    <li>Dicta al cajero el número de referencia en esta ficha para que tecleé directamete en la pantalla de venta.</li>
                                    <li>Realiza el pago correspondiente con dinero en efectivo.</li>
                                    <li>Al confirmar tu pago, el cajero te entregará un comprobante impreso. <strong>En el podrás verificar que se haya realizado correctamente.</strong> Conserva este comprobante de pago.</li>
                                </ol>
                                <div class="opps-footnote">Al completar estos pasos recibirás un correo de <strong>Nombre del negocio</strong> confirmando tu pago.</div>
                            </div>
                        </div>
                        <div class="contenedor">
                            <div class="grupo">
                                <label for="inputNumero">Número Tarjeta</label>
                                <input type="text" id="inputNumero" maxlength="19" autocomplete="off">
                            </div>
                            <div class="grupo">
                                <label for="inputNombre">Nombre</label>
                                <input type="text" id="inputNombre" maxlength="19" autocomplete="off">
                            </div>
                            <div class="flexbox">
                                <div class="grupo expira">
                                    <label for="selectMes">Expiracion</label>
                                    <div class="flexbox">
                                        <div class="grupo-select">
                                            <select name="mes" id="selectMes">
                                                <option disabled selected>Mes</option>
                                            </select>
                                            <i class="fas fa-angle-down"></i>
                                        </div>
                                        <div class="grupo-select">
                                            <select name="year" id="selectYear">
                                                <option disabled selected>Año</option>
                                            </select>
                                            <i class="fas fa-angle-down"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="grupo ccv">
                                    <label for="inputCCV">CCV</label>
                                    <input type="text" id="inputCCV" maxlength="3">
                                </div>
                            </div>
                        </div>
                        <input type="submit" value="Realizar Compra">
                    </form>
                </div>
            </div>
        </body>
    <?php
    } else {
        header("Location:consultas.php");
    }
    ?>

</html>
<script>
    $(document).ready(function() {
        $("#pais").val('');
        $(".opps").hide();
        $(".contenedor").hide();
        $("#pais").change(function() {
            $("#estado").prop('disabled', false);
            $("#muni").prop('disabled', true);
            $("#estado").empty();
            $("#muni").empty();
            if (this.selectedIndex == 0) {
                <?php require_once 'mexico.php'; ?>
                const mexico = <?php echo json_encode($mexico); ?>;
                var selEst = document.getElementById('estado');
                for (let i = 0; i < mexico.length; i++) {
                    const est = mexico[i].estado;
                    var op = document.createElement("option");
                    op.text = est;
                    op.value = est;
                    selEst.add(op);
                }
            } else if (this.selectedIndex == 1) {
                <?php require_once 'USA.php'; ?>;
                const usa = <?php echo json_encode($USA); ?>;
                var selEst = document.getElementById('estado');
                for (let i = 0; i < usa.length; i++) {
                    const est = usa[i].estado;
                    var op = document.createElement("option");
                    op.text = est;
                    op.value = est;
                    selEst.add(op);
                }
            }
            $("#estado").val('');
            $("#muni").val('');
        });
        $("#estado").change(function() {
            $("#muni").prop('disabled', false)
            $("#muni").empty();
            if ($("#pais")[0].selectedIndex == 0) {
                const mexico = <?php echo json_encode($mexico); ?>;
                muni = mexico[this.selectedIndex].municipios;
                var selMuni = document.getElementById('muni');
                for (let i = 0; i < muni.length; i++) {
                    const element = muni[i];
                    var op = document.createElement("option");
                    op.text = element;
                    op.value = element;
                    selMuni.add(op);
                }
            } else if ($("#pais")[0].selectedIndex == 1) {
                const usa = <?php echo json_encode($USA); ?>;
                muni = usa[$("#estado")[0].selectedIndex].municipios;
                var selMuni = document.getElementById('muni');
                for (let i = 0; i < muni.length; i++) {
                    const element = muni[i];
                    var op = document.createElement("option");
                    op.text = element;
                    op.value = element;
                    selMuni.add(op);
                }
            }
            $("#muni").val('');
        });
        $('input[name="metodo"]').change(function() {
            if ($('input[name="metodo"]:checked').val() == "OXXO") {
                $(".opps").show();
                $(".contenedor").hide();
            } else if ($('input[name="metodo"]:checked').val() == "Tarjeta") {
                $(".opps").hide();
                $(".contenedor").show();
            }
        });
    });
</script>

<!-- <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
<script src="js/mainTarjeta.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
<?php
} else {
    header("Location:loginForm.php");
}
include 'html/footer.html';
?>