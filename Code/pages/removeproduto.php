<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/ef5be7179f.js" crossorigin="anonymous"></script> <!-- Icons library-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="shortcut icon" href="../images/logo.png">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/style_admin.css">
    <title>FC FEUP | Admin</title>
</head>

<?php
  session_start();
    
  include "../database/opendb.php";

  $query = "select* from produto";
  $result = pg_exec($conn, $query);
  
  pg_close($conn);

  $row = pg_fetch_assoc($result); 
?>

<body>

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
    
   
   
    <main>
        <div class="sidenav">
            <a class="hvr-underline-from-left" href="admin_sociopendente.php">Pedidos de Sócio Pendentes</a>
            <a class="hvr-underline-from-left" href="novoproduto.php">Adicionar Produto</a>
            <a id="active" href="removeproduto.php">Remover Produto</a>
            <a class="hvr-underline-from-left" href="novojogador.php">Adicionar Jogador</a>
            <a class="hvr-underline-from-left" href="removemembro.php">Remover Membro</a>
            <a class="hvr-underline-from-left" href="#contact">Estatísticas Vendas</a>
        </div>

        <div class="content">

            <h3>Produtos</h3>

            <div class="flexbox">
                
            <?php if(empty($row['id'])){ ?>
                        <img src="../images/empty-search.png">
                        <h3>Não há membros atuamente</h3>    
            <?php  }
             else{
                    while(isset($row['id'])){ ?>

                    <div class="card">
                        <span onClick="eliminate_click(<?php echo $row['id'] ?>)" class="remove"><i class="fas fa-times-circle"></i></span>
                        <span onClick="edit_click(<?php echo $row['id'] ?>)" class="edit"><i class="fas fa-edit"></i></span>
                        <img src= "<?php echo $row['imagem']; ?>">
                        <div class="text">
                            <b>Nº Sócio:</b> <?php echo $row['id']; ?><br>
                            <b>Nome:</b> <?php echo $row['nome']; ?><br>
                        </div>
                    </div>

                    <?php
                        $row = pg_fetch_assoc($result);
                    } 
                } ?>
            </div>
 
        </div>
    </main>


    <?php 
        include '../includes/footer.html';
        include '../includes/modal_login.html';
     ?>



    <div id="id01" class="modal">
        <div class="content center">

            <div class="member center">
                <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>  
                <h1>Editar Produto</h1>
                <form method="POST" action="../actions/edit_product.php" enctype="multipart/form-data" name="modal_lojaadmin">
                    
                    <input type="number" name="id" value=''>

                    <div class="item">
                        <input type="text" id="nome" name="nome" value="" required><br>
                    </div>   

                    <div class="item">
                        <textarea type="text" id="descricao" name="descricao" value=""></textarea><br>
                    </div>

                    <div class="item">
                        <input type="number" style="width: 34%;margin-right: 5px;" id="preco" name="preco" value="" min="0.00" max="10000.00" step="0.01" required>
                        <input type="number" style="width: 34%;" id="stock" name="stock" value="" required>
                    </div>

                    <div class="item">
                        <button type="submit">Editar</button>
                    </div>
                </form> 
            </div>
        </div>
    </div>
    

    <script>
        function eliminate_click(id) {
            if (confirm("Tem a certeza que quer apagar o produto")) {
                    $.ajax({
                        url: '../actions/remove_produto.php',
                        type: 'POST',
                        data: {"id":id},
                        success: function(response) { window.location.reload(); }
                    });
            }
        }   

        // Get the modal 
        var modal = document.getElementById("id01");

        function edit_click(clicked_id) {
            var img = document.getElementById(clicked_id);

            $.ajax({
                    url: '../actions/modal_loja.php',
                    type: 'POST',
                    data: {"id":clicked_id},
                    datatype: "json",
                    success: function(result) { 
                        var data = JSON.parse(result);
                        document.getElementById("nome").value = data.nome;
                        document.getElementById("descricao").value = data.descricao;
                        document.getElementById("preco").value = data.preco;
                        document.getElementById("stock").value = data.stock;

                        document.forms['modal_lojaadmin']['id'].value = clicked_id;
                        document.forms['modal_lojaadmin']['id'].type = "hidden";
                    }
            });
            setTimeout(function() {
                modal.style.display = "block";
            }, 100); 
        }
    </script>

</body>

</html>