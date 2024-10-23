<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Formularios</title>
    <?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    require('../05_Funciones/ejAllFormulariosFunciones.php');
    require('../05_Funciones/temperaturas.php')
    ?>
</head>

<body>
    <!-- FORMULARIO DE DIVISAS -->
    <h2>Cambio de divisas:</h2>
    <form action="" method="post">
        Para empezar, introduzca la cantidad a cambiar:
        <input type="text" name="inicial"><br><br>

        <label for="divisas">Seleccione la divisa original: </label>
        <select name="origen" id="origen">
            <option value="euro">Euros</option>
            <option value="dolar">Dólares</option>
            <option value="yenes">Yenes</option>
        </select>
        <select name="final" id="final">
            <option value="euro">Euros</option>
            <option value="dolar">Dólares</option>
            <option value="yenes">Yenes</option>
        </select>
        <input type="hidden" name="accion" value="formulario_divisas">
        <input type="submit" value="enviar">
    </form>
    <hr>

    <!-- FORMULARIO DE potencia -->
     <h2>Formulario de potencia:</h2>
    <form action="" method="post">
        <label for="base">Base:      </label>
        <input type="text" name="base" id="base" placeholder="Introduzca la base">
        <br><br>
        <label for="elevado">Elevado: </label> 
        <input type="text" name="elevado" id="elevado" placeholder="Introduzca el exponente">
        <br><br>
        <input type="hidden" name="accion" value="formulario_potencia">
        <input type="submit" value="Calcular">
    </form>
    <hr>

    <!-- FORMULARIO DE tabla de multiplicar -->
    <h2>Tabla de multiplicar</h2>
    <form action="" method="post">
        <label for="number">Número:      </label>
        <input type="text" name="number" id="number" placeholder="Introduzca un número">
        <br><br>
        <input type="hidden" name="accion" value="formulario_multiplicar">
        <input type="submit" value="Calcular">
    </form>
    <br><br>
    <table>
        <thead>
            <tr>
                <th>Multiplicando</th>
                <th></th>
                <th>Multiplicador</th>
                <th></th>
                <th>Producto</th>
            </tr>
        </thead>
    
<!-- FORMULARIO DE temperatura-->
<hr>
<h2>Formulario de temperatura</h2>
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

        <input type="hidden" name="accion" value="formulario_temperatura">
        <input type="submit" value="enviar">
    </form>

    <!-- PHP -->
      <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // PHP de Divisas
            if ($_POST["accion"] == "formulario_divisas"){
                $inicial = $_POST["inicial"];
                $origen = $_POST["origen"];
                $final = $_POST["final"];

                cambiarDivisa($inicial, $origen, $final);
            }
            // PHP de Potencia
            if ($_POST["accion"] == "formulario_potencia"){
                $base = $_POST["base"];
                $elevado = $_POST["elevado"];

                calcularPotencia($base, $elevado);
            }
            // PHP de Tabla Multiplicar
            if ($_POST["accion"] == "formulario_multiplicar"){
                $number = $_POST["number"];

                tablaDeMultiplicar($number);
            }
            // PHP de Temperatura
            if ($_POST["accion"] == "formulario_temperatura"){
                $inicial = $_POST["inicial"];
                $origen = $_POST["origen"];
                $final = $_POST["final"];

                if ($inicial != ''){
                    if (is_numeric($inicial)){
                        // CELSIUS
                        if ($origen == "Celsius" and $inicial >= -273.15){
                            echo convertirTemperatura($inicial, $origen, $final);
                        }
                        elseif($origen == "Celsius" and $inicial < -273.15) {
                            echo "<p>La temperatura no puede ser inferior a -273.15 Celsius</p>";
                        }
                        // FAHRENHEIT
                        if ($origen == "Fahrenheit" and $inicial >= -459.67){
                            echo convertirTemperatura($inicial, $origen, $final);
                        }
                        elseif($origen == "Fahrenheit" and $inicial < -459.67) {
                            echo "<p>La temperatura no puede ser inferior a -273.15 Fahrenheit</p>";
                        }
                        // KELVIN
                        if ($origen == "Kelvin" and $inicial >= 0){
                            echo convertirTemperatura($inicial, $origen, $final);
                        }
                        elseif($origen == "Kelvin" and $inicial < 0) {
                            echo "<p>La temperatura no puede ser inferior a 0 Kelvin</p>";
                        }
                    }
                    else {
                        echo "<p>La temperatura debe de ser un número</p>";
                    }
                }
                else {
                    echo "<p>Falta la temperatura inicial</p>";
                }
                if ($origen != ''){
                    
                }
                else {
                    echo "<p>Falta la unidad origen</p>";
                }
                if ($final != ''){
                    
                }
                else {
                    echo "<p>Falta la unidad final</p>";
                }
                $temperaturaFinal = convertirTemperatura($inicial, $origen, $final);
                echo "<p>$temperaturaFinal</p>";    // estamos dejando atras todas las variables que cree en la funcion pero vale
            }
        }
      ?>
</body>

</html>