<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/ef5be7179f.js" crossorigin="anonymous"></script> <!-- Icons library-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="shortcut icon" href="../images/logo.png">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/style_admin.css">
    <title>FC FEUP | Admin</title>
</head>

<?php
  session_start();
?>

<body>

    <?php
    
        include "../database/opendb.php";

        $query = "select* from cliente where aprovacao='FALSE';";
        $result = pg_exec($conn, $query);

        pg_close($conn);

        $row = pg_fetch_assoc($result); 
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
            <a id="active" href="admin_sociopendente.php">Pedidos de Sócio Pendentes</a>
            <a class="hvr-underline-from-left" href="novoproduto.php">Adicionar Produto</a>
            <a class="hvr-underline-from-left" href="removeproduto.php">Remover/Editar Produto</a>
            <a class="hvr-underline-from-left" href="novojogador.php">Adicionar Jogador</a>
            <a class="hvr-underline-from-left" href="removemembro.php">Remover Membro</a>
            <a class="hvr-underline-from-left" href="admin_encomendas.php">Histórico Encomendas</a>
            <a class="hvr-underline-from-left" href="#contact">Estatísticas Vendas</a>
        </div>

        <div class="content center">

            <?php if(empty($row['num_socio'])){ ?>
                      <img src="../images/empty-search.png">
                      <h3>Não há pedidos de sócio pendentes</h3>
            <?php } else {?>
                    <table id=cart>
                        <tr>
                            <th>Nº Sócio</th>
                            <th><!-- Imagem --></th>
                            <th>Nome</th>
                            <th>Morada</th>
                            <th>Telefone</th>
                            <th>Aprovar</th>
                            <th>Eliminar</th>
                        </tr>
                        <?php while(isset($row['num_socio']) and !empty($row['num_socio']) ){ ?>
                            <tr>                    
                                <td><?php echo $row['num_socio']; ?></td>
                                <td><img src= "<?php echo $row['imagem']; ?>"></td>
                                <td><?php echo $row['nome']; ?></td>
                                <td><?php echo $row['morada']; ?></td>
                                <td><?php echo $row['telefone']; ?></td>
                                <td><i class="fas fa-check-circle" style="color:green; cursor: pointer;" onClick=" add_click(<?php echo $row['num_socio'] ?>)" > </i></td>
                                <td><i class="fas fa-times-circle" style="color:red; cursor: pointer;" onClick="eliminate_click(<?php echo $row['num_socio'] ?>)"></i></td>    
                            </tr>
                        
                        <?php
                            $row = pg_fetch_assoc($result);
                        }
                    } ?>
                    </table>    
        </div>
    </main>


    <?php 
        include '../includes/footer.html';
        include '../includes/modal_login.html';
     ?>

    <script>
        function eliminate_click(socio) {
            if (confirm("Tem a certeza que quer rejeitar o sócio")) {
                    $.ajax({
                        url: '../actions/remove_socio.php',
                        type: 'POST',
                        data: {"id":socio},
                        success: function(response) { window.location.reload(); }
                    });
            }
        }   

        function add_click(socio) {
            if (confirm("Tem a certeza que quer aceitar o sócio")) {
                    $.ajax({
                        url: '../actions/accept_socio.php',
                        type: 'POST',
                        data: {"id":socio},
                        success: function(response) { window.location.reload(); }
                    });
            }
        } 
    </script>

</body>

</html>