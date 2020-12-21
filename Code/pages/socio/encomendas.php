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
    <title>FC FEUP | Sócio</title>
</head>

<?php
  session_start();
?>

<body>

    <?php

        include "../../includes/opendb.php";

        $query = "SELECT * FROM encomenda WHERE comprado = 'TRUE' AND clienteid = '".$_SESSION['num_socio']."' ";
        $encomendas = pg_exec($conn, $query);

        pg_close($conn);

        $encomenda = pg_fetch_assoc($encomendas); 
    ?>

    <?php include "../../includes/header.php" ?>
    
    <main>
        <div class="sidenav">
            <a class="hvr-underline-from-left" href="socio_dados.php">Dados Pessoais</a>
            <a id="active" href="encomendas.php">Histórico de Encomendas</a>
        </div>

        <div class="content center">

            <?php if(empty($encomenda['id'])){ ?>
                      <img style="width: 350px" src="../images/empty_box.png">
                      <h3>Não realizou qualquer encomenda</h3>
            <?php } else {?>

            <h3>Histórico de Encomendas</h3>
            <table id="cart" class="js-sort-table">
            <thead>
              <tr>
                <th class="js-sort-number">ID</th>
                <th class="js-sort-number">Quantidade de Produtos</th>
                <th class="js-sort-date">Data de Entrega</th>
                <th class="js-sort-number">Total</th>
                <th>Detalhes</th>
              </tr>
              </thead>
              <tbody>
                <?php while(isset($encomenda['id'])){ ?>
                   <tr>
                      <td>#<?php echo $encomenda['id']; ?></td>
                      <td><?php echo $encomenda['num_produtos']; ?></td>
                      <td><?php echo $encomenda['data_entrega']; ?></td>
                      <td><?php echo $encomenda['total']; ?> €</td>
                      <td><i class="fas fa-search" style="cursor: pointer;" onClick ="click_modalEncomenda(<?php echo $encomenda['id'];?>)"></i></td>
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
        include '../../includes/modal_login.html';
     ?>


</body>

<script src="../../javascript/ajax.js"> </script>

</html>