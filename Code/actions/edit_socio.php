<?php
    session_start();

    include "../includes/opendb.php";
    include "../database/socio.php";

    $num_socio = $_SESSION['num_socio'];
    $nome = $morada = $telefone = "";

    if(isset($_POST['nome']))
        $nome = $_POST['nome'];
    if(isset($_POST['morada']))
        $morada = $_POST['morada'];
    if(isset($_POST['telefone']))
        $telefone = $_POST['telefone'];

    if($num_socio =="" OR $nome == "" OR $morada == "" OR $telefone == ""){
        $_SESSION['error'] = "Por favor preencha todos os campos do formulário";
        header('Location: ../pages/socio/socio_ddados.php');
    }
    else{
        updateSocio($nome, $telefone, $morada, $num_socio);
        pg_close($conn);
        header('Location: ../pages/socio/socio_dados.php');
    }
?>