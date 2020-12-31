<?php
    session_start();

    include "../includes/opendb.php";
    include "../database/socio.php";

    $num_socio = $_SESSION['num_socio'];
    $nome = $morada = $telefone = "";

    $imagem = getImagembyNum($num_socio);

    if(isset($_POST['nome']))
        $nome = $_POST['nome'];
    if(isset($_POST['morada']))
        $morada = $_POST['morada'];
    if(isset($_POST['telefone']))
        $telefone = $_POST['telefone'];
    if (file_exists($_FILES['img']['tmp_name']) && is_uploaded_file($_FILES['img']['tmp_name'])) 
    {
        //Apaga imagem anterior
        unlink($imagem);
        $diretorio = "../images/";
        $imagem = $diretorio . basename($_FILES["img"]["name"]);
        move_uploaded_file($_FILES["img"]["tmp_name"], $imagem);
    }

    if($num_socio =="" OR $nome == "" OR $morada == "" OR $telefone == ""){
        $_SESSION['error'] = "Por favor preencha todos os campos do formulário";
        header('Location: ../pages/socio/socio_dados.php');
    }
    else{
        updateSocio($nome, $telefone, $morada, $imagem, $num_socio);
        header('Location: ../pages/socio/socio_dados.php');
    }

    pg_close($conn);
?>