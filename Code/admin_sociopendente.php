<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/ef5be7179f.js" crossorigin="anonymous"></script> <!-- Icons library-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="shortcut icon" href="images/logo.png">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style_admin.css">
    <title>FC FEUP | Admin</title>
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
        $query = "select* from socio where aprovado='FALSE';
        ";
        $result = pg_exec($conn, $query);
        pg_close($conn);

        $row = pg_fetch_assoc($result); 
    ?>

    <header>
        <img class="logo" src="images/logo.png">
        <nav>
           <ul>
                <li class="hvr-underline-from-left"><a href="inicio.html">Inicio</a></li>
                <li class="hvr-underline-from-left"><a href="membros.php">Membros</a></li>
                <li class="hvr-underline-from-left"><a href="loja.html">Loja</a></li>
                <li id="active"><a href="admin_sociopendente.php">Admin</a></li>          
            </ul> 
        </nav>
        <nav>
            <ul>
                <li class="loginandchart hvr-grow-shadow"><a role="button" onclick="document.getElementById('myForm').style.display = 'block'" style="cursor: pointer;">Login <i class="fas fa-sign-in-alt"></i></a></li>
                <li class="loginandchart hvr-grow-shadow"><a href="carrinho.html">Carrinho <i class="fas fa-shopping-cart"></i></a></li>
            </ul> 
         </nav>
    </header>
    
    <main>
        <div class="sidenav">
            <a id="active" href="admin_sociopendente.php">Pedidos de Sócio Pendentes</a>
            <a class="hvr-underline-from-left" href="novoproduto.html">Adicionar Produto</a>
            <a class="hvr-underline-from-left" href="#services">Remover Produto</a>
            <a class="hvr-underline-from-left" href="novojogador.html">Adicionar Jogador</a>
            <a class="hvr-underline-from-left" href="removemembro.php">Remover Membro</a>
            <a class="hvr-underline-from-left" href="#contact">Estatísticas Vendas</a>
        </div>

        <div class="content center">

            <?php if(empty($row['num_socio'])){ ?>
                      <img src="images/empty-search.png">
                      <h3>Não há pedidos de sócio pendentes</h3>
            <?php } else {?>
                    <table id=cart>
                        <tr>
                            <th>Nº Sócio</th>
                            <th><!-- Imagem --></th>
                            <th>Nome</th>
                            <th>Morada</th>
                            <th>Telefone</th>
                            <th>Aprovar</th>
                            <th>Eliminar</th>
                        </tr>
                        <?php while(isset($row['num_socio']) and !empty($row['num_socio']) ){ ?>
                            <tr>                    
                                <td><?php echo $row['num_socio']; ?></td>
                                <td><img src= "<?php echo $row['imagem']; ?>"></td>
                                <td><?php echo $row['nome']; ?></td>
                                <td><?php echo $row['morada']; ?></td>
                                <td><?php echo $row['telefone']; ?></td>
                                <td><i class="fas fa-check-circle" style="color:green; cursor: pointer;" onClick=" add_click(<?php echo $row['num_socio'] ?>)" > </i></td>
                                <td><i class="fas fa-times-circle" style="color:red; cursor: pointer;" onClick="eliminate_click(<?php echo $row['num_socio'] ?>)"></i></td>    
                            </tr>
                        
                        <?php
                            $row = pg_fetch_assoc($result);
                    }
                } ?>
                </table> 
                
        </div>
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

    <script>

        function eliminate_click(socio) {
            if (confirm("Tem a certeza que quer rejeitar o sócio")) {
                    $.ajax({
                        url: 'php/remove_socio.php',
                        type: 'POST',
                        data: {"id":socio},
                        success: function(response) { window.location.reload(); }
                    });
            }
            
        }   

        function add_click(socio) {
            if (confirm("Tem a certeza que quer aceitar o sócio")) {
                    $.ajax({
                        url: 'php/add_socio.php',
                        type: 'POST',
                        data: {"id":socio},
                        success: function(response) { window.location.reload(); }
                    });
            }
            
        } 
    </script>

</body>

</html>