<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Potencias</title>
    <!-- Mostrar errores en la web -->
    <?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    require('../05_Funciones/funPotencianew.php');
    ?>
</head>
<body>
    <!-- 
    CREAR UN FORMULARIO QUE RECIBA DOS PARÁMETROS: BASE Y EXPONENTE
    CUANDO SE ENVÍE EL FORMULARIO, SE CALCULARÁ EL RESULTADO DE ELEVAR LA BASE AL EXPONENTE
    EJEMPLOS:
        2 ELEVADO A 3 = 8
        3 ELEVADO A 2 = 9
        2 ELEVADO A 1 = 2
        3 ELEVADO A 0 = 1
    -->

    <h3>Calculadora de potencias</h3>
    <br>
    <form action="" method="post">
        <!-- name es el id de este input -->
        <label for="base">Base:      </label>
        <input type="text" name="base" id="base" placeholder="Introduzca la base">
        <br><br>
        <label for="elevado">Elevado: </label> 
        <input type="text" name="elevado" id="elevado" placeholder="Introduzca el exponente">
        <br><br>
        <input type="submit" value="Calcular">
    </form>

    <?php
    $mostrar = "Resultado = ";
    if($_SERVER["REQUEST_METHOD"] == "POST"){ 

        $tmp_base = $_POST["base"];     // tmp_  variable temporal
        $tmp_exponente = $_POST["elevado"];

        // BASE
        if ($tmp_base != ''){
            if (filter_var($tmp_base, FILTER_VALIDATE_INT !== FALSE)){
                $base = $tmp_base;
            }
            else {
                echo "<p>La base debe ser un número</p>";
            }
        }
        else {
            echo "<p>La base es un campo obligatorio</p>";
        }

        // EXPONENTE
        if ($tmp_exponente != ''){
            if (filter_var($tmp_exponente, FILTER_VALIDATE_INT !== FALSE)){
                if ($tmp_exponente >= 0){
                    $exponente = $tmp_exponente;
                }
                else {
                    echo "<p>El exponente debe ser mayor o igual a 0</p>";
                }
            }
            else {
                echo "<p>El exponente debe ser un número</p>";
            }
        }
        else {
            echo "<p>El exponente es un campo obligatorio</p>";
        }

        // OPERACION FINAL
        if (isset($base) && isset($exponente)) {  // si existen estas variables
            $resultado = calcularPotencia($base, $exponente);  // calculo la potencia
            echo "<h3>El resultado es $resultado</h3>";
        }
    } 
    ?>

    <?php

    ?>
</body>
</html>