<?php
    session_start();

    include "../includes/opendb.php";
    include "../database/produto.php";


    $id = $nome = $descricao = $preco = $stock = "";

    if(isset($_POST['id']))
        $id = $_POST['id'];
    if(isset($_POST['nome']))
        $nome = $_POST['nome'];
    if(isset($_POST['descricao']))
        $descricao= $_POST['descricao'];
    if(isset($_POST['stock']))
        $stock = $_POST['stock'];
    if(isset($_POST['preco']))
        $preco = $_POST['preco'];

    if($id =="" OR $nome == "" OR $descricao == "" OR $preco == "" OR $stock == ""){
        $_SESSION['error'] = "Por favor preencha todos os campos do formulário";
        header('Location: .../pages/admin/removeproduto.php');
    }
    else{
        updateProduto($nome, $descricao, $stock, $preco, $id);
        pg_close($conn);
        header('Location: ../pages/admin/removeproduto.php');
    }
?>