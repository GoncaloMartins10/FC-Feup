<?php

    include "../includes/opendb.php";
    include "../database/produto.php";

    if (isset($_POST['id'])) {
        deleteProduto($_POST['id']);      
    }
?>