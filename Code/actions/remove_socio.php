<?php

    include "../includes/opendb.php";
    include "../database/socio.php";

    if (isset($_POST['id'])) {
        removesocioById($_POST['id']);
    }    
    
?>