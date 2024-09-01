<?php
require_once('conexion.php');

if (isset($_POST['crear'])) 
{

    $nombre   = htmlspecialchars(trim($_POST['nombre']));
    $correo   = htmlspecialchars(trim($_POST['correo']));
    $password = htmlspecialchars(trim($_POST['password']));
    $hashedPassword = md5($password);
    $status   = 1;
    $sqlU = "SELECT * FROM usuarios WHERE correo = ?";
    $stmtU = $conn->prepare($sqlU);

    // Verificar si la preparación de la declaración fue exitosa
    if (!$stmtU) {
        die("Error al preparar la declaración de verificación: " . $conn->error);
    }

    // Vincular los parámetros y ejecutar la declaración
    $stmtU->bind_param("s", $correo);
    if (!$stmtU->execute()) {
        die("Error al ejecutar la declaración de verificación: " . $stmtU->error);
    }

    $result = $stmtU->get_result();

    // Verificar si se encontró el correo en la base de datos
    if ($result->num_rows > 0) {
        echo "Ya existe ese registro";
        $stmtU->close();
        $conn->close();
        exit;
    }
    // Preparar la consulta SQL para insertar el nuevo usuario
    $sql = "INSERT INTO usuarios (nombre, correo, pass,status) VALUES (?, ?, ?,?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error al preparar la declaración: " . $conn->error);
    }
    $stmt->bind_param("sssi", $nombre, $correo, $hashedPassword,$status);

    // Ejecutar la declaración
    if ($stmt->execute()) {
         echo "Registro exitoso, bienvenido $nombre!";
 
    } else {
        echo "Error al registrar el usuario: " . $stmt->error;
        echo "entre";
        exit;
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conn->close();
}
?>

