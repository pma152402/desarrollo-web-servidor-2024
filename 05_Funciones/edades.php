<?php

function calcularEdad($name, $age){
    $mostrar = "Nombre: ";

    if ($age < 18) {
        $mostrar = "$mostrar" . "$name." . " Es menor de edad";
    } 
    elseif ($age >= 18 && $age <= 65) {
        $mostrar = "$mostrar" . "$name. " . "Edad: " . $age . " Es mayor de edad";
    } 
    else {
        $mostrar = "$mostrar" . "$name. " . "Está jubilado";
    }
    echo "<br>";
    echo $mostrar;
}
?>