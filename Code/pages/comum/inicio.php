<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/ef5be7179f.js" crossorigin="anonymous"></script> <!-- Icons library-->
    <link rel="shortcut icon" href="../../images/logo.png">
    <link rel="stylesheet" href="../../style/style.css">
    <title>FC FEUP | Inicio</title>
</head>

<?php
  session_start();
?>

<body>
    <?php include "../../includes/header.php" ?>

    <div id="cover">
        <img src="../../images/logo.png">
        <h5>Futebol Clube da FEUP</h5>
        <h2>Um Engenherio também sabe jogar à bola</h2>
        <br>
        <p style="color: white;">
            Gonçalo Martins &emsp;-&emsp; Ricardo Martins<br>
            up201604140@fe.up.pt &emsp;-&emsp;  up201608378@fe.up.pt<br>
        </p>

        <div class="iconbox">
            <img class="hvr-grow-shadow" src="../../images/zip-flat.svg">
            <img class="hvr-grow-shadow" src="../../images/css-flat.svg">
            <img class="hvr-grow-shadow" src="../../images/ppt-flat.svg">
        </div>
        
    </div>

    <?php 
        include '../../includes/footer.html';
        include '../../includes/modal_login.php';
     ?>

</body>
</html>