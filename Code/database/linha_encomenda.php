<?php

  function createlinha_encomenda($quantidade, $tamanho, $total, $id){

    global $conn;

    $query = "INSERT INTO linha_encomenda(quantidade, tamanho, total, produtoid, encomendaid) VALUES ('".$quantidade."','".$tamanho."','".$total."','".$id."',(SELECT id FROM encomenda WHERE clienteid ='".$_SESSION['num_socio']."' AND comprado = 'FALSE'))";
    pg_exec($conn, $query);

  }

  function getLinha_encomendaQuantTot($id){

    global $conn;

    $query = "SELECT quantidade,total FROM linha_encomenda WHERE id = '".$id."' ";
    return pg_exec($conn, $query);
  }

  function deleteLinha_encomenda($id){
    
    global $conn;

    $query = "DELETE FROM linha_encomenda WHERE id = '".$id."' ";
    pg_exec($conn, $query);
  }

  function getLinha_encomenda($cliente,$encomenda){

    global $conn;

    $query = "SELECT linha_encomenda.id, imagem, nome, tamanho, quantidade, data_entrega, linha_encomenda.total FROM linha_encomenda
    JOIN encomenda ON (encomendaid = encomenda.id) 
    JOIN produto ON (produtoid = produto.id)  
    WHERE clienteid = '".$cliente."' AND comprado = 'TRUE' AND encomendaid = '".$encomenda."'";

    return pg_exec($conn, $query);
  }

  function getLinha_encomendaCarrinho($cliente){

    global $conn;

    $query = "SELECT linha_encomenda.id, imagem, nome, tamanho, preco, quantidade, linha_encomenda.total FROM linha_encomenda
    JOIN encomenda ON (encomendaid = encomenda.id) 
    JOIN produto ON (produtoid = produto.id)  
    WHERE clienteid = '".$cliente."' AND comprado = 'FALSE' ";

    return pg_exec($conn, $query);
  }

?>