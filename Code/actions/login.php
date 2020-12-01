<?php
  session_start();

    $num_socio = $_POST['numero'];
    $password = $_POST['psw'];
    $password_md5 = md5($password);

  include "../database/opendb.php";

  $query = "SELECT * FROM cliente WHERE num_socio ='".$num_socio."' AND password ='".$password_md5."'";
  $result=pg_exec($conn,$query);

  pg_close($conn);

  $num_registos = pg_numrows($result);

  /*Verificação do login, com diferentes outputs*/
  
  if ($num_registos > 0) {

    $row = pg_fetch_assoc($result);
    $_SESSION['num_socio'] = $row['num_socio'];
    $_SESSION['admin'] = $row['admin'];
      if(isset($_SESSION['num_socio']) and $_SESSION['admin']=="t") {
        header('Location: ../pages/admin_sociopendente.php'); 
      }
      elseif(isset($_SESSION['num_socio']) and $_SESSION['admin']=="f") { 
        header('Location: ../pages/socio_dados.php');
       }
  } 
  else {
    $_SESSION['erro']= "Número de Sócio ou Password inexistente! Por favor tente novamente.";
    header('Location: ../pages/inicio.php');
  }

 ?>