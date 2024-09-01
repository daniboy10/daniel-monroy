<?php 
require_once('php/login.php');
require_once('php/conexion.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_SESSION['token']) ) {
    $sqlU = "SELECT nombre, token FROM usuarios WHERE correo = ?";
$stmtU = $conn->prepare($sqlU);
$stmtU->bind_param("s", $_SESSION['correo']);
$stmtU->execute();
$result = $stmtU->get_result();

    while ($row = $result->fetch_assoc()) {
        $nombre = $row['nombre'];
        $token = $row['token'];
    }


} else {
   header('location:form.php');
}


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido, <?php echo $nombre ?> </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <style>
        * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
}

body {
    background-color: #f0f2f5;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.container {
    background-color: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
    width: 300px;
}

header h1 {
    font-size: 24px;
    color: #333;
    margin-bottom: 20px;
}

.menu {
    margin-top: 20px;
}

.menu ul {
    list-style-type: none;
    padding: 0;
}

.menu li {
    margin: 10px 0;
}

.menu a {
    text-decoration: none;
    color: #007bff;
    font-size: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 10px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.menu a:hover {
    background-color: #f0f0f0;
}

.menu i {
    margin-right: 8px;
}

    </style>
    <div class="container">
        <header>
            <h1>Hola, Miguel</h1>
        </header>

        <nav class="menu">
            <ul>
                <li>
                    <a href="form_producto.php">
                        <i class="fas fa-plus-circle"></i> Agregar Producto
                    </a>
                </li>
                <li>
                    <a href="gestion_productos.php">
                        <i class="fas fa-edit"></i> Gestion Productos
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</body>
</html>
