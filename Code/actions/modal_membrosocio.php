<?php

    if (isset($_POST['id'])) {
        include "../includes/opendb.php";
        include "../database/socio.php";

                                     
        $result = getsocioByNum($_POST['id']);
        $row = pg_fetch_assoc($result);
        echo json_encode($row);

        pg_close($conn);
    }
?>
