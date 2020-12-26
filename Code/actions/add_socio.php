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

  include "../includes/opendb.php";
  include "../database/socio.php";
  include "../database/encomenda.php";

  $nome = $morada = $telefone = $pass = $imagem = $num_socio = "";

  if(isset($_POST['nome']))
      $nome = $_POST['nome'];

  if(isset($_POST['morada']))
      $morada = $_POST['morada'];

  if(isset($_POST['telefone']))
      $telefone = $_POST['telefone'];

  if(isset($_POST['pass'])){    
      $pass = $_POST['pass'];
      $password_md5 = md5($pass);
  }
  
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
                 <li class="hvr-underline-from-left"><a href="../pages/comum/inicio.php">Inicio</a></li>
                 <li class="hvr-underline-from-left"><a href="../pages/comum/membros.php">Membros</a></li>
                 <li class="hvr-underline-from-left"><a href="../pages/comum/loja.php">Loja</a></li>
                 <?php if(isset($_SESSION['num_socio']) and $_SESSION['admin']=="t") { ?>
                    <li class="hvr-underline-from-left"><a href="../pages/admin/sociopendente.php">Admin</a></li>          
                 <?php }?>
             </ul> 
        </nav>
        <nav>
            <ul>
            <?php if(isset($_SESSION['num_socio']) ) { ?>
                <li class="loginandchart hvr-grow-shadow"><a role="button" style="cursor: pointer;" href="logout.php">Logout <i class="fas fa-sign-in-alt"></i></a></li>
            <?php } else {?>
                <li class="loginandchart hvr-grow-shadow"><a role="button" onclick="document.getElementById('myForm').style.display = 'block'" style="cursor: pointer;">Login <i class="fas fa-sign-in-alt"></i></a></li>
            <?php }?>

                <li class="loginandchart hvr-grow-shadow"><a href="../pages/comum/carrinho.php">Carrinho <i class="fas fa-shopping-cart"></i></a></li>
            </ul> 
        </nav>
    </header>
    
    <main class="center">

        <?php

            if($nome == "" OR $telefone == "" OR $morada == "" OR $pass == "" OR $imagem == ""){
                $_SESSION['error'] = "Por favor preencha todos os campos do formulário";
                header('Location: ../pages/comum/socio.php');
            }
            else{
                /* Insere Cliente */
                $row = createSocio($nome, $imagem, $telefone, $morada, $password_md5);
                $num_socio = $row['0'];
                /* Cria Carrinho */
                createEncomenda($num_socio);
                pg_close($conn);
        ?>

                <div class="note">
                    <h1>Obrigado <?php echo $nome;?>!</h1>
                    <br>
                    <p>O teu número de sócio é:</p>
                    <h4><?php echo $num_socio;?></h4>
                    <p>Aguarda pacientemente a aprovoção da nossa direção</p>
                    <br>
                    <a href="../pages/comum/inicio.php"><div class="button hvr-grow-shadow">Voltar ao Início</div></a>
                </div>
    <?php  } ?>

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
                    <a href="https://www.inesctec.pt/" target="_blank"><img src="../images/inesctec.png"></a>
                </div>
                <div class="box hvr-grow-shadow">
                    <a href="https://www.inegi.pt/" target="_blank"><img src="../images/inegi.jpg"></a>
                </div>
                <div class="box hvr-grow-shadow">
                    <a href="https://www.aefeup.pt/" target="_blank"><img src="../images/aefeup.png"></a>
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

    <form action="../actions/login.php" method="POST"  class="form-container">

        <span onclick="document.getElementById('myForm').style.display = 'none'" class="close" title="Close Modal">&times;</span>

        <h1>Login</h1>

        <label for="numero"><b>Número de Sócio</b></label>
        <input type="text" placeholder="Insira o número de sócio" id="numero" name="numero" onkeyup='keyup(this);' required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Insira a Password" id="psw" name="psw" onkeyup='keyup(this);' required>
        <span style="color:red; font-size:15px;"> <?php if(isset($_SESSION['erro']))echo $_SESSION['erro']; ?> </span> <br><br>

        <button type="submit" class="btn">Login</button>
        <a href="../comum/socio.php" class="button">Tornar-se Sócio</a>
    </form>

</div>


<script>
    <?php if(isset($_SESSION['erro'])) { ?>
            document.getElementById('myForm').style.display = "block";
            document.getElementById('numero').style.border = "2px solid red";
            document.getElementById('psw').style.border = "2px solid red";
    <?php   $_SESSION['erro']=NULL;
     } ?>

    var keyup = function(input) {
        document.getElementById(input.id).style.border = "";
    }

</script>

</body>

</html>