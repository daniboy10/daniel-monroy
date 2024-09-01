<?php 
require_once('conexion.php');
session_start(); // Inicia la sesión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Preparar y ejecutar la consulta para verificar si el correo existe
    $sql = "SELECT * FROM usuarios WHERE correo = ?";
    $stmt = $conn->prepare($sql);

    // Verificar si la preparación de la declaración fue exitosa
    if (!$stmt) {
        die("Error al preparar la declaración: " . $conn->error);
    }

    // Vincular el parámetro
    $correo = htmlspecialchars($_POST['correo']);
    $stmt->bind_param("s", $correo);

    // Ejecutar la declaración
    if (!$stmt->execute()) {
        die("Error al ejecutar la declaración: " . $stmt->error);
    }

    $result = $stmt->get_result();

    // Verificar si se encontró el correo en la base de datos
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); // Obtener la fila del resultado

        // Suponiendo que la contraseña está almacenada de forma segura con password_hash
        $hashedPassword = $row['pass'];

        // Verificar la contraseña
        if (password_verify(MD5(htmlspecialchars($_POST['password'])), $hashedPassword)) {
       
        } else {
           

            // Generar token y guardar en la sesión
            $_SESSION['token'] = bin2hex(random_bytes(16)); 
            $_SESSION['correo'] = $correo;

            // Preparar la actualización del token en la base de datos
            $sqlToken = "UPDATE usuarios SET token = ? WHERE correo = ?";
            $stmtU = $conn->prepare($sqlToken);

            // Verificar si la preparación fue exitosa
            if (!$stmtU) {
                die("Error al preparar la declaración para actualizar el token: " . $conn->error);
            }

            // Vincular parámetros y ejecutar
          // Vincular parámetros y ejecutar
          $stmtU->bind_param("ss", $_SESSION['token'], $_SESSION['correo']);
          $stmtU->execute();
            // Redirigir a index.php
            header("Location: ../index.php");
            exit;
        }
    } else {
        echo "El correo no existe en la base de datos.";
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conn->close();
}
?>
