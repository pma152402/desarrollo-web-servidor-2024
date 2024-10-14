<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EJERCICIO 5 PHP</title>
    <?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    ?>
</head>
<body>
    <h2>Calcular el salario neto</h2>

    <form action="" method="post">
        Introduzca su salario BRUTO: <input type="text" name="bruto">
        <input type="submit" value="enviar">
    </form>
    <?php
    // DEVOLVER EL SALARIO NETO 
    // hasta 12.400 al 19%, 
    // de hasta 20.199 al 24%
    // de hasta 30.000 al 30%
    if ($_SERVER["REQUEST_METHOD"] == "POST"){

        $bruto = $_POST["bruto"];
        $resultado = 0;

        if ($bruto < 12400){
            $resultado = $bruto - ($bruto * 0.19);
            echo"<p>Después de robarte, tu salario se queda en $resultado €</p>";
        }
        elseif (($bruto > 12400) && ($bruto < 20199)){
            $resultado = $bruto - ($bruto * 0.24);
            echo"<p>Después de robarte, tu salario se queda en $resultado €</p>";
        }
        elseif (($bruto > 20199) && ($bruto < 30000)){
            $resultado = $bruto - ($bruto * 0.30);
            echo"<p>Después de robarte, tu salario se queda en $resultado €</p>";
        }
    }
    ?>
    
</body>
</html>