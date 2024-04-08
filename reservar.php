<!-- Conexion a Base de Datos -->
<?php

// Se incluyen los archivos de configuración necesarios
require 'config/config.php'; // Archivo que contiene las configuraciones generales de la aplicación
require 'config/logi.php'; // Archivo que contiene la funcionalidad de autenticación
require 'config/database.php'; // Archivo que contiene la configuración de la base de datos
// Se crea una nueva instancia de la clase Database, que se encarga de la conexión a la base de datos
$db = new Database();
// Se establece la conexión a la base de datos
$con = $db->conectar();
// Se prepara la consulta SQL para seleccionar los productos activos (activo = 1) y se ejecuta la consulta
$sql = $con->prepare("SELECT id, nombre, precio FROM productos WHERE activo = 1");
$sql->execute();
// Se recuperan los resultados de la consulta y se guardan en la variable $resultado
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
// Quitar productos de carrito, solo pruebas - - -
//session_destroy();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/7e99496f14.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/a.css">
    <!-- Tittulo -->
    <title>Loncheria lobos</title>
</head>

<body>
    <!-- Navegacion web -->
    <nav class="bg-blue-700 p-4 flex justify-between items-center fixed top-0 left-0 w-full">
        <div class="text-white font-bold text-lg ml-5">
            <i class="fa-solid fa-burger"></i> Loncheria lobos
        </div>
        <div class="hidden md:flex">
            <a href="index.php"
                class="text-white mx-2 p-2 hover:bg-white hover:text-black rounded-full duration-200 ease-in-out">
                <i class="fa-solid fa-house"></i> Inicio</a>
            <a href="compras.php"
                class="text-white mx-2 p-2 hover:bg-white hover:text-black rounded-full duration-200 ease-in-out">
                <i class="fa-solid fa-book-open"></i> Menú</a>
            <a href="#"
                class="text-white mx-2 p-2 hover:bg-white hover:text-black rounded-full duration-200 ease-in-out">
                <i class="fa-solid fa-book"></i> Reservar</a>
            <a href="carrito.php"
                class="text-white mx-2 p-2 hover:bg-white hover:text-black rounded-full duration-200 ease-in-out">
                <i class="fas fa-shopping-cart"></i> Carrito:
                <span id="num_cart">
                    <?php echo $num_cart; ?>
                </span>
            </a>
            <a href="login.php"
                class="text-white mx-2 p-2 hover:bg-white hover:text-black rounded-full duration-200 ease-in-out">
                <i class="fa-solid fa-door-open"></i></a>
        </div>
        <!-- Botón para el modo responsivo -->
        <div class="md:hidden flex space-x-4">
            <button id="openNav" class="text-white text-2xl">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>
    </nav>

    <!-- Menú desplegable para el modo responsivo -->
    <nav>
        <div id="responsiveNav"
            class="fixed top-0 right-0 h-full w-2/3 bg-blue-800 p-4 transform translate-x-full md:hidden transition-transform duration-300 ease-in-out">
            <div class="flex justify-between items-center mb-4">
                <div class="text-white font-bold text-lg">
                    <i class="fa-solid fa-magnifying-glass"></i> Menú
                </div>
                <button id="closeNav" class="text-white text-3xl">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="flex flex-col space-y-4 text-lg">
                <a href="index.php" class="text-white bg-blue-700 p-3 rounded-full">
                    <i class="fa-solid fa-house"></i> Inicio</a>
                <a href="compras.php" class="text-white bg-blue-700 p-3 rounded-full">
                    <i class="fa-solid fa-book-open"></i> Menú</a>
                <a href="reservar.php" class="text-white bg-blue-700 p-3 rounded-full">
                    <i class="fa-solid fa-book"></i> Reservar</a>
                <a href="carrito.php" class="text-white bg-blue-700 p-3 rounded-full">
                    <i class="fas fa-shopping-cart"></i> Carrito:
                    <span id="num_cart">
                        <?php echo $num_cart; ?>
                    </span>
                </a>
            </div>
            <!-- Botón "Cerrar sesión" -->
            <a href="login.php" class="fixed bottom-4 text-white bg-blue-700 p-4 rounded-full">
                <i class="fa-solid fa-door-open"></i> Cerrar sesión</a>
        </div>
        <!-- Fin de la navegacion -->
    </nav>
    <div class="flex justify-center items-center h-screen mt-28 xl:mt-12">
        <div class="w-2/3 lg:w-1/3 bg-white p-6 rounded shadow-md">
            <h2 class="text-blue-800 text-xl font-semibold mb-4">Reserva tu mesa</h2>
            <form class="flex flex-col space-y-4">
                <label for="name" class="text-blue-800">Nombre:</label>
                <input type="text" id="name" name="name" class="border border-blue-800 p-2 rounded" required>

                <label for="email" class="text-blue-800">Email:</label>
                <input type="email" id="email" name="email" class="border border-blue-800 p-2 rounded" required>

                <label for="date" class="text-blue-800">Fecha de reserva:</label>
                <input type="date" id="date" name="date" class="border border-blue-800 p-2 rounded" required>

                <label for="time" class="text-blue-800">Hora de reserva:</label>
                <input type="time" id="time" name="time" class="border border-blue-800 p-2 rounded" required>

                <label for="guests" class="text-blue-800">Número de invitados:</label>
                <input type="number" id="guests" name="guests" min="1" class="border border-blue-800 p-2 rounded"
                    required>

                <button type="submit" class="bg-blue-700 text-white p-2 rounded hover:bg-blue-800">Reservar</button>
            </form>
            <div class="mt-10 text-lg text-center">
                <h1 class="text-red-600 font-bold">IMPORTANTE</h1>
                <p>Toda esta información se almacenará, ten en cuenta llegar a tiempo.<br>
                    Cualquier duda o aclaración comunicarse rápidamente.</p>
            </div>
        </div>
    </div>
    <br><br><br><br><br>
    <footer class="bg-blue-800 text-white py-4 text-center">
        <p class="mb-2">Blvd. Juan Pablo II No. 1302 Ex hacienda la Cantera, Aguascalientes</p>
        <p class="mb-2">Teléfono: 449 123 45 67 </p>
        <p class="mt-2">&copy; 2024 Loncheria Lobos. Todos los derechos reservados.</p>
    </footer>
    <script src="js/menu.js"></script>
</body>

</html>