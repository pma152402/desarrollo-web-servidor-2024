<?php
function cambiarDivisa($inicial, $origen, $final){

    $unidadOrigen = "";
    $unidadFinal = "";

    $resultado = $inicial; //por si cambiamos al mismo

    // DE EUROS
    if ($origen == "euro") {
        $unidadOrigen = "Euros";
        // A DÓLARES
        if ($final == "dolar") {
            $unidadFinal = "Dólares";
            $resultado = $inicial * 1.09;
        }
        // A YENES
        if ($final == "yenes") {
            $unidadFinal = "Yenes";
            $resultado = $inicial * 163.38;
        }
    }

    // DE DOLARES
    if ($origen == "dolar") {
        $unidadOrigen = "Dólares";
        // A EUROS
        if ($final == "euro") {
            $unidadFinal = "Euros";
            $resultado = $inicial * 0.92;
        }
        // A YENES
        if ($final == "yenes") {
            $unidadFinal = "Yenes";
            $resultado = $inicial * 149.67;
        }
    }

    // DE YENES
    if ($origen == "yenes") {
        $unidadOrigen = "Yenes";
        // A EUROS
        if ($final == "euro") {
            $unidadFinal = "Euros";
            $resultado = $inicial * 0.0061;
        }
        // A YENES
        if ($final == "dolar") {
            $unidadFinal = "Dólares";
            $resultado = $inicial * 0.0067;
        }
    }
    echo "$inicial $unidadOrigen son $resultado $unidadFinal";
}

function calcularPotencia($base, $elevado){

        $resultado = $base;

        if($elevado == 0) {
            $resultado = 1;
        } elseif ($elevado == 1) {
            $resultado = $base;
        } else {
            for($i = 1; $i < $elevado; $i++) {
                $resultado *= $base;
            }
        }
    echo "<br>";
    echo "Resultado = $resultado";
}

function tablaDeMultiplicar($number){
        for($i = 0; $i <= 10; $i++){
            $resultado = $number*$i;
            echo "<tr>";
                echo "<td>$number</td>";
                echo "<td>x</td>";
                echo "<td>$i</td>";
                echo "<td>=</td>";
                echo "<td>$resultado</td>";
            echo "</tr>";
        }
}
?>