<html>


<head>
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Registro</title>
    <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="js/registro.js"></script>
</head>


<body class="all">
    <?php
    include "navbar.php";
    date_default_timezone_set('America/Mexico_City');
    echo "Ultima actualizacion: " . date("F d Y H:i:s.", filemtime(__FILE__));
    ?>
    <div class="contenido">
        <!-- <h2>Registrate</h2> <br> -->

        <div class="acceso">
            <form action="regisBD.php" method="post">
              
                <div class="form-group">
                    <label for="exampleInputEmail1">Nombre de Usuario</label>
                    <input type="text" class="form-control" id="usuario" name="usuario" aria-describedby="emailHelp" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Correo Electronico</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    <div id="error1"></div>
                </div>
                <div class="form-group">
                    <label for="exampleInputPasswordConf">Vuelve a ingresar la Contraseña</label>
                    <input type="password" class="form-control" id="password2" name="password2" required>
                    <div id="error2"></div>
                </div>
                <button id="regis" type="submit" class="btn btn-primary">Registrate</button>

            </form>
        </div>
    </div>
    <?php
    include "html/footer.html";

    ?>
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</body>

</html>