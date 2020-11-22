<?php
    function remove_click($id) {

        include "../database/opendb.php";;
                             
        $query = "DELETE FROM produto WHERE id = '".$id."'";
        pg_exec($conn, $query);

        pg_close($conn);
    } 

    if (isset($_POST['id'])) {
        remove_click($_POST['id']);
    }
?>