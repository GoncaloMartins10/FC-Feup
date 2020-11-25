<?php
    function remove_click($socio) {

        include "../database/opendb.php";

        
                             
        $query = "DELETE FROM cliente WHERE num_socio = '".$socio."'";
        pg_exec($conn, $query);

        pg_close($conn);
    } 

    if (isset($_POST['id'])) {
        remove_click($_POST['id']);
    }
?>