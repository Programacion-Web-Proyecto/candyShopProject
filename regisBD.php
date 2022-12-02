

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
    $sql = $conexion->prepare("select * from usuarios WHERE nombreUsr =?"); //hacemos cadena con la sentencia mysql que consulta todo el contenido de la tabla
    $sql->bind_param('s', $nomUsr);
    $sql->execute();

    $resultado = $sql->get_result(); //aplicamos sentencia
    if ($fila = $resultado->fetch_assoc()) {
        header("Location: errorRegistro.php");
    } else {
        //hacemos cadena con la sentencia mysql para insertar datos
        $sql = $conexion->prepare("INSERT INTO usuarios (idUsr, nombreUsr, correo, contrasena,bloqueo,contadorB,nuevaContra) 
    VALUES(?,?,?,?,?,?,?)");
        $sql->bind_param('sssssss', $id, $nomUsr, $correo, $pass, $bloq, $contadorB, $nuevaContra);
        $sql->execute();
        $resultado2 = $sql->get_result();  //aplicamos sentencia que inserta datos en la tabla usuarios de la base de datos
        echo $resultado2; //revisamos que se inserto un registro
        header("Location: exitoRegistro.php");
    }
}
