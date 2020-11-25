<?php
    session_start();
    
    include "../database/opendb.php";
                            
    $query = "UPDATE encomenda SET comprado = 'TRUE' WHERE clienteid = '".$_SESSION['num_socio']."' AND comprado = 'FALSE' ";
    pg_exec($conn, $query);

    /* Cria Carrinho */
    $query = "INSERT INTO encomenda(clienteID) VALUES ('".$_SESSION['num_socio']."')";
    pg_exec($conn, $query);

    pg_close($conn);
    
    header('Location: ../pages/inicio.php');
?>