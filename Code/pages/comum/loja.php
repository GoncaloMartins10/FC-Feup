<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/ef5be7179f.js" crossorigin="anonymous"></script> <!-- Icons library-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="shortcut icon" href="../../images/logo.png">
    <link rel="stylesheet" href="../../style/style.css">
    <title>FC FEUP | Loja</title>
</head>

<?php
    session_start();
        
    include "../../includes/opendb.php";
    include "../../database/produto.php";

    $maxprice = "";
    $minprice = "";
    $price = "";
    $procura = "";
    $sort = "";

    /* Preços*/
    $precos = getPrecosMaxMin();
    $maxprice = $precos['max'];
    $minprice = $precos['min'];
    

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

    $produtos = getProdutoFilter($price, $procura, $sort);
    $produto = pg_fetch_assoc($produtos); 
    
    pg_close($conn);
  
?>

<body>
    <?php include "../../includes/header.php" ?>

    <form class="search" action="loja.php" method="GET">

        <div class="item" style="width: 270px; max-width: 270px;">
            <label for="price"> Preço:</label><br>
            <?php echo($minprice); ?> € <input type="range" id="price" name="price" step="0.01" value="<?php echo($price); ?>" min ="<?php echo($minprice); ?>" max="<?php echo($maxprice); ?>" oninput="this.nextElementSibling.value = this.value">
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
                <img src="../../images/empty-search.png">
                <h3>Não encontramos nada, procure novamente!</h3>
        </main>  

    <?php } else { ?> 

        <main>
            <h3>Produtos</h3>
            <div class="flexbox">
                <?php  while(isset($produto['id'])){ ?>

                <div class="card">
                        <img src= "../<?php echo $produto['imagem'];?>" id="<?php echo $produto['id'];?>" style="cursor: pointer;"  onClick="click_modalLoja(this.id)">
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
        include '../../includes/footer.html';
        include '../../includes/modal_login.php';
     ?>

    <div id="id01" class="modal">

        <form class="modal-content animate" action="../../actions/add_carrinho.php" method="post" name="modal_loja">   

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
                <input type="number" min="1" max ="" name="quantidade" required><br><br>

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

</body>

<script src="../../javascript/ajax.js"> </script>

</html>