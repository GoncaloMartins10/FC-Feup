<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/ef5be7179f.js" crossorigin="anonymous"></script> <!-- Icons library-->
    <link rel="shortcut icon" href="images/logo.png">
    <link rel="stylesheet" href="style.css">
    <title>Tornar-se Sócio</title>
</head>

<body>
    <header>
        <img class="logo" src="images/logo.png">
        <nav>
           <ul>
                <li class="hvr-underline-from-left"><a href="inicio.html">Inicio</a></li>
                <li class="hvr-underline-from-left"><a href="membros.php">Membros</a></li>
                <li class="hvr-underline-from-left"><a href="loja.html">Loja</a></li>
                <li class="hvr-underline-from-left"><a href="admin_sociopendente.php">Admin</a></li>          
            </ul> 
        </nav>
        <nav>
            <ul>
                <li class="loginandchart hvr-grow-shadow"><a role="button" onclick="document.getElementById('myForm').style.display = 'block'" style="cursor: pointer;">Login <i class="fas fa-sign-in-alt"></i></a></li>
                <li class="loginandchart hvr-grow-shadow"><a href="carrinho.html">Carrinho <i class="fas fa-shopping-cart"></i></a></li>
            </ul> 
         </nav>
    </header>
    
    <main class="center">

        <?php
            $nome = $morada = $telefone = $pass = $imagem = "";

            if(isset($_POST['nome']))
                $nome = $_POST['nome'];

            if(isset($_POST['morada']))
                $morada = $_POST['morada'];

            if(isset($_POST['telefone']))
                $telefone = $_POST['telefone'];

            if(isset($_POST['pass']))    
                $pass = $_POST['pass'];
            
            //Imagem
            $diretorio = "images/";
            $imagem = $diretorio . basename($_FILES["img"]["name"]);
            move_uploaded_file($_FILES["img"]["tmp_name"], $imagem);
            

            echo "Nome: $nome <br>Morada: $morada<br>Telefone: $telefone<br> Pass: $pass<br> imagem: $imagem<br><br>";

            //Conta GONÇALO
            $conn = pg_connect("host=db.fe.up.pt dbname=siem2021 user=siem2021 password=uqKSXuBZ");
            //Conta RICARDO
            //$conn = pg_connect("host=db.fe.up.pt dbname=siem2047 user=siem2047 password=XutlXFnC");

            if(!$conn){
                echo("Ligação não foi estabelecida");
            }
            $query = "set schema 'fcfeup'";
            pg_exec($conn, $query);
            
            echo "INSERT INTO socio(nome, imagem, telefone, morada, pass, aprovado) VALUES ('".$nome."', '".$imagem."', '".$telefone."', '".$morada."', '".$pass."', 'FALSE')";
            $query = "INSERT INTO socio(nome, imagem, telefone, morada, pass, aprovado) VALUES ('".$nome."', '".$imagem."', '".$telefone."', '".$morada."', '".$pass."', 'FALSE')";
            pg_exec($conn, $query);
        ?>


    </main>


    <footer>
        <div class="container">
            <div class="title"><h2>Informações</h2></div>
            <div class="info">
                <i class="fas fa-map-marker-alt"></i>   Rua Dr. Roberto Frias, 4200-465 Porto<br>
                <i class="fas fa-phone"></i>  929999999 <br>
                <i class="fas fa-envelope"></i>   fcfeup@fe.up.pt 
            </div>
        </div>
        <div class="container">
            <div class="title"><h2>Parceiros</h2></div>
            <div class="partners center">
                <div class="box hvr-grow-shadow">
                    <a href="https://www.inesctec.pt/" target="_blank"><img src="images/inesctec.png"></a>
                </div>
                <div class="box hvr-grow-shadow">
                    <a href="https://www.inegi.pt/" target="_blank"><img src="images/inegi.jpg"></a>
                </div>
                <div class="box hvr-grow-shadow">
                    <a href="https://www.aefeup.pt/" target="_blank"><img src="images/aefeup.png"></a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="title"><h2>Redes Sociais</h2></div>
            <div class="socialmedia">
                <a href="https://www.facebook.com/paginafeup/" target="_blank" class="fa fa-facebook hvr-grow-shadow"></a>
                <a href="https://www.youtube.com/user/FEUPtv" target="_blank" class="fa fa-youtube hvr-grow-shadow"></a>
                <a href="https://www.instagram.com/feup_porto/" target="_blank" class="fa fa-instagram hvr-grow-shadow"></a>
            </div>
        </div>
    </footer>
    <div class="copyright">
        &copy 2020, Gonçalo Martins & Ricardo Martins. Todos os direitos reservados.
    </div>

    <div class="form-popup" id="myForm">
        <form action="/action_page.php" class="form-container">
            <span onclick="document.getElementById('myForm').style.display = 'none'" class="close" title="Close Modal">&times;</span>

            <h1>Login</h1>
    
            <label for="numero"><b>Número de Sócio</b></label>
             <input type="text" placeholder="Insira o número de sócio" name="numero" required>
    
            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Insira a Password" name="psw" required>
    
            <button type="submit" class="btn">Login</button>
        </form>
    </div>

</body>

</html>