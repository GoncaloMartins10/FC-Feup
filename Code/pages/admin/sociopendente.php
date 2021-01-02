<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/ef5be7179f.js" crossorigin="anonymous"></script> <!-- Icons library-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../../javascript/sort-table.js"></script>                                    <!-- Sort tables script -->
    <link rel="shortcut icon" href="../../images/logo.png">
    <link rel="stylesheet" href="../../style/style.css">
    <link rel="stylesheet" href="../../style/style_admin.css">
    <title>Admin | Sócios Pendentes</title>
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

        $result = getsocioNotAprovado();
        pg_close($conn);
        $row = pg_fetch_assoc($result); 
    ?>

    <?php include "../../includes/header.php" ?>

    <main>
        <div class="sidenav">
            <a id="active" href="sociopendente.php">Pedidos de Sócio Pendentes</a>
            <a class="hvr-underline-from-left" href="novoproduto.php">Adicionar Produto</a>
            <a class="hvr-underline-from-left" href="removeproduto.php">Remover/Editar Produto</a>
            <a class="hvr-underline-from-left" href="novojogador.php">Adicionar Jogador</a>
            <a class="hvr-underline-from-left" href="removemembro.php">Remover Membro</a>
            <a class="hvr-underline-from-left" href="encomendas.php">Histórico Encomendas</a>
            <a class="hvr-underline-from-left" href="estatisticas.php">Estatísticas Vendas</a>
        </div>

        <div class="content center">

            <?php if(empty($row['num_socio'])){ ?>
                      <img src="../../images/empty-search.png">
                      <h3>Não há pedidos de sócio pendentes</h3>
            <?php } else {?>
                    <table id="cart" class="js-sort-table">
                    <thead>
                        <tr>
                            <th class="js-sort-number">Nº Sócio</th>
                            <th><!-- Imagem --></th>
                            <th class="js-sort-string">Nome</th>
                            <th class="js-sort-string">Morada</th>
                            <th class="js-sort-number">Telefone</th>
                            <th>Aprovar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while(isset($row['num_socio']) and !empty($row['num_socio']) ){ ?>
                            <tr>                    
                                <td><?php echo $row['num_socio']; ?></td>
                                <td><img src= "../<?php echo $row['imagem']; ?>"></td>
                                <td><?php echo $row['nome']; ?></td>
                                <td><?php echo $row['morada']; ?></td>
                                <td><?php echo $row['telefone']; ?></td>
                                <td><i class="fas fa-check-circle" style="color:green; cursor: pointer;" onClick=" click_acceptSocio(<?php echo $row['num_socio'] ?>)" > </i></td>
                                <td><i class="fas fa-times-circle" style="color:red; cursor: pointer;" onClick="click_eliminateSocio(<?php echo $row['num_socio'] ?>)"></i></td>    
                            </tr>
                        
                        <?php
                            $row = pg_fetch_assoc($result);
                        }
                    } ?>
                    </tbody>
                    </table>    
        </div>
    </main>

    <?php 
        include '../../includes/footer.html';
        include '../../includes/modal_login.php';
     ?>

    <script src="../../javascript/ajax.js"> </script>

</body>

</html>