<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require("../util/conexion.php"); // Asegúrate de que el archivo de conexión exista

// Si al comenzar la sesión no se encuentra al usuario..
session_start();
if (isset($_SESSION["usuario"])){
    echo "<h2>Bienvenid@" . $_SESSION["usuario"] . "</h2>";
} 
else {
    header("location: ../index.php");
}

if (isset($_GET['categoria'])) {
    $categoria = htmlspecialchars($_GET['categoria']); // Limpia el valor recibido

    // Eliminar productos de la categoría
    $sql = "DELETE FROM productos WHERE categoria = '$categoria'";
    if ($_conexion->query($sql) === TRUE) {
        header("Location: index.php"); // Redirige al índice tras borrar
        exit;
    } else {
        echo "Error al eliminar la categoría: " . $_conexion->error;
    }
} else {
    echo "Categoría no especificada.";
}

$_conexion->close();
?>

$nombre_categoria = $_POST["categoria"];
            $sql = "DELETE FROM categorias WHERE categoria = '$nombre_categoria'";
            $_conexion -> query($sql);