<?php

if(isset($_GET['error']) && $_GET['error'] === 'invalid_credentials'): ?>
<p style="color: red;">El usuario o la contraseña son incorrectos.</p>
<?php endif;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="../assets/css/styles.css" rel="stylesheet" type="text/css">
    <title class="title">Iniciar </title>
</head>
<body>
    <form action="../actions/login_action.php" method="POST" class="form">
    <p class="title">Iniciar Sesión</p>
    
    <label>
        <input type="text" name="username"  class="input" alt="Nombre de Usuario" required>
        <span>Usuario</span>
    </label>
    <label>
        <input type="password" name="password" class="input" alt="Contraseña"  required>
        <span>Contraseña</span>
        </label>
        <button type="submit" class="submit">Iniciar Sesión</button> 
        <p class="signin">Aun no tienes Cuenta? <a href="./register.php">Registrate</a> </p>
    </form>
</body>
</html>
