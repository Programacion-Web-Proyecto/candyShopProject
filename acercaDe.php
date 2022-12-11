<html>


<head>
    <!-- <link rel="stylesheet" href="css/style2.css"> -->
    <link rel="stylesheet" href="css/style4.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Sobre Nosotros</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico" />

</head>


<body class="all">
    <?php
    include "navbar.php";
    date_default_timezone_set('America/Mexico_City');
    echo "Ultima actualizacion: " . date("F d Y H:i:s.", filemtime(__FILE__));
    ?>
    <div class="contenedor">
        <h2>ACERCA DE NOSOTROS</h2>
        <div class="cont1">
            <header class="header">
                <h2> Somos una empresa 100% comprometida
                </h2>
            </header>
            <main class="contenido">
                <p>
                    <br><br>
                    CandyShop Mx es una cadena de dulcerías con amplio surtido, excelente sercivio y precios competitivos. Nos esforzamos para que nuestros clientes tengas la mejor experiencia de compra, accedan al mejor surtido de productos y aprovechen niestros precios y promociones.
                    <br><br>
                    Desde hace mas de 30 años somos mayoristas y trabajamos directamnte con fabricantes para llevarte los mejores precios y los productos mas novedosos. En nuestras tiendas encontraras mas de 1000 productos para surtur tu tienda, armas una fiesta, poner uan mesa de dulcs, comprar un regalo o simplemente satisfaces tus anotjos.
                </p>
            </main>
            <img class="image" src="media/tiendaImg.png" alt="Developer Academy">



        </div>
        <div class="cont2">
            <header class="header2">
                <h2>NUESTRA EMPRESA</h2>
            </header>
            <div class="card card1" style="width: 18rem;">
                <img src="media/imgMision.png" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">MISION</h5>
                    <p class="card-text"> Ser una empresa de dulcería que ofrece los mejores productos y al mejor precio.Buscando que los clientes se sientan satisfechos con nuestros productos, por su excelente calidad y su buena atención.</p>
                </div>
            </div>
            <div class="card card2" style="width: 18rem;">
                <img src="media/visionImg.webp" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">VISION</h5>
                    <p class="card-text"> Ser posicionados como el producto más vendido por la exelente calidad de nuestros productos.Abrir nuevas sucursales en diferentes ciudades para que más personas conozcan la calidad de nuestros productos.</p>
                </div>
            </div>
            <div class="card card3" style="width: 18rem;">
                <img src="media/valoresImg.webp" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">OBJETIVOS</h5>
                    <p class="card-text"> Llegar a una cifra de 250.000 clientes en año 2025.
                        Garantizar a nuestros clientes, productos de excelente calidad.
                        Hacer y vender productos innovadores, deliciosos y con bajo costo.
                        Generar fuente de trabajo para Aguascalientes.</p>
                </div>
            </div>
        </div>
    </div>

    <?php
    include "html/footer.html";
    ?>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</body>

</html>