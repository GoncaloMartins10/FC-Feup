<?php
  session_start();

  $num_socio = $_GET['numero'];
  $password = $_GET['psw'];

  //Conta GONÇALO
  $conn = pg_connect("host=db.fe.up.pt dbname=siem2021 user=siem2021 password=uqKSXuBZ");
  //Conta RICARDO
  //$conn = pg_connect("host=db.fe.up.pt dbname=siem2047 user=siem2047 password=XutlXFnC");
  
  if(!$conn){
    echo("Ligação não foi estabelecida");
  }
  $query = "set schema 'fcfeup'";
  pg_exec($conn, $query);

  echo "SELECT * FROM cliente WHERE num_socio ='".$num_socio."' and password='".$password."' <br>";
  $query = "SELECT * FROM cliente WHERE num_socio ='".$num_socio."' AND password ='".$password."'";
  $result=pg_exec($conn,$query);

  $num_registos = pg_numrows($result);

  /*Verificação do login, com diferentes outputs*/
  
  if ($num_registos > 0) {

    $row = pg_fetch_assoc($result);
    echo "".$row['num_socio']."<br>";
    echo "".$row['admin']."<br>";
    $_SESSION['num_socio'] = $row['num_socio'];
    $_SESSION['admin'] = $row['admin'];
      if(isset($_SESSION['num_socio']) and $_SESSION['admin']=="t") {
        header('Location: ../admin_sociopendente.php'); 
        echo "HELLO"; 
      }
      else { 
        header('Location: ../inicio.php');
        echo "Bye";
       }
  } else {

    $_SESSION['erro']= "Número de Sócio ou Password inexistente! Por favor tente novamente.";
  }

 ?>