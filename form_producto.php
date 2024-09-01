<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   
</head>
<body>
    <style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    padding: 20px; /* Espacio adicional en los bordes */
}

.container {
    background-color: #fff;
    padding: 30px; /* Aumenta el padding para más espacio interior */
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px; /* Anchura máxima para dispositivos más grandes */
}

h1 {
    text-align: center;
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
}

input[type="text"],
input[type="number"] {
    width: 100%;
    padding: 10px; /* Aumenta el padding para más espacio en los campos */
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box; /* Asegura que el padding no afecte al ancho total */
}

button {
    width: 100%;
    padding: 12px; /* Aumenta el padding del botón */
    background-color: #5cb85c;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px; 
}

button:hover {
    background-color: #4cae4c;
}

/* Media query para dispositivos pequeños */
@media (max-width: 480px) {
    .container {
        padding: 20px; 
    }

    button {
        padding: 10px; 
        font-size: 14px; 
    }
}


    </style>
    <div class="container">
        <h1>Agregar Producto</h1>
        <form id="productForm">
            <label for="name">Nombre del Producto:</label>
            <input type="text" id="name"  name="name" >
            
            <label for="description">Descripción:</label>
            <input type="text" id="description" name="description">
            
            <label for="height">Altura (cm):</label>
            <input type="number" id="height" name="height">
            
            <label for="length">Longitud (cm):</label>
            <input type="number" id="length" name="length">
            
            <label for="width">Ancho (cm):</label>
            <input type="number" id="width"  name="width">
            
            
            <button type="submit">Agregar Producto</button>
            <div id="responseMessage" style="margin-top: 15px; color: red;"></div>

        </form>
    </div>

<script>
$(document).ready(function() {
    $('#productForm').on('submit', function(event) {
        event.preventDefault();

        // Obtener los datos del formulario
        var productData = {
            name: $('#name').val(),
            description: $('#description').val(),
            height: $('#height').val(),
            length: $('#length').val(),
            width: $('#width').val(),
            read:'read'
        };

        $.ajax({
            url: 'php/productos.php', 
            type: 'POST',
            data: productData,
            success: function(response) {
               // alert('Producto agregado exitosamente');
                 // Limpiar el formulario
                    $('#responseMessage').html(response);
                    setTimeout(() => {$('#responseMessage').html('');}, "2000");
                    setTimeout(() => {location.reload();}, "1000");
              
            
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error al agregar el producto: ' + textStatus);
            }
        });
    });
});


</script>
</body>
</html>
