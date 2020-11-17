<!DOCTYPE html>

<html>
    <head>
    </head>

    <body>

        <?php
        //Conta GONÇALO
        $conn = pg_connect("host=db.fe.up.pt dbname=siem2021 user=siem2021 password=uqKSXuBZ");
        //Conta RICARDO
        //$conn = pg_connect("host=db.fe.up.pt dbname=siem2047 user=siem2047 password=XutlXFnC");

        if(!$conn){
            echo("Ligação não foi estabelecida");
        }

        $query = "set schema 'fcfeup'";
        pg_exec($conn, $query);
        $query = "select * from cliente";
        $result = pg_exec($conn, $query);
        pg_close($conn);

        $row = pg_fetch_assoc($result); 

        ?>

        <table>
            <tr>
                <th>Numero socio</th>
                <th>nome</th>
                <th>Imagem</th>
                <th>telefone</th>
                <th>morada</th>
                <th>pass</th>
                <th>aprovado</th>
            </tr>
            <?php while(isset($row['num_socio'])){ ?>
            <tr>
                <td><?php echo $row['num_socio']; ?></td>
                <td><?php echo $row['nome']; ?></td>
                <td> <img src= "<?php echo $row['imagem']; ?>"></td>
                <td><?php echo $row['telefone']; ?></td>
                <td><?php echo $row['morada']; ?></td>
                <td><?php echo $row['password']; ?></td>
                <td><?php echo $row['aprovado']; ?></td>
            </tr>
            
            <?php
                $row = pg_fetch_assoc($result);
            } ?>
            </table>

    </body>
</html>