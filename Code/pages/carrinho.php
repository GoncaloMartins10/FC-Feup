<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/ef5be7179f.js" crossorigin="anonymous"></script> <!-- Icons library-->
    <link rel="shortcut icon" href="../images/logo.png">
    <link rel="stylesheet" href="../style/style.css">
    <title>FC FEUP | Carrinho</title>
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


    <main class="center" style="flex-direction: column; margin: 20px 0; justify-content: space-between;">

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
            <td><img src="../images/marega.jpg"></td>
            <td>Camisola Oficial</td>
            <td>M</td>
            <td>20,00€</td>
            <td>10</td>
            <td>200,00€</td>
          </tr>
        <tr>
          <td><i class="fas fa-trash"></i></td>
          <td>#123</td>
          <td><img src="../images/cr7.jpg"></td>
          <td>Camisola Oficial</td>
          <td>M</td>
          <td>20,00€</td>
          <td>10</td>
          <td>200,00€</td>
        </tr>
        <tr>
          <td><i class="fas fa-trash"></i></td>
          <td>#123</td>
          <td><img src="../images/biden.jpg"></td>
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
    
    <div class="button-container">
      <button class="hvr-grow-shadow">Comprar</button>
      <a href="../pages/loja.php"><button class="hvr-grow-shadow" style="background: #284b63">Adicionar mais Produtos</button></a>
    </div>

    </main>

    <?php 
        include '../includes/footer.html';
        include '../includes/modal_login.html';
     ?>

</body>

</html>