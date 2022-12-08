<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>graficas en html con chartJs</title>
    <style>
        body {
            background-color: rgb(11, 11, 69);
            color: #fff;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
</head>
<?php

$servidor = 'localhost:3307';
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
    <div>
        <canvas id="barras" height="600px"></canvas>
    </div>
    <div>
        <canvas id="pastel" height="600px"></canvas>
    </div>

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

</html>