<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TIENDA</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="css/style3.css" />
    <link rel="icon" type="image/x-icon" href="favicon.ico" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body>
    <?php
    //    error_reporting(E_ERROR);
    include "navbar.php";
    session_start();
    ?>
    <?php

    if (
        $_SESSION["acceso"]
    ) {
        //echo "HOLA SOLO TU PUEDES VER ESTO! ";
    }
    date_default_timezone_set('America/Mexico_City');
    echo "Ultima actualizacion: " . date("F d Y H:i:s.", filemtime(__FILE__));
    ?>
    <script>
        function entrada() {
            swal({
                title: "Suscribete ahora!",
                text: "Ingresa tu correo",
                content: "input",
                buttons: ["CANCELAR", "SUSCRIBIRME"],

            }).then((value) => {
                if (!value) throw null;
                var direccion = value;
                window.location.href = window.location.href + "?w1=" + direccion;
                // swal(`You typed: ${direccion}`);



            });
        }

        entrada();
    </script>


    <?php
    if (isset($_GET["w1"])) {
        $email = $_GET["w1"];
        correoSuscrip($email);

    } 
    ?>


    <?php
    include "html/footer.html";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    function correoSuscrip ($correo){
    
        require 'recursos/PHPMailer/src/PHPMailer.php';
        require 'recursos/PHPMailer/src/SMTP.php';
        require 'recursos/PHPMailer/src/Exception.php';
    
        $mail = new PHPMailer(true);
        try {
    
    
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
    
            $mail->Username = 'wichotl64@gmail.com';
            $mail->Password   = 'ipubwtvrhzyyqhly';
    
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
    
            $mail->setFrom('wichotl64@gmail.com', 'Candy Shop Mx');
            $mail->addAddress($correo, 'Gracias por suscribirte!');
    
            $mail->addCC($correo);
    
            $mail->isHTML(true);
    
            $mail->Subject = 'Gracias por suscribirte!';
    
            $mail->Body = 'Gracias por su suscripcion a nuestra gran familia, CandyShopMx le agradece con un cupon de descuento por nuevo usuario! :';
    
            $mail->send();
    
            // echo 'Correo electronico enviado con exito';
            header("Location: suscripcionExito.php");
           
        } catch (Exception $e) {
            echo $mail->ErrorInfo;
        }
    }
    






    ?>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</body>

</html>