<?php

    if (isset($_POST['id'])) {
        include "../database/opendb.php";
                             
        $query = "select* from produto where id = '".$_POST['id']."'";
        
        $result = pg_exec($conn, $query);
        $row = pg_fetch_assoc($result);
        echo json_encode($row);

        pg_close($conn);
    }
?>


