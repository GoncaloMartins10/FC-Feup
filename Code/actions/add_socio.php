<?php
    function add_click($socio) {

        include "database/opendb.php";
                             
        $query = "UPDATE cliente SET aprovacao = 'TRUE' WHERE num_socio = '".$socio."'";
        pg_exec($conn, $query);
        
        pg_close($conn);
    } 

    if (isset($_POST['id'])) {
        add_click($_POST['id']);
    }
?>