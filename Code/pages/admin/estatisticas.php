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

  if($_SESSION['admin'] != "t") 
    header("Location: ../comum/inicio.php");
?>

<body>

    <?php
        include "../../includes/opendb.php";
        include "../../includes/header.php";
        include "../../database/linha_encomenda.php";

        $vendasProduto = getVendasProduto();
        $produto = pg_fetch_assoc($vendasProduto);

        $vendasDiarias = getVendasDiarias();
        $vendas = pg_fetch_assoc($vendasDiarias);

        pg_close($conn);
    ?>

   
    <main>
        <div class="sidenav">
            <a class="hvr-underline-from-left" href="sociopendente.php">Pedidos de Sócio Pendentes</a>
            <a class="hvr-underline-from-left" href="novoproduto.php">Adicionar Produto</a>
            <a class="hvr-underline-from-left" href="removeproduto.php">Remover/Editar Produto</a>
            <a class="hvr-underline-from-left" href="novojogador.php">Adicionar Jogador</a>
            <a class="hvr-underline-from-left" href="removemembro.php">Remover Membro</a>
            <a class="hvr-underline-from-left" href="encomendas.php">Histórico Encomendas</a>
            <a id="active" href="estatisticas.php">Estatísticas Vendas</a>
        </div>

        <div class="content center">
 
            <script type="text/javascript">
                google.charts.load("current", {packages:["corechart"]});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ["Produto", "Quantidade", { role: "style" } ],
                        <?php while(isset($produto['nome'])){ ?>
                            ["<?php echo $produto['nome']; ?>", <?php echo $produto['unidades_vendidas']; ?>, "#284b63"],
                        
                        <?php $produto = pg_fetch_assoc($vendasProduto); } ?>
                    ]);

                    var view = new google.visualization.DataView(data);
                    var options = {
                        titleTextStyle: {
                                            color: '#284b63',    // any HTML string color ('red', '#cc00cc')
                                            fontName: 'Nunito', // i.e. 'Times New Roman'
                                            fontSize: 25, // 12, 18 whatever you want (don't specify px)
                                            bold: true,    // true or false
                                        },
                        title: "Unidades Vendidas por Produto",
                        animation: {
                                duration: 3000,
                                easing: 'out',
                                startup: true
                                },
                        width: 900,
                        height: 500,
                        bar: {groupWidth: "95%"},
                        legend: { position: "none" },
                    };
                    

                    var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
                    chart.draw(view, options);
                }
            </script>
            <div id="barchart_values" ></div>

            <script type="text/javascript">
                google.charts.load('current', {packages: ['corechart', 'line']});
                google.charts.setOnLoadCallback(drawBasic);
                function drawBasic() {
                    var data = new google.visualization.DataTable();
                    data.addColumn('string', 'X');
                    data.addColumn('number', 'Vendas');

                    data.addRows([<?php while(isset($vendas['dia'])){ ?>
                        ["<?php echo $vendas['dia']; ?>", <?php echo $vendas['receita']; ?>],
                        <?php $vendas = pg_fetch_assoc($vendasDiarias); } ?>
                    ]);

                    var options = {
                                    titleTextStyle: {                                           
                                            color: '#284b63',    // any HTML string color ('red', '#cc00cc')                                        
                                            fontName: 'Nunito', // i.e. 'Times New Roman'
                                            fontSize: 25, // 12, 18 whatever you want (don't specify px)
                                            bold: true,    // true or false
                                        },
                                    title: "Vendas Diárias",
                                    pointSize: 5,
                                    animation: {
                                        duration: 2000,
                                        easing: 'inAndOut',
                                        startup: true
                                    },
                                    width: 900,
                                    height: 500,                                   
                                    hAxis: {
                                            title: 'Data'
                                           },
                                    vAxis: {
                                            format: "#,### €",
                                            title: 'Lucro (€)'
                                           }
                    };

                    var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
                    var formatter = new google.visualization.NumberFormat({
                        suffix: '€'
                    });
                    formatter.format(data, 1);

                    chart.draw(data, options);
                }

            </script>
            <div id="chart_div"></div>

        </div>
    </main>


    <?php 
        include '../../includes/footer.html';
        include '../../includes/modal_login.php';
     ?>

</body>

</html>