<?php
require "../includes/config.php";
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
$user_id = $_SESSION['user_id'];

// Procesar formulario de agregar alojamiento
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accommodation_id'])) {
    $accommodation_id = $_POST['accommodation_id'];

    try {
        // Verificar si el alojamiento ya esta asignado al usuario
        $stmt = $pdo->prepare("SELECT * FROM user_accommodations WHERE user_id = ? AND accommodation_id = ?");
        $stmt->execute([$user_id, $accommodation_id]);
        $existing = $stmt->fetch();

        if (!$existing) {
            // Insertar la relacion en user_accommodations
            $stmt = $pdo->prepare("INSERT INTO user_accommodations (user_id, accommodation_id) VALUES (?, ?)");
            $stmt->execute([$user_id, $accommodation_id]);

            // Redirigir con éxito
            header('Location: user_account.php?success=1');
            exit();
        } else {
            // Redirigir con error
            header('Location: user_account.php?error=already_assigned');
            exit();
        }
    } catch (PDOException $e) {
        // Redirigir con error de base de datos
        header('Location: user_account.php?error=db_error');
        exit();
    }
}

// Obtener alojamientos del usuario
$stmt = $pdo->prepare("SELECT a.* FROM accommodations a JOIN user_accommodations ua ON a.id = ua.accommodation_id WHERE ua.user_id = ?");
$stmt->execute([$user_id]);
$user_accommodations = $stmt->fetchAll();

// Obtener alojamientos no asignados al usuario
$stmt = $pdo->prepare("SELECT * FROM accommodations WHERE id NOT IN (SELECT accommodation_id FROM user_accommodations WHERE user_id = ?)");
$stmt->execute([$user_id]);
$available_accommodations = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuenta de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        

        table img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        td {
            padding: 0;
            height: 200px;
        }
    </style>
</head>

<body>

    <div class="container my-5">
        <h1 class="mb-4">Mis Alojamientos</h1>
        <!-- Botón para abrir el modal -->
        <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#addAccommodationModal">
            Agregar Alojamiento
        </button>
        <br>
        <br>
        <table class="table table-striped table-bordered">
            <thead class="table-primary">
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($user_accommodations as $accommodation) : ?>
                    <tr>
                        <td>
                            <img src="<?= htmlspecialchars($accommodation['image_url']) ?>" alt="<?= htmlspecialchars($accommodation['name']) ?>" class="accommodation-image">
                        </td>
                        <td><?= htmlspecialchars($accommodation['name']) ?></td>
                        <td><?= htmlspecialchars($accommodation['description']) ?></td>
                        <td>
                            <form action="../actions/delete_accommodation.php" method="POST" class="d-inline">
                                <input type="hidden" name="accommodation_id" value="<?= $accommodation['id'] ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>



        <!-- Mensajes de exito o error -->
        <?php if (isset($_GET['success'])) : ?>
            <div class="alert alert-success mt-3">Alojamiento agregado correctamente.</div>
        <?php elseif (isset($_GET['error'])) : ?>
            <div class="alert alert-danger mt-3">
                <?php if ($_GET['error'] === 'already_assigned') : ?>
                    Este alojamiento ya esta asignado a tu perfil.
                <?php elseif ($_GET['error'] === 'db_error') : ?>
                    Hubo un problema al agregar el alojamiento.
                <?php else : ?>
                    Error desconocido.
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addAccommodationModal" tabindex="-1" aria-labelledby="addAccommodationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAccommodationModalLabel">Agregar Alojamiento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="user_account.php">
                        <div class="mb-3">
                            <label for="accommodation_id" class="form-label">Seleccionar Alojamiento</label>
                            <select name="accommodation_id" id="accommodation_id" class="form-select" required>
                                <option value="">Selecciona un alojamiento</option>
                                <?php foreach ($available_accommodations as $accommodation) : ?>
                                    <option value="<?= $accommodation['id'] ?>"><?= htmlspecialchars($accommodation['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>