<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/ef5be7179f.js" crossorigin="anonymous"></script> <!-- Icons library-->
    <link rel="shortcut icon" href="../images/logo.png">
    <link rel="stylesheet" href="../style/style.css">
    <title>Bem-Vindo ao FC FEUP</title>
</head>

<?php
  session_start();

  include "../database/opendb.php";

  $nome = $morada = $telefone = $pass = $imagem = $num_socio = "";

  if(isset($_POST['nome']))
      $nome = $_POST['nome'];

  if(isset($_POST['morada']))
      $morada = $_POST['morada'];

  if(isset($_POST['telefone']))
      $telefone = $_POST['telefone'];

  if(isset($_POST['pass']))    
      $pass = $_POST['pass'];
  
  //Imagem
  $diretorio = "../images/";
  $imagem = $diretorio . basename($_FILES["img"]["name"]);
  move_uploaded_file($_FILES["img"]["tmp_name"], $imagem);

?>

<body>

    <header>
        <img class="logo" src="../images/logo.png">
        <nav>
            <ul>
                 <li class="hvr-underline-from-left"><a href="../inicio.php">Inicio</a></li>
                 <li class="hvr-underline-from-left"><a href="../membros.php">Membros</a></li>
                 <li class="hvr-underline-from-left"><a href="../loja.php">Loja</a></li>
                 <?php if(isset($_SESSION['num_socio']) and $_SESSION['admin']=="t") { ?>
                    <li class="hvr-underline-from-left"><a href="../admin_sociopendente.php">Admin</a></li>          
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

                <li class="loginandchart hvr-grow-shadow"><a href="../carrinho.php">Carrinho <i class="fas fa-shopping-cart"></i></a></li>
            </ul> 
        </nav>
    </header>
    
    <main class="center">

        <?php

            if($nome == "" OR $telefone == "" OR $morada == "" OR $pass == "" OR $imagem == ""){
                $_SESSION['error'] = "Por favor preencha todos os campos do formulário";
                header('Location: ../socio.php');
            }
            else{
                /* Insere Cliente */
                $query = "INSERT INTO cliente(nome, imagem, telefone, morada, password) VALUES ('".$nome."', '".$imagem."', '".$telefone."', '".$morada."', '".$pass."') RETURNING num_socio";
                $row = pg_fetch_row( pg_exec($conn, $query));
                $num_socio = $row['0'];
                /* Cria Carrinho */
                $query = "INSERT INTO encomenda(clienteID) VALUES ('".$num_socio."')";
                pg_exec($conn, $query);
                pg_close($conn);
        ?>

                <div class="note">
                    <h1>Obrigado <?php echo $nome;?>!</h1>
                    <br>
                    <p>O teu número de sócio é:</p>
                    <h4><?php echo $num_socio;?></h4>
                    <p>Aguarda pacientemente a aprovoção da nossa direção</p>
                    <br>
                    <a href="../inicio.php"><div class="button hvr-grow-shadow">Voltar ao Início</div></a>
                </div>
    <?php  } ?>

    </main>


    <?php 
        include '../includes/footer.html';
        include '../includes/modal_login.html';
     ?>

</body>

</html>