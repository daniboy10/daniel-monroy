<?php 
include('php/conexion.php');
// Consulta SQL para obtener todos los productos
$sql = "SELECT * FROM catalog_products where status = 1";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

$productos = [];


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista de Producto</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
}

.table-container {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    max-width: 1000px;
    margin: 0 auto;
}

h1 {
    text-align: center;
    margin-bottom: 20px;
}

.product-table {
    width: 100%;
    border-collapse: collapse;
}

.product-table th,
.product-table td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.product-table th {
    background-color: #f8f8f8;
    font-weight: bold;
}

.product-table tr:hover {
    background-color: #f1f1f1;
}

.edit-btn,
.delete-btn {
    background: none;
    border: none;
    cursor: pointer;
    margin-right: 8px;
}

.edit-btn i {
    color: #007bff;
}

.delete-btn i {
    color: #dc3545;
}

.edit-btn i:hover,
.delete-btn i:hover {
    opacity: 0.7;
}

/* Media query para dispositivos pequeños */
@media (max-width: 768px) {
    .table-container {
        padding: 10px;
    }

    .product-table th,
    .product-table td {
        padding: 8px 10px;
    }
}

/* Estilo para el modal */
.modal {
    display: none; /* Inicialmente oculto */
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.5); /* Fondo oscuro */
}

.modal-content {
    background-color: #fff;
    margin: 15% auto; /* Centrando el modal */
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 500px; /* Ancho máximo del modal */
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.close-btn {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

.close-btn:hover,
.close-btn:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

.modal-form label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
}

.modal-form input[type="text"],
.modal-form input[type="number"],
.modal-form input[type="email"],
.modal-form textarea {
    width: calc(100% - 22px); /* Ajustar ancho para incluir padding */
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
}

.modal-form button {
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    margin-right: 10px;
}

.modal-form button:hover {
    background-color: #0056b3;
}


</style>
<body>
    <div class="table-container">
        <h1>Productos</h1>
        <table class="product-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Altura</th>
                    <th>Longitud</th>
                    <th>Ancho</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Producto ficticio -->
                <?php 
                while ($row = $result->fetch_assoc()) {
                    echo "<tr id='product-" . $row['id'] . "'>"; 
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                    echo "<td>" . $row['height'] . "</td>";
                    echo "<td>" . $row['length'] . "</td>";
                    echo "<td>" . $row['width'] . "</td>";
                    echo "<td>" . ($row['status'] == 1 ? 'Activo' : 'Inactivo') . "</td>";
                    echo "<td>";
                    echo "<button onclick='showForm(" . $row['id'] . ")'  class='edit-btn'><i class='fas fa-pencil-alt'></i></button>";
                    echo "<button onclick='eliminar(" . $row['id'] . ")' class='delete-btn'><i class='fas fa-times'></i></button>";
                    echo "</td>";
                    echo "</tr>";
                }
                 ?>
            </tbody>
        </table>
    </div>

    <!-- Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="document.getElementById('editModal').style.display='none'">&times;</span>
        <h2>Editar Producto</h2>
        <form class="modal-form">
            <label for="name">Nombre</label>
            <input type="text" id="name" name="name">

            <label for="description">Descripción</label>
            <textarea id="description" name="description" rows="4"></textarea>

            <label for="name">Altura</label>
            <input type="number" id="altura" name="altura">

            <label for="name">Longuitud</label>
            <input type="number" id="longuitud" name="longuitud">

            <label for="name">Ancho</label>
            <input type="number" id="ancho" name="ancho">
            <input type="hidden" id="idProducto" name="idProducto">

            <button type="submit" onclick="guardar()">Guardar</button>
            <button type="button" onclick="document.getElementById('editModal').style.display='none'">Cancelar</button>
        </form>
    </div>
</div>


<script>
function eliminar(id) {
    if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
        // Realizar la solicitud AJAX al backend
        $.ajax({
            url: 'php/productos.php', // Cambia esto a la ruta de tu archivo PHP de eliminación
            type: 'POST',
            data: { 
                id: id, 
                action: 'delete' // Este es un parámetro adicional para especificar la acción
            },
            success: function(response) {
                // Manejar la respuesta del servidor
                if (response == 1) {
                    
                    // Opcionalmente, puedes eliminar la fila de la tabla
                    $('#product-' + id).remove();
                } else {
                    alert('Error al eliminar el producto: ' + response);
                }
               
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error en la solicitud AJAX: ' + textStatus);
            }
        });
    }
}
function showForm(id){
   document.getElementById('editModal').style.display='block'
    mostrar(id)
}
function mostrar(id){
    $.ajax({
        url: 'php/productos.php', 
        type: 'POST', 
        data: { id: id, process:'read' }, 
        success: function (res) {  
            console.log(res)
            if (res) {
                producto = JSON.parse(res);
                document.getElementById('name').value = producto.name;
                document.getElementById('description').value = producto.description;
                document.getElementById('altura').value = producto.height;
                document.getElementById('longuitud').value = producto.length;
                document.getElementById('ancho').value = producto.width;
                document.getElementById('idProducto').value =producto.id; ;
                

            } else {
                alert("Producto no encontrado");
            }
        
        },
        error: function (xhr, status, error) {
            // Manejar errores de la solicitud AJAX
            alert("Error al obtener los datos del producto: " + error);
        }
    });
}
function guardar(){
     id     = document.getElementById('idProducto').value;
     name   = document.getElementById('name').value;
     desc   = document.getElementById('description').value;
     altura = document.getElementById('altura').value;
     longuitud = document.getElementById('longuitud').value;
     ancho   = document.getElementById('ancho').value;
     $.ajax({
        url: 'php/productos.php', 
        type: 'POST', 
        data: { id: id, process:'update',name:name,desc:desc,altura:altura,longuitud:longuitud,ancho:ancho }, 
        success: function (res) {  
               alert(res)
        },
        error: function (xhr, status, error) {
            // Manejar errores de la solicitud AJAX
            alert("Error al obtener los datos del producto: " + error);
        }
    });
}
</script>
</body>
</html>
