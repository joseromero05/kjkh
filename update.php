<?php
session_start();
include 'db.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['id'])) {
    header("Location: login.php"); // Redirigir al login si no está autenticado
    exit();
}

// Obtener el ID del usuario que se desea actualizar
if (!isset($_GET['id'])) {
    header("Location: dashboard.php"); // Redirigir si no se especifica el ID
    exit();
}

$user_id_to_update = $_GET['id'];

// Consulta para obtener los datos del usuario
$sql = "SELECT * FROM usuarios WHERE id='$user_id_to_update'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "Usuario no encontrado.";
    exit();
}

$user_to_update = $result->fetch_assoc();

// Procesar la actualización del usuario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $correo = mysqli_real_escape_string($conn, $_POST['correo']);

    // Consulta para actualizar los datos del usuario
    $update_sql = "UPDATE usuarios SET nombre='$nombre', correo='$correo' WHERE id='$user_id_to_update'";

    if ($conn->query($update_sql) === TRUE) {
        echo "Usuario actualizado con éxito.";
        header("Location: dashboard.php"); // Redirigir al dashboard después de actualizar
        exit();
    } else {
        echo "Error al actualizar usuario: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Usuario</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Actualizar Usuario</h2>
    <form method="post" action="">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" value="<?php echo $user_to_update['nombre']; ?>" required><br><br>

        <label for="correo">Correo:</label><br>
        <input type="email" id="correo" name="correo" value="<?php echo $user_to_update['correo']; ?>" required><br><br>

        <input type="submit" value="Actualizar Usuario">
    </form>

    <br>
    <a href="dashboard.php">Volver al panel</a>
</body>
</html>
