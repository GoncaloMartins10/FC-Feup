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
    <title>Sócio | Estatisticas</title>
</head>

<?php
  session_start();

  if($_SESSION['num_socio']==null) 
    header("Location: ../comum/inicio.php");
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
                <a class="hvr-underline-from-left" href="encomendas_pessoais.php">Histórico de Encomendas</a>
                <a id="active" class="hvr-underline-from-left" href="estatisticas_pessoais.php">Estatísticas</a>
        </div>

        <div class="content center">

            <?php if(empty($produto['nome'])){ ?> 
                <img src="../../images/empty-search.png">
                <h3>Ainda não comprou nenhum produto!</h3>
            <?php } else { ?> 
    
                <script type="text/javascript">
                    google.charts.load("current", {packages:["corechart"]});
                    google.charts.setOnLoadCallback(drawChart);
                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                        ['Task', 'Hours per Day'],
                        <?php while(isset($produto['nome'])){ ?>
                            ["<?php echo $produto['nome']; ?>", <?php echo $produto['unidades_compradas'];?>],
                            
                            <?php $produto = pg_fetch_assoc($Compras); } ?>
                        ]);

                        var options = {
                            titleTextStyle: {                                           
                                                color: '#284b63',    // any HTML string color ('red', '#cc00cc')                                        
                                                fontName: 'Nunito', // i.e. 'Times New Roman'
                                                fontSize: 25, // 12, 18 whatever you want (don't specify px)
                                                bold: true,    // true or false
                                            },
                            title: "Produtos Comprados",
                            is3D: true
                        };
                        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                        chart.draw(data, options);
                    }
                </script>

                <div id="piechart_3d" style="width: 900px; height: 450px;"></div>

            <?php } ?>
        </div>
    </main>


    <?php 
        include '../../includes/footer.html';
        include '../../includes/modal_login.php';
     ?>

</body>

</html>