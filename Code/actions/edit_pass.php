<?php
    session_start();

    include "../includes/opendb.php";
    include "../database/socio.php";

    $num_socio = $_SESSION['num_socio'];
    $passantiga = $passnova = $passnovaa = "";

    if(isset($_POST['pass_antiga']))
        $passantiga = $_POST['pass_antiga'];
    if(isset($_POST['pass_nova']))
        $passnova = $_POST['pass_nova'];
    if(isset($_POST['pass_novaa']))
        $passnovaa = $_POST['pass_novaa'];

    if($num_socio =="" OR $passantiga == "" OR $passnova == "" OR $passnovaa == ""){
        $_SESSION['error'] = "Por favor preencha todos os campos do formulário";
        header('Location: ../pages/socio/socio_dados.php');
    }
    else{
        
        if( md5($passantiga) == pg_fetch_assoc(getPass($num_socio))['password'] ){
            updatePass(md5($passnova), $num_socio);
            pg_close($conn);
            header('Location: ../pages/socio/socio_dados.php');
        }

    }
?>