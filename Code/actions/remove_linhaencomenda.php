<?php
    session_start();

    if (isset($_POST['id'])) {
        include "../includes/opendb.php";
        include "../database/linha_encomenda.php";
        include "../database/encomenda.php";

        $result = getLinha_encomendaQuantTot($_POST['id']);
        $row = pg_fetch_assoc($result); 

        updateEncomenda($row['quantidade'], $row['total'], $_SESSION['num_socio']);
                             
        deleteLinha_encomenda($_POST['id']);

        pg_close($conn);
    }
?>