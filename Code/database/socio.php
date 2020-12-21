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

    function updateSocio($nome, $telefone, $morada, $password_md5, $num_socio){
        $query = "UPDATE cliente 
                SET nome = '".$nome."', 
                    telefone = '".$telefone."',
                    morada = '".$morada."',
                    password = '".$password_md5."'
                WHERE num_socio = '".$num_socio."' ";

        pg_exec($conn, $query);
    }
?>