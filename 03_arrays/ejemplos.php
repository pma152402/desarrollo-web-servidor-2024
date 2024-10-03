<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplos</title>
    <link href="estilos.css" rel="stylesheet" type="text/css">
</head>
<body>
    <?php
        error_reporting( E_ALL);
        ini_set("display_errors", 1);
    ?>
    <?php
    /* TODOS LOS ARRAYS EN PHP SON ASOCIATIVOS, COMO LOS MAP DE JAVA, 
    TIENEN PARES CLAVE-VALOR */
    $numeros = [5,10,9,6,7,4];
    $numeros = array(6,10,9,4,3); #array modo funcion
    print_r($numeros); #Print relational

    echo "<br><br>";

  //  $animales = ["Perro", "Gato", "Cocodrilo"];

   /*  $animales = [
        "A01" => "Perro",
        "A02" => "Gato",
        "A03" => "Ornitorrinco",
        "A04" => "Suricato",
        "A05" => "Capibara",
    ]; */


    $animales = [
        "Perro",
        "Gato",
        "Ornitorrinco",
        "Suricato",
        "Capibara",
    ];

  //  print_r($animales);

    echo "<p>" . $animales["AO3"] . "</p>";

    $animales[2] = "Koala";

    $animales[6] = "Iguana";
    $animales["A01"] = "Elefante";
    array_push($animales, "Morsa", "Foca");
    $animales[] = "Ganso";

    unset($animales[1]);

    $animales = array_values($animales);

    $cantidad_animales = count($animales);

    echo "<h3>Hay $cantidad_animales animales</h3>";

    print_r($animales);

    echo "<br><hr><h3>Array de coches:</h3>";




    /* CREAR EL ARRAY CON 3 COCHES, AÑADIR 2 COCHES CON SUS MATRICULAS,
    AÑADIR 1 COCHE SIN MATRICULA, BORRAR EL COCHE SIN MATRICULA,
    RESETEAR LAS CLAVES Y ALMACENAR EL RESULTADO EN OTRO ARRAY */


    $coches = [
        "4312 TDZ" => "Audi TT",
        "1122 KFC" => "Mercedes CLA",
        "5426 LMG" => "Volkswagen Polo",
    ];

    $coches["8734 MMG"] = "BMW M3";
    $coches["7823 LPF"] = "Nissan GTR";

    array_push($coches, "Fiat Multipla");

    print_r($coches);

    echo "<hr>";

    unset($coches[0]);

    print_r($coches);

    echo "<hr>";

    $coches_sinClave = (array_values($coches));

    print_r($coches_sinClave);

///////////////////////////////////////////////////////////////////////////
    echo "<hr>";

    // RECORRER UN ARRAY
    //for
    echo "<ol>";
    for($i = 0; $i < count($animales); $i++) {
        echo "<li>" . $animales[$i] . "</li>";
    }
    echo "</ol>";

    //while
    echo "<ul>";
    $i = 0;
    while($i != count($animales)):
        echo "<li>" . $animales[$i] . "</li>";
        $i++;
    endwhile;
    echo "</ul>";

    //for-each  SIN CLAVE
    echo "<ol>";
    foreach($coches as $coche) {
        echo "<li>$coche</li>";
    }
    echo "</ol>";

    //for-each  CON CLAVE
    echo "<ol>";
    foreach($coches as $matricula => $coche) {
        echo "<li>$matricula, $coche</li>";
    }
    echo "</ol>";
    ?>

    <table>
        <caption>Coches</caption>
        <thead>
            <tr>
                <th>Matricula</th>
                <th>Coche</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>2133 FSD</td>
                <td>Ferrari 355</td>
            </tr>

            <?php
                foreach($coches as $matricula => $coche) {
                    echo "<tr><td>$matricula</td><td>$coche</td></tr>";
                }
                /* DE ESTA FORMA ES MAS FACIL DE MANTENER
                    echo "<tr>;
                    echo "<td>$matricula</td>";
                    echo "<td>$coche</td>";
                    echo "</tr>; */
            ?>

            <!-- LA FORMA MAS OPTIMA DE HACERLO ES ESTA, PARA BBDD
             ?php
            foreach($coches as $amtricula => $coche) { ?>
                <tr>
                    <td>?php echo $matricula ?></td>
                    <td>?php echo $coche ?></td>
                </tr>
            ?php }
            ?> -->
        </tbody>
    </table>


</body>
</html>