<?php
$base_url = '/login_system/';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_system";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión falló: " . $conn->connect_error);
}