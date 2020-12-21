<?php

    include "../includes/opendb.php";
    include "../database/socio.php";

    if (isset($_POST['id'])) {
        $socio = $_POST['id'];                             
        aprovasocioById($socio);
    }
?>