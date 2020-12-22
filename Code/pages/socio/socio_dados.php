<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/ef5be7179f.js" crossorigin="anonymous"></script> <!-- Icons library-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="shortcut icon" href="../../images/logo.png">
    <link rel="stylesheet" href="../../style/style.css">
    <link rel="stylesheet" href="../../style/style_admin.css">
    <title>FC FEUP | Sócio</title>
</head>

<?php
  session_start();
?>

<body>

    <?php
    
        include "../../includes/opendb.php";
        include "../../database/socio.php";

        $dados = getsocioByNum($_SESSION['num_socio']);
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

    <?php include "../../includes/header.php" ?>
    
    <main>
        <div class="sidenav">
            <a id="active"  href="socio_dados.php">Dados Pessoais</a>
            <a class="hvr-underline-from-left" href="encomendas.php">Histórico de Encomendas</a>
            <a class="hvr-underline-from-left" href="estatisticas.php">Estatísticas</a>
        </div>

        <div class="content center">
        <h3>Dados Pessoais <span onClick="click_modalEditDados(<?php echo $num_socio; ?>)"><i class="fas fa-edit" style="color: black; cursor: pointer;"></i></span></h3>

            <div class="infobox">
                <img class="logo" src= "../<?php echo($imagem);?>">
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

        <div id="id01" class="modal">
            <div class="content center">

                <div class="member center" style="position: relative;">
                    <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                    <h1>Editar Dados Pessoais</h1>
                    <form method="POST" action="../../actions/edit_socio.php" enctype="multipart/form-data">

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
    </div>


    </main>


    <?php 
        include '../../includes/footer.html';
        include '../../includes/modal_login.html';
     ?>

</body>

<script src="../../javascript/ajax.js"> </script>

</html>