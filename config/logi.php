<?php
$dbhost = "localhost";
$dbuser = "id21098003_lunchbd";
$dbpass = "Lunchtimebd90*";
$dbname = "id21098003_lunchtime";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Comprobar si las claves del array $_POST están definidas
if (isset($_POST['txtusuario']) && isset($_POST['txtpassword'])) {
    $nombre = $_POST['txtusuario'];
    $pass = $_POST['txtpassword'];

    // Validar y filtrar las entradas de usuario
    $nombre = mysqli_real_escape_string($conn, $nombre);
    $pass = mysqli_real_escape_string($conn, $pass);

    // Utilizar declaraciones preparadas para evitar la inyección de SQL
    $stmt = mysqli_prepare($conn, "SELECT * FROM login WHERE usuario = ? AND password = ?");
    mysqli_stmt_bind_param($stmt, "ss", $nombre, $pass);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($resultado) > 0) {
        // Si hay resultados, el usuario ha iniciado sesión correctamente
        // Crear una variable de sesión para almacenar el nombre de usuario
        session_start();
        $_SESSION['usuario'] = $nombre;

        // Redirigir al usuario a la página principal
        header("Location: ../index.php");
        exit();
    } else {
        // Si no hay resultados, el inicio de sesión ha fallado
        // Redirigir al usuario de vuelta al formulario de inicio de sesión
        header("Location: login.php?error=login_failed");
        exit();
    }

    mysqli_close($conn);
}
?>