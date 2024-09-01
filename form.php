<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="styles.css">
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
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f2f5;
            margin: 0;
        }

        .container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .login-form {
            display: flex;
            flex-direction: column;
        }

        .login-form h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            margin-bottom: 5px;
            display: block;
            color: #555;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .btn {
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        /* Estilos para la leyenda 'Crear' */
        .crear-cuenta {
            text-align: center;
            margin-top: 15px;
        }

        .crear-cuenta a {
            color: #007bff;
            text-decoration: none;
            font-size: 14px;
        }

        .crear-cuenta a:hover {
            text-decoration: underline;
        }

        /* Estilos responsivos */
        @media (max-width: 600px) {
            .container {
                padding: 15px;
                max-width: 300px;
            }

            .login-form h2 {
                font-size: 24px;
            }

            .input-group input {
                font-size: 14px;
            }

            .btn {
                font-size: 14px;
            }

            .crear-cuenta a {
                font-size: 12px;
            }
        }
    </style>
    <div class="container">
        <form action="php/login.php" method="post" class="login-form">
            <h2>Login</h2>
            <div class="input-group">
                <label for="correo">Correo</label>
                <input type="email" id="correo" name="correo" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Guardar</button>
        </form>
        
        <!-- Leyenda para crear una nueva cuenta -->
        <div class="crear-cuenta">
            <a href="register.php">Crear Seison</a>
        </div>
    </div>
</body>
</html>
