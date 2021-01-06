<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/ef5be7179f.js" crossorigin="anonymous"></script> <!-- Icons library-->
    <link rel="shortcut icon" href="../../images/logo.png">
    <link rel="stylesheet" href="../../style/style.css">
    <title>FC FEUP | Inicio</title>
</head>

<?php
  session_start();
?>

<body>
    <?php include "../../includes/header.php" ?>

    <div id="cover">
        <img src="../../images/logo.png">
        <h5>Futebol Clube da FEUP</h5>
        <h2>Um Engenheiro também sabe jogar à bola</h2>
        <br>
        <p style="color: white;">
            Gonçalo Martins &emsp;-&emsp; Ricardo Martins<br>
            up201604140@fe.up.pt &emsp;-&emsp;  up201608378@fe.up.pt<br>
        </p>

        <div class="iconbox">
            <img class="hvr-grow-shadow" src="../../images/zip-flat.svg">
            <img class="hvr-grow-shadow" src="../../images/css-flat.svg">
            <img class="hvr-grow-shadow" src="../../images/ppt-flat.svg">
        </div>
        
    </div>

    <main class="center" style="flex-direction: column;">

        <div class="main-container">
            <h3>Logins</h3>
            <div class="flexbox">
                <div class="card">
                    <h4>Presidente</h4>
                    <div class="text">
                        <b>Nº Sócio:</b> 1 <br>
                        <b>Password:</b> admin <br>
                    </div>
                </div>
                <div class="card">
                    <h4>Sócio</h4>
                    <div class="text">
                        <b>Nº Sócio:</b> 4 <br>
                        <b>Password:</b> socio <br>
                    </div>
                </div>
            </div>
        </div>

        <div class="main-container">
            <h3>Publicidade</h3>
            <!-- Slideshow container -->
            <div class="slideshow-container">
    
                <div class="mySlides fade">
                <a href="socio.php">
                    <img src="../../images/galeria1.png">
                </a>
                </div>
            
                <div class="mySlides fade">
                <a href="loja.php">
                    <img src="../../images/galeria2.png">
                </a>
                </div>
            
                <div class="mySlides fade">
                <a href="membros.php">
                    <img src="../../images/galeria3.png">
                </a>
                </div>
            
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
            </div>
            <br>
            
            <!-- The dots/circles -->
            <div style="text-align:center">
                <span class="dot" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
                <span class="dot" onclick="currentSlide(3)"></span>
            </div>
        </div>

    </main>

    <?php 
        include '../../includes/footer.html';
        include '../../includes/modal_login.php';
     ?>

<script>
var slideIndex = 0;
showSlides();
var slides,dots;

function showSlides() {
    var i;
    slides = document.getElementsByClassName("mySlides");
    dots = document.getElementsByClassName("dot");
    for (i = 0; i < slides.length; i++) {
       slides[i].style.display = "none";  
    }
    slideIndex++;
    if (slideIndex> slides.length) {slideIndex = 1}    
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";  
    dots[slideIndex-1].className += " active";
    setTimeout(showSlides, 5000); // Change image every 5 seconds
}

function plusSlides(position) {
    slideIndex +=position;
    if (slideIndex> slides.length) {slideIndex = 1}
    else if(slideIndex<1){slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
       slides[i].style.display = "none";  
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";  
    dots[slideIndex-1].className += " active";
}

function currentSlide(index) {
    if (index> slides.length) {index = 1}
    else if(index<1){index = slides.length}
    for (i = 0; i < slides.length; i++) {
       slides[i].style.display = "none";  
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[index-1].style.display = "block";  
    dots[index-1].className += " active";
}
</script>

</body>
</html>