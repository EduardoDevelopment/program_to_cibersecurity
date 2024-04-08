<?php

require '../config/config.php'; // Se importa el archivo de configuración del sitio
require '../config/database.php'; // Se importa el archivo de conexión a la base de datos

if(isset($_POST['action'])){ // Si se ha enviado el parámetro "action" por POST
    $action = $_POST['action']; // Se obtiene el valor de "action"
    $id = isset($_POST['id']) ? $_POST['id'] : 0; // Se obtiene el valor de "id", si no existe se asigna 0

    if($action == 'agregar'){ // Si "action" es igual a "agregar"
        $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : 0; // Se obtiene el valor de "cantidad", si no existe se asigna 0
        $respuesta = agregar($id, $cantidad); // Se llama a la función "agregar" con los parámetros "id" y "cantidad"
        if($respuesta > 0){ // Si la respuesta de la función "agregar" es mayor a 0
            $datos['ok'] = true; // Se asigna true a la clave "ok" del array "datos"
        }else{
            $datos['ok'] = false; // De lo contrario, se asigna false a la clave "ok" del array "datos"
        }
        $datos['sub'] = MONEDA . number_format($respuesta, 2, '.', ','); // Se asigna al valor de "sub" del array "datos" el resultado de formatear la respuesta de "agregar"
    } else if($action == 'eliminar'){ // Si "action" es igual a "eliminar"
        $datos['ok'] = eliminar($id); // Se llama a la función "eliminar" con el parámetro "id" y se asigna el resultado a la clave "ok" del array "datos"
    } else{ // Si "action" no es igual ni a "agregar" ni a "eliminar"
        $datos['ok'] = false; // Se asigna false a la clave "ok" del array "datos"
    }
} else{ // Si no se ha enviado el parámetro "action" por POST
    $datos['ok'] = false; // Se asigna false a la clave "ok" del array "datos"
}

echo json_encode($datos);

// Agregar producto al carrito
function agregar($id, $cantidad){
    $res = 0;
    // Verificar si el id y la cantidad son válidos
    if($id > 0 && $cantidad > 0 && is_numeric(($cantidad))){
        // Si el producto ya existe en el carrito, se actualiza la cantidad
        if(isset($_SESSION['carrito']['productos'][$id])){
            $_SESSION['carrito']['productos'][$id] = $cantidad;

            // Obtener el precio y descuento del producto desde la base de datos
            $db = new Database();
            $con = $db->conectar();
            $sql = $con-> prepare("SELECT precio, descuento FROM productos WHERE id=? AND activo=1");
            $sql-> execute([$id]);
            $row = $sql -> fetch(PDO::FETCH_ASSOC);
            $precio = $row['precio'];
            $descuento = $row['descuento'];
            // Calcular el precio con descuento
            $precio_desc = $precio - (($precio * $descuento) / 100);
            // Calcular el subtotal del producto
            $res = $cantidad * $precio_desc;

            return $res;
        }
    }else{
        return $res;
    }
}

// Eliminar producto del carrito
function eliminar($id){
    if ($id > 0) {
        if (isset($_SESSION['carrito']['productos'][$id])) {
            unset($_SESSION['carrito']['productos'][$id]);
            return true;
        }
    }
    return false;
}
