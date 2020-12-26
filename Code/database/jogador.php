<?php

  function createjogador($numero, $nome, $posicao, $idade, $imagem){

    global $conn;

    $query = "INSERT INTO jogador(num_camisola, nome, posicao, idade, imagem) VALUES ('".$numero."','".$nome."','".$posicao."','".$idade."','".$imagem."')";
    pg_exec($conn, $query);

  }

  function getAlljogador(){

    global $conn;

    $query = "SELECT * FROM jogador";
    $result = pg_exec($conn, $query);

    return $result;
  }

  function getjogadorById($numero){

    global $conn;

    $query = "SELECT * FROM jogador WHERE num_camisola = '".$numero."'";
    $result = pg_exec($conn, $query);

    return $result;
  }

  function getJogadorByName($procura){
    global $conn;

    $query = "SELECT * FROM jogador";

    if (!empty($procura) && sizeof($procura)>0) {
        for ($k=0; $k<sizeof($procura); $k++){
          if($k == 0) 
              $query .= " WHERE LOWER(nome) LIKE LOWER('%$procura[$k]%')";
          else{
              $query .= " AND LOWER(nome) LIKE LOWER('%$procura[$k]%')";
          }
        }  
    }

    return pg_exec($conn, $query);
  }

  function removejogadorById($numero){

    global $conn;

    $query = "DELETE FROM jogador WHERE num_camisola = '".$numero."'";
    pg_exec($conn, $query);
  }

?>