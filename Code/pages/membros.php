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
        
        $s = $p = $j = FALSE;
        $procura="";
        $cargos = $_GET['cargos'];
        
        if(isset($_GET['search'])) {
            $procura = $_GET['search'];
            $procura = explode(" ", $procura);
        }

        if(!empty($cargos)){
            
            for($i=0; $i < count($cargos); $i++)
            {
                if( $cargos[$i]=="presidente"){  
                    $p = TRUE;             
                    $query = "select * from cliente where admin = 'TRUE'";
                    if (!empty($procura) && sizeof($procura)>0) {
                        for ($j=0; $j<sizeof($procura) ; $j++)
                            $query .= " AND LOWER(nome) LIKE LOWER('%$procura[$j]%')";
                    }
                    $presidentes = pg_exec($conn, $query);
                    $presidente = pg_fetch_assoc($presidentes);
                }
                elseif($cargos[$i]=="socio"){
                    $s = TRUE;
                    $query = "select * from cliente where admin = 'FALSE' AND aprovacao = 'TRUE'";
                    if (!empty($procura) && sizeof($procura)>0) {
                        for ($j=0; $j<sizeof($procura) ; $j++)
                            $query .= " AND LOWER(nome) LIKE LOWER('%$procura[$j]%')";
                    }
                    $socios = pg_exec($conn, $query);
                    $socio = pg_fetch_assoc($socios);
                }
                else{
                    $j = TRUE;  
                    $query = "select * from jogador";
                    if (!empty($procura) && sizeof($procura)>0) {
                        for ($j=0; $j<sizeof($procura) ; $j++)
                            $query .= " WHERE LOWER(nome) LIKE LOWER('%$procura[$j]%')";
                    }
                    $jogadores = pg_exec($conn, $query);
                    $jogador = pg_fetch_assoc($jogadores);
                }
            }
        }
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

    <form class="search" action="membros.php" method="GET">
        <div class="item">
            <input type="checkbox" name="cargos[]" value="jogador" checked>
            <label for="jogadores"> Jogadores</label>
        </div>
        <div class="item">
            <input type="checkbox" name="cargos[]" value="presidente" checked>
            <label for="presidentes"> Presidentes</label>
        </div>
        <div class="item">
            <input type="checkbox" name="cargos[]" value="socio" checked>
            <label for="socios"> Sócios</label>
        </div>

        <div class="item">
            <input type="text" id="search" name="search" placeholder="Nº Sócio ou Nome">
        </div>

        <div class="item">
            <button type="submit" name="procura"><i class="fas fa-search"></i></button>
        </div>

    <?php if(! isset($_SESSION['num_socio']) ) { ?>
        <div class="item" style="margin-left: auto;">
            <a href="socio.php"><div class="button hvr-grow-shadow">Tornar-se Sócio</div> </a>
        </div>             
    <?php }?>

    </form> 

<?php   if(empty($cargos)){ ?>
            <main class="center" style="flex-direction: column;">
                <img src="../images/empty-search.png">
                <h3>Não selecionou nenhum cargo</h3>
            </main>
<?php   } 
        else { 
            if(empty($presidente['num_socio']) AND empty($socio['num_socio']) AND empty($jogador['num_camisola']) ){ ?>

            <main class="center" style="flex-direction: column;">
                <img src="../images/empty-search.png">
                <h3>Não encontrámos nada, procure novamente!</h3>
            </main>

<?php       }
            else {?>

            <main>
<?php
                if($p AND !empty($presidente)){ ?>
                    <h3>Presidentes</h3>

                    <div class="flexbox">

                    <?php while(isset($presidente['num_socio'])){ ?>

                        <div class="card">
                            <img src= "<?php echo $presidente['imagem']; ?>">
                            <div class="text">
                                <b>Nº Sócio:</b> <?php echo $presidente['num_socio']; ?><br>
                                <b>Nome:</b> <?php echo $presidente['nome']; ?><br>
                            </div>
                        </div>

                    <?php
                        $presidente = pg_fetch_assoc($presidentes);
                    } ?>

                    </div>
<?php           }

                if($s AND !empty($socio)){ ?>
                    <h3>Sócios</h3>

                    <div class="flexbox">

                    <?php while(isset($socio['num_socio'])){ ?>

                        <div class="card">
                            <img src= "<?php echo $socio['imagem']; ?>">
                            <div class="text">
                                <b>Nº Sócio:</b> <?php echo $socio['num_socio']; ?><br>
                                <b>Nome:</b> <?php echo $socio['nome']; ?><br>
                            </div>
                        </div>

                    <?php
                        $socio = pg_fetch_assoc($socios);
                    } ?>

                    </div>

<?php           }
                if($j AND !empty($jogador)){ ?>
                    <h3>Jogadores</h3>

                    <div class="flexbox">

                    <?php while(isset($jogador['num_camisola'])){ ?>

                        <div class="card">
                            <img src= "<?php echo $jogador['imagem']; ?>">
                            <div class="text">
                                <b>Nº Camisola:</b> <?php echo $jogador['num_camisola']; ?><br>
                                <b>Nome:</b> <?php echo $jogador['nome']; ?><br>
                                <b>Posição:</b> <?php echo $jogador['posicao']; ?><br>
                            </div>
                        </div>

                    <?php
                        $jogador = pg_fetch_assoc($jogadores);
                    } ?>

                    </div>

<?php           }?>

            </main>

<?php           } 
        } ?>

    <?php 
        include '../includes/footer.html';
        include '../includes/modal_login.html';
     ?>

</body>