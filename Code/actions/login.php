<?php
  session_start();
  include "../includes/opendb.php";
  include "../database/socio.php";

  $num_socio = $_POST['numero'];
  $password = $_POST['psw'];
  $password_md5 = md5($password);

  $result = getsocioByNumPass($num_socio, $password_md5);

  pg_close($conn);

  $num_registos = pg_numrows($result);

  $_SESSION['erro'] = null;
  /*Verificação do login, com diferentes outputs*/
  if ($num_registos > 0) {

    $row = pg_fetch_assoc($result);
    $_SESSION['num_socio'] = $row['num_socio'];
    $_SESSION['admin'] = $row['admin'];
    $_SESSION['aprovado'] = $row['aprovacao'];

    if(isset($_SESSION['num_socio']) and $_SESSION['admin']=="t" and $_SESSION['aprovado']=="t") {
      header('Location: ../pages/admin/sociopendente.php'); 
    }
    elseif(isset($_SESSION['num_socio']) and $_SESSION['admin']=="f" and $_SESSION['aprovado']=="t") { 
      header('Location: ../pages/socio/socio_dados.php');
    }
    elseif(isset($_SESSION['num_socio']) and $_SESSION['aprovado']=="f" and $_SESSION['aprovado']=="f") { 
      $_SESSION['num_socio'] = $_SESSION['admin'] = $_SESSION['aprovado'] = null;
      $_SESSION['erro'] = "Sócio pendente de aprovação! Aguarde mais um pouco.";
      header('Location: ../pages/comum/inicio.php');
    }
  } 
  else {
    $_SESSION['erro'] = "Número de Sócio ou Password inexistente! Por favor tente novamente.";
    header('Location: ../pages/comum/inicio.php');
  }

 ?>