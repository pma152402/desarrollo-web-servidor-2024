<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1);
        
        require("../util/conexion.php");
        
        // Si al comenzar la sesión no se encuentra al usuario..
        session_start();
        if (isset($_SESSION["usuario"])){
            echo "<h2>Bienvenid@" . $_SESSION["usuario"] . "</h2>";
            //exit;
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
    <?php
        // FUNCION PARA DEPURAR
        function depurar($entrada) {    
            if (!$entrada == null) {
                $salida = htmlspecialchars($entrada);
                $salida = trim($salida);
                $salida = stripslashes($salida);
                $salida = preg_replace('!\s+!', ' ', $salida);
                return $salida;
            }
            else {
                return "";
            }
        }
    ?>
    <!-- VALIDACIONES -->
    <div class="container">
        <h1>Editar producto:</h1>

        <?php
            // obtenemeos los productos
            $id_producto = $_GET["id_producto"];
            $sql = "SELECT * FROM productos WHERE id_producto = '$id_producto'";
            $resultado = $_conexion -> query($sql);

            while ($fila = $resultado -> fetch_assoc()) {
                $nombre = $fila["nombre"];
                $precio = $fila["precio"];
                $categoria_original = $fila["categoria"];
                $descripcion = $fila["descripcion"];
                $stock = $fila["stock"];
            }
        
            $sql_categorias = "SELECT categoria FROM categorias";
            $resultado_categorias = $_conexion -> query($sql_categorias);

            $categorias = [];
            while ($fila_categoria = $resultado_categorias -> fetch_assoc()){
                array_push($categorias, $fila_categoria["categoria"]);
            }


            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $tmp_nombre = depurar($_POST["nombre"]);
                $tmp_precio = depurar($_POST["precio"]);
                $tmp_categoria = depurar($_POST["categoria"]);
                $tmp_descripcion = depurar($_POST["descripcion"]);
                $tmp_stock = depurar($_POST["stock"]);
               
                /* VALIDAR NOMBRE */
                if ($tmp_nombre == "") {
                    $tmp_nombre = "El nombre es un campo obligatorio";
                } 
                else {
                    if (strlen($tmp_nombre) < 2 || strlen($tmp_nombre) > 30) {
                        $err_nombre = "El nombre debe de tener de 2 a 30 carácteres";
                    } 
                    else {
                        $patron = "/^[0-9a-zA-Z ñçáéióúÁÉÍÓÚñÑüÜ]+$/";
                        if (!preg_match($patron, $tmp_nombre)) {
                            $err_nombre = "El nombre no puede tener números o carácteres especiales";
                        } 
                        else {
                            $nombre = $tmp_nombre;
                        }
                    }
                }

                /* VALIDAR PRECIO */
                if ($tmp_precio == "") {
                    $err_precio = "El precio es un campo obligatorio";
                } 
                else {
                    if (!is_numeric($tmp_precio)) {
                        $err_precio = "El precio debe de ser un número";
                    } 
                    else {
                        if ($tmp_precio < 0 || $tmp_precio > 2147483647) { // limite de la BBDD 
                            $err_precio = "El precio debe de estar entre 0 y  2147483647";
                        } 
                        else {
                            $precio = $tmp_precio;
                        }   
                    }
                }

                /* VALIDAR CATEGORIA */
                if ($tmp_categoria == "") {
                    $err_categoria = "La categoría es un campo obligatorio";
                } 
                else {
                    if (strlen($tmp_categoria) > 30) {
                        $err_categoria = "La categoría solo puede tener hasta 30 carácteres";
                    }

                    if (!in_array($tmp_categoria, $categorias)) {
                        $err_categoria = "La categoría seleccionada es inválida";
                    } else {
                        $categoria_nueva = $tmp_categoria;
                    }
                }

                /* VALIDAR DESCRIPCION */
                if ($tmp_descripcion == "") {
                    $err_descripcion = "La descripción es un campo obligatorio";
                } 
                else {
                    if (strlen($tmp_descripcion) > 255) {
                        $err_descripcion = "La descripción solo puede tener hasta 255 carácteres";
                    } 
                    else {
                        $descripcion = $tmp_descripcion;
                    }
                }

                /* VALIDAR STOCK */
                if ($tmp_stock = ""){
                    $stock = intval($tmp_stock);
                }
                else {
                    if (!is_numeric($tmp_stock)) {
                        $err_stock = "El stock debe ser un número";
                    } 
                    else {
                        if ($tmp_stock < 0 || $tmp_stock > 2147483647) {
                            $err_stock = "El stock debe estar entre 0 y 2147483647";
                        } 
                        else {
                            $stock = $tmp_stock;
                        }
                    }
                }
                
            }
            /* SACAMOS Y ORDENAMOS LAS CATEGORIAS */
            $sql = "SELECT * FROM categorias ORDER BY categoria";
            $resultado = $_conexion -> query($sql);
            $categorias = [];

            while ($fila = $resultado -> fetch_assoc()) {
                array_push($categorias, $fila["categoria"]);
            }
        ?>


        <!-- FORMULARIO -->
        <form class="col-4" action="" method="post" enctype="multipart/form-data">

            <!-- NOMBRE -->
            <div class="mb-3">
                <label class="form-label">Nombre:</label>
                <input class="form-control" type="text" name="nombre" value="<?php echo $nombre ?>">
                <?php if(isset($err_nombre)) echo "<span class='error'>$err_nombre</span>" ?>
            </div>

            <!-- PRECIO -->
            <div class="mb-3">
                <label class="form-label">Precio:</label>
                <input class="form-control" type="text" name="precio" value="<?php echo $precio ?>">
                <?php if(isset($err_precio)) echo "<span class='error'>$err_precio</span>" ?>
            </div>

            <!-- CATEGORIAS -->
            <div class="mb-3">
                <label class="form-label">Categoría:</label>
                <select class="form-select" name="categoria">
                    <?php
                        foreach ($categorias as $categoria) { ?>
                            <option value="<?php echo $categoria ?>">
                                <?php echo $categoria ?>
                            </option>
                    <?php } ?>
                </select>
                <?php if(isset($err_categoria)) echo "<span class='error'>$err_categoria</span>" ?>
            </div>

            <!-- DESCRIPCION -->
            <div class="mb-3">
                <label class="form-label">Descripción:</label>
                <textarea class="form-control" name="descripcion" rows="5"><?php echo $descripcion ?></textarea>
                <?php if(isset($err_descripcion)) echo "<span class='error'>$err_descripcion</span>" ?>
            </div>

            <!-- STOCK -->
            <div class="mb-3">
                <label class="form-label">Stock:</label>
                <input class="form-control" type="text" name="stock" value="<?php echo $stock ?>">
                <?php if(isset($err_stock)) echo "<span class='error'>$err_stock</span>" ?>
            </div>

            <!-- ENVIAR -->
            <div class="mb-3">
                <input class="btn btn-primary" type="submit" name="Enviar">
                <input type="hidden" name="categoria" value="<?php echo $id_producto ?>">

                <!-- VOLVER -->
                <a class="btn btn-secondary" href="./index.php">Volver</a>
            </div>

        </form>
    </div>
    <!-- INSERTAR EN LA BASE DE DATOS -->
    <?php
        if (isset($nombre) && isset($precio) && isset($categoria) && isset($stock) && isset($descripcion)) {
            $update = "UPDATE productos SET
                nombre = '$nombre',
                precio = '$precio',
                categoria = '$categoria',
                stock = '$stock',
                descripcion = '$descripcion'
                WHERE id_producto = '$id_producto' ";
            $_conexion -> query($update);
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

<!-- FALLO: Una vez cambiada la categoria, no se puede volver a cambiar, no reconoce las categorias del array