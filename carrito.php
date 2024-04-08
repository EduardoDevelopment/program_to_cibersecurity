<!-- Conexion a Base de Datos -->
<?php

require 'config/config.php';
require 'config/database.php';
require 'config/carro.php'
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
  <link rel="stylesheet" href="css/estilos.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/7e99496f14.js" crossorigin="anonymous"></script>
  <!-- Tittulo -->
  <title>Loncheria lobos</title>
</head>
<header>
  <!-- Navegacion web -->
  <nav class="bg-blue-700 p-3 flex justify-between items-center fixed top-0 left-0 w-full">
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
</header>

<body>
  <main>
    <!-- Tabla de productos -->
    <div class="container mx-auto mt-10">
      <div class="overflow-x-auto">
        <table class="table w-full">
          <thead>
            <th>Platillo</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Subtotal</th>
            <th></th>
          </thead>
          <!-- Verifica si la lista de carrito está vacía -->
          <tbody>
            <?php if ($lista_carrito == null): ?>
              <!-- Si está vacía, muestra un mensaje -->
              <tr>
                <td colspan="5" class="text-center font-bold">Lista Vacia</td>
              </tr>
            <?php else:
              // Si no está vacía, muestra los productos
              $total = 0;
              foreach ($lista_carrito as $producto):
                // Obtiene los datos del producto
                $_id = $producto['id'];
                $nombre = $producto['nombre'];
                $precio = $producto['precio'];
                $descuento = $producto['descuento'];
                $cantidad = $producto['cantidad'];
                // Calcula el precio con descuento y el subtotal
                $precio_desc = $precio - (($precio * $descuento) / 100);
                $subtotal = $cantidad * $precio_desc;
                // Calcula el total
                $total += $subtotal;
                ?>
                <tr>
                  <td>
                    <?php echo $nombre; ?>
                  </td>
                  <td>
                    <?php echo MONEDA . number_format($precio_desc, 2, '.', ','); ?>
                  </td>
                  <!-- Crea un campo de entrada para actualizar la cantidad de productos -->
                  <td>
                    <input type="number" min="1" max="10" step="1" value="<?php echo $cantidad ?>" size="5"
                      id="cantidad_<?php echo $_id; ?>" onchange="actualizaCantidad(this.value, <?php echo $_id; ?>)">
                  </td>
                  <td>
                    <!-- Muestra el subtotal del producto -->
                    <div id="subtotal_<?php echo $_id; ?>" name="subtotal[]"><?php echo MONEDA . number_format($subtotal, 2, '.', ','); ?></div>
                  </td>
                  <!-- Agrega un botón para eliminar el producto -->
                  <td><a id="eliminar" class="btn btn-warning btn-sm" data-bs-id="<?php echo $_id ?>" data-bs-toggle="modal"
                      data-bs-target="#eliminaModal"><i class="fa-solid fa-trash"></i> Eliminar</a></td>
                </tr>
              <?php endforeach; ?>
              <!-- Muestra el total de la compra -->
              <tr>
                <td colspan="3"></td>
                <td colspan="2">
                  <p class="text-lg font-bold" id="total"><b>
                      <?php echo MONEDA . number_format($total, 2, '.', ','); ?>
                    </b></p>
                </td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
        <!-- Boton de pago -->
      </div>
      </div>
      <?php if ($lista_carrito != null): ?>
        <div class="flex justify-end mt-4">
          <a href="pago.php" class="btn btn-primary">Realizar pago</a>
        </div>
      <?php endif; ?>
      <!--  -->
    </div>
  </main>
  <!-- El atributo "id" se utiliza para identificar el modal y puede ser utilizado en JavaScript o CSS. -->
  <div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="eliminaModalLabel" aria-hidden="true">
    <!-- El div con clase "modal-dialog" establece el tamaño del modal y su alineación. -->
    <div class="modal-dialog modal-sm">
      <!-- El div con clase "modal-content" establece el contenido del modal. -->
      <div class="modal-content">
        <!-- El div con clase "modal-header" establece el encabezado del modal. -->
        <div class="modal-header">
          <!-- El h1 con clase "modal-title" establece el título del modal. -->
          <h1 class="modal-title fs-5" id="eliminaModalLabel">¡Alerta!</h1>
          <!-- El botón con clase "btn-close" se utiliza para cerrar el modal. -->
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- El div con clase "modal-body" establece el cuerpo del modal. -->
        <div class="modal-body">
          ¿Quieres eliminar este platillo?
        </div>
        <!-- El div con clase "modal-footer" establece el pie del modal. -->
        <div class="modal-footer">
          <!-- El botón con clase "btn btn-success" se utiliza para cancelar la eliminación. -->
          <button type="button" class="p-2 bg-red-600 hover:bg-red-400 rounded" data-bs-dismiss="modal">Cancelar</button>
          <!-- El botón con id "btn-elimina" y clase "btn btn-danger" se utiliza para eliminar el artículo y se llama a la función "eliminar" cuando se hace clic. -->
          <button id="btn-elimina" type="button" class="p-2 pl-10 bg-cyan-400 hover:bg-cyan-600 rounded" onclick="eliminar()">Borrar</button>
        </div>
      </div>
    </div>
  </div>
  <footer class="bg-blue-800 text-white py-4 text-center">
        <p class="mb-2">Blvd. Juan Pablo II No. 1302 Ex hacienda la Cantera, Aguascalientes</p>
        <p class="mb-2">Teléfono: 449 123 45 67 </p>
        <p class="mt-2">&copy; 2024 Loncheria Lobos. Todos los derechos reservados.</p>
    </footer>
</body>
 
<!--  -->
<script src="js/eliminar.js"></script>
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
  integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>

</html>