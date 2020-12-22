<?php
    session_start();
    include "../includes/opendb.php";
    include "../database/encomenda.php";
                            
    updateEncomendaComprado($_SESSION['num_socio']);
    /* Cria Carrinho */
    createEncomenda($_SESSION['num_socio']);

    pg_close($conn);
    
    header('Location: ../pages/comum/inicio.php');
?>