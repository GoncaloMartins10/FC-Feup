<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/ef5be7179f.js" crossorigin="anonymous"></script> <!-- Icons library-->
    <link rel="shortcut icon" href="../../images/logo.png">
    <link rel="stylesheet" href="../../style/style.css">
    <title>Tornar-se Sócio</title>
</head>

<?php
  session_start();
?>

<body>
    <?php include "../../includes/header.php" ?>
    
    <main class="center">
        
            <div class="member center">
                <h1>Bem-vindo ao FC FEUP</h1>
                <form method="POST" action="add_socio.php" enctype="multipart/form-data">

                    <div class="item">
                        <input type="text" id="nome" name="nome" placeholder="Nome" required><br>
                    </div>
                    <div class="item">
                        <input type="text" id="morada" name="morada" placeholder="Morada" required><br>                     
                    </div>
                    <div class="item">
                        <input type="tel" id="telefone" name="telefone" pattern="[0-9]{9}"  placeholder="Número de Telefone" required><br>
                    </div>
                    <div class="item">
                        <label for="img">Imagem:</label><br>
                        <input type="file" id="img" name="img" accept="image/*" required><br>                       
                    </div>
                    <div class="item">
                        <input type="password" id="pass" name="pass" placeholder="Password" required><br>                        
                    </div>
                    <div class="item">
                        <button type="submit">Tornar-se Sócio</button>
                    </div>
                </form> 
            </div>

    </main>


    <?php 
        include '../../includes/footer.html';
        include '../../includes/modal_login.html';
     ?>

</body>

</html>