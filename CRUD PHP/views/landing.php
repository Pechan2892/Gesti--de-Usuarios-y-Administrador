<?php

require "../includes/config.php";
$query = $pdo->query("SELECT * FROM accommodations");
$accommodations = $query->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Landing Page</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <h1>Alojamientos Disponibles</h1>
    <div class="accommodations-container">
        <?php foreach ($accommodations as $accommodation): ?>
            <div class="accommodation-card">
                <img src="<?= htmlspecialchars($accommodation['image_url']) ?>" alt="<?= htmlspecialchars($accommodation['name']) ?>">
                <h3><?= htmlspecialchars($accommodation['name']) ?></h3>
                <p><?= htmlspecialchars($accommodation['description']) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>