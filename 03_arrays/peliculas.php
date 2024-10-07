<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peliculas</title>
    <link href="estilos.css" rel="stylesheet" type="text/css">
    <?php
        error_reporting( E_ALL);
        ini_set("display_errors", 1);
    ?>
</head>
<body>
    <?php
    $peliculas = [
        ["Kárate a muerte en Torremolinos", "Acción", 1975],
        ["Sharknado 1-5", "Acción", 2015],
        ["Princesa por sorpresa 2", "Comedia", 2008],
        ["Temblores 4", "Terror", 2018],
        ["Stuart Little", "Infantil", 2000]
    ];

/* 1. AÑADIR CON UN RAND, LA DURACION DE CADA PELICULA (COLUMNA). LA DURACION SERA
    UN NUMERO ALEATORIO ENTRE 30 Y 240

    2. AÑADIR COMO UNA NUEVA COLUMNA, EL TIPO DE PELICULA, EL TIPO SERA:
        - CORTOMETRAJE ( > 60 )
        - LARGOMETRAJE ( 60 >= )

    3. MOSTRAR EN OTRA TABLA, TODAS LAS COLUMNAS, ORDENAR EN ESTE ORDEN:
        1) GENERO
        2) AÑO
        3) TITULO
        TODO ALFABETICAMENTE, Y EL AÑO DE MAS RECIENTE A MAS ANTIGUO
*/

    ?>

<table>
        <thead>
            <tr>
                <th>Pelicula</th>
                <th>Categoría</th>
                <th>Año</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($peliculas as $pelicula) {
                list($titulo, $categoria, $año) = $pelicula;
                echo "<tr>";
                echo "<td>$titulo</td>";
                echo "<td>$categoria</td>";
                echo "<td>$año</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>