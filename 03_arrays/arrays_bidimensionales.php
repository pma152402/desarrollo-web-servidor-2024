<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="estilos.css" rel="stylesheet" type="text/css">
    <?php
        error_reporting( E_ALL);
        ini_set("display_errors", 1);
    ?>
</head>
<body>
    <?php
        $array = [1,2,3,4];

        $videojuegos = [
            ["Disco Elysium","RPG", 9.99],
            ["Dragon Ball Z Kakarot", "Acción", 59.99],
            ["Persona 3", "RPG", 24.99],
            ["Commando 2", "Estrategia", 4.99],
            ["Stardew Valley", "Gestión de recursos", 7.99]
        ];

        $nuevo_videojuego = ["Octopath Traveler", "RPG", 29.95];
        array_push($videojuegos, $nuevo_videojuego);

        array_push($videojuegos, ["Ender Lilies", "Metroidvania", 9.95]);

        //unset($videojuegos[3]);

        array_push($videojuegos, ["Dota 2", "MOBA", 0]);
        array_push($videojuegos, ["Fall Guys", "Plataformas", 0]);
        array_push($videojuegos, ["Rocket League", "Deporte", 0]);
        array_push($videojuegos, ["Lego Fortnite", "Accion", 0]);

        for ($i = 0; $i < count($videojuegos); $i++){
        /* PARA METER UNA NUEVA COLUMNA */

            if ($videojuegos[$i][2] == 0) {
                $videojuegos[$i][3] = "Si";
            }
            else {
                $videojuegos[$i][3] = "No";
            }
        }

    ?>
    <table>
        <thead>
            <tr>
                <th>Videojuego</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>ForFree</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // etiquetas auxiliares
            $_titulo = array_column($videojuegos, 0);
            $_categoria = array_column($videojuegos, 1);
            $precio = array_column($videojuegos, 2);

            // si fuera descendente, SORT_DESC
            array_multisort($_titulo, SORT_ASC, $videojuegos);



            foreach($videojuegos as $videojuego) {
                //print_r($videojuego);
               /*  echo $videojuego[0];
                echo "<br><br>"; */
                list($titulo, $categoria, $precio, $forfree) = $videojuego;
                echo "<tr>";
                echo "<td>$titulo</td>";
                echo "<td>$categoria</td>";
                echo "<td>$precio</td>";
                echo "<td>$forfree</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>