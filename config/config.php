<?php

// Definición de la constante KEY_TOKEN y MONEDA
define("KEY_TOKEN", "HSAs&/78SA*_");
define("MONEDA", "$");

// Iniciar sesión para mantener los datos del carrito de compras
session_start();

// Obtener la cantidad de productos en el carrito de compras
$num_cart = 0;
if(isset($_SESSION['carrito']['productos'])){
    $num_cart = count($_SESSION['carrito']['productos']);
}
?>