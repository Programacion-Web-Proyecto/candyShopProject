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
    <link rel="stylesheet" href="css/styleFormularioCompra.css">

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
                    <h2>Datos de Pago</h2>
                    <form action="compra.php" method="post">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nombre</label>
                            <input class="form-control" type="text" name="nombre" id="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="tel">Teléfono</label>
                            <input class="form-control" type="number" name="tel" id="tel" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Correo Electrónico</label>
                            <input class="form-control" type="text" name="email" id="email" required>
                        </div>
                        <div class="form-group">
                            <label>Dirección</label>
                            <label for="calle">Calle</label>
                            <input class="form-control" type="text" name="calle" id="calle" required>
                        </div>
                        <div class="form-group">
                            <label for="noExt">Numero Exterior</label>
                            <input class="form-control" type="number" name="noExt" id="noExt" required>
                        </div>
                        <div class="form-group">
                            <label for="pais">País</label>
                            <select class="custom-select" name="pais" id="pais" required>
                                <option value="mx">México</option>
                                <option value="us">Estados Unidos</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select class="custom-select" name="estado" id="estado" disabled="disabled" required></select>
                        </div>
                        <div class="form-group">
                            <label for="muni">Municipio</label>
                            <select class="custom-select" name="muni" id="muni" disabled="disabled" required></select>
                        </div>
                        <div class="form-group">
                            <label for="CP">Código Postal</label>
                            <input class="form-control" type="number" name="CP" id="CP" required>
                        </div>
                        <div class="form-group">
                            <label for="CP">Agregar cupón de descuento</label>
                            <input class="form-control" type="text" name="cupon" id="cupon">
                        </div>
                        <fieldset class="form-group row">
                            <!-- <label for=""></label> -->
                            <legend class="col-form-label col-sm-3 float-sm-left pt-0">Método de pago</legend>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="metodo" id="oxxo" value="OXXO">
                                    <label class="form-check-label" for="oxxo">OXXO</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="metodo" id="tarjeta" value="Tarjeta">
                                    <label class="form-check-label" for="tarjeta">Tarjeta</label>
                                </div>
                            </div>
                        </fieldset>
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
                            <form class="needs-validation" novalidate>
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="validationTooltip01">Número Tarjeta</label>
                                        <input type="number" class="form-control" id="validationTooltip01" value="" >
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="validationTooltip02">Nombre</label>
                                        <input type="text" class="form-control" id="validationTooltip01" value="" >
                                        <div class="valid-tooltip">
                                            Completo!
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="validationTooltip03">Mes</label>
                                        <input type="number"min="1" max="12" class="form-control" id="validationTooltip03" >
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="validationTooltip04">Año</label>
                                        <input type="number"min="1" max="99" class="form-control" id="validationTooltip03" >
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="validationTooltip05">CVV</label>
                                        <input type="password" class="form-control" id="validationTooltip05"  maxlength="3">
                                    </div>
                                </div>
                            </form>








                        </div>
                        <input class="btn btn-success btn-lg btn-block" type="submit" value="Realizar Compra">
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