<?php

    function createSocio($nome, $imagem, $telefone, $morada, $password_md5){
        global $conn;

        $query = "INSERT INTO cliente(nome, imagem, telefone, morada, password) VALUES ('".$nome."', '".$imagem."', '".$telefone."', '".$morada."', '".$password_md5."') RETURNING num_socio";
        return pg_fetch_row( pg_exec($conn, $query));
    
    }

    function getsocioByNum($num_socio){
        global $conn;

        $query = "SELECT * FROM cliente WHERE num_socio ='".$num_socio."'";
        return pg_exec($conn, $query);
    }

    function getsocioByNumPass($num_socio, $password_md5){
        global $conn;

        $query = "SELECT * FROM cliente WHERE num_socio ='".$num_socio."' AND password ='".$password_md5."'";
        return pg_exec($conn, $query);
    }

    function getPass($num_socio){
        global $conn;

        $query = "SELECT password FROM cliente WHERE num_socio ='".$num_socio."'";
        return pg_exec($conn, $query);
    }

    function getSocio(){
        global $conn;

        $query = "SELECT * FROM cliente 
                  WHERE aprovacao='TRUE' AND admin = 'FALSE';";

        return pg_exec($conn, $query);
    }

    function getSocioByName($procura){
        global $conn;

        $query = "SELECT * FROM cliente 
                  WHERE aprovacao='TRUE' AND admin = 'FALSE'";

        if (!empty($procura) && sizeof($procura)>0) {
            for ($k=0; $k<sizeof($procura) ; $k++)
                $query .= " AND LOWER(nome) LIKE LOWER('%$procura[$k]%')";
        }

        return pg_exec($conn, $query);
    }

    function getsocioNotAprovado(){
        global $conn;

        $query = "SELECT* FROM cliente WHERE aprovacao='FALSE';";
        return pg_exec($conn, $query);
    }

    function getsocioAprovado(){
        global $conn;

        $query = "SELECT* FROM cliente WHERE aprovacao='TRUE';";
        return pg_exec($conn, $query);
    }

    function getPresidente(){
        global $conn;

        $query = "SELECT * FROM cliente 
                  WHERE admin = 'TRUE'";

        return pg_exec($conn, $query);
    }

    function getPresidenteByName($procura){
        global $conn;

        $query = "SELECT * FROM cliente 
                  WHERE admin = 'TRUE'";

        if (!empty($procura) && sizeof($procura)>0) {
            for ($k=0; $k<sizeof($procura) ; $k++)
                $query .= " AND LOWER(nome) LIKE LOWER('%$procura[$k]%')";
        }

        return pg_exec($conn, $query);
    }

    function removesocioById($socio){
        global $conn;

        $query = "DELETE FROM cliente WHERE num_socio = '".$socio."'";
        pg_exec($conn, $query);
    }

    function aprovasocioById($socio){
        global $conn;

        $query = "UPDATE cliente SET aprovacao = 'TRUE' WHERE num_socio = '".$socio."'";
        pg_exec($conn, $query);        
    }

    function updateSocio($nome, $telefone, $morada, $num_socio){
        global $conn;

        $query = "UPDATE cliente 
                  SET nome = '".$nome."', 
                      telefone = '".$telefone."',
                      morada = '".$morada."'
                  WHERE num_socio = '".$num_socio."' ";

        pg_exec($conn, $query);
    }

    function updatePass($password, $num_socio){
        global $conn;

        $query = "UPDATE cliente 
                  SET password = '".$password."'
                  WHERE num_socio = '".$num_socio."' ";

        pg_exec($conn, $query);
    }

?>