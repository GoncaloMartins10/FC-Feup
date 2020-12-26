<?php
  session_start();
?>

<div class="form-popup" id="myForm">

    <form action="../../actions/login.php" method="POST"  class="form-container">

        <span onclick="document.getElementById('myForm').style.display = 'none'" class="close" title="Close Modal">&times;</span>

        <h1>Login</h1>

        <label for="numero"><b>Número de Sócio</b></label>
        <input type="text" placeholder="Insira o número de sócio" id="numero" name="numero" onkeyup='keyup(this);' required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Insira a Password" id="psw" name="psw" onkeyup='keyup(this);' required>
        <span style="color:red; font-size:15px;"> <?php if(isset($_SESSION['erro'])) echo $_SESSION['erro'];?> </span> <br><br>

        <button type="submit" class="btn">Login</button>
    </form>

</div>



<script>
    <?php if(isset($_SESSION['erro'])) { ?>
            document.getElementById('myForm').style.display = "block";
            document.getElementById('numero').style.border = "2px solid red";
            document.getElementById('psw').style.border = "2px solid red";
    <?php } ?>

    var keyup = function(input) {
        document.getElementById(input.id).style.border = "";
    }

</script>



