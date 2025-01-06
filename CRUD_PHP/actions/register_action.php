<?php
require '../includes/config.php';

// Verificar si el usuario ha iniciado sesión

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
   
    // Validar que los campos no estén vacíos
    if (empty($username) || empty($password)) {
        die("Todos los campos son obligatorios.");
    }

    // Validar longitud del nombre de usuario
    if (strlen($username) < 4 || strlen($username) > 20) {
        die("El nombre de usuario debe tener entre 4 y 20 caracteres.");
    }

    // Validar longitud de la contraseña
    if (strlen($password) < 6) {
        die("La contraseña debe tener al menos 6 caracteres.");
    }

    // Hash de la contraseña
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insertar usuario
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?, )");
    try {
        $stmt->execute([$username, $hashedPassword,$rol]);
        header('Location: ../views/login.php?success=registered');
    } catch (PDOException $e) {
        die("Error al registrar: " . $e->getMessage());
    }
}
?>