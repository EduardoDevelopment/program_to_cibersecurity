<!-- Conexion a Base de Datos -->
<?php

require 'config/config.php';
require 'config/database.php';
require 'config/compraas.php';
// Quitar productos de carrito, solo pruebas - - -
//session_destroy();

?>

<!-- Pagina -->

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Tittulo -->
  <script src="https://kit.fontawesome.com/7e99496f14.js" crossorigin="anonymous"></script>

  <title>Loncheria Lobos</title>
</head>

<main>
<header>
  <!-- Navegacion web -->
  <nav class="bg-blue-700 p-4 flex justify-between items-center fixed top-0 left-0 w-full">
    <div class="text-white font-bold text-lg ml-5">
      <i class="fa-solid fa-burger"></i> Loncheria Lobos
    </div>
    <div class="hidden md:flex">
      <a href="index.php"
        class="text-white mx-2 p-2 hover:bg-white hover:text-black rounded-full duration-200 ease-in-out">
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
    <a href="login.php" class="fixed bottom-4 text-white bg-blue-700 p-4 rounded-full">
      <i class="fa-solid fa-door-open"></i> Cerrar sesión</a>
  </div>
  <!-- Fin de la navegacion -->

  <div class="text-center text-lg mt-24 xl:mt-36 mx-8">
    <p>
    Bienvenidos a <strong>Loncheria Lobos</strong>. Somos un restaurante especializado en cocina gourmet, ofreciendo una amplia variedad de platos deliciosos y exquisitos. <br>Nuestro objetivo es brindar a nuestros clientes una experiencia culinaria única y memorable en un ambiente acogedor y elegante.
  </p>
  <h1 class="text-center text-xl font-bold mt-8">- Menú -</h1>
  </div>
  <!--  -->

  <div class="flex flex-wrap xl:mx-40 mt-10">
  <!-- Bucle foreach para iterar sobre los resultados de la consulta de productos -->
  <?php foreach ($resultado as $row) { ?>
    <!-- Contenedor de cada producto -->
    <div class="w-full sm:w-full md:w-1/2 px-4 mb-4">
      <div class="bg-white rounded-lg shadow-md p-4 mx-auto flex">
        <?php
        // Se obtiene la imagen principal del producto a partir del ID
        $id = $row['id'];
        $imagen = "img/" . $id . "/principal.webp";

        // Si la imagen no existe, se usa una imagen por defecto
        if (!file_exists($imagen)) {
          $imagen = "img/No-image-found.webp";
        }
        ?>
        <!-- Imagen del producto -->
        <img class="object-cover rounded-lg w-1/3" src="<?php echo $imagen; ?>" alt="img_">
        <div class="w-2/3 ml-4">
          <div class="mt-4">
            <!-- Nombre del producto -->
            <h5 class="text-lg font-semibold">
              <?php echo $row['nombre'] ?>
            </h5>
            <!-- Precio del producto -->
            <p class="text-gray-600 mt-2">
              $
              <?php echo number_format($row['precio'], 2, '.', ',') ?>
            </p>
          </div>
          <div class="mt-4 flex justify-between items-center">
            <div>
              <!-- Botón para ver más detalles del producto -->
              <a class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded"
                href="detalles.php?id=<?php echo $row['id']; ?>&token=<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN) ?>">Ver
                más</a>
            </div>
            <!-- Botón para añadir el producto al carrito -->
            <button type="button" class="bg-green-500 hover:bg-green-600 text-white py-1 px-3 rounded"
              onclick="addproducto(<?php echo $row['id'] ?>, '<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN) ?>')">Añadir</button>
          </div>
        </div>
      </div>
    </div>
  <?php } ?> <!-- Fin del bucle foreach y del contenedor de cada producto -->
</div>

<footer class="bg-blue-800 text-white py-4 text-center">
    <p class="mb-2">Blvd. Juan Pablo II No. 1302 Ex hacienda la Cantera, Aguascalientes</p>
    <p class="mb-2">Teléfono: 449 123 45 67 </p>
    <p class="mt-2">&copy; 2024 Loncheria lobos. Todos los derechos reservados.</p>
  </footer>

    <!--  -->
    <script>
        const openNavButton = document.getElementById('openNav');
const closeNavButton = document.getElementById('closeNav');
const responsiveNav = document.getElementById('responsiveNav');
const mainContent = document.querySelector('main');

openNavButton.addEventListener('click', () => {
    responsiveNav.classList.remove('translate-x-full');
});

closeNavButton.addEventListener('click', () => {
    responsiveNav.classList.add('translate-x-full');
});

// Cerrar el menú al dar clic en un link
const links = document.querySelectorAll('#responsiveNav a');
links.forEach(link => {
    link.addEventListener('click', () => {
        responsiveNav.classList.add('translate-x-full');
    });
});

// Cerrar el menú al dar clic fuera del menú
document.addEventListener('click', (event) => {
    if (!responsiveNav.contains(event.target) && !openNavButton.contains(event.target)) {
        responsiveNav.classList.add('translate-x-full');
    }
});

// Cerrar el menú deslizándose o tocando fuera del menú
let startX = 0;
let dist = 0;

document.addEventListener('touchstart', (event) => {
    const touch = event.touches[0];
    startX = touch.clientX;
});

document.addEventListener('touchmove', (event) => {
    const touch = event.touches[0];
    dist = touch.clientX - startX;
});

document.addEventListener('touchend', () => {
    if (dist > 50) {
        responsiveNav.classList.add('translate-x-full');
    }
});
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
      crossorigin="anonymous"></script>
    <script src="js/numero.js"></script>
  </main>
  </body>

</html>