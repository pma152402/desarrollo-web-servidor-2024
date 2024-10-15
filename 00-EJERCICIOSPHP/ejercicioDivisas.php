<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EJERCICIO DIVISAS</title>
</head>
<body>
    <h2>Cambio de divisas:</h2>
    <form action ="" method="post">
        Para empezar, introduzca la cantidad a cambiar:
        <input type="text" name="inicial"><br><br>
        
        <label for ="divisas">Seleccione la divisa original: </label>
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
        <input type="submit" value="enviar">
    </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $inicial = $_POST["inicial"];

            $unidadOrigen = "";
            $unidadFinal = "";

            $resultado = $inicial; //por si cambiamos al mismo

            // DE EUROS
            if ($_POST["origen"] == "euro") {
                $unidadOrigen = "Euros";
                // A DÓLARES
                if ($_POST["final"] == "dolar") {
                    $unidadFinal = "Dólares";
                    $resultado = $inicial * 1.09;
                }
                // A YENES
                if ($_POST["final"] == "yenes") {
                    $unidadFinal = "Yenes";
                    $resultado = $inicial * 163.38;
                }
            }

            // DE DOLARES
            if ($_POST["origen"] == "dolar") {
                $unidadOrigen = "Dólares";
                // A EUROS
                if ($_POST["final"] == "euro") {
                    $unidadFinal = "Euros";
                    $resultado = $inicial * 0.92;
                }
                // A YENES
                if ($_POST["final"] == "yenes") {
                    $unidadFinal = "Yenes";
                    $resultado = $inicial * 149.67;
                }
            }

            // DE YENES
            if ($_POST["origen"] == "yenes") {
                $unidadOrigen = "Yenes";
                // A EUROS
                if ($_POST["final"] == "euro") {
                    $unidadFinal = "Euros";
                    $resultado = $inicial * 0.0061;
                }
                // A YENES
                if ($_POST["final"] == "dolar") {
                    $unidadFinal = "Dólares";
                    $resultado = $inicial * 0.0067;
                }
            }
            echo "$inicial $unidadOrigen son $resultado $unidadFinal";
        }
        ?>
        
    
</body>
</html>