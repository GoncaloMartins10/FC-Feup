<?php $page = basename($_SERVER['PHP_SELF']);?>


<header>   

    <img class="logo" src="../../images/logo.png">
    <nav>
        <ul>
            <li id="<?php if($page == 'inicio.php'){echo 'active"';}else{?>" class=" <?php echo 'hvr-underline-from-left"';}?>" > <a href="../comum/inicio.php"> Inicio</a></li>
            <li id="<?php if($page == 'membros.php'){echo 'active"';}else{?>" class=" <?php echo 'hvr-underline-from-left"';}?>" ><a href="../comum/membros.php">Membros</a></li>
            <li id="<?php if($page == 'loja.php'){echo 'active"';}else{?>" class=" <?php echo 'hvr-underline-from-left"';}?>" ><a href="../comum/loja.php">Loja</a></li>
            <?php if(isset($_SESSION['num_socio']) and $_SESSION['admin']=="t") { ?>
            <li id="<?php if($page == 'sociopendente.php'){echo 'active"';}else{?>" class=" <?php echo 'hvr-underline-from-left"';}?>" ><a href="../admin/sociopendente.php">Admin</a></li>          
            <?php }?>
            <?php if(isset($_SESSION['num_socio']) and $_SESSION['admin']=="f") { ?>
            <li id="<?php if($page == 'encomendas.php'){echo 'active"';}else{?>" class=" <?php echo 'hvr-underline-from-left"';}?>" ><a href="../socio/encomendas.php">Sócio</a></li>          
            <?php }?>
        </ul> 
    </nav>
    <nav>
        <ul>
            <?php if(isset($_SESSION['num_socio']) ) { ?>
                <li class="loginandchart hvr-grow-shadow"><a role="button" style="cursor: pointer;" href="../../actions/logout.php">Logout <i class="fas fa-sign-in-alt"></i></a></li>
            <?php } else {?>
                <li class="loginandchart hvr-grow-shadow"><a role="button" onclick="document.getElementById('myForm').style.display = 'block'" style="cursor: pointer;">Login <i class="fas fa-sign-in-alt"></i></a></li>
            <?php }?>
                <li class="loginandchart hvr-grow-shadow"><a href="../../pages/comum/carrinho.php">Carrinho <i class="fas fa-shopping-cart"></i></a></li>
        </ul> 
    </nav>

</header>