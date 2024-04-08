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

<!-- Pagina -->
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Loncheria lobos</title>
  <!-- Agrega aquí el enlace a la hoja de estilos de Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/7e99496f14.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/a.css">
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
      <a href="reservar.php"
        class="text-white mx-2 p-2 hover:bg-white hover:text-black rounded-full duration-200 ease-in-out">
        <i class="fa-solid fa-book"></i> Reservar</a>
      <a href="carrito.php"
        class="text-white mx-2 p-2 hover:bg-white hover:text-black rounded-full duration-200 ease-in-out">
        <i class="fas fa-shopping-cart"></i> Carrito:
        <span id="num_cart">
          <?php echo $num_cart; ?>
        </span>
      </a>
      <a href="login.php" class="text-white mx-2 p-2 hover:bg-white hover:text-black rounded-full duration-200 ease-in-out">
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
  <main class="container mx-auto mt-8">
    <img src="img/banner.svg" alt="Restaurante" class="w-full h-auto max-w-screen-xl mx-auto sm:my-4 pt-8">
    <section class="mb-8">
      <h2 class="text-3xl font-bold mb-4 text-center mt-10">Menú diario</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mx-4">
        <div class="bg-white p-4 shadow-md rounded-md">
          <img class="w-80" src="img/1/principal.webp" alt="img">
          <h3 class="text-xl font-bold mb-2">Quesadilla de jamón</h3>
          <p class="mt-2">Precio: $15.99</p>
        </div>
        <div class="bg-white p-4 shadow-md rounded-md">
          <img class="w-80" src="img/3/principal.webp" alt="img">
          <h3 class="text-xl font-bold mb-2">Quesadilla de bistec</h3>
          <p class="mt-2">Precio: $12.99</p>
        </div>
        <div class="bg-white p-4 shadow-md rounded-md">
          <img class="w-80" src="img/4/principal.webp" alt="img">
          <h3 class="text-xl font-bold mb-2">Quesadilla de queso de puerco</h3>
          <p class="mt-2">Precio: $39.00</p>
        </div>
        <div class="bg-white p-4 shadow-md rounded-md">
          <img class="w-80" src="img/4/principal.webp" alt="img">
          <h3 class="text-xl font-bold mb-2">Quesadilla de pollo</h3>
          <p class="mt-2">Precio: $18.50</p>
        </div>
      </div>
      <div class="flex justify-center">
        <a href="compras.php" class="bg-blue-500 hover:bg-blue-800 text-white px-4 py-2 mt-10 rounded-full">Ver más</a>
      </div>
    </section>
  </main>

  <main class="container mx-auto mt-8">
    <section class="flex flex-col items-center mb-10 my-40 xl:my-20">
      <h2 class="text-3xl font-bold">Reservaciones</h2>
      <p class="text-gray-600 mb-4 mx-2 text-center mx-10">¡Reserva una mesa para poder disfrutar de un platillo en
        nuestro local!</p>
      <a href="reservar.php" class="bg-blue-500 hover:bg-blue-800 text-white px-4 py-2 rounded">Reservar Mesa</a>
    </section>

    <section class="text-center mb-8 my-40 xl:my-20 mx-10">
      <h2 class="text-3xl font-bold mb-4">Calidad y Servicio al Cliente</h2>
      <p class="text-gray-600">En la loncheria lobos, nos enorgullecemos de ofrecer alimentos de la más alta calidad,
        preparados con ingredientes frescos y deliciosos.</p>
      <p class="text-gray-600">Nuestro equipo de chefs expertos se esfuerza por crear platos excepcionales que deleiten
        a nuestros clientes en cada visita.</p>
      <p class="text-gray-600">Además, nuestro personal altamente capacitado está dedicado a brindar un servicio al
        cliente excepcional, asegurándose de que cada experiencia en nuestro restaurante sea inolvidable.</p>
    </section>
  </main>

  <footer class="bg-blue-800 text-white py-4 text-center">
    <p class="mb-2">Blvd. Juan Pablo II No. 1302 Ex hacienda la Cantera, Aguascalientes</p>
    <p class="mb-2">Teléfono: 465 116 5951 </p>
    <p class="mt-2">&copy; 2024 Loncheria Lobos. Todos los derechos reservados.</p>
  </footer>

  <!-- Script para manejar el menú responsivo -->
  <script src="js/menu.js"></script>
</body>

</html>