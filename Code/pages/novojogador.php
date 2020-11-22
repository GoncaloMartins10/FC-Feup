<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/ef5be7179f.js" crossorigin="anonymous"></script> <!-- Icons library-->
    <link rel="shortcut icon" href="../images/logo.png">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/style_admin.css">
    <title>FC FEUP | Admin</title>
</head>

<?php
  session_start();
?>

<body>
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
            <a class="hvr-underline-from-left" href="removeproduto.php">Remover Produto</a>
            <a id="active" href="novojogador.php">Adicionar Jogador</a>
            <a class="hvr-underline-from-left" href="removemembro.php">Remover Membro</a>
            <a class="hvr-underline-from-left" href="#contact">Estatísticas Vendas</a>
        </div>

        <div class="content center">
            <div class="member center">
                <h1>Novo Jogador</h1>
                <form method="POST" action="" enctype="multipart/form-data">
    
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
        include '../includes/footer.html';
        include '../includes/modal_login.html';
     ?>

</body>

</html>