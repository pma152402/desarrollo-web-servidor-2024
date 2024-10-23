<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Varios formularios</title>
    <?php
    //  Activamos los errores de PHP
        error_reporting(E_ALL);
        ini_set("display_errors", 1);

        require('../05_funciones/temperaturas.php');
        require('../05_Funciones/edades.php')
    ?>
</head>

<body>
    <!-- FORMULARIO TEMPERATURAS-->
    <h2>Formulario temperaturas</h2>
    <form action="" method="post">
        <input type="number" name="temperatura" placeholder="temperatura"><br><br>
        <label>Unidad inicial: </label>
        <select name="inicial">
            <option value="C">Celsius</option>
            <option value="K">Kelvin</option>
            <option value="F">Fahrenheit</option>
        </select><br><br>
        <label>Unidad final: </label>
        <select name="final">
            <option value="C">Celsius</option>
            <option value="K">Kelvin</option>
            <option value="F">Fahrenheit</option>
        </select><br><br>
        <input type="hidden" name="accion" value="formulario_temperaturas">
        <input type="submit" value="Convertir">
    </form>

    <!-- FORMULARIO EDADES-->
    <h2>Formulario edades</h2>
    <form action="" method="post">
        <label for="name">Nombre: </label>
        <input type="text" name="name" id="name" placeholder="Introduzca su nombre">
        <br><br>
        <label for="age">Edad: </label>
        <input type="text" name="age" id="age" placeholder="Introduzca su edad">
        <br><br>
        <input type="hidden" name="accion" value="formulario_edades">
        <input type="submit" value="Enviar">
    </form>

    <!-- PHP-->
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Formulario edades
        if ($_POST["accion"] == "formulario_edades") {
            $nombre = $_POST["name"];
            $edad = $_POST["age"];

            calcularEdad($nombre, $edad);
        }

        // Formulario temperaturas
        if ($_POST["accion"] == "formulario_temperaturas") {
            $temperatura = $_POST["temperatura"];
            $inicial = $_POST["inicial"];
            $final = $_POST["final"];

            convertirTemperatura($temperatura, $inicial, $final);
        }
    }
    // En otro fichero nuevo, poner todos los demas formularios, y
    // hacerlo con funciones; hacerlo por lo menos con 4 formularios

    ?>

</body>

</html>