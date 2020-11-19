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

        $query = "set schema 'fcfeup'";
        pg_exec($conn, $query);
        $query = "select* from cliente where aprovacao = 'TRUE'";
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
                    <li class="hvr-underline-from-left"><a href="admin_sociopendente.php">Admin</a></li>          
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
            <a class="hvr-underline-from-left" href="admin_sociopendente.php">Pedidos de Sócio Pendentes</a>
            <a class="hvr-underline-from-left" href="novoproduto.php">Adicionar Produto</a>
            <a class="hvr-underline-from-left" href="#">Remover Produto</a>
            <a class="hvr-underline-from-left" href="novojogador.php">Adicionar Jogador</a>
            <a id="active" href="removemembro.php">Remover Membro</a>
            <a class="hvr-underline-from-left" href="#contact">Estatísticas Vendas</a>
        </div>

        <div class="content">

            <h3>Sócios</h3>

            <div class="flexbox">
                
            <?php if(empty($row['num_socio'])){ ?>
                        <img src="images/empty-search.png">
                        <h3>Não há membros atuamente</h3>    
            <?php  }
             else{
                    while(isset($row['num_socio'])){ ?>

                    <div class="card">
                        <span onClick="eliminate_click(<?php echo $row['num_socio'] ?>)" class="remove"><i class="fas fa-times-circle"></i></span>
                        <img src= "<?php echo $row['imagem']; ?>">
                        <div class="text">
                            <b>Nº Sócio:</b> <?php echo $row['num_socio']; ?><br>
                            <b>Nome:</b> <?php echo $row['nome']; ?><br>
                        </div>
                    </div>

                    <?php
                        $row = pg_fetch_assoc($result);
                    } 
                } ?>
            </div>

            <h3>Jogadores</h3>

            <div class="flexbox">
                <div class="card">
                    <img src="images/marega.jpg">
                    <div class="text">
                        <b>Nº Sócio:</b> 1235<br>
                        <b>Nome: </b> Moussa Marega<br>
                    </div>
                </div>
                <div class="card">
                    <img src="images/biden.jpg">
                    <div class="text">
                        <b>Nº Sócio:</b> 1237<br>
                        <b>Nome: </b> Joe Biden<br>
                    </div>
                </div>

            </div>
 
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
                        url: 'actions/remove_socio.php',
                        type: 'POST',
                        data: {"id":socio},
                        success: function(response) { window.location.reload(); }
                    });
            }
        }   
    </script>

</body>

</html>