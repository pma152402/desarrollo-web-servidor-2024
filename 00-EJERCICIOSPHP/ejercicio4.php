<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EJERCICIO 4 PHP</title>
</head>
<body>
    <h2>Conversor de temperaturas</h2>
    <form action="" method="post">
    Introduzca la temperatura inicial: <input type="text" name="inicial"><br><br>

        <!-- Pasar de.. -->
        <label for="origen">Convertir de</label>
        <select name="origen" id="origen">
            <option value="Celsius">Celsius</option>
            <option value="Fahrenheit">Fahrenheit</option>
            <option value="Kelvin">Kelvin</option>
        </select>

        <!-- A.. -->
        <label for="final"> a </label>
        <select name="final" id="final">
            <option value="Celsius">Celsius</option>
            <option value="Fahrenheit">Fahrenheit</option>
            <option value="Kelvin">Kelvin</option>
        </select>

        <input type="submit" value="enviar">
    </form>

    <?php
    // Para convertir de CELSIUS a FAHRENHEIT = celsius * 1.8, +32
    // De CELSIUS a KELVIN = celsius + 273
    // De FAHRENHEIT a KELVIN = -32, * 5, /9, +273

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        
        $inicial = $_POST["inicial"];

        $resultado = 0;
        $unidadOrigen = "";
        $unidadFinal = "";

        // De CELSIUS
        if ($_POST["origen"] == "Celsius"){
            $unidadOrigen = "Celsius";

            // A Fahrenheit
            if ($_POST["final"] == "Fahrenheit"){
                $unidadFinal = "Fahrenheit";
                $resultado = ($inicial * 1.8) +32;
            }

            // A Kelvin
            elseif ($_POST["final"] == "Kelvin"){
                $unidadFinal = "Kelvin";
                $resultado = $inicial + 273;
            }
        }
        // De FAHRENHEIT
        elseif ($_POST["origen"] == "Fahrenheit"){
            $unidadOrigen = "Fahrenheit";

            // A Celsius
            if ($_POST["final"] == "Celsius"){
                $unidadFinal = "Celsius";
                $resultado = ($inicial - 32) / 1.8;
            }

            // A Kelvin
            elseif ($_POST["final"] == "Kelvin"){
                $unidadFinal = "Kelvin";
                $resultado = ((($inicial - 32) * 5) / 9) + 273;
            }
        }
        // De KELVIN
        elseif ($_POST["origen"] == "Kelvin"){
            $unidadOrigen = "Kelvin";

            // A Celsius
            if ($_POST["final"] == "Celsius"){
                $unidadFinal = "Celsius";
                $resultado = $inicial - 273;
            }

            // A Fahrenheit
            if ($_POST["final"] == "Fahrenheit"){
                $unidadFinal = "Fahrenheit";
                $resultado = ($inicial - 273) * 1.8 + 32; // me estaba dando problemas asi que al final lo he pasado a Celsius :)
            }
        }


        // Pintar el resultado
        echo "<p>El resultado de la conversión de $inicial grados <b>$unidadOrigen</b> a <b>$unidadFinal</b> es $resultado</p>";
    }
    ?>
</body>
</html>