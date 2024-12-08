<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias</title>
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
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <a class="btn btn-success" href="../index.php">Inicio</a>
    <a class="btn btn-info" href="../productos/index.php">Productos</a>

    <div class="container">
        <h1>Categorías:</h1>
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                $categoria = $_POST["categoria"];

                $nombre_categoria = $_POST["categoria"];

                // Si hay productos asociados no se podra borrar
                $productos = "SELECT * FROM productos WHERE categoria = '$nombre_categoria'";
                $resultado = $_conexion -> query($productos);
    
                if ($resultado -> num_rows >= 1) {
                    echo "<p class='error'> No es posible borrar la categoría $nombre_categoria 
                    porque tiene productos asociados. </p>";
                } 
                else {
                    $sql = "DELETE FROM categorias WHERE categoria = '$nombre_categoria'";
                    $_conexion -> query($sql);
                }

                // obtener categorias
                $sql = "SELECT * FROM categorias";
                $resultado = $_conexion -> query($sql);
            }
        
        ?>
            

        
        <?php
            $sql = "SELECT * FROM categorias";
            $resultado = $_conexion -> query($sql);

        ?>
        <a class="btn btn-secondary" href="nueva_categoria.php">Crear nueva categoria</a><br><br>
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Categoría</th>
                    <th>Descripción</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($fila = $resultado -> fetch_assoc()) {    
                        echo "<tr>";
                        echo "<td>" . $fila["categoria"] . "</td>";
                        echo "<td>" . $fila["descripcion"] . "</td>"; 
                        ?>
                        <td>
                            <a class="btn btn-primary" href="editar_categoria.php?categoria=<?php echo $fila["categoria"] ?>">Editar</a>
                        </td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="categoria" value="<?php echo $fila["categoria"] ?>">
                                <input class="btn btn-danger" type="submit" value="Borrar">
                            </form>
                        </td>
                        <?php
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
