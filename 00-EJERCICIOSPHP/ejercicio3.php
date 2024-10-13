<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EJERCICIO 3 PHP</title>
    <?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    ?>
</head>
<body>
    <h2>Formulario Ejercicio 3</h2>
    <p>Vamos a calcular todos los números primos entre <b>A</b> y <b>B</b></p>
    <form action="" method="post">
        <b>Número A</b><input type="text" name="numA"><br>
        <b>Número B</b><input type="text" name="numB"><br>
        <input type="submit" value="enviar">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $numA = $_POST["numA"];
        $numB = $_POST["numB"];

        echo "<p>Los números primos en el rango de $numA hasta $numB son: </p>";

        for ($i = $numA; $i <= $numB; $i++){ // rango de A hasta B   

            $booleano = true; // para ver si es primo o no

            for ($j = 2; $j < $i; $j++){ //para comprobar todos los numeros en el rango, SIEMPRE A PARTIR DE 2, $i es $numA
                
                if ($i % $j == 0) {  // si el resto es 0, no es primo
                    $booleano = false;
                }
            }

            if ($booleano){ // si es primo lo sacamos
                echo "<ul>";
                echo "<li>$i</li>";
                echo "</ul>";
            }

        }
    }
    ?>
</body>
</html>