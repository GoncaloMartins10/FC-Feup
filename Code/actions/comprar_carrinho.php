<?php
    session_start();
    include "../includes/opendb.php";
    include "../database/encomenda.php";
    include "../database/linha_encomenda.php";
    include "../database/produto.php";
                            

    //Diminuir stpck
    $produtos = getLinha_encomendaCarrinho($_SESSION['num_socio']);
    $produto = pg_fetch_assoc($produtos);
    while(isset($produto['produtoid'])){
        updateQuantidadeProduto( $produto['quantidade'], $produto['produtoid']);   
        $produto = pg_fetch_assoc($produtos);
    }

    //Encomenda Comprada
    updateEncomendaComprado($_SESSION['num_socio']);
    /* Cria Carrinho */
    createEncomenda($_SESSION['num_socio']);

    pg_close($conn);
    
    header('Location: ../pages/comum/inicio.php');
?>