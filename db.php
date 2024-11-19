<?php
$servername = "localhost"; // o tu servidor de base de datos
$username = "root"; // tu usuario de base de datos
$password = ""; // tu contraseña
$dbname = "base4"; // tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
