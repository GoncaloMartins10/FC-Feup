<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/ef5be7179f.js" crossorigin="anonymous"></script> <!-- Icons library-->
    <link rel="shortcut icon" href="../images/logo.png">
    <link rel="stylesheet" href="../style/style.css">
    <title>FC FEUP | Membros</title>
</head>

<?php
  session_start();
?>

<body>

    <?php
    
        include "../database/opendb.php";

        $query = "select* from cliente where aprovacao = 'TRUE'";
        $result = pg_exec($conn, $query);
        pg_close($conn);

        $row = pg_fetch_assoc($result); 
    ?>

    <header>
        <img class="logo" src="../images/logo.png">
        <nav>
            <ul>
                 <li class="hvr-underline-from-left"><a href="inicio.php">Inicio</a></li>
                 <li id="active" ><a href="membros.php">Membros</a></li>
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

    <form class="search" action="/action_page.php">
        <div class="item">
            <input type="checkbox" id="jogadores" name="jogadores" value="jogador"  checked>
            <label for="jogadores"> Jogadores</label>
        </div>
        <div class="item">
            <input type="checkbox" id="presidentes" name="presidentes" value="presidente"  checked>
            <label for="presidentes"> Presidentes</label>
        </div>
        <div class="item">
            <input type="checkbox" id="socios" name="socios" value="socio"  checked>
            <label for="socios"> Sócios</label>
        </div>

        <div class="item">
            <input type="text" id="search" name="search" placeholder="Nº Sócio ou Nome"><br>
        </div>

        <div class="item" style="margin-left: auto;">
            <a href="socio.php"><div class="button hvr-grow-shadow">Tornar-se Sócio</div> </a>
        </div>
    </form> 

    <main>        
       
            <h3>Sócios</h3>

            <div class="flexbox">
                
                <?php if(empty($row['num_socio'])){
                        echo "nada";    
                    }
                    while(isset($row['num_socio'])){ ?>

                    <div class="card">
                        <img src= "<?php echo $row['imagem']; ?>">
                        <div class="text">
                            <b>Nº Sócio:</b> <?php echo $row['num_socio']; ?><br>
                            <b>Nome:</b> <?php echo $row['nome']; ?><br>
                        </div>
                    </div>

                <?php
                    $row = pg_fetch_assoc($result);
                } ?>

            </div>
            
            <h3>Jogadores</h3>
                
            <div class="flexbox">
                <div class="card">
                    <img src="../images/marega.jpg">
                    <div class="text">
                        <b>Nº Sócio:</b> 1235<br>
                        <b>Nome: </b> Moussa Marega<br>
                    </div>
                </div>
                <div class="card">
                    <img src="../images/biden.jpg">
                    <div class="text">
                        <b>Nº Sócio:</b> 1237<br>
                        <b>Nome: </b> Joe Biden<br>
                    </div>
                </div>
            </div>
                
    </main>


    <?php 
        include '../includes/footer.html';
        include '../includes/modal_login.html';
     ?>

</body>