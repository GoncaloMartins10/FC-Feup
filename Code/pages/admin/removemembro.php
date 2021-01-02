<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/ef5be7179f.js" crossorigin="anonymous"></script> <!-- Icons library-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="shortcut icon" href="../../images/logo.png">
    <link rel="stylesheet" href="../../style/style.css">
    <link rel="stylesheet" href="../../style/style_admin.css">
    <title>Admin | Remover Membro</title>
</head>

<?php
  session_start();

  if($_SESSION['admin'] != "t") 
    header("Location: ../comum/inicio.php");
?>

<body>

    <?php
        include "../../includes/opendb.php";
        include "../../database/socio.php";
        include "../../database/jogador.php";

        $socios = getsocioAprovado();

        $jogadores = getAlljogador();
        pg_close($conn);

        $socio = pg_fetch_assoc($socios); 
        $jogador = pg_fetch_assoc($jogadores); 
    ?>

    <?php include "../../includes/header.php" ?>


    <main>
        <div class="sidenav">
            <a class="hvr-underline-from-left" href="sociopendente.php">Pedidos de Sócio Pendentes</a>
            <a class="hvr-underline-from-left" href="novoproduto.php">Adicionar Produto</a>
            <a class="hvr-underline-from-left" href="removeproduto.php">Remover/Editar Produto</a>
            <a class="hvr-underline-from-left" href="novojogador.php">Adicionar Jogador</a>
            <a id="active" href="removemembro.php">Remover Membro</a>
            <a class="hvr-underline-from-left" href="encomendas.php">Histórico Encomendas</a>
            <a class="hvr-underline-from-left" href="estatisticas.php">Estatísticas Vendas</a>
        </div>

        <div class="content">

            <h3>Sócios</h3>

            <div class="flexbox">
                
            <?php if(empty($socio['num_socio'])){ ?>
                        <img src="../../images/empty-search.png">
                        <h3>Não há membros atualmente</h3>    
            <?php  }
             else{
                    while(isset($socio['num_socio'])){ ?>

                    <div class="card">
                        <span onClick="click_eliminateSocio(<?php echo $socio['num_socio'] ?>)" class="remove"><i class="fas fa-times-circle"></i></span>
                        <img src= "../<?php echo $socio['imagem']; ?>">
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
                        <img src="../../images/empty-search.png">
                        <h3>Não há membros atualmente</h3>    
            <?php  }
             else{
                    while(isset($jogador['num_camisola'])){ ?>

                    <div class="card">
                        <span onClick="click_eliminateJogador(<?php echo $jogador['num_camisola'] ?>)" class="remove"><i class="fas fa-times-circle"></i></span>
                        <img src= "../<?php echo $jogador['imagem']; ?>">
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
        include '../../includes/footer.html';
        include '../../includes/modal_login.php';
     ?>

    <script src="../../javascript/ajax.js"> </script>

</body>

</html>