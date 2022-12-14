<head>
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Correo Enviado!</title>
</head>

<body class="all">
    <?php
    include "navbar.php";
    date_default_timezone_set('America/Mexico_City');
    echo "Ultima actualizacion: " . date("F d Y H:i:s.", filemtime(__FILE__));

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'recursos/PHPMailer/src/PHPMailer.php';
    require 'recursos/PHPMailer/src/SMTP.php';
    require 'recursos/PHPMailer/src/Exception.php';

    $mail = new PHPMailer(true);
    echo "<div class='contenido' id='part1'>";
    try {


        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;

        $mail->Username = 'wichotl64@gmail.com';
        $mail->Password   = 'ipubwtvrhzyyqhly';

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('wichotl64@gmail.com', 'Candy Shop Mx');
        $mail->addAddress($_POST['email'], 'Actividad correo');

        $mail->addCC($_POST['email']);

        $mail->isHTML(true);

        $mail->Subject = 'Actividad Correo';

        $mail->Body = 'Gracias por su mensaje, CandyShopMx le informa que será atendido con brevedad!';

        $mail->send();

        // echo 'Correo electronico enviado con exito';
        echo "<div class='acceso'>
                            <div class='alert alert-success ' role='alert'>
                                CORREO ENVIADO!
                            </div>
                            <a href='contacto.php' class='btn btn-secondary btn-lg btn-block' role='button' aria-pressed=true'>REGRESAR</a>
                        </div>";
    } catch (Exception $e) {
        echo $mail->ErrorInfo;
    }
    echo "</div>";
    ?>
</body>