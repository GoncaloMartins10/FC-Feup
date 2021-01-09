<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/ef5be7179f.js" crossorigin="anonymous"></script> <!-- Icons library-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="shortcut icon" href="../../images/logo.png">
    <link rel="stylesheet" href="../../style/style.css">
    <link rel="stylesheet" href="../../style/style_admin.css">
    <title>Sócio | Dados Pessoais</title>
</head>

<?php
  session_start();
  if($_SESSION['num_socio']==null) 
    header("Location: ../comum/inicio.php");
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
            <a class="hvr-underline-from-left" href="encomendas_pessoais.php">Histórico de Encomendas</a>
            <a class="hvr-underline-from-left" href="estatisticas_pessoais.php">Estatísticas</a>
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

        <h3>Alterar Password <span onClick="click_modalEditPass(<?php echo $num_socio; ?>)"><i class="fas fa-key" style="color: black; cursor: pointer;"></i></span></h3>


        <div id="id01" class="modal">
            <div class="content center">

                <div class="member center" style="position: relative; margin: 0; position: absolute; top: 50%; -ms-transform: translateY(-50%); transform: translateY(-50%);">
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
                            <label for="img">Imagem (Opcional):</label><br>
                            <input type="file" id="img" name="img" accept="image/*"><br>                       
                        </div>
                        <div class="item">
                            <button type="submit">Editar Dados</button>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
        
        <div id="id02" class="modal">
            <div class="content center">

                <div class="member center" style="position: relative; margin: 0; position: absolute; top: 50%; -ms-transform: translateY(-50%); transform: translateY(-50%);">
                    <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
                    <h1>Alterar Password</h1>
                    <form method="POST" action="../../actions/edit_pass.php" enctype="multipart/form-data">

                        <div class="item">
                            <label for="pass_antiga">Password Antiga</label><br>
                            <input type="password" id="pass_antiga" name="pass_antiga"  onkeyup='keyup(this);' required><br>
                            <span id="error" style="color:red; font-size:15px;"> <?php if(isset($_SESSION['erro_pass'])) echo $_SESSION['erro_pass'];?> </span> <br>
                        </div>
                        <div class="item">
                            <label for="pass_nova">Password Nova</label><br>
                            <input type="password" id="pass_nova" name="pass_nova" onkeyup='confirmPassNew(this);' required> 
                            <span id='message2' ><i class='fas fa-times-circle' style="color:red" ></i></span><br>                   
                        </div>
                        <div class="item">
                            <label for="pass_novaa">Confirme Password Nova</label><br>
                            <input type="password" id="pass_novaa" name="pass_novaa" onkeyup='checkPass();' required>
                            <span id='message3' ><i class='fas fa-times-circle' style="color:red" ></i></span><br>
                        </div>
                        <div class="item">
                            <button id="button_pass" type="button">Mudar Password</button>
                        </div>
                    </form> 
                </div>
            </div>
        </div>


    </main>


    <?php 
        include '../../includes/footer.html';
        include '../../includes/modal_login.php';
     ?>

</body>
<script>

    var confirmPassNew = function(pass) {
        
        if ( pass.value )  { 
            document.getElementById('message2').style.color = 'green';
            document.getElementById('message2').innerHTML = "<i class='fas fa-check-circle'></i>";
        } else {
            document.getElementById('message2').style.color = 'red';
            document.getElementById('message2').innerHTML = "<i class='fas fa-times-circle'></i>";
        }
    }

    var checkPass = function() {
        if ( document.getElementById('pass_nova').value == document.getElementById('pass_novaa').value ) {
            document.getElementById('message3').style.color = 'green';
            document.getElementById('message3').innerHTML = "<i class='fas fa-check-circle'></i>";
            document.getElementById('button_pass').type = "submit";
        } else {
            document.getElementById('message3').style.color = 'red';
            document.getElementById('message3').innerHTML = "<i class='fas fa-times-circle'></i>";
        }
    }

    var keyup = function(input) {
        document.getElementById(input.id).style.border = "";
        document.getElementById('error').innerHTML= "";
    }

    <?php if(isset($_SESSION['erro_pass'])) { ?>
            document.getElementById('id02').style.display = "block";
            document.getElementById('pass_antiga').style.border = "2px solid red";
    <?php   $_SESSION['erro_pass'] = null; 
          }?>

</script>

<script src="../../javascript/ajax.js"> </script>

</html>