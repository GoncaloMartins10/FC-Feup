<?php
    session_start();

    include "../database/opendb.php";

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
        $query = "UPDATE cliente 
        SET nome = '".$nome."', 
        telefone = '".$telefone."',
        morada = '".$morada."',
        password = '".$password_md5."'
        WHERE num_socio = '".$num_socio."' ";
      
      echo $query;
        pg_exec($conn, $query);
        pg_close($conn);
        header('Location: ../pages/membros.php');
    }
?>