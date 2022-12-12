<?php session_start(); ?>

<head>
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Recibo Enviado!</title>
</head>

<body class="all">
    <?php
    include "navbar.php";
    $servidor = 'localhost:3307';
    // $servidor = 'localhost:33065';
    $cuenta = 'root';
    $password = '';
    $bd = 'tienda2';
    $conexion = new mysqli($servidor, $cuenta, $password, $bd);

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    if ($conexion->connect_errno) {
        die('Error en la conexion');
    } else {
        date_default_timezone_set('America/Mexico_City');
        echo "Ultima actualizacion: " . date("F d Y H:i:s.", filemtime(__FILE__));


        require 'recursos/PHPMailer/src/PHPMailer.php';
        require 'recursos/PHPMailer/src/SMTP.php';
        require 'recursos/PHPMailer/src/Exception.php';

        $mail = new PHPMailer(true);
        echo "<div class='contenido' id='part1'>";
        try {
            $totalPagar = 0;
            for ($i = 0; $i < count($_SESSION['carrito']); $i++) {
                $sql = "SELECT * FROM productos WHERE idProducto=" . $_SESSION['carrito'][$i][0];
                $resultado = $conexion->query($sql);
                if ($fila = $resultado->fetch_assoc()) {
                    if ($_SESSION['carrito'][$i][1])
                        $totalPagar += ($_SESSION['carrito'][$i][2] * $_SESSION['carrito'][$i][1]);
                    else
                        $totalPagar += ($_SESSION['carrito'][$i][2] * $fila['precio']);
                }
            }
            $totDesc = $totalPagar;

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;

            $mail->Username = 'wichotl64@gmail.com';
            $mail->Password   = 'ipubwtvrhzyyqhly';

            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('wichotl64@gmail.com', 'Candy Shop Mx');
            $mail->addAddress($_POST['email'], 'Recibo de pago');
            // $mail->addAddress("victor000hugo10@gmail.com", 'Actividad correo');

            $mail->addCC($_POST['email']);
            // $mail->addCC("victor000hugo10@gmail.com");

            $mail->isHTML(true);
            $cupon = (isset($_POST['cupon'])) ? $_POST['cupon'] : "Ninguno";
            $descuento = 0;
            $iva = $totalPagar * 0.16;
            $gastos = ($_POST['pais'] == "USA") ?  150 : 0;


            switch ($cupon) {
                case 'WELCOMEFAMILY22': //50%
                    $descuento = $totDesc * 0.5;
                    $totDesc *= 0.5;
                    $iva = $totDesc * 0.16;
                    break;
                case 'DULCES10': //10%
                    $descuento = $totDesc * 0.1;
                    $totDesc *= 0.9;
                    $iva = $totDesc * 0.16;
                    break;
                case 'DESCUENTO50': //50 PESOS MENOS
                    $totDesc -= 50;
                    if ($totDesc < 0) $totDesc = 0;
                    $descuento = 50;
                    $iva = $totDesc * 0.16;
                    break;
            }
            $totDesc += $gastos;
            $mail->Subject = 'Recibo de Pago';
            $direccion = $_POST['calle'] . ' #' . $_POST['noExt'];
            for ($i = 0; $i < count($_SESSION['carrito']); $i++) {
                $sql = "SELECT nombreProducto,precio FROM productos WHERE idProducto=" . $_SESSION['carrito'][$i][0];
                $resultado = $conexion->query($sql);
                $PRODUCTOS = "";
                if ($fila = $resultado->fetch_assoc()) {
                    $precio = ($_SESSION['carrito'][$i][1]) ? $_SESSION['carrito'][$i][1] : $fila['precio'];
                    $PRODUCTOS .= 'Producto: ' . $fila['nombreProducto'] . '   Precio: $' . $precio . ' Cantidad: ' . $_SESSION['carrito'][$i][2] . '<br>';
                }
            }
            $mail->Body = 'Gracias por comprar en CandyShopMx le adjunto su recibo <br> <br>
                        DATOS DEL CLIENTE <br>
                        Nombre: ' . $_POST['nombre'] . ' <br>
                        Pais: ' . $_POST['pais'] . '<br> 
                        Estado: ' . $_POST['estado'] . ' <br>
                        Municipio: ' . $_POST['muni'] . ' <br>
                        Direccion: ' . $direccion . ' <br>
                        Codigo Postal: ' . $_POST['CP'] . ' <br>
                        Numero de telefono: ' . $_POST['tel'] . ' <br> <br>
                        CONCEPTO: DULCERIA <br>
                        Modo de Pago: ' . $_POST['metodo'] . ' <br>'.
                        $PRODUCTOS.'
                        Total a pagar: $' . $totalPagar . '  <br>
                        Gastos de envio: $' . $gastos . '  <br>
                        Cupon: ' . $cupon . '  <br>
                        IVA: ' . $iva . '<br>
                        Descuento: ' . $descuento . '<br>
                        <p style: "font-size: 30px">TOTAL FINAL: <b>$' . $totDesc . '</b></p>';


            $mail->send();

            // echo 'Correo electronico enviado con exito';
            echo '<div class="acceso">
                            <div class="alert alert-success " role="alert">
                                PAGO REALIZADO!
                            </div>
                            <ul class="list-group list-group-flush">
                            <li class="list-group-item ticketComp">DATOS DEL CLIENTE</li>
                            <li class="list-group-item ticketComp">Nombre: ' . $_POST['nombre'] . '</li>
                            <li class="list-group-item ticketComp">Pais: ' . $_POST['pais'] . '</li>
                            <li class="list-group-item ticketComp">Estado: ' . $_POST['estado'] . '</li>
                            <li class="list-group-item ticketComp">Municipio: ' . $_POST['muni'] . ' </li>
                            <li class="list-group-item ticketComp">Direccion: ' . $direccion . ' </li>
                            <li class="list-group-item ticketComp">Numero de telefono: ' . $_POST['tel'] . ' </li>
                            <li class="list-group-item ticketComp">Codigo Postal: ' . $_POST['CP'] . ' </li>
                            <li class="list-group-item ticketComp">CONCEPTO: DULCERIA </li>
                            <li class="list-group-item ticketComp">Modo de Pago: ' . $_POST['metodo'] . ' </li>';
            for ($i = 0; $i < count($_SESSION['carrito']); $i++) {
                $sql = "SELECT nombreProducto,precio FROM productos WHERE idProducto=" . $_SESSION['carrito'][$i][0];
                $resultado = $conexion->query($sql);
                if ($fila = $resultado->fetch_assoc()) {
                    $precio = ($_SESSION['carrito'][$i][1]) ? $_SESSION['carrito'][$i][1] : $fila['precio'];
                    echo '<li class="list-group-item ticketComp">Producto: ' . $fila['nombreProducto'] . '   Precio: $' . $precio . ' Cantidad: ' . $_SESSION['carrito'][$i][2] . '</li>';
                }
            }
            echo '<li class="list-group-item ticketComp">Total a pagar: $' . $totalPagar . ' </li>
                            <li class="list-group-item ticketComp">Gastos de envio: $' . $gastos . ' </li>
                            <li class="list-group-item ticketComp">Cupon: ' . $cupon . ' </li>
                            <li class="list-group-item ticketComp">IVA: ' . $iva . ' </li>
                            <li class="list-group-item ticketComp">Descuento: ' . $descuento . '</li>
                            <li class="list-group-item ticketComp h2">TOTAL FINAL: <b>$' . $totDesc . '</li>
                            </ul>
                            <a href="consultas.php" class="btn btn-secondary btn-lg btn-block" role="button" aria-pressed=true">Regresar a la tienda</a>
                        </div>';
            for ($i = 0; $i < count($_SESSION['carrito']); $i++) {
                $sql = "SELECT existencia FROM productos WHERE idProducto=" . $_SESSION['carrito'][$i][0];
                $resultado = $conexion->query($sql);
                if ($fila = $resultado->fetch_assoc()) {
                    $existencia = $fila['existencia'];
                    $existencia -= $_SESSION['carrito'][$i][2];
                    if ($existencia < 0) $existencia = 0;
                    echo "<script>console.log(" . $existencia . ");</script>";
                    $sql = "UPDATE productos SET existencia=" . $existencia . " WHERE idProducto=" . $_SESSION['carrito'][$i][0] . ";";
                    $conexion->query($sql);
                }
            }
            unset($_SESSION['carrito']);
        } catch (Exception $e) {
            echo $mail->ErrorInfo;
        }
        echo "</div>";
    }
    ?>
</body>