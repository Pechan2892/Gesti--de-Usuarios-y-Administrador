<?php
require "../includes/config.php";
session_start();

// Verificar si el usuario ha iniciado sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accommodation_id = $_POST['accommodation_id'] ?? null;
    $user_id = $_SESSION['user_id'] ?? null;

    if ($accommodation_id && $user_id) {
        try {
            // Verificar si el alojamiento ya está asignado al usuario
            $stmt = $pdo->prepare("SELECT * FROM user_accommodations WHERE user_id = ? AND accommodation_id = ?");
            $stmt->execute([$user_id, $accommodation_id]);
            $existing = $stmt->fetch();

            if ($existing) {
                header('Location: ../views/user_account.php?error=already_assigned');
                exit();
            }

            // Insertar la relación en user_accommodations
            $stmt = $pdo->prepare("INSERT INTO user_accommodations (user_id, accommodation_id) VALUES (?, ?)");
            $stmt->execute([$user_id, $accommodation_id]);

            header('Location: ../views/user_account.php?success=1');
            exit();
        } catch (PDOException $e) {
            error_log("Error al agregar el alojamiento: " . $e->getMessage());
            header('Location: ../views/user_account.php?error=db_error');
            exit();
        }
    } else {
        header('Location: ../views/user_account.php?error=missing_data');
        exit();
    }
} else {
    header('Location: ../views/user_account.php?error=invalid_method');
    exit();
}