<?php
    function remove_click($socio) {
        //Conta GONÇALO
        $conn = pg_connect("host=db.fe.up.pt dbname=siem2021 user=siem2021 password=uqKSXuBZ");
        //Conta RICARDO
        //$conn = pg_connect("host=db.fe.up.pt dbname=siem2047 user=siem2047 password=XutlXFnC");

        if(!$conn){
            echo("Ligação não foi estabelecida");
        }
        $query = "set schema 'fcfeup'";
        pg_exec($conn, $query);
                             
        $query = "DELETE FROM socio WHERE num_socio = '".$socio."'";
        pg_exec($conn, $query);
    } 

    if (isset($_POST['id'])) {
        remove_click($_POST['id']);
    }
?>