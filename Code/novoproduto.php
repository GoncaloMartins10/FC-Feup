<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/ef5be7179f.js" crossorigin="anonymous"></script> <!-- Icons library-->
    <link rel="shortcut icon" href="images/logo.png">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/style_admin.css">
    <title>FC FEUP | Admin</title>
</head>

<?php
  session_start();
?>

<body>

    <header>
        <img class="logo" src="images/logo.png">
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
                <li class="loginandchart hvr-grow-shadow"><a role="button" style="cursor: pointer;" href="php/logout.php">Logout <i class="fas fa-sign-in-alt"></i></a></li>
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
            <a id="active" href="novoproduto.php">Adicionar Produto</a>
            <a class="hvr-underline-from-left" href="#services">Remover Produto</a>
            <a class="hvr-underline-from-left" href="novojogador.php">Adicionar Jogador</a>
            <a class="hvr-underline-from-left" href="removemembro.php">Remover Membro</a>
            <a class="hvr-underline-from-left" href="#contact">Estatísticas Vendas</a>
        </div>

        <div class="content center">
            <div class="member center">
                <h1>Novo Produto</h1>
                <form method="POST" action="" enctype="multipart/form-data">
    
                    <div class="item">
                        <input type="text" id="nome" name="nome" placeholder="Nome do Produto" required><br>
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


    <footer>
        <div class="container">
            <div class="title"><h2>Informações</h2></div>
            <div class="info">
                <i class="fas fa-map-marker-alt"></i>   Rua Dr. Roberto Frias, 4200-465 Porto<br>
                <i class="fas fa-phone"></i>  929999999 <br>
                <i class="fas fa-envelope"></i>   fcfeup@fe.up.pt 
            </div>
        </div>
        <div class="container">
            <div class="title"><h2>Parceiros</h2></div>
            <div class="partners center">
                <div class="box hvr-grow-shadow">
                    <a href="https://www.inesctec.pt/" target="_blank"><img src="images/inesctec.png"></a>
                </div>
                <div class="box hvr-grow-shadow">
                    <a href="https://www.inegi.pt/" target="_blank"><img src="images/inegi.jpg"></a>
                </div>
                <div class="box hvr-grow-shadow">
                    <a href="https://www.aefeup.pt/" target="_blank"><img src="images/aefeup.png"></a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="title"><h2>Redes Sociais</h2></div>
            <div class="socialmedia">
                <a href="https://www.facebook.com/paginafeup/" target="_blank" class="fa fa-facebook hvr-grow-shadow"></a>
                <a href="https://www.youtube.com/user/FEUPtv" target="_blank" class="fa fa-youtube hvr-grow-shadow"></a>
                <a href="https://www.instagram.com/feup_porto/" target="_blank" class="fa fa-instagram hvr-grow-shadow"></a>
            </div>
        </div>
    </footer>
    <div class="copyright">
        &copy 2020, Gonçalo Martins & Ricardo Martins. Todos os direitos reservados.
    </div>

    <div class="form-popup" id="myForm">
        <form action="php/login.php" class="form-container">
            <span onclick="document.getElementById('myForm').style.display = 'none'" class="close" title="Close Modal">&times;</span>

            <h1>Login</h1>
    
            <label for="numero"><b>Número de Sócio</b></label>
             <input type="text" placeholder="Insira o número de sócio" name="numero" required>
    
            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Insira a Password" name="psw" required>
    
            <button type="submit" class="btn">Login</button>
        </form>
    </div>

</body>

</html>