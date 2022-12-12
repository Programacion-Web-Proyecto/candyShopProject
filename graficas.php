<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GRAFICAS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />
    <link rel="icon" type="image/x-icon" href="favicon.ico" />

    <style>
        body {
            background-color: #151515;
            color: #fff;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
</head>
<?php
session_start(); //para poder hacer uso de las varaibles sesion 

if (($_SESSION["acceso"]) && $_SESSION["admin"]) {
    include "navbar.php";
    $servidor = 'localhost:3307';
    // $servidor = 'localhost:33065';
    $cuenta = 'root';
    $password = '';
    $bd = 'tienda2';

    $conexion = new mysqli($servidor, $cuenta, $password, $bd);

    if ($conexion->connect_errno) {
        die('Error en la conexion');
    } else {
        $sql = "select nombreProducto,ventas from productos where categoria='Chocolates'";
        $resultado = $conexion->query($sql);
        if ($resultado->num_rows) {
            $data = array();
            $products = array();
            $sales = array();
            $colores = array();
            while ($fila = $resultado->fetch_assoc()) {
                $data[$fila['nombreProducto']] = $fila['ventas'];
            }
            arsort($data);
            $letters = array('6', '5', '6', 'd', 'e', 'f');
            foreach ($data as $key => $value) {
                array_push($products, $key);
                array_push($sales, $value);
                $color = "#";
                for ($i = 0; $i < 6; $i++) {
                    $color .= $letters[rand(0, 5)];
                }
                array_push($colores, $color);
            }
        } else {
            echo "no hay datos";
        }
        $sql = "SELECT categoria,SUM(ventas) AS ventasCat FROM productos GROUP BY categoria";
        $resultado = $conexion->query($sql);
        if ($resultado->num_rows) {
            // $data = array();
            $products2 = array();
            $sales2 = array();
            while ($fila = $resultado->fetch_assoc()) {
                // $data[$fila['nombreProducto']] = $fila['ventas'];
                array_push($products2, $fila['categoria']);
                array_push($sales2, $fila['ventasCat']);
            }
            // arsort($data);
            // foreach ($data as $key => $value) {
            // }
        } else {
            echo "no hay datos";
        }
    }
?>

    <body>
        <br>
        <div>
            <canvas id="barras" height="600px"></canvas>
        </div>
        <br>
        <div>
            <canvas id="pastel" height="600px"></canvas>
        </div>
        <br>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            Chart.defaults.color = '#FFF';
            Chart.defaults.font.family = "'Montserrat', sans-serif";
            Chart.defaults.font.size = 15;
            const ctx = document.getElementById('barras');
            var products = <?php echo json_encode($products); ?>;
            var sales = <?php echo json_encode($sales); ?>;
            var colores = <?php echo json_encode($colores); ?>;
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: products,
                    datasets: [{
                        data: sales,
                        borderWidth: 0,
                        backgroundColor: colores
                    }]

                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        title: {
                            display: true,
                            text: "Ventas de los productos de la categoría Chocolates",
                            font: {
                                size: 25
                            }
                        },
                        legend: {
                            display: false
                        }
                    }
                }
            });
            const ctx2 = document.getElementById('pastel');
            var products2 = <?php echo json_encode($products2); ?>;
            var sales2 = <?php echo json_encode($sales2); ?>;
            new Chart(ctx2, {
                type: 'pie',
                data: {
                    labels: products2,
                    datasets: [{
                        label: 'Ventas de la categoría',
                        data: sales2,
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        title: {
                            display: true,
                            text: "Ventas por categoría",
                            font: {
                                size: 25
                            }
                        }
                    }
                }
            });
        </script>
    </body>
<?php include 'html/footer.html';
} else {
    header("Location:index.php");
} ?>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>

</html>