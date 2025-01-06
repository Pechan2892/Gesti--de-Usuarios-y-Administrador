<?php

if(isset($_GET['success']) && $_GET['success'] === 'registered'): ?>
<p style="color: green;">El usuario se ha registrado correctamente.</p>
<?php endif;

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="../assets/css/styles.css" rel="stylesheet" type="text/css">
    <title>Registro</title>
</head>
<body>
    <form action="../actions/register_action.php" method="POST" class="form">
    <p class="title">Crear Cuenta </p>
    <label>
        <input type="text" name="username"  required class="input" alt="Nombre de Usuario">
        <span>Usuario</span>
</label>
<label>
        <input type="password" name="password"  required class="input" alt="COntraseña">
        <span>Contraseña</span>
    </label>
   
    
        <button type="submit" class="submit">Registrarse</button>
    </form>
</body>
</html>
