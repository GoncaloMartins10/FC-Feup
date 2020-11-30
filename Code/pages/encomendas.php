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

        $query = "SELECT * FROM encomenda WHERE clienteid = '".$_SESSION['num_socio']."' AND comprado = 'TRUE'";
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
            <a id="active" href="encomendas.php">Histórico de Encomendas</a>
            <a class="hvr-underline-from-left" href="socio_dados.php">Dados Pessoais</a>
        </div>

        <div class="content center">

            <?php if(empty($encomenda['id'])){ ?>
                      <img style="width: 350px" src="../images/empty_box.png">
                      <h3>Não realizou qualquer encomenda</h3>
            <?php } else {?>
                    <table id=cart>
                        <tr>
                            <th>ID</th>
                            <th>Quantidade de Produtos</th>
                            <th>Data de Entrega</th>
                            <th>Total</th>
                        </tr>
                        <?php while(isset($encomenda['id']) and !empty($encomenda['id']) ){ ?>
                            <tr>                    
                                <td><?php echo $encomenda['id']; ?></td>
                                <td><?php echo $encomenda['num_produtos']; ?></td>
                                <td><?php echo $encomenda['data_entrega']; ?></td>
                                <td><?php echo $encomenda['total']; ?></td>
                            </tr>
                        
                        <?php
                            $encomenda = pg_fetch_assoc($encomendas);
                        }
                    } ?>
                    </table>    
        </div>
    </main>


    <?php 
        include '../includes/footer.html';
        include '../includes/modal_login.html';
     ?>


</body>

</html>