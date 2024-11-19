<?php
session_start();
include 'db.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['id'])) {
    header("Location: login.php"); // Redirigir al login si no está autenticado
    exit();
}

// Obtener el ID del usuario a eliminar
if (!isset($_GET['id'])) {
    header("Location: dashboard.php"); // Redirigir si no se especifica el ID
    exit();
}

$user_id_to_delete = $_GET['id'];

// Eliminar el usuario
$delete_sql = "DELETE FROM usuarios WHERE id='$user_id_to_delete'";

if ($conn->query($delete_sql) === TRUE) {
    echo "Usuario eliminado con éxito.";
    header("Location: dashboard.php"); // Redirigir al dashboard después de eliminar
    exit();
} else {
    echo "Error al eliminar el usuario: " . $conn->error;
}

$conn->close();
?>
