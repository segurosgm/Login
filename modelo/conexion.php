<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gmk";

// Crear conexión
$conn = new mysqli( $servername,  $username,  $password,  $dbname);

// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}



$conn = new mysqli("localhost", "root", "", "gmk");
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

?>   
