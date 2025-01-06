<?php
require '../includes/config.php';
session_start();

// Verificar si el usuario ha iniciado sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        die("Todos los campos son obligatorios.");
    }

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        header('Location: ../views/user_account.php');
    } else {
        header('Location: ../views/login.php?error=invalid_credentials');
    }
}
?>