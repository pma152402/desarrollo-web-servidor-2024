<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1);
     
        require("../util/conexion.php");

        // Si al comenzar la sesión no se encuentra al usuario..
        session_start();
        if (isset($_SESSION["usuario"])){
            echo "<h2>Bienvenid@ " . $_SESSION["usuario"] . "</h2>";
            echo "<a class='btn btn-warning' href='../usuario/cerrar_sesion.php'>Cerrar sesión</a>";
        } 
        else {
            header("location: ../index.php");   
        }
    ?>
</head>
    <body>
        <a class="btn btn-success" href="../index.php">Inicio</a>
        <a class="btn btn-info" href="../categorias/index.php">Categorías</a>

        <div class="container">
            <h1>Productos:</h1>
                
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $id_producto = $_POST["id_producto"];

                    // Borrar el producto
                    $sql = "DELETE FROM productos WHERE id_producto = $id_producto";
                    $_conexion -> query($sql);
                }
                // Obtener todos los productos
                $sql = "SELECT * FROM productos";
                $resultado = $_conexion -> query($sql);
            ?>

            <a class="btn btn-secondary" href="nuevo_producto.php">Crear nuevo producto</a><br><br>
            <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Categoría</th>
                    <th>Stock</th>
                    <th>Imagen</th>
                    <th>Descripción</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
            <?php
                while ($fila = $resultado -> fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $fila["nombre"] . "</td>";
                    echo "<td>" . $fila["precio"] . "</td>";
                    echo "<td>" . $fila["categoria"] . "</td>";
                    echo "<td>" . $fila["stock"] . "</td>";
                    ?> 
                    <td>
                        <img style="height: 200px; width: 200px" src="<?php echo ($fila["imagen"]) ?>" alt="Sin imagen">
                    </td>
                    <?php
                    echo "<td>" . $fila["descripcion"] . "</td>";
                    ?>
                    <td>
                        <a class="btn btn-primary" href="editar_producto.php?id_producto=<?php echo $fila["id_producto"] ?>">Editar</a>
                    </td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="id_producto" value="<?php echo $fila["id_producto"] ?>">
                            <input class="btn btn-danger" type="submit" value="Borrar">
                        </form>
                    </td>
                    <?php
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        </div>
    </body>
</html>