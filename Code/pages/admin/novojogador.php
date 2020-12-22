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
            <a class="hvr-underline-from-left" href="novoproduto.php">Adicionar Produto</a>
            <a class="hvr-underline-from-left" href="removeproduto.php">Remover/Editar Produto</a>
            <a id="active" href="novojogador.php">Adicionar Jogador</a>
            <a class="hvr-underline-from-left" href="removemembro.php">Remover Membro</a>
            <a class="hvr-underline-from-left" href="encomendas.php">Histórico Encomendas</a>
            <a class="hvr-underline-from-left" href="estatisticas.php">Estatísticas Vendas</a>
        </div>

        <div class="content center">
            <div class="member center">
                <h1>Novo Jogador</h1>
                <form method="POST" action="../../actions/add_jogador.php" enctype="multipart/form-data">
    
                    <div class="item">
                        <input type="text" id="nome" name="nome" placeholder="Nome do Jogador" required><br>
                    </div>
                    <div class="item">
                        <input list="posicoes" placeholder="Posição" name="posicao" id="posicao">
                        <datalist id="posicoes">
                          <option value="Guarda-Redes">
                          <option value="Defesa">
                          <option value="Médio">
                          <option value="Avançado">
                        </datalist>
                    </div>                
                    <div class="item">
                        <input type="number" style="width: 40%;" id="idade" name="idade" placeholder="Idade" required>
                    </div>
                    <div class="item">
                        <input type="number" style="width: 40%;" id="numero" name="numero" placeholder="Nº Camisola" min="0" max="99" required>
                    </div>
                    <div class="item">
                        <label for="img">Imagem:</label><br>
                        <input type="file" id="img" name="img" accept="image/*" required><br>                       
                    </div>
                    <div class="item">
                        <button type="submit">Adicionar à Equipa</button>
                    </div>
                </form> 
            </div>
        </div>
    </main>


    <?php 
        include '../../includes/footer.html';
        include '../../includes/modal_login.html';
     ?>

</body>

</html>