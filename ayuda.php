<html>


<head>
    <link rel="stylesheet" href="css/style5.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Preguntas Frecuentes</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico" />

</head>


<body class="all">
    <?php
    include "navbar.php";
    date_default_timezone_set('America/Mexico_City');
    echo "Ultima actualizacion: " . date("F d Y H:i:s.", filemtime(__FILE__));
    ?>
    <div class="contenedor">
        <div class="cont1">
            <header class="header">
                <h2>Preguntas Frecuentes</h2>
            </header>
            <div class="cont1">
                <div class="categorias" id="categorias">
                    <div class="categoria activa" data-categoria="metodos-pago">
                        <svg viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
                            <path d="M21.19 7h2.81v15h-21v-5h-2.81v-15h21v5zm1.81 1h-19v13h19v-13zm-9.5 1c3.036 0 5.5 2.464 5.5 5.5s-2.464 5.5-5.5 5.5-5.5-2.464-5.5-5.5 2.464-5.5 5.5-5.5zm0 1c2.484 0 4.5 2.016 4.5 4.5s-2.016 4.5-4.5 4.5-4.5-2.016-4.5-4.5 2.016-4.5 4.5-4.5zm.5 8h-1v-.804c-.767-.16-1.478-.689-1.478-1.704h1.022c0 .591.326.886.978.886.817 0 1.327-.915-.167-1.439-.768-.27-1.68-.676-1.68-1.693 0-.796.573-1.297 1.325-1.448v-.798h1v.806c.704.161 1.313.673 1.313 1.598h-1.018c0-.788-.727-.776-.815-.776-.55 0-.787.291-.787.622 0 .247.134.497.957.768 1.056.344 1.663.845 1.663 1.746 0 .651-.376 1.288-1.313 1.448v.788zm6.19-11v-4h-19v13h1.81v-9h17.19z" />
                        </svg>
                        <p>Métodos de pago</p>
                    </div>
                    <div class="categoria" data-categoria="entregas">
                        <svg viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
                            <path d="M7 24h-5v-9h5v1.735c.638-.198 1.322-.495 1.765-.689.642-.28 1.259-.417 1.887-.417 1.214 0 2.205.499 4.303 1.205.64.214 1.076.716 1.175 1.306 1.124-.863 2.92-2.257 2.937-2.27.357-.284.773-.434 1.2-.434.952 0 1.751.763 1.751 1.708 0 .49-.219.977-.627 1.356-1.378 1.28-2.445 2.233-3.387 3.074-.56.501-1.066.952-1.548 1.393-.749.687-1.518 1.006-2.421 1.006-.405 0-.832-.065-1.308-.2-2.773-.783-4.484-1.036-5.727-1.105v1.332zm-1-8h-3v7h3v-7zm1 5.664c2.092.118 4.405.696 5.999 1.147.817.231 1.761.354 2.782-.581 1.279-1.172 2.722-2.413 4.929-4.463.824-.765-.178-1.783-1.022-1.113 0 0-2.961 2.299-3.689 2.843-.379.285-.695.519-1.148.519-.107 0-.223-.013-.349-.042-.655-.151-1.883-.425-2.755-.701-.575-.183-.371-.993.268-.858.447.093 1.594.35 2.201.52 1.017.281 1.276-.867.422-1.152-.562-.19-.537-.198-1.889-.665-1.301-.451-2.214-.753-3.585-.156-.639.278-1.432.616-2.164.814v3.888zm3.79-19.913l3.21-1.751 7 3.86v7.677l-7 3.735-7-3.735v-7.719l3.784-2.064.002-.005.004.002zm2.71 6.015l-5.5-2.864v6.035l5.5 2.935v-6.106zm1 .001v6.105l5.5-2.935v-6l-5.5 2.83zm1.77-2.035l-5.47-2.848-2.202 1.202 5.404 2.813 2.268-1.167zm-4.412-3.425l5.501 2.864 2.042-1.051-5.404-2.979-2.139 1.166z" />
                        </svg>
                        <p>Entregas</p>
                    </div>
                    <div class="categoria" data-categoria="seguridad">
                        <svg viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
                            <path d="M12 0c-3.371 2.866-5.484 3-9 3v11.535c0 4.603 3.203 5.804 9 9.465 5.797-3.661 9-4.862 9-9.465v-11.535c-3.516 0-5.629-.134-9-3zm0 1.292c2.942 2.31 5.12 2.655 8 2.701v10.542c0 3.891-2.638 4.943-8 8.284-5.375-3.35-8-4.414-8-8.284v-10.542c2.88-.046 5.058-.391 8-2.701zm5 7.739l-5.992 6.623-3.672-3.931.701-.683 3.008 3.184 5.227-5.878.728.685z" />
                        </svg>
                        <p>Seguridad</p>
                    </div>
                    <div class="categoria" data-categoria="cuenta">
                        <svg viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
                            <path d="M9.484 15.696l-.711-.696-2.552 2.607-1.539-1.452-.698.709 2.25 2.136 3.25-3.304zm0-5l-.711-.696-2.552 2.607-1.539-1.452-.698.709 2.25 2.136 3.25-3.304zm0-5l-.711-.696-2.552 2.607-1.539-1.452-.698.709 2.25 2.136 3.25-3.304zm10.516 11.304h-8v1h8v-1zm0-5h-8v1h8v-1zm0-5h-8v1h8v-1zm4-5h-24v20h24v-20zm-1 19h-22v-18h22v18z" />
                        </svg>
                        <p>Cuenta</p>
                    </div>
                </div>
            </div>

                    <div class="preguntas">

                    <!-- Preguntas Metodos de pago -->
                    <div class="contenedor-preguntas activo" data-categoria="metodos-pago">
                        <div class="contenedor-pregunta">
                            <p class="pregunta">¿Cuáles son los métodos de pagos que tienen disponibles? <img src="./img/suma.svg" alt="Abrir Respuesta" /></p>
                            <p class="respuesta">Contamos con pagos por tarjeta (MASTERCARD O VISA) además de pagos mediante OXXO</p>
                        </div>
                        <div class="contenedor-pregunta">
                            <p class="pregunta">¿Mi pago es seguro? <img src="./img/suma.svg" alt="Abrir Respuesta" /></p>
                            <p class="respuesta">Su pago es 100% seguro.</p>
                        </div>
                    </div>

                    <!-- Preguntas Entregas -->
                    <div class="contenedor-preguntas" data-categoria="entregas">
                        <div class="contenedor-pregunta">
                            <p class="pregunta">¿Cuentan con envió a domicilio? <img src="./img/suma.svg" alt="Abrir Respuesta" /></p>
                            <p class="respuesta">Claro, contamos con envios nacionales e internacionales</p>
                        </div>
                        <div class="contenedor-pregunta">
                            <p class="pregunta">¿Cuál es el costo de envio a nivel nacional (MX)? <img src="./img/suma.svg" alt="Abrir Respuesta" /></p>
                            <p class="respuesta">Es costo de envio promedio a nivel nacional es de $100. Si gastas más de $500 tu envio es gratis.</p>
                        </div>
                    </div>

                    <!-- Preguntas Seguridad -->
                    <div class="contenedor-preguntas" data-categoria="seguridad">
                        <div class="contenedor-pregunta">
                            <p class="pregunta">¿Como puedo saber si son confiables? <img src="./img/suma.svg" alt="Abrir Respuesta" /></p>
                            <p class="respuesta">Nuestras referencias en clientes nos respaldan.</p>
                        </div>
                        <div class="contenedor-pregunta">
                            <p class="pregunta">¿Que pasa con mis datos personales? <img src="./img/suma.svg" alt="Abrir Respuesta" /></p>
                            <p class="respuesta">No se utilizaran para ningun otro tipo de información que no sea relacionada con tu pedido.</p>
                        </div>
                    </div>

                    <!-- Preguntas Cuenta -->
                    <div class="contenedor-preguntas" data-categoria="cuenta">
                        <div class="contenedor-pregunta">
                            <p class="pregunta">¿Como puedo ver mis pedidos realizados? <img src="./img/suma.svg" alt="Abrir Respuesta" /></p>
                            <p class="respuesta">En la nota de compra puedes ver tus pedidos realizados.</p>
                        </div>
                        <div class="contenedor-pregunta">
                            <p class="pregunta">¿Como puedo cambiar mi contraseña? <img src="./img/suma.svg" alt="Abrir Respuesta" /></p>
                            <p class="respuesta">En la parte de modificar contraseña.</p>
                        </div>
                    </div>
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

    <script src="js/categorias.js"></script>
    <script src="js/preguntasFrecuentes.js"></script>
</body>

</html>