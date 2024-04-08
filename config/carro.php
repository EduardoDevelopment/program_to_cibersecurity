<?php

$db = new Database();
$con = $db->conectar();

//Traer productos
$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;
$lista_carrito = array();

//Validar
if ($productos != null) {
    foreach ($productos as $clave => $cantidad) {
        $sql = $con->prepare("SELECT id, nombre, precio, descuento, $cantidad AS cantidad FROM productos WHERE id=? AND activo = 1");
        $sql->execute([$clave]);
        $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);
    }
}

?>