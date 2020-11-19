<?php

  session_start();
  $_SESSION['num_socio'] ="";
  $_SESSION['admin'] = "";

  session_destroy();
  header('Location: ../pages/inicio.php');

 ?>