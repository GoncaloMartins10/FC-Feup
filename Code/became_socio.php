<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/ef5be7179f.js" crossorigin="anonymous"></script> <!-- Icons library-->
    <link rel="shortcut icon" href="images/logo.png">
    <link rel="stylesheet" href="style/style.css">
    <title>Tornar-se Sócio</title>
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
                <li class="loginandchart hvr-grow-shadow"><a role="button" style="cursor: pointer;" href="actions/logout.php">Logout <i class="fas fa-sign-in-alt"></i></a></li>
            <?php } else {?>
                <li class="loginandchart hvr-grow-shadow"><a role="button" onclick="document.getElementById('myForm').style.display = 'block'" style="cursor: pointer;">Login <i class="fas fa-sign-in-alt"></i></a></li>
            <?php }?>

                <li class="loginandchart hvr-grow-shadow"><a href="carrinho.php">Carrinho <i class="fas fa-shopping-cart"></i></a></li>
            </ul> 
        </nav>
    </header>
    
    <main class="center">

        <?php
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
            $diretorio = "images/";
            $imagem = $diretorio . basename($_FILES["img"]["name"]);
            move_uploaded_file($_FILES["img"]["tmp_name"], $imagem);
        

            include "database/opendb.php";

            $query = "INSERT INTO encomenda DEFAULT VALUES RETURNING id";
            $row = pg_fetch_row( pg_exec($conn, $query));
            $encomendaid = $row['0'];
            $query = "INSERT INTO cliente(nome, imagem, telefone, morada, password, encomendaid) VALUES ('".$nome."', '".$imagem."', '".$telefone."', '".$morada."', '".$pass."', '".$encomendaid."') RETURNING num_socio";
            $num_socio = pg_fetch_row( pg_exec($conn, $query));
        
        ?>

        <div class="note">
            <h1>Obrigado <?php echo $nome;?>!</h1>
            <br>
            <p>O teu número de sócio é:</p>
            <h4><?php echo $num_socio['0'];?></h4>
            <p>Aguarda pacientemente a aprovoção da nossa direção</p>
            <br>
            <a href="inicio.php"><div class="button hvr-grow-shadow">Voltar ao Início</div></a>
        </div>
    </main>


    <?php 
        include 'includes/footer.html';
        include 'includes/modal_login.html';
     ?>

</body>

</html>