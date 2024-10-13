<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EJERCICIO 1 PHP</title>
    <?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    ?>
</head>
<body>
    <h2>Formulario Ejercicio 1</h2>
    <p>Vamos a comprobar cuál es el mayor de todos los números especificados</p>
    <form action="" method="post">
        <b>Número A:</b><input type="text" name="numA"><br>
        <b>Número B:</b><input type="text" name="numB"><br>
        <b>Número C:</b><input type="text" name="numC"><br>
        <input type="submit" value="Enviar">
    </form>

    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $numA = $_POST["numA"];
        $numB = $_POST["numB"];
        $numC = $_POST["numC"];

        $mayor = 0;

        if (($numA > $numB)&&($numA > $numB)){
            $mayor = $numA;
        }
        elseif (($numC > $numA)&&($numC > $numB)){
            $mayor = $numC;
        }
        else{
            $mayor = $numB;
        }

        echo "<p>El número mayor es:<b> $mayor</b></p>";
    }
    ?>
</body>
</html>
