<?php
include 'conexion.php';
if (!isset($_SESSION['token'])) {
    header('location:form.php');
}

 
 
// Verificar si se recibió la solicitud AJAX con el parámetro 'read'
if ($_POST['read'] === 'read') {

    // Obtener los datos enviados desde el formulario
    $name        = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $height      = mysqli_real_escape_string($conn, $_POST['height']);
    $length      = mysqli_real_escape_string($conn, $_POST['length']);
    $width       = mysqli_real_escape_string($conn, $_POST['width']);
    $status      = 1;

    // Validar que los campos requeridos no estén vacíos
    if (!empty($name) && !empty($description) && !empty($height) && !empty($length) && !empty($width) && !empty($status)) {

       
        $stmt = $conn->prepare("INSERT INTO catalog_products (name, description, height, length, width, status) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiiii", $name, $description, $height, $length, $width, $status);

        // Ejecutar la consulta y verificar si fue exitosa
        if ($stmt->execute()) {
            echo "Producto agregado exitosamente";
        } else {
            echo "Error al agregar el producto: " . $stmt->error;
        }

        // Cerrar la declaración y la conexión
        $stmt->close();
    } else {
        echo "Todos los campos son obligatorios.";
    }
}


    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') 
    {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            // Consulta para actualizar el estado del producto a 0
            $sql = "UPDATE catalog_products SET status = 0 WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
    
            if ($stmt->execute()) {
               echo 1;
               exit;
            } else {
                echo 'Error al actualizar el producto: ' . $stmt->error;
            }
    
            $stmt->close();
        }
    }

    if (isset($_POST['process']) && $_POST['process'] == 'read') {
        $id = $_POST['id'];
    
        // Preparar la consulta SQL para obtener el producto
        $stmt = $conn->prepare("SELECT * FROM catalog_products WHERE id = ?");
        $stmt->bind_param("i", $id); // 'i' indica que el parámetro es un entero
        $stmt->execute();
    
        // Obtener el resultado
        $result = $stmt->get_result();
        $producto = $result->fetch_assoc();
    
        // Verificar si se encontró el producto y convertirlo a JSON
        if ($producto) {
            // Retornar el resultado en formato JSON
            echo json_encode($producto);
        } else {
            echo json_encode(['error' => 'Producto no encontrado']);
        }
    }

    if ( $_POST['process'] == 'update') {

        $id          = $_POST['id'];
        $name        = $_POST['name'];
        $description = $_POST['desc'];
        $altura      = $_POST['altura'];
        $longuitud   = $_POST['longuitud'];
        $ancho       = $_POST['ancho'];
        $status      = 1;
    
        // Validar que los campos requeridos no estén vacíos
        if (empty($name) || empty($description) || empty($description)) {
            echo "campos obligatorios";
            exit;
        }

// Preparar la consulta SQL para actualizar el producto
$stmt = $conn->prepare("UPDATE catalog_products SET name = ?, description = ?, height = ?, length = ?, width = ? , status=?  WHERE id = ?");
$stmt->bind_param("ssiiiii", $name, $description, $altura, $longuitud, $ancho,$status, $id);

// Ejecutar la consulta y verificar si fue exitosa
if ($stmt->execute()) {

} else {
    echo "noo se pudo realizar accion";
    exit;
}
    }
// Cerrar la conexión
$conn->close();
?>
