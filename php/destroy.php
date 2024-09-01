<?php
session_start(); // Inicia la sesión

// Destruye la sesión actual
session_unset(); // Limpia todas las variables de sesión
session_destroy(); // Destruye la sesión

// Redirigir al usuario a index.php
header('Location: ../index.php');
exit(); // Asegura que el script se detenga después de la redirección
?>
