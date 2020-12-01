<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/ef5be7179f.js" crossorigin="anonymous"></script> <!-- Icons library-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="shortcut icon" href="../images/logo.png">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/style_admin.css">
    <title>FC FEUP | Sócio</title>
</head>

<?php
  session_start();
?>

<body>

    <?php
    
        include "../database/opendb.php";

        $query = "SELECT * FROM cliente WHERE num_socio = '".$_SESSION['num_socio']."';";
        $dados = pg_exec($conn, $query);

        pg_close($conn);

        $dados = pg_fetch_assoc($dados);

        $num_socio = $dados['num_socio'];
        $nome = $dados['nome'];
        $telefone = $dados['telefone'];
        $morada = $dados['morada']; 
        $imagem = $dados['imagem'];
        
        if($dados['admin']=="t")
            $cargo = "Presidente";
        else
            $cargo = "Sócio";
 
    ?>

    <header>    
        <img class="logo" src="../images/logo.png">
        <nav>
            <ul>
                 <li class="hvr-underline-from-left"><a href="inicio.php">Inicio</a></li>
                 <li class="hvr-underline-from-left"><a href="membros.php">Membros</a></li>
                 <li class="hvr-underline-from-left"><a href="loja.php">Loja</a></li>
                 <?php if(isset($_SESSION['num_socio']) and $_SESSION['admin']=="t") { ?>
                    <li id="active" ><a href="admin_sociopendente.php">Admin</a></li>          
                 <?php }?>
                 <?php if(isset($_SESSION['num_socio']) and $_SESSION['admin']=="f") { ?>
                    <li id="active" ><a href="encomendas.php">Sócio</a></li>          
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
            <a id="active"  href="socio_dados.php">Dados Pessoais</a>
            <a class="hvr-underline-from-left" href="encomendas.php">Histórico de Encomendas</a>
        </div>

        <div class="content center">
            <h3>Dados Pessoais</h3>

            <div class="infobox">
                <img class="logo" src=<?php echo($imagem);?>>
                <div>
                    <h1><?php echo($nome);?></h1>
                    <table>
                        <tr>
                            <th>Nº Sócio:</th>
                            <td><?php echo($num_socio);?></td>
                        </tr>
                        <tr>
                            <th>Morada:</th>
                            <td><?php echo($morada);?></td>
                        </tr>
                        <tr>
                            <th>Telefone:</th>
                            <td><?php echo($telefone);?></td>
                        </tr>
                        <tr>
                            <th>Cargo:</th>
                            <td><?php echo($cargo);?></td>
                        </tr>
                    </table>
                    
                </div>
            </div>


            <div class="member">
                <h1>Editar Dados Pessoais</h1>
                <form method="POST" action="../actions/edit_socio.php" enctype="multipart/form-data">

                    <div class="item">
                        <label for="nome">Nome</label><br>
                        <input type="text" id="nome" name="nome" value ="<?php echo($nome);?>" required><br>
                    </div>
                    <div class="item">
                        <label for="morada">Morada</label><br>
                        <input type="text" id="morada" name="morada" value ="<?php echo($morada);?>" required><br>                     
                    </div>
                    <div class="item">
                        <label for="telefone">Telefone</label><br>
                        <input type="tel" id="telefone" name="telefone" pattern="[0-9]{9}" value ="<?php echo($telefone);?>" required><br>
                    </div>
                    <div class="item">
                        <label for="pass">Password</label><br>
                        <input type="password" id="pass" name="pass" placeholder="Password" required><br>                        
                    </div>
                    <div class="item">
                        <button type="submit">Editar Dados</button>
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