<?php
    function calcularPotencia($base, $exponente){

        $resultado = $base;

        if($exponente == 0) {
            $resultado = 1;
        } elseif ($exponente == 1) {
            $resultado = $base;
        } else {
            for($i = 1; $i < $exponente; $i++) {
                $resultado *= $base;
            }
        }

        return $resultado;

    }
?>