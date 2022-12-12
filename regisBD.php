<?php
$servidor = ':33065';
$cuenta = 'root';
$password = '';
$bd = 'candy_info';

//conexion a la base de datos
$conexion = new mysqli($servidor, $cuenta, $password, $bd);

if ($conexion->connect_errno) {
    die('Error en la conexion');
} else {

    //obtenemos datos del formulario
    $id = 0;
    $nomUsr = $_POST["usuario"];
    $correo = $_POST["email"];
    $pass = hash('sha512', $_POST["password"]);
    $bloq = false;
    $contadorB = 0;
    $nuevaContra = false;

    //ANTES DE REGISTRAR, BUSCAMOS SI EL USUARIO NO EXISTE 
    $sql = "select * from usuarios WHERE nombreUsr = '$nomUsr'"; //hacemos cadena con la sentencia mysql que consulta todo el contenido de la tabla
    $resultado = $conexion->query($sql); //aplicamos sentencia
    if ($resultado->num_rows) {
        header("Location: errorRegistro.php");
    } else {
        //hacemos cadena con la sentencia mysql para insertar datos
        $sql = "INSERT INTO usuarios (idUsr, nombreUsr, correo, contrasena,bloqueo,contadorB,nuevaContra) 
    VALUES('$id', '$nomUsr', '$correo', '$pass', '$bloq', '$contadorB', '$nuevaContra')";
        $conexion->query($sql);
        if ($conexion->affected_rows >= 1) { //revisamos que se inserto un registro
            echo $resultado2; //revisamos que se inserto un registro
            header("Location: exitoRegistro.php");
        }
    }
}
