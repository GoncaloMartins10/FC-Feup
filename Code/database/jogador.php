<?php

  function createjogador($numero, $nome, $posicao, $idade, $imagem){

    global $conn;

    $query = "INSERT INTO jogador(num_camisola, nome, posicao, idade, imagem) VALUES ('".$numero."','".$nome."','".$posicao."','".$idade."','".$imagem."')";
    pg_exec($conn, $query);

  }

  function getAlljogador($numero){

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

  function removejogadorById($numero){

    global $conn;

    $query = "DELETE FROM jogador WHERE num_camisola = '".$numero."'";
    pg_exec($conn, $query);
  }

?>