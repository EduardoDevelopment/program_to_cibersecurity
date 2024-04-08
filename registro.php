<?php
require 'config/database.php'; // Importa el archivo de configuración de la base de datos

// Función para procesar el formulario de registro
function processRegistration()
{
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Obtener los datos del formulario
        $usuario = $_POST["txtusuario"];
        $email = $_POST["txtemail"];
        $password = $_POST["txtpassword"];
        $confirmPassword = $_POST["txtconfirmpassword"];

        // Verificar si las contraseñas coinciden
        if ($password === $confirmPassword) {
            // Aquí puedes realizar la lógica para almacenar los datos en la base de datos o realizar cualquier otra acción necesaria
            // Por ejemplo, puedes usar la función password_hash() para hashear la contraseña antes de almacenarla en la base de datos
            // password_hash($password, PASSWORD_DEFAULT);
            // Luego puedes insertar los datos en la tabla de usuarios en la base de datos
            // $sql = "INSERT INTO usuarios (usuario, email, password) VALUES (?, ?, ?)";
            // ...
            // Redirigir al usuario a la página de inicio de sesión o mostrar un mensaje de éxito
            header("Location: login.php");
            exit;
        } else {
            // Las contraseñas no coinciden, mostrar un mensaje de error
            $error_message = "Las contraseñas no coinciden";
        }
    }
}

// Llamamos a la función para procesar el formulario de registro
processRegistration();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <!-- Enlazamos los estilos de Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/aa.css">
</head>

<body class="flex flex-col min-h-screen">
    <!-- Contenedor principal con el fondo degradado -->
    <div class="flex-grow">
        <div class="flex items-center justify-center xl:mt-28 mt-10 relative">
            <form action="config/regi.php" method="POST" class="xl:p-20 p-10 bg-white bg-opacity-90 rounded-xl shadow-lg xl:m-2">
                <h4 class="text-2xl font-bold mb-6 text-center border-b pb-4">Registrarse</h4>
                <?php if (isset($error_message)): ?>
                    <p class="text-red-500 text-center">
                        <?php echo $error_message; ?>
                    </p>
                <?php endif; ?>

                <!-- Mostramos los campos de nombre de usuario y correo electrónico en columnas de dos en dos (modo responsivo) -->
                <div class="flex flex-col space-y-4 md:flex-row md:space-x-4 md:space-y-0">
                    <div>
                        <label for="username" class="text-gray-700">Nombre de usuario</label>
                        <input type="text" name="txtusuario" autocomplete="off" required
                            class="block w-full border rounded-md shadow-sm py-2 px-3 mt-1">
                    </div>
                    <div>
                        <label for="email" class="text-gray-700">Correo electrónico</label>
                        <input type="email" name="txtemail" autocomplete="off" required
                            class="block w-full border rounded-md shadow-sm py-2 px-3 mt-1">
                    </div>
                </div>

                <!-- Mostramos los campos de contraseña y confirmar contraseña en columnas de dos en dos (modo responsivo) -->
                <div class="flex flex-col space-y-4 mt-6 md:flex-row md:space-x-4 md:space-y-0">
                    <div>
                        <label for="password" class="text-gray-700">Contraseña</label>
                        <input type="password" name="txtpassword" autocomplete="off" required
                            class="block w-full border rounded-md shadow-sm py-2 px-3 mt-1">
                    </div>
                    <div>
                        <label for="confirm_password" class="text-gray-700">Confirmar contraseña</label>
                        <input type="password" name="txtconfirmpassword" autocomplete="off" required
                            class="block w-full border rounded-md shadow-sm py-2 px-3 mt-1">
                    </div>
                </div>

                <!-- Cambiamos el color del botón a azul -->
                <div class="mt-6">
                    <input type="submit" value="Registrarse"
                        class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded-full hover:bg-red-600">
                </div>
                <p class="mt-4 text-center">¿Ya tienes una cuenta? <a href="login.php"
                        class="text-blue-500 hover:text-red-600">¡Inicia sesión aquí!</a></p>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-blue-500 text-white py-4 px-4">
        <div class="container mx-auto flex flex-col md:flex-row justify-between">
            <!-- Información del restaurante -->
            <div class="mb-4 md:mb-0">
                <h4 class="text-xl font-bold">Lunch Time</h4>
                <p class="mt-2">Blvd. Juan Pablo II No. 1302 Ex hacienda la Cantera, Aguascalientes</p>
                <p>Teléfono: 449 123 45 67</p>
            </div>
        </div>
    </footer>

</body>

</html>