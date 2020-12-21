<?php

    include "../includes/opendb.php";
    include "../database/jogador.php";

    if (isset($_POST['id'])) {
        removejogadorById($_POST['id']);
    }    
    
?>