<?php
    session_start();

    include "../database/opendb.php";

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
        header('Location: ../pages/novoproduto.php');
    }
    else{
        $query = "UPDATE produto 
        SET nome = '".$nome."', 
        descricao = '".$descricao."',
        stock = '".$stock."',
        preco = '".$preco."'
        WHERE id = '".$id."' ";
      
      echo $query;
        pg_exec($conn, $query);
        pg_close($conn);

    }
?>