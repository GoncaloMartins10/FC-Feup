<?php
    session_start();

    include "../database/opendb.php";

    $id = $quantidade = $tamanho = "";

    if(isset($_POST['id']))
        $id = $_POST['id'];
    if(isset($_POST['quantidade']))
        $quantidade= $_POST['quantidade'];
    if(isset($_POST['tamanho']))
        $tamanho = $_POST['tamanho'];
    

    if($id == "" OR $quantidade == "" OR $tamanho == ""){
        $_SESSION['error'] = "Por favor preencha todos os campos do formulário";
        header('Location: ../pages/loja.php');
    }
    else{
        //Insere Encomenda no Carrinho
        $query = "SELECT preco from produto WHERE id= '".$id."'"; 
        $result = pg_exec($conn, $query);
        $row = pg_fetch_assoc($result);
        $total = $row['preco'] * $quantidade;
    
        $query = "INSERT INTO linha_encomenda(quantidade, tamanho, total, produtoid, encomendaid) VALUES ('".$quantidade."','".$tamanho."','".$total."','".$id."',(SELECT id FROM encomenda WHERE clienteid ='".$_SESSION['num_socio']."' AND comprado = 'FALSE'))";
        pg_exec($conn, $query);
        
        $query = "UPDATE encomenda SET num_produtos=num_produtos + ".$quantidade.", total=total + ".$total."  WHERE clienteid = '".$_SESSION['num_socio']."' AND comprado = 'FALSE'";
        pg_exec($conn, $query);

        pg_close($conn);
        header('Location: ../pages/carrinho.php');
    }

 ?>