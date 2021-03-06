<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/ef5be7179f.js" crossorigin="anonymous"></script> <!-- Icons library-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../../javascript/sort-table.js"></script>                                         <!-- Sort tables script -->
    <link rel="shortcut icon" href="../../images/logo.png">
    <link rel="shortcut icon" href="../../images/logo.png">
    <link rel="stylesheet" href="../../style/style.css">
    <link rel="stylesheet" href="../../style/style_admin.css">
    <title>Sócio | Histórico Encomendas</title>
</head>

<?php
  session_start();

  if($_SESSION['num_socio']==null) 
    header("Location: ../comum/inicio.php");
?>

<body>

    <?php

        include "../../includes/opendb.php";
        include "../../database/encomenda.php";

        $encomendas = getallEncomendas($_SESSION['num_socio']);
        pg_close($conn);
        $encomenda = pg_fetch_assoc($encomendas); 
    ?>

    <?php include "../../includes/header.php" ?>
    
    <main>
        <div class="sidenav">
            <a class="hvr-underline-from-left" href="socio_dados.php">Dados Pessoais</a>
            <a id="active" href="encomendas_pessoais.php">Histórico de Encomendas</a>
            <a class="hvr-underline-from-left" href="estatisticas_pessoais.php">Estatísticas</a>

        </div>

        <div class="content center">

            <?php if(empty($encomenda['id'])){ ?>
                      <img style="width: 350px" src="../../images/empty_box.png">
                      <h3>Não realizou qualquer encomenda</h3>
            <?php } else {?>

            <h3>Histórico de Encomendas</h3>
            <table id="cart" class="js-sort-table">
            <thead>
              <tr>
                <th class="js-sort-number">ID</th>
                <th class="js-sort-number">Quantidade de Produtos</th>
                <th class="js-sort-date">Data de Compra</th>
                <th class="js-sort-number">Total</th>
                <th>Detalhes</th>
              </tr>
              </thead>
              <tbody>
                <?php while(isset($encomenda['id'])){ ?>
                   <tr>
                      <td>#<?php echo $encomenda['id']; ?></td>
                      <td><?php echo $encomenda['num_produtos']; ?></td>
                      <td><?php echo $encomenda['data_compra']; ?></td>
                      <td><?php echo $encomenda['total']; ?> €</td>
                      <td><i class="fas fa-search" style="cursor: pointer;" onClick ="click_modalEncomenda(<?php echo $encomenda['id'];?>,<?php echo $_SESSION['num_socio']?>)"></i></td>
                    </tr>
                
                <?php
                    $encomenda = pg_fetch_assoc($encomendas);
                }
            } ?>
            </tbody>
            </table>
            <!-- Historico de Encomendas-->
            <div id="div1"> </div>

        </div>
    </main>


    <?php 
        include '../../includes/footer.html';
        include '../../includes/modal_login.php';
     ?>


</body>

<script src="../../javascript/ajax.js"> </script>

</html>