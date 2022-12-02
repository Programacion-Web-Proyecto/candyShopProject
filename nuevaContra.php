<head>
<link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Inciar Sesion</title>
    <link rel="icon" type="image/x-icon" href="favicon_logo.ico" />
    <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="js/desbloqueo.js"></script>
</head>
<body class="all">

    <?php
    include "navbar.php";
    date_default_timezone_set('America/Mexico_City');
    echo "Ultima actualizacion: " . date("F d Y H:i:s.", filemtime(__FILE__));
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

        //obtenemos datos del formulario
        $nomUsr = $_COOKIE['usr'];
        //eliminamos la cookie
        setcookie("usr", "", time() - 61 * 24 * 30);
        $pass = hash('sha512', $_POST["password"]);
        $nuevaContra = false;

        //ANTES DE REGISTRAR, BUSCAMOS SI EL USUARIO NO EXISTE 
        //hacemos cadena con la sentencia mysql para insertar datos
        $sql = $conexion->prepare("UPDATE usuarios set contrasena=?,nuevaContra=? WHERE nombreUsr=?"); //hacemos cadena con la sentencia mysql que consulta todo el contenido de la tabla

        $sql->bind_param('sss', $pass, $nuevaContra, $nomUsr);
        $sql->execute();
        $resultado2 = $sql->get_result();  //aplicamos sentencia que inserta datos en la tabla usuarios de la base de datos
        echo "<div class='acceso'>
                            <div class='alert alert-success ' role='alert'>
                                SE CAMBIO LA CONTRASEÑA!
                            </div>
                            <a href='loginForm.php' class='btn btn-secondary btn-lg btn-block' role='button' aria-pressed=true'>INICIAR SESION</a>
                        </div>";
    }
    echo "</div>";
    ?>

</body>