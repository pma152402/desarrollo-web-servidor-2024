<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    /* $numero = 2;

    if($numero > 0) {
        echo "<p>1 El numero $numero es mayor que cero</p>";
    }

    if($numero > 0) echo "<p>2 el numero $numero es mayor que cero</p>";

    if($numero > 0):
        echo "<p>3 el numero $numero es mayor que cero</p>";
    endif; */
    /////////////////////////////////
    
/* // forma 1
    if($numero > 0) {
        echo "<p>1 El numero $numero es mayor que cero</p>";
    } else {
        echo "<p>1 El numero $numero es menor que cero</p>";
    }
// forma 2
    if($numero > 0) echo "<p>2 el numero $numero es mayor que cero</p>";
    else echo "<p>2 El numero $numero es menor que cero</p>";

// forma 3
    if($numero > 0):
        echo "<p>3 el numero $numero es mayor que cero</p>";
    else:
        echo "<p>3 El numero $numero es menor que cero</p>";
    endif;
 */
    $numero = 0;
    // forma 1
    if($numero > 0) {
        echo "<p>1 El numero $numero es mayor que ceroooo</p>";
    } elseif ($numero == 0) {
        echo "<p>1 El numero $numero es igual que cerooooo</p>";
    } elseif ($numero < 0) {
        echo "<p>1 El numero es menor que ceroooooo";
    }

    // forma 2
    if($numero > 0) echo "<p>2 el numero $numero es mayor que cero</p>";
    elseif ($numero == 0) echo "<p>2 El numero $numero es igual que cero</p>";
    else echo "<p>2 El numero $numero es menor que cero</p>";

    // forma 3
    if($numero > 0):
        echo "<p>3 el numero $numero es mayor que cero</p>";
    elseif($numero == 0):
        echo "<p>3 el numero $numero es igual que cero</p>";
    else:
        echo "<p>3 El numero $numero es menor que cero</p>";
    endif;


    // IF para comprobar un rango de numeros, and o &&

    $num = -7;

    if ($num >= -10 and $num < 0) {
        echo "<p>El numero $num esta en el rango [-10, 0)</p>";
    } 
    elseif($num >= 0 and $num <= 10) {
        echo "<p>El numero $num esta en el rango [0, 10]</p>";
    } 
    elseif($num > 10 and $num <= 20) {
        echo "<p>El numero $num esta en el rango (10, 20]</p>";
    }
    ?>

    <h3>EJERCICIO 2</h3>
    <p>CALCULAR EL FACTORIAL DE 6 CON WHILE</p>
    <?php
    $i = 6;
    $aux = 1;

    while ($i > 0):
        $aux *= $i;
        $i--;
    endwhile;

    echo("Factorial de 6 = $aux");
    ?>
    

    <h3>EJERCICIO 3</h3>
    <p> Sumar numeros pares hasta 20</p>
    <?php
    $suma = 0; 
    $i = 1;  
    while ($i <= 20): 
        if ($i % 2 == 0): 
            $suma += $i;  
        endif; 
        $i++; 
    endwhile; 
        echo "La suma de los números pares entre 1 y 20 es: $suma\n"; 
    ?>

    <h3>EJERCICIO 4</h3>
    <p> Calcular los multiplos de 3</p>
    <?php
    $i = 0; 
    while ($i <= 9): 
        $resultado = $i * 3; 
        if ($resultado % 2 == 0): echo "$resultado es par\n"; 
        else: echo "$resultado es impar\n"; 
        endif; 
        $i++; 
    endwhile; 
    ?>

    <h3>EJERCICIO 5</h3>
    <p> MOSTRAR EN UNA LISTA LOS NUMEROS MULTIPLOS DE 3 </p>
    <ul>
    <?php
        $i = 1;
        while($i <= 100):
            if($i % 3 == 0):
                echo "<li>$$i</li>";
            endif;
            $i++;
        endwhile;
    ?>
    </ul>

    <h1>Lista con FOR</h1>
    <?php
    echo "<ul>";
    for($i = 1; $i <= 10; $i++){
        echo "<li>$i</li>";
    }
    echo "</ul>";
    ?>

    <h1>Lista con FOR alternativa : endfor</h1>
    <?php
    echo "<ul>";
    for($i = 1; $i <= 10; $i++):
        echo "<li>$i</li>";
    endfor;
    echo "</ul>";
    ?>

    <h1>Lista con FOR break CURSED</h1>
    <?php
    echo "<ul>";
    for($i = 1; ; $i++){
        if($i > 10) {
            break;
        }
        echo "<li>$i</li>";
    }
    echo "</ul>";
    ?>

    <h1>EJERCICIO 6</h1>
    <p>MUESTRA POR PANTALLA LOS 50 PRIMEROS NUMEROS PRIMOS</p>
    <?php
    /*  siempre entre 1 o si mismo dara 0, asiq lo contrario
    4 % 2 = 2   4 NO ES PRIMO
    4 % 3 = 1

    5 % 2 = 1      5 SI ES PRIMO
    5 % 3 = 2
    5 % 4 = 1

    BUCLE DE 2 A N-1
    $n = 7
    DESDE 2 hasta n - 1
        comprobar si 7 tiene divisores que den de resto 0,
            si existe, devolvemos falso
    */
    echo "<ul>";
    $n = 31;
    $res = 0;
    $primo = false;

    for($i = 2; $i <= $n - 1; $i++) {
        echo "<li>$$n % $i =";


        if($n % $i == 0){
            $res = $n % $i;
            echo "$res El numero NO es primo";
            $i = $n + 50; // Salimos del bucle
        }
        else {
            $res = $n % $i;
            echo "$res";
            if ($n == $i){
                echo "El numero es primo !!";
            }
        }
        echo "</li>";
    }
    echo "</ul> ";
    ?>

    // resolucion
    <h1>RESOLUCION</h1>
    <?php
    $numero = 2;
    $numerosPrimos = 0;

    echo "<ol>";
    while($numerosPrimos < 50){

        $esprimo = true;
        for ($i = 2; $i < $numero; $i++){
            if($numero % i == 0) {
                // No es primo
                $esPrimo = false;
                break;
            }
        }
        if($esPrimo) {
            $numerosPrimos++;
            echo "<li>$numero</li>";
        }
        $numero++;
    }
    echo "</ol>";

    // N*N -> O(N²)
  //   var_dump($esPrimo);
    ?>



</body>
</html>