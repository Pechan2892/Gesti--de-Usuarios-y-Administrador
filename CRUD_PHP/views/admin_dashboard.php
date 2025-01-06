<?php

require "../includes/config.php";
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}
//obtener todos los alojamientos
$query = $pdo->query("SELECT * FROM accommodations");
$accommodations = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/alojamientos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<body>
    <div>

        <h1 class="h1">Panel de Administración</h1>
        <form action="../actions/add_accommodation.php" method="POST" enctype="multipart/form-data" class="form">

            <p class="title"> Registro de Alojamientos </p>

            <label>
                <input type="text" name="name" class="input" required>
                <span>Nombre de ALojamiento</span>
            </label>
            <label>
                <textarea name="description" class="input" required></textarea>
                <span>Descripcion</span>
            </label>
            <label>
                <input type="text" name="image_url" class="input" required>
                <span>Url Imagen de Alojamiento</span>
            </label>
            <button type="submit" class="submit">Agregar Alojamiento</button>
        </form>
    </div>
    <h1 class="h1">Alojamientos Registrados</h1>

<div class="prueba">

    <div class="acomodaciones">
        
            <?php foreach ($accommodations as $accommodation): ?>
                <div class="card">
                <div class="imagen">
                <img src="<?= htmlspecialchars($accommodation['image_url']) ?>
                " alt="<?= htmlspecialchars($accommodation['name']) ?>">
                </div>
                <div class="pie">
                    <h3><?= htmlspecialchars($accommodation['name']) ?></h3>
                    <p><?= htmlspecialchars($accommodation['description']) ?></p>

                </div>
                </div>

            <?php endforeach; ?>
        
    </div>
    </div>

</body>

</html>