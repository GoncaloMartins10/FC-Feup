<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/ef5be7179f.js" crossorigin="anonymous"></script> <!-- Icons library-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="shortcut icon" href="../../images/logo.png">
    <link rel="stylesheet" href="../../style/style.css">
    <title>FC FEUP | Membros</title>
</head>

<?php
  session_start();
?>

<body>

    <?php
    
        include "../../includes/opendb.php";
        include "../../database/jogador.php";
        include "../../database/socio.php";
        
        $s = $j = $p = FALSE;
        $procura = "first";

        /* Pesquisa */
        if(isset($_GET['search'])) {
            $procura = $_GET['search'];
            $procura = explode(" ", $procura);  
        }

        /* Filtro dos Cargos*/
        if(isset($_GET['cargos'])) {
            $cargos = $_GET['cargos'];

            for($i=0; $i < count($cargos); $i++)
            {
                if( $cargos[$i]=="presidente"){  
                    $p = TRUE;        
                    $presidentes = getPresidenteByName($procura);
                    $presidente = pg_fetch_assoc($presidentes);
                }
                elseif($cargos[$i]=="socio"){
                    $s = TRUE; 
                    $socios = getSocioByName($procura);
                    $socio = pg_fetch_assoc($socios);
                }
                else {
                    $j = TRUE;  
                    $jogadores = getJogadorByName($procura);
                    $jogador = pg_fetch_assoc($jogadores);
                }
            }
        }
        /* Seleciona Todos */
        else{
            if($procura == "first")
                $s = $j = $p = TRUE;
            else
                $s = $j = $p = FALSE;
        
            $presidentes = getPresidente();
            $presidente = pg_fetch_assoc($presidentes);

            $socios = getSocio();
            $socio = pg_fetch_assoc($socios);

            $jogadores = getAlljogador();
            $jogador = pg_fetch_assoc($jogadores);

        }

        pg_close($conn);
        
    ?>

    <?php include "../../includes/header.php" ?>


    <form class="search" action="membros.php" method="GET">
        <div class="item">
            <input type="checkbox" name="cargos[]" value="jogador" <?php if($j) echo("checked"); ?> >
            <label for="jogadores"> Jogadores</label>
        </div>
        <div class="item">
            <input type="checkbox" name="cargos[]" value="presidente" <?php if($p) echo("checked");?> >
            <label for="presidentes"> Presidentes</label>
        </div>
        <div class="item">
            <input type="checkbox" name="cargos[]" value="socio" <?php if($s) echo("checked");?> >
            <label for="socios"> Sócios</label>
        </div>

        <div class="item">
            <input type="text" id="search" name="search" placeholder="Membro">
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

<?php   if($p == FALSE AND $s == FALSE AND $j == FALSE){ ?>
            <main class="center" style="flex-direction: column;">
                <img src="../../images/empty-search.png">
                <h3>Não selecionou nenhum cargo</h3>
            </main>
<?php   } 
        else { 
            if(empty($presidente['num_socio']) AND empty($socio['num_socio']) AND empty($jogador['num_camisola']) ){ ?>

            <main class="center" style="flex-direction: column;">
                <img src="../../images/empty-search.png">
                <h3>Não encontramos nada, procure novamente!</h3>
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
                            <img src= "../<?php echo $presidente['imagem']; ?>" id="<?php echo $presidente['num_socio'];?>" style="cursor: pointer;"  onClick="click_modalMembro(this.id)">
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
                            <img src= "../<?php echo $socio['imagem']; ?>" id="<?php echo $socio['num_socio'];?>" style="cursor: pointer;"  onClick="click_modalMembro(this.id)">
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
                            <img src= "../<?php echo $jogador['imagem']; ?>">
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
        include '../../includes/footer.html';
        include '../../includes/modal_login.php';
     ?>
    
    <div id="id01" class="modal">

        <form class="modal-content animate" action="../../actions/add_carrinho.php" method="post" name="modal_membrosocio">   

            <div class="imgcontainer center">
                <img id="img01" alt="Avatar" class="avatar">
            </div>

            <div class="details"> 
                <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                <h3>Detalhes</h3>
                <table id=cart>
                    <tr>
                        <th>Nome:</th>
                        <td id="nome"> </td>
                    </tr>
                    <tr>
                        <th>Número Sócio:</th>
                        <td id="num_socio"> </td>
                    </tr>
                    <tr>
                        <th>Morada:</th>
                        <td id="morada"> </td>
                    </tr>
                    <tr>
                        <th>Telefone:</th>
                        <td id="telefone"> </td>
                    </tr>
                </table>
            </div>

        </form>
    </div>

</body>

<script src="../../javascript/ajax.js"> </script>

</html>