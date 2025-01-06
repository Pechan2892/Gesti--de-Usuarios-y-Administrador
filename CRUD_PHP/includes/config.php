<?php
$host = '127.0.0.1';
$user = "root";
$password = "";
$dbname = "alojamientos_db";


try {
    $pdo = new PDO("mysql:host=$host;port=3309;dbname=$dbname", $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

} catch (PDOException $e) {
   die("Error al conectar, con la base de datos: " . $e->getMessage());
}

?>