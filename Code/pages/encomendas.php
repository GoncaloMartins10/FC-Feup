<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/ef5be7179f.js" crossorigin="anonymous"></script> <!-- Icons library-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="shortcut icon" href="../images/logo.png">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/style_admin.css">
    <title>FC FEUP | Sócio</title>
</head>

<?php
  session_start();
?>

<body>

    <?php

        include "../database/opendb.php";

        $query = "SELECT * FROM encomenda WHERE comprado = 'TRUE' AND clienteid = '".$_SESSION['num_socio']."' ";
        $encomendas = pg_exec($conn, $query);

        pg_close($conn);

        $encomenda = pg_fetch_assoc($encomendas); 
    ?>

    <header>    
        <img class="logo" src="../images/logo.png">
        <nav>
            <ul>
                 <li class="hvr-underline-from-left"><a href="inicio.php">Inicio</a></li>
                 <li class="hvr-underline-from-left"><a href="membros.php">Membros</a></li>
                 <li class="hvr-underline-from-left"><a href="loja.php">Loja</a></li>
                 <?php if(isset($_SESSION['num_socio']) and $_SESSION['admin']=="t") { ?>
                    <li id="active" ><a href="admin_sociopendente.php">Admin</a></li>          
                 <?php }?>
                 <?php if(isset($_SESSION['num_socio']) and $_SESSION['admin']=="f") { ?>
                    <li id="active" ><a href="encomendas.php">Sócio</a></li>          
                 <?php }?>
             </ul> 
        </nav>
        <nav>
            <ul>
            <?php if(isset($_SESSION['num_socio']) ) { ?>
                <li class="loginandchart hvr-grow-shadow"><a role="button" style="cursor: pointer;" href="../actions/logout.php">Logout <i class="fas fa-sign-in-alt"></i></a></li>
            <?php } else {?>
                <li class="loginandchart hvr-grow-shadow"><a role="button" onclick="document.getElementById('myForm').style.display = 'block'" style="cursor: pointer;">Login <i class="fas fa-sign-in-alt"></i></a></li>
            <?php }?>
                <li class="loginandchart hvr-grow-shadow"><a href="carrinho.php">Carrinho <i class="fas fa-shopping-cart"></i></a></li>
            </ul> 
        </nav>
    </header>
    
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
            <table id=cart>
              <tr>
                <th>ID</th>
                <th>Quantidade de Produtos</th>
                <th>Data de Entrega</th>
                <th>Total</th>
                <th>Detalhes</th>
              </tr>
                <?php while(isset($encomenda['id'])){ ?>
                   <tr>
                      <td>#<?php echo $encomenda['id']; ?></td>
                      <td><?php echo $encomenda['num_produtos']; ?></td>
                      <td><?php echo $encomenda['data_entrega']; ?></td>
                      <td><?php echo $encomenda['total']; ?></td>
                      <td><i class="fas fa-search" style="cursor: pointer;" onClick ="reply_click(<?php echo $encomenda['id'];?>)"></i></td>
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
        include '../includes/footer.html';
        include '../includes/modal_login.html';
     ?>

    

<script>

function reply_click(clicked_id) {

$.ajax({
        url: '../actions/modal_encomenda.php',
        type: 'POST',
        data: {"id":clicked_id},
        success: function(result) { 
            $("#div1").html(result);
            console.log(result);
        }
});

}
</script>


</body>

</html>