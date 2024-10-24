<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
        error_reporting(E_ALL);
        ini_set("display_errors", 1);

        require('../05_Funciones/funIRPF.php');
    ?>    
</head>
<body>
    <form action="" method="post">
        <input type="text" name="salario" placeholder="Salario">
        <input type="submit" value="Calcular salario bruto">
    </form>
    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {

        $tmp_salario = $_POST["salario"];

        if ($tmp_salario != ''){
            if (filter_var($tmp_salario, FILTER_VALIDATE_FLOAT) !== FALSE){
                if ($tmp_salario > 0){
                    $salario = $tmp_salario;
                }
                else {
                    echo "<p>El salario debde de ser superior a 0</p>"; // y en verdad deberia ser el SMIP
                }
            }
            else {
                echo "<p>El salario debe de ser un numero</p>";
            }
        }
        else {
            echo "<p>El campo del salario no puede estar vacío</p>";
        }

        if (isset($salario)){
            $resultado = calcularIRPF($salario);
            echo "<h3>El salario neto de $salario es $resultado</h3>";
        }
    }
    ?>
</body>
</html>