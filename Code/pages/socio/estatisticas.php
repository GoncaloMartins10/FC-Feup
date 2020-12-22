<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/ef5be7179f.js" crossorigin="anonymous"></script> <!-- Icons library-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="shortcut icon" href="../../images/logo.png">
    <link rel="stylesheet" href="../../style/style.css">
    <link rel="stylesheet" href="../../style/style_admin.css">
    <title>FC FEUP | Admin</title>
</head>

<?php
  session_start();
?>

<body>

    <?php
        include "../../includes/opendb.php";
        include "../../includes/header.php";
        include "../../database/linha_encomenda.php";

        $Compras = getCompras($_SESSION['num_socio']);
        $produto = pg_fetch_assoc($Compras);

        pg_close($conn);
    ?>

   
    <main>
        <div class="sidenav">
                <a class="hvr-underline-from-left" href="socio_dados.php">Dados Pessoais</a>
                <a class="hvr-underline-from-left" href="encomendas.php">Histórico de Encomendas</a>
                <a id="active" class="hvr-underline-from-left" href="estatisticas.php">Estatísticas</a>
            </div>

            <div class="content center">
    
            <script type="text/javascript">
                google.charts.load("current", {packages:["corechart"]});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                    ['Task', 'Hours per Day'],
                    <?php while(isset($produto['nome'])){ ?>
                        ["<?php echo $produto['nome']; ?>", <?php echo $produto['unidades_vendidas'];?>],
                        
                        <?php $produto = pg_fetch_assoc($Compras); } ?>
                    ]);

                    var options = {
                    is3D: true,
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                    chart.draw(data, options);
                }
            </script>

            <h3>Produtos Comprados</h3>
            <div id="piechart_3d" style="width: 900px; height: 450px;"></div>
        </div>
    </main>


    <?php 
        include '../../includes/footer.html';
        include '../../includes/modal_login.html';
     ?>

</body>

</html>