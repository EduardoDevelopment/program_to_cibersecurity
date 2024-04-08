<!-- Conexion a Base de Datos -->
<?php

// Se requieren los archivos de configuración de la aplicación y la base de datos.
require 'config/config.php';
require 'config/database.php';

// Se instancia un objeto de la clase Database para conectarse a la base de datos.
$db = new Database();
$con = $db->conectar();

// Se verifica si hay productos en el carrito de compras.
$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;
$lista_carrito = array();

// Si hay productos en el carrito se obtienen los datos de cada producto desde la base de datos.
if ($productos != null) {
  foreach ($productos as $clave => $cantidad) {
    // Se prepara y ejecuta una consulta para obtener los datos del producto.
    $sql = $con->prepare("SELECT id, nombre, precio, descuento, $cantidad AS cantidad FROM productos WHERE id=? AND activo = 1");
    $sql->execute([$clave]);
    // Se agrega la información del producto a un arreglo.
    $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);
  }
} else {
  // Si no hay productos en el carrito se redirige al usuario al inicio.
  header("Location: index.php");
  exit;
}

?>

<!-- Pagina -->

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/7e99496f14.js" crossorigin="anonymous"></script>
  <!-- Tittulo -->
  <title>Loncheria Lobos</title>
</head>
<header>
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
    <button class="fixed bottom-4 text-white bg-red-700 p-4 rounded-full">
      <i class="fa-solid fa-door-open"></i> Cerrar sesión</button>
  </div>
  <!-- Fin de la navegacion -->
</header>

<body>
  <main>
  <div class="max-w-4xl mx-auto py-8 px-4">
    <form class="bg-white rounded-lg p-8 mt-20">
      <h3 class="text-center mb-8">Ingresa tus datos para proceder con el pago.</h3>
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="nombre">
          Nombre completo:
        </label>
        <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" id="nombre" type="text" placeholder="Nombre completo">
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="telefono">
          Número de teléfono:
        </label>
        <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" id="telefono" type="tel" placeholder="Número de teléfono">
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
          Correo electrónico:
        </label>
        <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" id="email" type="email" placeholder="Correo electrónico">
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">
          Dirección a domicilio:
        </label>
        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="block text-gray-700 text-sm font-bold mb-2" for="calle">
              Calle:
            </label>
            <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" id="calle" type="text" placeholder="Nombre de la calle">
          </div>
          <div>
            <label class="block text-gray-700 text-sm font-bold mb-2" for="numero">
              Número:
            </label>
            <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" id="numero" type="text" placeholder="Número de la casa/apartamento">
          </div>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="colonia">
            Colonia:
          </label>
          <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" id="colonia" type="text" placeholder="Nombre de la colonia o barrio">
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="codigo-postal">
            Código postal:
          </label>
          <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" id="codigo-postal" type="text" placeholder="Código postal">
        </div>
        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="block text-gray-700 text-sm font-bold mb-2" for="ciudad">
              Ciudad/Localidad:
            </label>
            <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" id="ciudad" type="text" placeholder="Nombre de la ciudad o localidad">
          </div>
          <div>
            <label class="block text-gray-700 text-sm font-bold mb-2" for="estado">
              Estado/Provincia/Región:
            </label>
            <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" id="estado" type="text" placeholder="Nombre del estado, provincia o región">
          </div>
        </div>
      </div>
      <div class="flex items-center justify-center">
      <button id="mostrarDetallesPagoBtn" class="bg-blue-500 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded focus:outline-none" type="button">
          Enviar solicitud
        </button>
      </div>
    </form>
  </div>
    <!-- Tabla de productos -->
    <div id="detallesPagoContainer" class="hidden">
      <div class="">
        <div class="max-w-3xl mx-auto py-8 px-4">
    <div class="flex justify-center mt-8">
      <div>
        <div class="table-responsive">
        <div class="col-2">
          <h4>Detalles de pago</h4>
        </div>
          <tbody>
            <?php if ($lista_carrito == null) {
              echo '<tr>
                      <td colspan="5" class="text_center"><b>Lista Vacia</b></td>
                    </tr>';
            } else {
              $total = 0;
              foreach ($lista_carrito as $producto) {
                // Se obtienen los datos del producto para mostrarlos en la tabla
                $_id = $producto['id'];
                $nombre = $producto['nombre'];
                $precio = $producto['precio'];
                $descuento = $producto['descuento'];
                $cantidad = $producto['cantidad'];
                $precio_desc = $precio - (($precio * $descuento) / 100);
                $subtotal = $cantidad * $precio_desc;
                $total += $subtotal;
                ?>
                <tr>
                  <td>
                    <?php echo $nombre; ?>
                  </td>
                  <td>
                    <!-- Se muestra el subtotal del producto -->
                    <div id="subtotal_<?php echo $_id; ?>" name="subtotal[]">
                      <?php echo MONEDA . number_format($subtotal, 2, '.', ','); ?>
                    </div>
                  </td>
                </tr>
              <?php } ?>
              <!-- Aquí termina el foreach que recorre los productos del carrito -->
              <!-- Se muestra el total del carrito -->
              <tr>
                <td colspan="2">
                  <h4 class="mt-4">Total</h4>
                </td>
                <td colspan="2"></td>
                <td>
                  <p class="h6" id="total"><b>
                      <?php echo MONEDA . number_format($total, 2, '.', ','); ?>
                    </b></p>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </div>
        
        <div id="smart-button-container" class="col-4">
          <div style="text-align: center;">
            <div id="paypal-button-container"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
      </div>
    </div>
  </main>
  <script src="https://www.paypal.com/sdk/js?client-id=BAAFVV7GleBzVWrWB84RkeQcxiD2_ZapBl0YgdQFw6TaWJYLhz54zS-5lOgI9kxcbb6jLc9ye5EGw3zkAA&components=hosted-buttons&disable-funding=venmo&currency=MXN"></script>
<div id="paypal-container-69D6ULB26J8FU"></div>
<script>
  paypal.HostedButtons({
    hostedButtonId: "69D6ULB26J8FU",
  }).render("#paypal-container-69D6ULB26J8FU")
</script>
</body>
<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <script src="https://www.paypal.com/sdk/js?client-id=BAAFVV7GleBzVWrWB84RkeQcxiD2_ZapBl0YgdQFw6TaWJYLhz54zS-5lOgI9kxcbb6jLc9ye5EGw3zkAA&components=hosted-buttons&disable-funding=venmo&currency=MXN"></script>

<!-- Paypal -->

<script src="https://www.paypal.com/sdk/js?client-id=sb&enable-funding=venmo&currency=MXN"
  data-sdk-integration-source="button-factory">
</script>
<script src="js/paypal.js"></script>
<script src="js/menu.js"></script>
<script>
    document.getElementById('mostrarDetallesPagoBtn').addEventListener('click', function() {
      document.getElementById('detallesPagoContainer').style.display = 'block';
    });
  </script>

</html>