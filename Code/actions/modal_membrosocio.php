<?php

    if (isset($_POST['id'])) {
        include "../database/opendb.php";
                             
        $query = "select* from cliente where num_socio = '".$_POST['id']."'";
        
        $result = pg_exec($conn, $query);
        $row = pg_fetch_assoc($result);
        echo json_encode($row);

        pg_close($conn);
    }
?>
