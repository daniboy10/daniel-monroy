<?php
require_once('conexion.php'); // Asegúrate de que este archivo esté correctamente incluido y que la conexión funcione
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$_SESSION['correo'] = 'jperez@gmail.com';

$sqlU = "SELECT nombre, token FROM usuarios WHERE correo = ?";
$stmtU = $conn->prepare($sqlU);
$stmtU->bind_param("s", $_SESSION['correo']);
$stmtU->execute();
$result = $stmtU->get_result();

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Iterar sobre los resultados
    while ($row = $result->fetch_assoc()) {
        $nombre = $row['nombre'];
        $token = $row['token'];

        // Puedes hacer lo que necesites con $nombre y $token
        echo "Nombre: " . $nombre . "<br>";
        echo "Token: " . $token . "<br>";
    }
} else {
    echo "No se encontraron resultados para el correo proporcionado.";
}


?>
