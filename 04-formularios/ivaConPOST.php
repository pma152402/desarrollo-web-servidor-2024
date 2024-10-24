<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de IVA</title>
    <?php
    //  Activamos los errores de PHP
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );

        require('../05_Funciones/economia.php');
    ?>
</head>
<body>
    <form action="" method="post">
        <label for="precio">Precio</label>
        <input type="number" name="precio" id="precio"><br><br>
        <label for="iva">IVA</label>
        <select name="iva" id="iva">
            <option value="general">General</option>
            <option value="reducido">Reducido</option>
            <option value="superreducido">Superreducido</option>
        </select><br><br>
        <input type="submit" value="Calcular PVP">
    </form>

    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $tmp_precio = $_POST["precio"];
        $tmp_iva = $_POST["iva"];

        // PRECIO
        if ($tmp_precio != ''){
            if (filter_var($tmp_precio, FILTER_VALIDATE_FLOAT) !== FALSE){
                if ($tmp_precio > 0){
                    $precio = $tmp_precio;
                }
                else {
                    echo "<p>El precio debde de ser superior a 0</p>"; // y en verdad deberia ser el SMIP
                }
            }
            else {
                echo "<p>El precio debe de ser un numero</p>";
            }
        }
        else {
            echo "<p>El campo del precio no puede estar vacío</p>";
        }
        // IVA
        if ($tmp_iva == ''){
            echo "<p>El IVA es obligatorio</p>";
        } 
        else {
            $valores_validos_iva = ["general", "reducido", "superreducido"];

            if (!in_array($tmp_iva, $valores_validos_iva)){
                echo "<p>El IVA solo puede ser: GENERAL, REDUCIDO o SUPERREDUCIDO";
            }
            else {
                $iva = $tmp_iva;
            }
        }
        var_dump($precio);
        var_dump($iva);
        // COMPROBACION Y OPERACION FINAL
        if (isset($precio) && isset($iva)){
            $resultado = calcularPVP($precio, $iva);
            echo "<El resultado es $resultado</p>";
        }
       

    }
    ?>
</body>
</html>