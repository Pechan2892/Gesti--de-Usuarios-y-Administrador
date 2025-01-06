<?php
//<a href="#" class="logo"><img src="../assets/img/logo.jpg" alt=""></a>
require "../includes/config.php";
$query = $pdo->query("SELECT * FROM accommodations");
$accommodations = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Landing Page</title>
    
    <link rel="stylesheet" href="../assets/css/landing_css.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<body>



    <header class="header" id="navigation-menu">

        <div class="menu container">
            <a href="#" class="logo">Destino</a>
            <label for="menu">
                <img src="../assets/img/menu.png" class="menu-icono" alt="">
            </label>

            <nav class="navbar">
                <ul>
                    <li><a href="../index.php">Inicio</a></li>
                    <li><a href="./login.php">Iniciar Sesion</a></li>
                    <li><a href="./register.php">Registrarse</a></li>
                    <li><a href="./login.php">Cerrar Sesion</a></li>
                </ul>
            </nav>

            <div class="icons">
                <i class="fa-brands fa-facebook"></i>
                <i class="fa-brands fa-twitter"></i>
                <i class="fa-brands fa-instagram"></i>
            </div>
        </div>

        <div class="header-content container">
            <div class="header-txt">
                <h1>Elige tu alojamiento favorito</h1>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus, dolore voluptates debitis enim est quasi itaque voluptatum id ex vitae beatae facilis commodi nesciunt alias assumenda nisi sint dolorum in.
                </p>
                <a href="#" class="btn-1">Registrarse</a>
            </div>
        </div>

        <div class="images">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <?php foreach ($accommodations as $accommodation): ?>
                        <div class="swiper-slide">


                            <img src="<?= htmlspecialchars($accommodation['image_url']) ?>" alt="<?= htmlspecialchars($accommodation['name']) ?>">
                            <h3><?= htmlspecialchars($accommodation['name']) ?></h3>
                            <p><?= htmlspecialchars($accommodation['description']) ?></p>

                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="rows">
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>

        </div>
    </header>
<footer>Grupo 8 </footer>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
   var swiper=new Swiper(".mySwiper",{
    slidePerView:1,
    centeredSlides:true,
    loop:true,
    spaceBetween:30,
    grapCursor:true,
    navigation:{
        nextE1:'.swiper-button-next',
        prevE1:'.swiper-button-prev',
    },
    breakpoints:{
        991:{slidesPerView:3
    }

    }


   });

</script>
</body>

</html>