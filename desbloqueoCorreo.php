<head>
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Desbloqueo</title>
    <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="js/desbloqueo.js"></script>
</head>

<body class="all">
    <?php
    include "navbar.php";
    date_default_timezone_set('America/Mexico_City');
    echo "Ultima actualizacion: " . date("F d Y H:i:s.", filemtime(__FILE__));



    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    $servidor = ':33065';
    $cuenta = 'root';
    $password = '';
    $bd = 'candy_info';

    //conexion a la base de datos
    $conexion = new mysqli($servidor, $cuenta, $password, $bd);
    echo "<div class='contenido' id='part1'>";
    if ($conexion->connect_errno) {
        die('Error en la conexion');
    } else {
        function randomText($length)
        {
            $key = "";
            $pattern = "1234567890abcdefghijklmnopqrstuvwxyz!@+*%$#";
            for ($i = 0; $i < $length; $i++) {
                $key .= $pattern[rand(0, 42)];
            }
            return $key;
        }
        $newPass = randomText(8);
        $newPassEn = hash('sha512', $newPass);

        $nomUsr = $_POST["usuario"];
        $correo = $_POST["usuario"];
        $sql = $conexion->prepare("select * from usuarios WHERE nombreUsr =?"); //hacemos cadena con la sentencia mysql que consulta todo el contenido de la tabla
        $sql->bind_param('s', $nomUsr);
        $sql->execute();

        $resultado = $sql->get_result(); //aplicamos sentencia


        if ($fila = $resultado->fetch_assoc()) {

            $bloqueo = $fila['bloqueo'];

            if ($bloqueo) {
                //CAMIAMOS LA CONTRASEÑA 

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

                    $mail->setFrom('wichotl64@gmail.com', 'Candy Shop');
                    $mail->addAddress($_POST['email'], $nomUsr);

                    $mail->addCC($_POST['email']);

                    $mail->isHTML(true);

                    $mail->Subject = 'Cambio Contrasena';

                    $mail->Body = "Gracias por su mensaje, Su nueva contrasena es:
                                '$newPass'";
                    $bloqueo = false;
                    $nuevaContra = true;
                    $contB = 0;
                    $mail->send();
                    $sql = $conexion->prepare("UPDATE usuarios set contrasena=?,bloqueo=?,contadorB=?,nuevaContra=? WHERE nombreUsr=?"); //hacemos cadena con la sentencia mysql que consulta todo el contenido de la tabla
                    $sql->bind_param('sssss', $newPassEn, $bloqueo, $contB, $nuevaContra, $nomUsr);
                    $sql->execute();
                    echo "<div class='acceso'>
                            <div class='alert alert-success ' role='alert'>
                                CORREO ENVIADO!
                            </div>
                            <a href='loginForm.php' class='btn btn-secondary btn-lg btn-block' role='button' aria-pressed=true'>INICIAR SESION</a>
                        </div>";
                } catch (Exception $e) {
                    echo $mail->ErrorInfo;
                }
            } else {
                echo "<div class='acceso'>
            <div class='alert alert-danger ' role='alert'>
                ESTA CUENTA NO ESTÁ BLOQUEADA!
            </div>
    <a href='loginForm.php' class='btn btn-secondary btn-lg btn-block' role='button' aria-pressed=true'>Regresar</a>
        </div>";
            }
        } else {
            // echo "No se encontro usuario";
            echo "<div class='acceso'>
            <div class='alert alert-danger ' role='alert'>
                NO SE ENCONTRO USUARIO!
            </div>
    <a href='cuentaBloqueo.php' class='btn btn-secondary btn-lg btn-block' role='button' aria-pressed=true'>Regresar</a>
        </div>";
        }
    }
    echo "</div>";
    ?>

    <?php
    include "html/footer.html";
    ?>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</body>

<body>

</body>