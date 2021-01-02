<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/ef5be7179f.js" crossorigin="anonymous"></script> <!-- Icons library-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="shortcut icon" href="../../images/logo.png">
    <link rel="stylesheet" href="../../style/style.css">
    <link rel="stylesheet" href="../../style/style_admin.css">
    <title>Admin | Editar Produto</title>
</head>

<?php
  session_start();

  if($_SESSION['admin'] != "t") 
    header("Location: ../comum/inicio.php");
    
  include "../../includes/opendb.php";
  include "../../database/produto.php";
  $result = getAllproduto();  
  pg_close($conn);
  $row = pg_fetch_assoc($result); 
?>

<body>

    <?php include "../../includes/header.php" ?>

    <main>
        <div class="sidenav">
            <a class="hvr-underline-from-left" href="sociopendente.php">Pedidos de Sócio Pendentes</a>
            <a class="hvr-underline-from-left" href="novoproduto.php">Adicionar Produto</a>
            <a id="active" href="removeproduto.php">Remover/Editar Produto</a>
            <a class="hvr-underline-from-left" href="novojogador.php">Adicionar Jogador</a>
            <a class="hvr-underline-from-left" href="removemembro.php">Remover Membro</a>
            <a class="hvr-underline-from-left" href="encomendas.php">Histórico Encomendas</a>
            <a class="hvr-underline-from-left" href="estatisticas.php">Estatísticas Vendas</a>
        </div>

        <div class="content">

            <h3>Produtos</h3>

            <div class="flexbox">
                
            <?php if(empty($row['id'])){ ?>
                        <img src="../../images/empty-search.png">
                        <h3>Não há produtos na loja</h3>    
            <?php  }
             else{
                    while(isset($row['id'])){ ?>

                    <div class="card">
                        <span onClick="click_eliminateProduto(<?php echo $row['id'] ?>)" class="remove"><i class="fas fa-times-circle"></i></span>
                        <span onClick="click_modalEditProduto(<?php echo $row['id'] ?>)" class="edit"><i class="fas fa-edit"></i></span>
                        <img src= "../<?php echo $row['imagem']; ?>">
                        <div class="text">
                            <b>Nome:</b> <?php echo $row['nome']; ?><br>
                            <b>Preço:</b> <?php echo $row['preco']; ?>€<br>
                            <b>Stock:</b> <?php if($row['stock'] > 0) echo $row['stock']; else echo '<span style="color: red"><b>Esgotado</b></span>'; ?><br>
                        </div>
                    </div>

                    <?php
                        $row = pg_fetch_assoc($result);
                    } 
                } ?>
            </div>
 
        </div>
    </main>


    <?php 
        include '../../includes/footer.html';
        include '../../includes/modal_login.php';
     ?>

    <div id="id01" class="modal">
        <div class="content center">

            <div class="member center" style="position: relative; margin: 0; position: absolute; top: 50%; -ms-transform: translateY(-50%); transform: translateY(-50%);">
                <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                <h1>Editar Produto</h1>
                <form method="POST" action="../../actions/edit_product.php" enctype="multipart/form-data" name="modal_lojaadmin">
                    
                    <input type="number" name="id" value=''>

                    <div class="item">
                        <label for="nome">Nome</label><br>
                        <input type="text" id="nome" name="nome" value="" required><br>
                    </div>   

                    <div class="item">
                        <label for="descricao">Descrição</label><br>
                        <textarea type="text" id="descricao" name="descricao" value=""></textarea><br>
                    </div>

                    <div class="item">
                        <label for="preco" style="margin-right: 72px;">Preço</label>
                        <label for="stock">Stock</label><br>
                        <input type="number" style="width: 34%;margin-right: 5px;" id="preco" name="preco" value="" min="0.00" max="10000.00" step="0.01" required>

                        <input type="number" style="width: 34%;" id="stock" name="stock" value=""  min="0"  required>
                    </div>

                    <div class="item">
                        <button type="submit">Editar</button>
                    </div>
                </form> 
            </div>
        </div>
    </div>
    
</body>
<script src="../../javascript/ajax.js">  </script>
</html>