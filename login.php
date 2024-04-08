<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Enlazamos los estilos de Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/aa.css">
    <title>Iniciar sesión</title>
</head>

<body class="from-white via-transparent to-transparent min-h-screen flex flex-col">
    <!-- Contenedor principal -->
    <div class="flex-grow flex items-center justify-center">
        <!-- Modificamos el tamaño de la tarjeta del formulario -->
        <form action="config/logi.php" method="POST"
            class="p-20 bg-white bg-opacity-90 rounded-xl shadow-lg m-2 max-w-md">
            <h4 class="text-2xl font-bold mb-6 text-center border-b pb-4">Inicia Sesión</h4>
            <?php if (isset($error_message)): ?>
                <p class="text-red-500 text-center">
                    <?php echo $error_message; ?>
                </p>
            <?php endif; ?>
            <div class="space-y-4">
                <div>
                    <label for="username" class="text-gray-700">Usuario</label>
                    <input type="text" name="txtusuario" autocomplete="off" required
                        class="block w-full border rounded-md shadow-sm py-2 px-3 mt-1">
                </div>
                <div>
                    <label for="password" class="text-gray-700">Contraseña</label>
                    <input type="password" name="txtpassword" autocomplete="off" required
                        class="block w-full border rounded-md shadow-sm py-2 px-3 mt-1">
                </div>
                <!-- Cambiamos el color del botón a rojo -->
                <div>
                    <input type="submit" value="Ingresar"
                        class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded-full hover:bg-red-600">
                </div>
            </div>
            <p class="mt-4 text-center">¿No tienes cuenta? <a href="registro.php"
                    class="text-blue-500 hover:text-red-600">¡Regístrate aquí!</a></p>
        </form>
    </div>

    <!-- Footer -->
    <footer class="bg-blue-500 text-white py-4 px-4">
        <div class="container mx-auto flex flex-col md:flex-row justify-between">
            <!-- Información del restaurante -->
            <div class="mb-4 md:mb-0">
                <h4 class="text-xl font-bold">Loncheria lobos</h4>
                <p class="mt-2">Blvd. Juan Pablo II No. 1302 Ex hacienda la Cantera, Aguascalientes</p>
                <p>Teléfono: 449 123 45 67</p>
            </div>
        </div>
    </footer>

</body>

</html>
