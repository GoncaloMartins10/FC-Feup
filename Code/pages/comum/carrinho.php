<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/ef5be7179f.js" crossorigin="anonymous"></script> <!-- Icons library-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="shortcut icon" href="../../images/logo.png">
    <link rel="stylesheet" href="../../style/style.css">
    <title>FC FEUP | Carrinho</title>
</head>

<?php
  session_start();
?>

<body>

    <?php
        
        include "../../includes/opendb.php";
        include "../../database/linha_encomenda.php";
        include "../../database/encomenda.php";


        $result = getLinha_encomendaCarrinho($_SESSION['num_socio']);
        $row = pg_fetch_assoc($result); 

        $result2 = getCarrinho($_SESSION['num_socio']);
        $row2 = pg_fetch_assoc($result2); 
        
        pg_close($conn);
    ?>

    <?php include "../../includes/header.php" ?>


    <main class="center" style="flex-direction: column; margin: 20px 0; justify-content: space-between;">


    <?php if(empty($row['id'])){ ?>
                      <img style="width: 200px" src="../../images/carrinho.png">
                      <h3>Carrinho Vazio</h3>
    <?php } else {?>
            <h3>Encomendas</h3>
            <table id=cart>
              <tr>
                <th></th>
                <th>ID</th>
                <th></th>
                <th>Produto</th>
                <th>Tamanho</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Total</th>
              </tr>
                <?php while(isset($row['id']) and !empty($row['id']) ){ ?>
                    <tr>
                      <td><i class="fas fa-trash"  style="cursor: pointer;" onClick=" click_eliminateLinhaEncomenda(<?php echo $row['id'] ?>)" ></i></td>
                      <td>#<?php echo $row['id']; ?></td>
                      <td><img src= "../<?php echo $row['imagem']; ?>"></td>
                      <td><?php echo $row['nome']; ?></td>
                      <td><?php echo $row['tamanho']; ?></td>
                      <td><?php echo $row['preco']; ?></td>
                      <td><?php echo $row['quantidade']; ?></td>
                      <td><?php echo $row['total']; ?></td>
                    </tr>
                
                <?php
                    $row = pg_fetch_assoc($result);
                }
            } ?>
            </table>
            <br><br><br>

          <?php if($row2['num_produtos'] != 0){ ?>
                  <h3>Sumário</h3> 
                    <table id=cart>
                    <tr>
                      <th>Quantidade Produtos:</th>                    
                      <td><?php echo $row2['num_produtos']; ?></td>
                    </tr>
                    <tr>
                      <th>Data Entrega:</th>
                      <td><?php echo $row2['data_entrega']; ?></td>
                    </tr>
                    <tr>
                      <th>Total:</th>
                      <td><?php echo $row2['total']; ?></td>
                    </tr>
                </table>
        <?php } ?>
            


    <div class="button-container">
    <?php if($row2['num_produtos']!= 0){?>
      <a href="../../actions/comprar_carrinho.php"> <button class="hvr-grow-shadow">Comprar</button></a>
    <?php } ?>
      <a href="../../pages/comum/loja.php"><button class="hvr-grow-shadow" style="background: #284b63">Adicionar mais Produtos</button></a>
    </div>

    </main>

    <?php 
        include '../../includes/footer.html';
        include '../../includes/modal_login.html';
     ?>


</body>

<script src="../../javascript/ajax.js"> </script>

</html>