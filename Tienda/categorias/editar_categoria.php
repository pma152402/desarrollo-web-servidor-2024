<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar categoría</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1);
        
        require("../util/conexion.php");
        
        // Si al comenzar la sesión no se encuentra al usuario..
        session_start();
        if (isset($_SESSION["usuario"])){
            echo "<h2>Bienvenid@ " . $_SESSION["usuario"] . "</h2>";
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
        <h1>Editar categoría:</h1>

        <?php
            // obtenemeos las categorías
            $categoria = $_GET["categoria"];
            $sql = "SELECT * FROM categorias WHERE categoria = '$categoria'";
            $resultado = $_conexion -> query($sql);

            while ($fila = $resultado -> fetch_assoc()) {
                $categoria = $fila["categoria"];
                $descripcion = $fila["descripcion"];
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                $tmp_descripcion = depurar($_POST["descripcion"]);

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
            }
        ?>


        <!-- FORMULARIO -->
        <form class="col-4" action="" method="post" enctype="multipart/form-data">

            <!-- CATEGORIAS -->
            <div class="mb-3">
                <label class="form-label">Categoría:</label>
                <input class="form-control" type="text" name="categoria" value="<?php echo $categoria ?>" disabled>
                <?php if(isset($err_categoria)) echo "<span class='error'>$err_categoria</span>" ?>
            </div>

            <!-- DESCRIPCION -->
            <div class="mb-3">
                <label class="form-label">Descripción:</label>
                <textarea class="form-control" name="descripcion" rows="5"><?php echo $descripcion ?></textarea>
                <?php if(isset($err_descripcion)) echo "<span class='error'>$err_descripcion</span>" ?>
            </div>

            <!-- ENVIAR -->
            <div class="mb-3">
                <input class="btn btn-primary" type="submit" name="Enviar">
                <input type="hidden" name="categoria" value="<?php echo $categoria ?>">

                <!-- VOLVER -->
                <a class="btn btn-secondary" href="./index.php">Volver</a>
            </div>

        </form>
    </div>
    <!-- INSERTAR EN LA BASE DE DATOS -->
    <?php
        if (isset($categoria) && isset($descripcion)) {
            $enviar = "UPDATE categorias SET descripcion = '$descripcion' WHERE categoria = '$categoria'";
            $_conexion -> query($enviar);
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>