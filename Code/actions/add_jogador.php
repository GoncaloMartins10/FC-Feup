<?php
    session_start();
    include "../database/jogador.php";
    include "../includes/opendb.php";

    $nome = $posicao = $idade = $numero = $imagem = "";

    if(isset($_POST['nome']))
        $nome = $_POST['nome'];
    if(isset($_POST['posicao']))
        $posicao = $_POST['posicao'];
    if(isset($_POST['idade']))
        $idade = $_POST['idade'];
    if(isset($_POST['numero']))
        $numero = $_POST['numero'];
    
    
    //Imagem
    $diretorio = "../images/";
    $imagem = $diretorio . basename($_FILES["img"]["name"]);
    move_uploaded_file($_FILES["img"]["tmp_name"], $imagem);

    if($nome == "" OR $posicao == "" OR $idade == "" OR $numero == "" OR $imagem == ""){
        $_SESSION['error'] = "Por favor preencha todos os campos do formulário";
        header('Location: ../pages/admin/novojogador.php');
    }
    else{
        //Pesquisa Jogador       
        $result = getjogadorById($numero);
        $num_registos = pg_numrows($result);

        if($num_registos > 0){
            $_SESSION['error'] = "Esse número já está atribuido. Por favor insira outro!";
            header('Location: ../pages/admin/novojogador.php');
        } 
        else{
            createjogador($numero, $nome, $posicao, $idade, $imagem);
            header('Location: ../pages/comum/membros.php');
        }

        pg_close($conn);
    }
 ?>