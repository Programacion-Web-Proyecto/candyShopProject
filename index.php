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
    <!-- CARRUSEL -->
    <br />
    <div class="CARROUSEL">
        <div class="carrousel">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="media/anuncio1.webp" alt="..." />
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="media/anuncio2.png" alt="..." />
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="media/anuncio3.png" alt="..." />
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-target="#carouselExampleIndicators" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </button>
            </div>
        </div>
    </div>
    <br />
    <div class="cont1">
        <h2>Por temporada navideña tenemos un regalo para ti!</h2><br>
        <div class="cont2" id="regalo">

            <button type="button" class="btnCupon" onclick="sorpresa()"><img src="media/liston.png" alt=""></button>

        </div>

    </div>
    <br>
    <div class="contenedor">
        <div class="cont">
            <div class="card card1" style="width: 16rem;">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-solid fa-credit-card iconos"></i></h5>
                    <p class="card-text"> Contamos con varios métodos de pago</p>
                </div>
            </div>
            <div class="card card2" style="width: 16rem;">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-solid fa-box iconos"></i></h5>
                    <p class="card-text"> Ventas por mayoreo (Personalizadas)</p>
                </div>
            </div>
            <div class="card card3" style="width: 16rem;">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-solid fa-truck iconos"></i></h5>
                    <p class="card-text"> Envíos Rápidos y Seguros </p>
                </div>
            </div>
            <div class="card card4" style="width: 16rem;">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-solid fa-tag iconos"></i></h5>
                    <p class="card-text"> Productos nuevos cada semana</p>
                </div>
            </div>
        </div>
    </div>
    <br />


    <script>
        function sorpresa() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("regalo").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "cupones.php", true);
            xhttp.send();
        }
    </script>


    <?php
    include "html/footer.html";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    function correoSuscrip($correo)
    {

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
            
            // $mail->Body = 'Gracias por su suscripcion a nuestra gran familia, CandyShopMx le agradece con un cupon de descuento por nuevo usuario!
            //  :WELCOMEFAMILY22 
            //  Embedded Image: <img alt="PHPMailer" src="cid:my-attach"> ';
            $mail->AddEmbeddedImage("cuponSus.png", "my-attach", "cuponSus.png");
            $mail->Body = 'Embedded Image: <img alt="PHPMailer" src="cid:my-attach"> Here is an image!';
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