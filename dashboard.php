<?php
session_start();
include 'db.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['id'])) {
    header("Location: login.php"); // Redirigir al login si no está autenticado
    exit();
}

// Obtener el usuario autenticado, asegurándonos de que las claves existan
$user_id = $_SESSION['id'];
$user_name = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : '';
$user_email = isset($_SESSION['correo']) ? $_SESSION['correo'] : '';

// Consulta para obtener todos los usuarios (sin excluir al usuario autenticado)
$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);

// Cerrar la conexión a la base de datos
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Bienvenido, <?php echo htmlspecialchars($user_name); ?></h2>
    

    <a href="logout.php">Cerrar sesión</a>

    <h3>Lista de Usuarios Registrados</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>".$row['id']."</td>
                        <td>".$row['nombre']."</td>
                        <td>".$row['correo']."</td>
                        <td>
                            <a href='update.php?id=".$row['id']."'>Actualizar</a> | 
                            <a href='delete.php?id=".$row['id']."' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este usuario?\")'>Eliminar</a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No hay usuarios registrados.</td></tr>";
        }
        ?>
    </table>
</body>
</html>
