<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/ef5be7179f.js" crossorigin="anonymous"></script> <!-- Icons library-->
    <link rel="shortcut icon" href="images/logo.png">
    <link rel="stylesheet" href="style/style.css">
    <title>FC FEUP | Inicio</title>
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


    <main class="center" style="flex-direction: column; margin: 20px 0;">

      <h3>Encomendas</h3>
      <table id=cart>
          <tr>
              <th></th>
              <th>ID</th>
              <th></th>
              <th>Produto</th>
              <th>Tamanho</th>
              <th>Preço</th>
              <th>Quantidade</th>
              <th>Total</th>
          </tr>
          <tr>
            <td><i class="fas fa-trash"></i></td>
            <td>#123</td>
            <td><img src="images/marega.jpg"></td>
            <td>Camisola Oficial</td>
            <td>M</td>
            <td>20,00€</td>
            <td>10</td>
            <td>200,00€</td>
          </tr>
        <tr>
          <td><i class="fas fa-trash"></i></td>
          <td>#123</td>
          <td><img src="images/cr7.jpg"></td>
          <td>Camisola Oficial</td>
          <td>M</td>
          <td>20,00€</td>
          <td>10</td>
          <td>200,00€</td>
        </tr>
        <tr>
          <td><i class="fas fa-trash"></i></td>
          <td>#123</td>
          <td><img src="images/biden.jpg"></td>
          <td>Camisola Oficial</td>
          <td>M</td>
          <td>20,00€</td>
          <td>10</td>
          <td>200,00€</td>
      </tr>
    </table>

    <h3>Sumário</h3>
    <table id=cart>
      <tr>
        <th>Quantidade Produtos:</th>
        <td>30</td>
      </tr>
      <tr>
        <th>Data Entrega:</th>
        <td>20/12/2020</td>
      </tr>
      <tr>
        <th>Total:</th>
        <td>600,00€</td>
      </tr>
    </table>
    
    <button class="hvr-grow-shadow">Comprar</button>

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