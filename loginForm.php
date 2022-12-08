<html>


<head>
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Inciar Sesion</title>
    <link rel="icon" type="image/x-icon" href="favicon_logo.ico" />
    <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="js/captchaJ.js"></script>
</head>


<body class="all">
    <?php
    include "navbar.php";
    date_default_timezone_set('America/Mexico_City');
    echo "Ultima actualizacion: " . date("F d Y H:i:s.", filemtime(__FILE__));
    if (!$_SESSION['acceso']) {


    ?>
        <div class="contenido">
            <!-- <h2>Iniciar Sesion</h2> -->

            <div class="acceso">
                <form action="login.php" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Usuario</label>
                        <input type="text" class="form-control" id="usuario" name="usuario" aria-describedby="emailHelp" required value="<?php if (isset($_COOKIE["username"])) {
                                                                                                                                                echo $_COOKIE["username"];
                                                                                                                                            } ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required value="<?php if (isset($_COOKIE["password"])) {
                                                                                                                        echo $_COOKIE["password"];
                                                                                                                    } ?>">
                    </div>
                    <div class="form-group">

                        Ingresa el texto: <br>
                        <img src="captcha.php" alt="">
                        <button class="btn btn-secondary" id="recargar">RECARGAR</button>
                        <br><br><input type="text" name="respuesta" size="6">

                    </div>



                    <div class="form-group">
                        <p>
                            <input type="checkbox" name="remember"> Recordar usuario y password
                        </p>
                    </div>
                    <button type="submit" class="btn btn-danger">Login</button>
                    <small id="emailHelp" class="form-text text-muted">¿No tienes una cuenta? <a href="registerForm.php">Registrate</a> </small>
                </form>
            </div>
        </div>
    <?php
    include "html/footer.html";

    } else {
        header("Location: index.php");
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</body>

</html>