<?php

    function createEncomenda($socio){
        global $conn;

        $query = "INSERT INTO encomenda(clienteID) VALUES ('".$socio."')";
        pg_exec($conn, $query);
    }

    function updateEncomenda($quantidade, $total, $socio){

        global $conn;

        $query = "UPDATE encomenda SET num_produtos=num_produtos + ".$quantidade.", total=total + ".$total."  WHERE clienteid = '".$socio."' AND comprado = 'FALSE'";
        pg_exec($conn, $query);
    }

    function updateEncomendaMenos($quantidade, $total, $socio){

        global $conn;

        $query = "UPDATE encomenda SET num_produtos=num_produtos - ".$quantidade.", total=total - ".$total."  WHERE clienteid = '".$socio."' AND comprado = 'FALSE'";
        pg_exec($conn, $query);
    }

    function updateEncomendaComprado($socio){

        global $conn;

        $query = "UPDATE encomenda SET comprado = 'TRUE' WHERE clienteid = '".$socio."' AND comprado = 'FALSE' ";
        
        pg_exec($conn, $query);
    }

    function getEncomendaComprada(){
        
        global $conn;

        $query = "SELECT id, clienteid, nome, num_produtos, data_compra, total  FROM encomenda 
                  JOIN cliente ON (clienteid = cliente.num_socio)
                  WHERE comprado = 'TRUE'";
    
        return pg_exec($conn, $query);
    }

    function getCarrinho($cliente){

        global $conn;

        $query = "UPDATE encomenda
                  SET data_compra = current_date
                  WHERE clienteid = '".$cliente."' AND comprado = 'FALSE' ";
        
        pg_exec($conn, $query);

        $query = "SELECT * FROM encomenda
                  WHERE clienteid = '".$cliente."' AND comprado = 'FALSE' ";

        return pg_exec($conn, $query);
    }
    
    function getallEncomendas($cliente){

        global $conn;

        $query = "SELECT * FROM encomenda WHERE comprado = 'TRUE' AND clienteid = '".$cliente."' ";
        return pg_exec($conn, $query);
    }
?>