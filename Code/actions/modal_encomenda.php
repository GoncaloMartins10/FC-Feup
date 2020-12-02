<?php
    session_start();

    if (isset($_POST['id'])) {
        include "../database/opendb.php";
                             
        $query = "SELECT linha_encomenda.id, imagem, nome, tamanho, quantidade, data_entrega, linha_encomenda.total FROM linha_encomenda
                  JOIN encomenda ON (encomendaid = encomenda.id) 
                  JOIN produto ON (produtoid = produto.id)  
                  WHERE clienteid = '".$_SESSION['num_socio']."' AND comprado = 'TRUE' AND encomendaid = '".$_POST['id']."'";
        
        $encomendas = pg_exec($conn, $query);
        $encomenda = pg_fetch_assoc($encomendas);

        pg_close($conn);
    }
?>


<div id="id01" class="modal center">

    <div class="content center" style="position:relative;"> 

            <table id=cart style="background-color: white;">
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th style="position:relative;"><span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span></th>
              </tr>
              <tr>
                <th>ID</th>
                <th><!-- Foto --></th>
                <th>Produto</th>
                <th>Tamanho</th>
                <th>Quantidade</th>
                <th>Data</th>
                <th>Total</th>
                <th></th>
              </tr>
                <?php while(isset($encomenda['id'])){ ?>
                    <tr>
                      <td>#<?php echo $encomenda['id']; ?></td>
                      <td><img src= "<?php echo $encomenda['imagem']; ?>"></td>
                      <td><?php echo $encomenda['nome']; ?></td>
                      <td><?php echo $encomenda['tamanho']; ?></td>
                      <td><?php echo $encomenda['quantidade']; ?></td>
                      <td><?php echo $encomenda['data_entrega']; ?></td>
                      <td><?php echo $encomenda['total']; ?> €</td>
                      <td></td>
                    </tr>
                
                <?php
                    $encomenda = pg_fetch_assoc($encomendas);
                } ?>
            </table>
    </div>
</div>

<script>
document.getElementById("id01").style.display = 'block';
</script>
