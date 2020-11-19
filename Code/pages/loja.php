<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/ef5be7179f.js" crossorigin="anonymous"></script> <!-- Icons library-->
    <link rel="shortcut icon" href="../images/logo.png">
    <link rel="stylesheet" href="../style/style.css">
    <title>FC FEUP | Loja</title>
</head>

<?php
  session_start();
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

    <form class="search" action="/action_page.php">
        <div class="item">
            <label for="price"> Preço:</label><br>
            0 € <input type="range" id="price" value="100" min ="0" max="100" oninput="this.nextElementSibling.value = this.value">
            <output>100</output> €
        </div>


        <div class="item">
            <input type="text" id="search" name="search" placeholder="Produto"><br>
        </div>

    </form> 

    <main>        
            <h3>Produtos</h3>

            <div class="flexbox">
                <div class="card hvr-grow">
                    <img src="../images/cr7.jpg" id="1" style="cursor: pointer;"  onClick="reply_click(this.id)">
                    <div class="text">
                        <b>Nome:</b> Cristiano Ronaldo<br>
                        <b>Preço:</b> 20,99€ <br>
                        <b>Stock:</b> 30 Unidades <br>
                    </div>
                </div>
                <div class="card">
                    <img src="../images/cr7.jpg">
                    <div class="text">
                        <b>Nome:</b> Cristiano Ronaldo<br>
                        <b>Preço:</b> 20,99€ <br>
                        <b>Stock:</b> 30 Unidades <br>
                    </div>
                </div>
                <div class="card">
                    <img src="../images/cr7.jpg">
                    <div class="text">
                        <b>Nome:</b> Cristiano Ronaldo<br>
                        <b>Preço:</b> 20,99€ <br>
                        <b>Stock:</b> 30 Unidades <br>
                    </div>
                </div>
                <div class="card">
                    <img src="../images/camisola.jpg">
                    <div class="text">
                        <b>Nome:</b> Camisola Principal<br>
                        <b>Preço:</b> 111.99€ <br>
                        <b>Stock:</b> 100 Unidades <br>
                    </div>
                </div>
                <div class="card">
                    <img src="../images/cr7.jpg">
                    <div class="text">
                        <b>Nome:</b> Cristiano Ronaldo<br>
                        <b>Preço:</b> 20,99€ <br>
                        <b>Stock:</b> 30 Unidades <br>
                    </div>
                </div>
                <div class="card">
                    <img src="../images/cr7.jpg">
                    <div class="text">
                        <b>Nome:</b> Cristiano Ronaldo<br>
                        <b>Preço:</b> 20,99€ <br>
                        <b>Stock:</b> 30 Unidades <br>
                    </div>
                </div>
                    
                <div class="card">
                    <img src="../images/cr7.jpg">
                    <div class="text">
                        <b>Nome:</b> Cristiano Ronaldo<br>
                        <b>Preço:</b> 20,99€ <br>
                        <b>Stock:</b> 30 Unidades <br>
                    </div>
                </div>

                <div class="card hvr-grow">
                    <img src="../images/marega.jpg" id="2" style="cursor: pointer;"  onClick="reply_click(this.id)">
                    <div class="text">
                        <b>Nome:</b> Cristiano Ronaldo<br>
                        <b>Preço:</b> 20,99€ <br>
                        <b>Stock:</b> 30 Unidades <br>
                    </div>
                </div>

                <div class="card">
                    <img src="../images/biden.jpg" id="3" style="cursor: pointer;"  onClick="reply_click(this.id)">
                    <div class="text">
                        <b>Nome:</b> Cristiano Ronaldo<br>
                        <b>Preço:</b> 20,99€ <br>
                        <b>Stock:</b> 30 Unidades <br>
                    </div>
                </div>

            </div>
                
    </main>


    <?php 
        include '../includes/footer.html';
        include '../includes/modal_login.html';
     ?>


    <div id="id01" class="modal">
        <form class="modal-content animate" action="/action_page.php" method="post">   
          
          <div class="imgcontainer center">
            <h4>Camisola Oficial</h4>          
            <img id="img01" alt="Avatar" class="avatar">
          </div>
    
          <div class="details"> 
            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
            <b>Descrição:<br></b>
            <p>Camisola oficial dos nossos atletas para a época 2019/2020</p><br>
            
            <label for="uname"><b>Quantidade</b></label>
            <input type="number" placeholder=0  name="uname" required><br><br>
            <label for="tamanho"><b>Tamanho</b></label>
            <input list="tamanhos" placeholder="S" name="tamanho"><br><br>
            <datalist id="tamanhos">
              <option value="S">
              <option value="M">
              <option value="L">
              <option value="XL">
              <option value="XXL">
            </datalist>
            <b>Preço:</b> 20,99€<br><br> 
            <button type="submit">Adicionar ao carrinho</button>
          </div>

        </form>
    </div>


    <script>
        // Get the modal 
        var modal = document.getElementById("id01");
        function reply_click(clicked_id) {
            // Get the image and insert it inside the modal - use its "alt" text as a caption
            var img = document.getElementById(clicked_id);
            var modalImg = document.getElementById("img01");

            modal.style.display = "block";
            modalImg.src = img.src;      
        }

    </script>

</body>