<?php
require "../includes/config.php";
session_start();

// Verificar si el usuario ha iniciado sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accommodation_id = $_POST['accommodation_id'] ?? null;

    if ($accommodation_id) {
        try {
            // Eliminar el registro de la tabla user_accommodations
            $stmt = $pdo->prepare("DELETE FROM user_accommodations WHERE accommodation_id = ?");
            $stmt->execute([$accommodation_id]);

            header('Location: ../views/user_account.php');
            exit();
        } catch (PDOException $e) {
            // Manejar errores de base de datos
            error_log("Error en la eliminación: " . $e->getMessage());
            header('Location: ../views/user_account.php?error=db_error');
            exit();
        }
    } else {
        // Si falta el accommodation_id
        header('Location: ../views/user_account.php?error=missing_id');
        exit();
    }
} else {
    // Si el método no es POST
    header('Location: ../views/user_account.php?error=invalid_method');
    exit();
}