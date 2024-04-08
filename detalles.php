<!-- Configuracion para Base de datos -->
<?php

require 'config/database.php';
require 'config/config.php';
require 'config/details.php';
// Quitar productos de carrito, solo pruebas - - -
//session_destroy();

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/7e99496f14.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/a.css">
  <!-- Tittulo -->
  <title>Loncheria Lobos</title>
</head>
<!-- Navegacion web -->
<nav class="bg-blue-700 p-4 flex justify-between items-center fixed top-0 left-0 w-full">
  <div class="text-white font-bold text-lg ml-5">
    <i class="fa-solid fa-burger"></i> Loncheria lobos
  </div>
  <div class="hidden md:flex">
    <a href="index.php" class="text-white mx-2 p-2 hover:bg-white hover:text-black rounded-full duration-200 ease-in-out">
      <i class="fa-solid fa-house"></i> Inicio</a>
    <a href="compras.php"
      class="text-white mx-2 p-2 hover:bg-white hover:text-black rounded-full duration-200 ease-in-out">
      <i class="fa-solid fa-book-open"></i> Menú</a>
    <a href="reservar.php" class="text-white mx-2 p-2 hover:bg-white hover:text-black rounded-full duration-200 ease-in-out">
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
  <button class="fixed bottom-4 text-white bg-blue-700 p-4 rounded-full">
    <i class="fa-solid fa-door-open"></i> Cerrar sesión</button>
</div>
<!-- Fin de la navegacion -->

<body class="flex flex-col min-h-screen">
  <main class="flex-grow">
    <!-- Contenido -->
    <div class="container mx-auto mt-40 xl:mt-30 mx-8 shadow-2xl xl:my-40 my-20">
      <div class="flex flex-wrap">
        <!-- Imagen del producto -->
        <div class="w-full md:w-1/2 order-1 md:order-1 my-10">
          <img src="<?php echo $rutaimg; ?>" class="block mx-auto max-w-sm md:max-w-full responsive-img">
        </div>
        <!-- Información del producto -->
        <div class="w-full md:w-1/2 order-2 md:order-2 px-4 md:px-0">
          <h2 class="text-3xl font-bold">
            <?php echo $nombre; ?>
          </h2>
          <h6 class="font-semibold my-2">Tipo:
            <?php echo $tipo; ?>
          </h6>
          <p class="text-lg my-2">
            <?php echo $descripcion ?>
          </p>
          <!-- Descuento (si aplica) -->
          <?php if ($descuento > 0) { ?>
            <h5 class="text-2xl text-red-500">
              <del>
                <?php echo MONEDA . number_format($precio, 2, '.', '.'); ?>
              </del>
            </h5>
            <h2 class="text-3xl my-2">
              <?php echo MONEDA . number_format($precio_desc, 2, '.', '.'); ?>
              <small class="text-green-500">
                <?php echo $descuento; ?>% de descuento
              </small>
            </h2>
            <!-- Si no hay descuento -->
          <?php } else { ?>
            <h2 class="text-3xl">
              <?php echo MONEDA . number_format($precio, 2, '.', '.'); ?>
            </h2>
          <?php } ?>
          <!-- Botones para comprar o agregar al carrito -->
          <div class="grid grid-cols-1 gap-3 w-10/12 mx-auto my-10">
            <button class="bg-green-500 text-white py-2 rounded-full" type="button">Comprar ahora</button>
            <button class="border border-blue-500 text-blue-500 py-2 rounded-full" type="button"
              onclick="addproducto(<?php echo $id ?>, '<?php echo $token_tmp ?>')">Añadir al carro</button>
          </div>
        </div>
      </div>
    </div>
    <!--  -->
    <footer class="bg-blue-800 text-white py-4 text-center">
    <p class="mb-2">Blvd. Juan Pablo II No. 1302 Ex hacienda la Cantera, Aguascalientes</p>
    <p class="mb-2">Teléfono: 449 123 45 67 </p>
    <p class="mt-2">&copy; 2024 Loncheria Lobos. Todos los derechos reservados.</p>
  </footer>
    <!-- Aumentar numero de carrito -->
    <script src="js/numero.js"></script>


    <script src="js/menu.js"></script>
  </main>
</body>

</html>