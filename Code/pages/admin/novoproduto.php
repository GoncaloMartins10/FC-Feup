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

    <?php include "../../includes/header.php" ?>

   
    <main>
        <div class="sidenav">
            <a class="hvr-underline-from-left" href="sociopendente.php">Pedidos de Sócio Pendentes</a>
            <a id="active" href="novoproduto.php">Adicionar Produto</a>
            <a class="hvr-underline-from-left" href="removeproduto.php">Remover/Editar Produto</a>
            <a class="hvr-underline-from-left" href="novojogador.php">Adicionar Jogador</a>
            <a class="hvr-underline-from-left" href="removemembro.php">Remover Membro</a>
            <a class="hvr-underline-from-left" href="encomendas.php">Histórico Encomendas</a>
            <a class="hvr-underline-from-left" href="#contact">Estatísticas Vendas</a>
        </div>

        <div class="content center">
            <div class="member center">
                <h1>Novo Produto</h1>
                <form method="POST" action="../../actions/add_product.php" enctype="multipart/form-data">
    
                    <div class="item">
                        <input type="text" id="name" name="name" placeholder="Nome do Produto" required><br>
                    </div>                
                    <div class="item">
                        <textarea type="text" id="discription" name="discription" placeholder="Descrição do Produto (Opcional)"></textarea><br>
                    </div>
                    <div class="item">
                        <input type="number" style="width: 34%;margin-right: 5px;" id="price" name="price" placeholder="Preço (€)" min="0.00" max="10000.00" step="0.01" required>
                        <input type="number" style="width: 34%;" id="stock" name="stock" placeholder="Stock Inicial" required>
                    </div>
                    <div class="item">
                        <label for="img">Imagem:</label><br>
                        <input type="file" id="img" name="img" accept="image/*" required><br>                       
                    </div>
                    <div class="item">
                        <button type="submit">Adicionar à loja</button>
                    </div>
                </form> 
            </div>
        </div>
    </main>


    <?php 
        include '../includes/footer.html';
        include '../includes/modal_login.html';
     ?>

</body>

</html>