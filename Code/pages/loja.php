<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/ef5be7179f.js" crossorigin="anonymous"></script> <!-- Icons library-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="shortcut icon" href="../images/logo.png">
    <link rel="stylesheet" href="../style/style.css">
    <title>FC FEUP | Loja</title>
</head>

<?php
    session_start();
        
    include "../database/opendb.php";

    $maxprice = "";
    $minprice = "";
    $price = "";
    $procura = "";
    $sort = "";

    /* Preços*/
    $query = "SELECT MAX(preco) FROM produto";
    $result = pg_exec($conn, $query);
    $row = pg_fetch_assoc($result);
    $maxprice = $row['max'];

    $query = "SELECT MIN(preco) FROM produto";
    $result = pg_exec($conn, $query);
    $row = pg_fetch_assoc($result);
    $minprice = $row['min'];

    if(isset($_GET['price'])) 
        $price = $_GET['price'];
    else
        $price = $maxprice;

    /* Organiza por preço */
    if ( !empty($_GET['sort']) && $_GET['sort'] == 'asc' ) {
        $sort=" ORDER BY preco ASC";
    } 
    if ( !empty($_GET['sort']) && $_GET['sort'] == 'desc' ) {
        $sort=" ORDER BY preco DESC";
    }
    /* Organiza por ordem alfabetica */
    if ( !empty($_GET['sort']) && $_GET['sort'] == 'az' ) {
        $sort=" ORDER BY nome ASC";
    } 
    if ( !empty($_GET['sort']) && $_GET['sort'] == 'za' ) {
        $sort=" ORDER BY nome DESC";
    }

    /* Procura */
    if(isset($_GET['search'])) {
        $procura = $_GET['search'];
        $procura = explode(" ", $procura);
    }

    $query = "select * from produto WHERE preco <= $price";
    if (!empty($procura) && sizeof($procura)>0) {
        for ($k=0; $k<sizeof($procura) ; $k++)
            $query .= " AND LOWER(nome) LIKE LOWER('%$procura[$k]%')";
    }
    $query .= $sort;
    $produtos = pg_exec($conn, $query);
    
    pg_close($conn);

    $produto = pg_fetch_assoc($produtos); 
?>

<body>
    <header>
        <img class="logo" src="../images/logo.png">
        <nav>
            <ul>
                 <li class="hvr-underline-from-left"><a href="inicio.php">Inicio</a></li>
                 <li class="hvr-underline-from-left"><a href="membros.php">Membros</a></li>
                 <li id="active" ><a href="loja.php">Loja</a></li>
                 <?php if(isset($_SESSION['num_socio']) and $_SESSION['admin']=="t") { ?>
                    <li class="hvr-underline-from-left"><a href="admin_sociopendente.php">Admin</a></li>          
                 <?php }?>
                 <?php if(isset($_SESSION['num_socio']) and $_SESSION['admin']=="f") { ?>
                    <li class="hvr-underline-from-left" ><a href="socio_dados.php">Sócio</a></li>          
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

    <form class="search" action="loja.php" method="GET">

        <div class="item">
            <label for="price"> Preço:</label><br>
            <?php echo($minprice); ?> € <input type="range" id="price" name="price" value="<?php echo($price); ?>" min ="<?php echo($minprice); ?>" max="<?php echo($maxprice); ?>" oninput="this.nextElementSibling.value = this.value">
            <output><?php echo($price); ?></output> €
        </div>


        <div class="item">
            <input type="text" id="search" name="search" placeholder="Produto"><br>
        </div>

        <div class="item">
            <select id="sort" name="sort">
                <option value="">-- Ordenar --</option>
                <option value="asc">Preço mais baixo</option>
                <option value="desc">Preço mais alto</option>
                <option value="az">A-Z</option>
                <option value="za">Z-A</option>
            </select>
        </div>

        <div class="item">
            <button type="submit" name="procura"><i class="fas fa-search"></i></button>
        </div>

    </form> 

    <?php if(empty($produto['id'])){ ?> 

        <main class="center" style="flex-direction: column;">
                <img src="../images/empty-search.png">
                <h3>Não encontramos nada, procure novamente!</h3>
        </main>  

    <?php } else { ?> 

        <main>
            <h3>Produtos</h3>
            <div class="flexbox">
                <?php  while(isset($produto['id'])){ ?>

                <div class="card">
                        <img src= "<?php echo $produto['imagem'];?>" id="<?php echo $produto['id'];?>" style="cursor: pointer;"  onClick="reply_click(this.id)">
                        <div class="text">
                            <b>Nome:</b> <?php echo $produto['nome']; ?><br>
                            <b>Preço:</b> <?php echo $produto['preco']; ?>€<br>
                            <b>Stock:</b> <?php echo $produto['stock']; ?><br>
                        </div>
                </div>    

                <?php
                    $produto = pg_fetch_assoc($produtos);
                } ?>    

            </div>
        </main>

    <?php } ?>

    <?php 
        include '../includes/footer.html';
        include '../includes/modal_login.html';
     ?>

    <div id="id01" class="modal">

        <form class="modal-content animate" action="../actions/add_carrinho.php" method="post" name="modal_loja">   

            <div class="imgcontainer center">
                <h4 id="titulo"> </h4>        
                <img id="img01" alt="Avatar" class="avatar">
            </div>

            <div class="details"> 
                <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                <b>Descrição:<br></b>
                <p id="descricao"></p><br>
                
                <input type="number" name="id" value=''>

                <label for="uname"><b>Quantidade</b></label>
                <input type="number" placeholder=0  name="quantidade" required><br><br>

                <label for="tamanho"><b>Tamanho</b></label>
                <input list="tamanhos" placeholder="S" name="tamanho" required><br><br>
                <datalist id="tamanhos">
                <option value="S">
                <option value="M">
                <option value="L">
                <option value="XL">
                <option value="XXL">
                </datalist>

                <b>Preço:</b> <p id="preco"> </p> <br><br> 
                <button type="submit">Adicionar ao carrinho</button>
            </div>

        </form>
    </div>

    <script>
        // Get the modal 
        var modal = document.getElementById("id01");

        function reply_click(clicked_id) {

            var img = document.getElementById(clicked_id);
            var modalImg = document.getElementById("img01");

            $.ajax({
                    url: '../actions/modal_loja.php',
                    type: 'POST',
                    data: {"id":clicked_id},
                    datatype: "json",
                    success: function(result) { 
                        var data = JSON.parse(result);
                        document.getElementById("titulo").innerHTML = data.nome;
                        document.getElementById("descricao").innerHTML = data.descricao;
                        document.getElementById("preco").innerHTML = data.preco+"€";
                        
                        document.forms['modal_loja']['id'].value = clicked_id;
                        document.forms['modal_loja']['id'].type = "hidden";
                    }
            });
            setTimeout(function() {
                modal.style.display = "block";
                modalImg.src = img.src;   
            }, 100); 
        }
    </script>

</body>