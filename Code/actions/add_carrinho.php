<?php
    session_start();

    include "../includes/opendb.php";
    include "../database/produto.php";
    include "../database/linha_encomenda.php";
    include "../database/encomenda.php";

    $id = $quantidade = $tamanho = "";

    if(isset($_POST['id']))
        $id = $_POST['id'];
    if(isset($_POST['quantidade']))
        $quantidade= $_POST['quantidade'];
    if(isset($_POST['tamanho']))
        $tamanho = $_POST['tamanho'];
    
    if(isset($_SESSION['num_socio'])){
        if($id == "" OR $quantidade == "" OR $tamanho == ""){
            $_SESSION['error'] = "Por favor preencha todos os campos do formulário";
            header('Location: ../pages/comum/loja.php');
        }
        else{
            $result = getPrecoprodutoById($id);
            $row = pg_fetch_assoc($result);
            $total = $row['preco'] * $quantidade;
        
            createlinha_encomenda($quantidade, $tamanho, $total, $id);
            updateEncomenda($quantidade, $total, $_SESSION['num_socio']);
            pg_close($conn);
            
            header('Location: ../pages/comum/carrinho.php');
        }
    }  
    else{
        header('Location: ../pages/comum/socio.php');
        $_SESSION['error'] = "Para adicionar produtos ao carrinho, inicie sessão ou torne-se sócio.";
    }  
   

 ?>