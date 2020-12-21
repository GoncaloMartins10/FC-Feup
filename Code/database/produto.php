<?php

  function createProduto($nome, $descricao, $imagem, $preco, $stock){

    global $conn;

    $query = "INSERT INTO produto(nome, descricao, imagem, preco, stock) VALUES ('".$nome."','".$descricao."','".$imagem."','".$preco."','".$stock."')";
    pg_exec($conn, $query);

  }

  function getAllproduto(){

    global $conn;

    $query = "SELECT* from produto";

    return pg_exec($conn, $query);
  }

  function getPrecoprodutoById($id){

    global $conn;

    $query = "SELECT preco from produto WHERE id= '".$id."'"; 

    return pg_exec($conn, $query);
  }

  function getprodutoById($id){

    global $conn;

    $query = "SELECT * from produto WHERE id= '".$id."'"; 

    return pg_exec($conn, $query);
  }

  function updateProduto($nome, $descricao, $stock, $preco, $id){

    global $conn;

    $query = "UPDATE produto 
              SET nome = '".$nome."', 
                  descricao = '".$descricao."',
                  stock = '".$stock."',
                  preco = '".$preco."'
              WHERE id = '".$id."' ";
  
    pg_exec($conn, $query);
  }

  function deleteProduto($id){
    
    global $conn;

    $query = "DELETE FROM produto WHERE id = '".$id."'";
    pg_exec($conn, $query);
  }

?>

