<?php
    session_start();

    include "../includes/opendb.php";
    include "../database/socio.php";

    $num_socio = $_SESSION['num_socio'];
    $nome = $morada = $telefone = $pass = "";

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

    if($num_socio =="" OR $nome == "" OR $morada == "" OR $telefone == "" OR $password_md5 == ""){
        $_SESSION['error'] = "Por favor preencha todos os campos do formulário";
        header('Location: ../pages/socio_dados.php');
    }
    else{
        updateSocio($nome, $telefone, $morada, $password_md5, $num_socio);
        pg_close($conn);
        header('Location: ../pages/socio_dados.php');
    }
?>