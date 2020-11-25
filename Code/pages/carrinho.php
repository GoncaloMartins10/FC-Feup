<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/ef5be7179f.js" crossorigin="anonymous"></script> <!-- Icons library-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="shortcut icon" href="../images/logo.png">
    <link rel="stylesheet" href="../style/style.css">
    <title>FC FEUP | Carrinho</title>
</head>

<?php
  session_start();
?>

<body>

    <?php
        
        include "../database/opendb.php";

        $query = "set schema 'fcfeup'";
        pg_exec($conn, $query);

        $query = "SELECT linha_encomenda.id, imagem, nome, tamanho, preco, quantidade, linha_encomenda.total FROM linha_encomenda
                  JOIN encomenda ON (encomendaid = encomenda.id) 
                  JOIN produto ON (produtoid = produto.id)  
                  WHERE clienteid = '".$_SESSION['num_socio']."' AND comprado = 'FALSE' ";

        $result = pg_exec($conn, $query);
        $row = pg_fetch_assoc($result); 

        $query = "SELECT * FROM encomenda
                  WHERE clienteid = '".$_SESSION['num_socio']."' AND comprado = 'FALSE' ";

        $result2 = pg_exec($conn, $query);
        $row2 = pg_fetch_assoc($result2); 
        
        pg_close($conn);
    ?>

    <header>
        <img class="logo" src="../images/logo.png">
        <nav>
            <ul>
                 <li class="hvr-underline-from-left"><a href="inicio.php">Inicio</a></li>
                 <li class="hvr-underline-from-left"><a href="membros.php">Membros</a></li>
                 <li class="hvr-underline-from-left"><a href="loja.php">Loja</a></li>
                 <?php if(isset($_SESSION['num_socio']) and $_SESSION['admin']=="t") { ?>
                    <li class="hvr-underline-from-left"><a href="admin_sociopendente.php">Admin</a></li>          
                 <?php }?>
             </ul> 
        </nav>
        <nav>
            <ul>
            <?php if(isset($_SESSION['num_socio']) ) { ?>
                <li class="loginandchart hvr-grow-shadow"><a role="button" style="cursor: pointer;" href="../actions/logout.php">Logout <i class="fas fa-sign-in-alt"></i></a></li>
            <?php } else {?>
                <li class="loginandchart hvr-grow-shadow"><a role="button" onclick="document.getElementById('myForm').style.display = 'block'" style="cursor: pointer;">Login <i class="fas fa-sign-in-alt"></i></a></li>
            <?php }?>

                <li class="loginandchart hvr-grow-shadow"><a href="carrinho.php">Carrinho <i class="fas fa-shopping-cart"></i></a></li>
            </ul> 
        </nav>
    </header>


    <main class="center" style="flex-direction: column; margin: 20px 0; justify-content: space-between;">


    <?php if(empty($row['id'])){ ?>
                      <img src="../images/empty-search.png">
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
                      <td><i class="fas fa-trash"  style="cursor: pointer;" onClick=" eliminate_click(<?php echo $row['id'] ?>)" ></i></td>
                      <td>#<?php echo $row['id']; ?></td>
                      <td><img src= "<?php echo $row['imagem']; ?>"></td>
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


            <?php if(empty($row2['id'])){ ?>
                      <img src="../images/empty-search.png">
                      <h3>Carrinho Vazio</h3>
            <?php } else {?>
                        <?php while(isset($row2['id']) and !empty($row2['id']) ){ ?>
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
                        <?php
                            $row2 = pg_fetch_assoc($result);
                        }
                    } ?>
                    </table>


    <div class="button-container">
      <a href="../actions/comprar_carrinho.php"> <button class="hvr-grow-shadow">Comprar</button></a>
      <a href="../pages/loja.php"><button class="hvr-grow-shadow" style="background: #284b63">Adicionar mais Produtos</button></a>
    </div>

    </main>

    <?php 
        include '../includes/footer.html';
        include '../includes/modal_login.html';
     ?>


    <script>
      function eliminate_click(id) {
          if (confirm("Tem a certeza que quer apagar")) {
                  $.ajax({
                      url: '../actions/remove_linhaencomenda.php',
                      type: 'POST',
                      data: {"id":id},
                      success: function(response) { window.location.reload();}
                  });
          }
      }  
    </script>

</body>

</html>