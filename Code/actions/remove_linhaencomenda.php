<?php
    session_start();

    if (isset($_POST['id'])) {
        include "../database/opendb.php";

        $query = "SELECT quantidade,total FROM linha_encomenda WHERE id = '".$_POST['id']."' ";
        $result = pg_exec($conn, $query);
        $row = pg_fetch_assoc($result); 

        $query = "UPDATE encomenda SET num_produtos=num_produtos - ".$row['quantidade'].", total=total - ".$row['total']."  WHERE clienteid = '".$_SESSION['num_socio']."' AND comprado = 'FALSE'";
        pg_exec($conn, $query);
                             
        $query = "DELETE FROM linha_encomenda WHERE id = '".$_POST['id']."' ";
        pg_exec($conn, $query);

        pg_close($conn);
    }
?>