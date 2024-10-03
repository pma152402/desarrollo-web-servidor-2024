<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- RECORDATORIO!!! EL VIERNES VEMOS COMO ORDENAR TABLAS -->
    <!-- EJERCICIO 1
        Desarrollo web en entorno servidor => Alejandra
        Desarrollo web en entorno cliente => Jose miguel
        Diseño de interfaces web => Jose Miguel
        Despliegue de aplicaciones => Jaime
        Empresa e iniciativa emprendedora => Andrea
        Ingles => Virginia

        MOSTRARLO TODO EN UNA TABLA

    -->

    <?php
        $asignaturas["Desarrollo web en entorno servidor"] = "Alejandra";
        $asignaturas["Desarrollo web en entorno cliente"] = "Jose Miguel";
        $asignaturas["Diseño de interfaces web"] = "Jose Miguel";
        $asignaturas["Despliegue de aplicaciones"] = "Jaime";
        $asignaturas["Empresa e iniciativa eprendedora"] = "Andrea";
        $asignaturas["Ingles"] = "Virginia";
    ?>
    <table>
        <caption>Asignaturas</caption>
        <thead>
            <tr>
                <td>Asignatura</td>
                <td>Profesor</td>
            </tr>
        </thead>
        <tbody>
            <!-- EJERCICIO 1 RESUELTO -->
            <?php foreach($asignaturas as $asignatura => $profesor) {
                    echo "<tr><td>$asignatura</td><td>$profesor</td></tr>";
                }
            ?>
            <!-- ?php
            foreach($asignaturas as $profesor => $asignatura)  { ?>
                <tr>
                    <td>?php $asignatura ?></td>
                    <td>?php $profesor ?></td>
                </tr>
            ?php } ?>  -->
        </tbody>
    </table>
    <hr>
    <!-- EJERCICIO 2

        Francisco => 3
        Daniel => 5
        Aurora => 10
        Luis => 7
        Samuel => 9
        
        MOSTRAR EN UNA TABLA CON 3 COLUMNAS
            - COLUMNA 1: ALUMNO
            - COLUMNA 2: NOTA
            - COLUMNA 3: SI NOTA < 5 SUSPENSO
            
        si el alumno es suspenso ROJO, si es aprobado VERDE -->

    <?php
        $alumnos["Francisco"] = "3";
        $alumnos["Daniel"] = "5";
        $alumnos["Auroraa"] = "10";
        $alumnos["Luis"] = "7";
        $alumnos["Samuel"] = "9";
    ?>

    <table>
        <caption>Notas de los alumnos</caption>
        <thead>
            <tr>
                <td>Alumno</td>
                <td>Nota</td>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($alumnos as $alumno => $nota) {
                    echo "<tr>";
                    echo "<td>$alumno</td>";
                    echo "<td>$nota</td>";
                    echo "</tr>";
                } 
            ?>
        </tbody>
    </table>
</body>
</html>