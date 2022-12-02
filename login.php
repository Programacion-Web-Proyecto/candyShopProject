<head>
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Inciar Sesion</title>
</head>

<body class="all">
    <?php

    include "navbar.php";
    date_default_timezone_set('America/Mexico_City');
    echo "Ultima actualizacion: " . date("F d Y H:i:s.", filemtime(__FILE__));


    if (!$_SESSION['acceso']) {
        # code...

        echo "<div class='contenido' id='part1'>";

        if (!empty($_COOKIE["captcha"]) && $_COOKIE["captcha"] == sha1($_POST["respuesta"])) {
            echo "<br> Captcha Correcto<br><br>";
            $servidor = ':33065';
            $cuenta = 'root';
            $password = '';
            $bd = 'candy_info';

            //conexion a la base de datos
            $conexion = new mysqli($servidor, $cuenta, $password, $bd);

            if ($conexion->connect_errno) {
                die('Error en la conexion');
            } else {
                //DATOS DEL FORMULARIO
                $band = 0; //para saber si la cuenta y contrasena estan en el archivo

                $nomUsr = $_POST["usuario"];
                $pass = hash('sha512', $_POST["password"]);

                $contB = 0;
                $bloqueo = false;
                $sql = $conexion->prepare("select * from usuarios WHERE nombreUsr =? AND contrasena=?"); //hacemos cadena con la sentencia mysql que consulta todo el contenido de la tabla
                $sql->bind_param('ss', $nomUsr, $pass);
                $sql->execute();

                $resultado = $sql->get_result(); //aplicamos sentencia


                if ($fila = $resultado->fetch_assoc()) {
                    $bloqueo = $fila['bloqueo'];
                    $contAUX = $fila['contadorB'];
                    $nuevaContra = $fila['nuevaContra'];
                    echo $fila['bloqueo'];

                    if (!$bloqueo) {
                        echo "NO ";
                        if ($contAUX != 0) {
                            $contAUX = 0;
                            $sql = $conexion->prepare("UPDATE usuarios set contadorB=? WHERE nombreUsr=?"); //hacemos cadena con la sentencia mysql que consulta todo el contenido de la tabla
                            $sql->bind_param('ss', $contAUX, $nomUsr);
                            $sql->execute();

                            // $res = $conexion->query($sql); //aplicamos sentencia
                        }

                        if ($nuevaContra) {
                            setcookie("usr", $nomUsr, time() + 60 * 24 * 30);
                            header("Location: nuevaContraForm.php");
                        } else {
                            $band = 1;
                        }
                    } else {
                        echo "SI ";
                        header("Location: cuentaBloqueo.php");
                    }
                } else {
                    //INICIAMOS EL CONTADOR DE BLOQUEO DE CUENTA
                    echo "CONTRASENA INCORRECTA" . "<br>";
                    // echo '<br>'.$pass.'<br>';
                    $sql = $conexion->prepare("select * from usuarios WHERE nombreUsr =?"); //hacemos cadena con la sentencia mysql que consulta todo el contenido de la tabla
                    $sql->bind_param('s', $nomUsr);
                    $sql->execute();

                    $resultado2 = $sql->get_result(); //aplicamos sentencia

                    if ($fila = $resultado2->fetch_assoc()) {

                        //recorremos los registros obtenidos de la tabla
                        // $contB = intval($fila['contadorB'], 10);
                        $contB = $fila['contadorB'];
                        echo $fila['contadorB'];

                        echo $contB . "<br>";
                        $contB++;
                        echo $contB;
                        $sql = $conexion->prepare("UPDATE usuarios set contadorB=? WHERE nombreUsr=?"); //hacemos cadena con la sentencia mysql que consulta todo el contenido de la tabla
                        $sql->bind_param('ss', $contB, $nomUsr);
                        $sql->execute();


                        if ($contB >= 3) {
                            $bloqueo = true;
                            $sql = $conexion->prepare("UPDATE usuarios set bloqueo=? WHERE nombreUsr=?"); //hacemos cadena con la sentencia mysql que consulta todo el contenido de la tabla
                            $sql->bind_param('ss', $bloqueo, $nomUsr);
                            $sql->execute();
                            echo "CUENTA BLOQUEADA";
                            header("Location: cuentaBloqueo.php");
                        } else {
                            header("Location: errorLog.php");
                        }
                    } else {
                        header("Location: errorLog.php");
                    }
                }
            }



            # Luego de haber obtenido los valores, ya podemos comprobar:
            //ADMIN
            if ($band == 1 && $user == 'ADMIN') {
                session_start();
                $_SESSION["admin"] = true;
                $_SESSION["acceso"] = true;
                $_SESSION["usuario"] = $nomUsr;

                //cookies
                if (!empty($_POST["remember"])) {
                    setcookie("username", $_POST["usuario"], time() + 30 * 60 * 24 * 30);
                    setcookie("password", $_POST["password"], time() + 30 * 60 * 24 * 30);
                } else {
                    setcookie("usuario", "");
                    setcookie("password", "");
                }
                header("Location: index.php");
                //USUARIO NORMAL
            } elseif ($band == 1) {
                session_start();
                if (!empty($_POST["remember"])) {
                    setcookie("username", $_POST["usuario"], time() + 3600);
                    setcookie("password", $_POST["password"], time() + 3600);
                } else {
                    setcookie("usuario", "");
                    setcookie("password", "");
                }
                $_SESSION["acceso"] = true;
                $_SESSION["usuario"] = $nomUsr;

                header("Location: index.php");
            } else {
                # No coinciden, asi  que simplemente imprimimos un
                # mensaje diciendo que es incorrecto
                $_SESSION["acceso"] = false;
                //nota: hacer el error log con AJAX 
                // header("Location: errorLog.php");
            }
        } else {
            echo "<div class='acceso'>
            <div class='alert alert-danger ' role='alert'>
                CAPTCHA INCORRECTO!
            </div>
    <a href='loginForm.php' class='btn btn-secondary btn-lg btn-block' role='button' aria-pressed=true'>Regresar</a>
        </div>";
        }
        echo "</div>";
    } else {
        header("Location: index.php");
    }
    ?>
</body>