<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inicio</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1);
        
        require("util/conexion.php");
        
        // Si al comenzar la sesión no se encuentra al usuario..
        session_start();
        if (!isset($_SESSION["usuario"])){
            echo "<a class='btn btn-primary' href='usuario/iniciar_sesion.php'>Iniciar sesión</a>";
            echo "<a class='btn btn-info' href='usuario/registro.php'>Registro</a>";
        } 
        else {
            echo "<a class='btn btn-warning' href='usuario/cerrar_sesion.php'>Cerrar sesión</a>";
            echo "<a class='btn btn-info' href='categorias/index.php'>Categorías</a>";
            echo "<a class='btn btn-info' href='productos/index.php'>Productos</a>";
            echo "<a class='btn btn-secondary' href='usuario/cambiar_credenciales.php'>Cambiar credenciales</a>";
            echo "<h2>Bienvenid@ " . $_SESSION["usuario"] . "</h2>";
        }
    ?>
    <style>
        .error {
            color: red;
        }
    </style>
    </head>
    <body>
        <h1>Estás en el inicio, dónde puedes ver todos los productos :)</h1>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $id_producto = $_POST["id_producto"];
            }

            $sql = "SELECT * FROM productos";
            $resultado = $_conexion -> query($sql);
        ?>
        <br>
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Categoría</th>
                    <th>Stock</th>
                    <th>Descripción</th>
                    <th>Imagen</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while ($fila = $resultado -> fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $fila["nombre"] . "</td>";
                        echo "<td>" . $fila["precio"] . "</td>";
                        echo "<td>" . $fila["categoria"] . "</td>";
                        echo "<td>" . $fila["stock"] . "</td>";
                        echo "<td>" . $fila["descripcion"] . "</td>";
                        ?>
                        <td>
                            <img style="height: 200px; width: 200px;" src="./imagenes/<?php echo $fila["imagen"] ?>" alt="Sin imagen">
                        </td>
                        <?php
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>