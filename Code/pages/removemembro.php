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
        $query = "select * from cliente where aprovacao = 'TRUE'";
        $socios = pg_exec($conn, $query);

        $query = "select * from jogador";
        $jogadores = pg_exec($conn, $query);

        pg_close($conn);

        $socio = pg_fetch_assoc($socios); 
        $jogador = pg_fetch_assoc($jogadores); 
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
            <a class="hvr-underline-from-left" href="removeproduto.php">Remover/Editar Produto</a>
            <a class="hvr-underline-from-left" href="novojogador.php">Adicionar Jogador</a>
            <a id="active" href="removemembro.php">Remover Membro</a>
            <a class="hvr-underline-from-left" href="admin_encomendas.php">Histórico Encomendas</a>
            <a class="hvr-underline-from-left" href="#contact">Estatísticas Vendas</a>
        </div>

        <div class="content">

            <h3>Sócios</h3>

            <div class="flexbox">
                
            <?php if(empty($socio['num_socio'])){ ?>
                        <img src="../images/empty-search.png">
                        <h3>Não há membros atualmente</h3>    
            <?php  }
             else{
                    while(isset($socio['num_socio'])){ ?>

                    <div class="card">
                        <span onClick="eliminate_click(<?php echo $socio['num_socio'] ?>)" class="remove"><i class="fas fa-times-circle"></i></span>
                        <img src= "<?php echo $socio['imagem']; ?>">
                        <div class="text">
                            <b>Nº Sócio:</b> <?php echo $socio['num_socio']; ?><br>
                            <b>Nome:</b> <?php echo $socio['nome']; ?><br>
                        </div>
                    </div>

                    <?php
                        $socio = pg_fetch_assoc($socios);
                    } 
                } ?>
            </div>

            <h3>Jogadores</h3>

            <div class="flexbox">
                
            <?php if(empty($jogador['num_camisola'])){ ?>
                        <img src="../images/empty-search.png">
                        <h3>Não há membros atualmente</h3>    
            <?php  }
             else{
                    while(isset($jogador['num_camisola'])){ ?>

                    <div class="card">
                        <span onClick="eliminate_click(<?php echo $jogador['num_camisola'] ?>)" class="remove"><i class="fas fa-times-circle"></i></span>
                        <img src= "<?php echo $jogador['imagem']; ?>">
                        <div class="text">
                            <b>Nº Camisola:</b> <?php echo $jogador['num_camisola']; ?><br>
                            <b>Nome:</b> <?php echo $jogador['nome']; ?><br>
                            <b>Posição:</b> <?php echo $jogador['posicao']; ?><br>
                        </div>
                    </div>

                    <?php
                        $jogador = pg_fetch_assoc($jogadores);
                    } 
                } ?>
 
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
    </script>

</body>

</html>