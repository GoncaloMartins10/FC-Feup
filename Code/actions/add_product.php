<?php
    session_start();

    include "../database/opendb.php";

    $nome = $descricao = $preco = $stock = $imagem = "";

    if(isset($_POST['name']))
        $nome = $_POST['name'];
    if(isset($_POST['discription']))
        $descricao= $_POST['discription'];
    if(isset($_POST['stock']))
        $stock = $_POST['stock'];
    if(isset($_POST['price']))
        $preco = $_POST['price'];
    
    //Imagem
    $diretorio = "../images/";
    $imagem = $diretorio . basename($_FILES["img"]["name"]);
    move_uploaded_file($_FILES["img"]["tmp_name"], $imagem);

    if($nome == "" OR $descricao == "" OR $preco == "" OR $stock == "" OR $imagem == ""){
        $_SESSION['error'] = "Por favor preencha todos os campos do formulário";
        header('Location: ../pages/novoproduto.php');
    }
    else{
        //Insere Produto
        $query = "INSERT INTO produto(nome, descricao, imagem, preco, stock) VALUES ('".$nome."','".$descricao."','".$imagem."','".$preco."','".$stock."')";
        pg_exec($conn, $query);
        pg_close($conn);
        header('Location: ../pages/loja.php');        

    }

 ?>