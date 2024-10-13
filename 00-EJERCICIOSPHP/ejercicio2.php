<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EJERCICIO 2 PHP</title>
    <?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    ?>
</head>
<body>
    <h2>Formulario Ejercicio 2</h2>
    <p>Vamos a calcular los números primos de <b>C</b> dentro del rango de <b>A</b> hasta <b>B</b><p>
    <form action="" method="post">
        <b>Número A</b><input type="text" name="numA"><br>
        <b>Número B</b><input type="text" name="numB"><br>
        <b>Número C</b><input type="text" name="numC"><br>
        <input type="submit" value="enviar">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $numA = $_POST["numA"];
        $numB = $_POST["numB"];
        $numC = $_POST["numC"];

        $resultado = 0;

        for($i = 0; $i < $numB; $i++){
            if ((($numC * $i) >= $numA)&&(($numC * $i) <= $numB)) {

                $resultado = $numC * $i;

                echo "<ul>";
                echo "<li>$numC x $i = <b>$resultado</b></li>";
                echo "</ul>";
            }
        }
    }
    ?>
</body>
</html>