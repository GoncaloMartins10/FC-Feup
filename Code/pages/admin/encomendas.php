<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/ef5be7179f.js" crossorigin="anonymous"></script> <!-- Icons library-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
        include "../../database/encomenda.php";

        $encomendas = getEncomendaComprada();
        pg_close($conn);
        $encomenda = pg_fetch_assoc($encomendas);        
    ?>

    <?php include "../../includes/header.php"; ?>
    
    <main>
    <div class="sidenav">
            <a class="hvr-underline-from-left" href="sociopendente.php">Pedidos de Sócio Pendentes</a>
            <a class="hvr-underline-from-left" href="novoproduto.php">Adicionar Produto</a>
            <a class="hvr-underline-from-left" href="removeproduto.php">Remover/Editar Produto</a>
            <a class="hvr-underline-from-left" href="novojogador.php">Adicionar Jogador</a>
            <a class="hvr-underline-from-left" href="removemembro.php">Remover Membro</a>
            <a id="active" href="encomendas.php">Histórico Encomendas</a>
            <a class="hvr-underline-from-left" href="#contact">Estatísticas Vendas</a>
        </div>

        <div class="content center">

            <?php if(empty($encomenda['id'])){ ?>
                      <img style="width: 350px" src="../../images/empty_box.png">
                      <h3>Não há registo de nenhuma encomenda</h3>
            <?php } else {?>

            <h3>Histórico de Encomendas</h3>
            <table id=cart>
              <tr>
                <th>ID</th>
                <th>Nº Sócio</th>
                <th>Cliente</th>
                <th>Quantidade de Produtos</th>
                <th>Data de Entrega</th>
                <th>Total</th>
                <th>Detalhes</th>
              </tr>
                <?php while(isset($encomenda['id'])){ ?>
                   <tr>
                      <td>#<?php echo $encomenda['id']; ?></td>
                      <td><?php echo $encomenda['clienteid']; ?></td>
                      <td><?php echo $encomenda['nome']; ?></td>
                      <td><?php echo $encomenda['num_produtos']; ?></td>
                      <td><?php echo $encomenda['data_entrega']; ?></td>
                      <td><?php echo $encomenda['total']; ?> €</td>
                      <td><i class="fas fa-search" style="cursor: pointer;" onClick ="click_modalEncomendaAdmin(<?php echo "".$encomenda['id'].",".$encomenda['clienteid'];?> )"></i></td>
                    </tr>
                
                <?php
                    $encomenda = pg_fetch_assoc($encomendas);
                }
            } ?>
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