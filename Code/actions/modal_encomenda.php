<?php
    session_start();

    if (isset($_POST['id'])) {
        include "../includes/opendb.php";
        include "../database/linha_encomenda.php";
                             
        $encomendas = getLinha_encomenda($_POST['cliente'],$_POST['id']);
        $encomenda = pg_fetch_assoc($encomendas);

        pg_close($conn);
    }
?>


<div id="id01" class="modal center">

    <div class="content center"> 

            <table id="cart" class="center" style="background-color: white; margin: 0; position: absolute; top: 50%; -ms-transform: translateY(-50%); transform: translateY(-50%);">
              <tr>
                <th>ID</th>
                <th><!-- Foto --></th>
                <th>Produto</th>
                <th>Tamanho</th>
                <th>Quantidade</th>
                <th>Data</th>
                <th>Total</th>
                <th><span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal" style="position: relative">&times;</span></th>
              </tr>
                <?php while(isset($encomenda['id'])){ ?>
                    <tr>
                      <td>#<?php echo $encomenda['id']; ?></td>
                      <td><img src= "../<?php echo $encomenda['imagem']; ?>"></td>
                      <td><?php echo $encomenda['nome']; ?></td>
                      <td><?php echo $encomenda['tamanho']; ?></td>
                      <td><?php echo $encomenda['quantidade']; ?></td>
                      <td><?php echo date("d/m/Y",strtotime($encomenda['data_compra'])); ?></td>
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
