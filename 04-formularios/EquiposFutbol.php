<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipos de futbol</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1 );  
    ?>
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
    <!-- FUNCION PARA DEPURAR -->
    <?php 
    function depurar(string $entrada): string   {
        // recortar espacios al principio y al final
        $salida = trim($entrada);
    
        // convertir caracteres especiales a texto plano
        $salida = htmlspecialchars($salida); //   ,ENT_QUOTES, 'UTF-8'   para comillas 
    
        // eliminar slashes
        $salida = stripslashes($salida);
    
        // reemplazar muchos espacios por uno solo
        $salida = preg_replace('/\s+/', ' ', $salida);  // revisa patron
    
        return $salida;
    }
    ?>
    <!-- CODIGO PHP -->
    <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            // DECLARAR VARIABLES
            $tmp_nombre = depurar($_POST["nombre"]);
            $tmp_iniciales = depurar($_POST["iniciales"]);
            $tmp_liga = depurar($_POST["liga"]);
            $tmp_ciudad = depurar($_POST["ciudad"]);
            $tmp_tiene_liga = depurar($_POST["tiene_liga"]);
            $tmp_fecha_fundacion = depurar($_POST["fecha_fundacion"]);
            $tmp_numero_jugadores = depurar($_POST["numero_jugadores"]);

            // VALIDAR NOMBRE
            if ($tmp_nombre == ""){
                $err_nombre = "El nombre no puede estar vacío";
            }
            else{
                if (strlen($tmp_nombre) < 3 ||strlen($tmp_nombre) > 30){
                    $err_nombre = "El nombre debe de tener entre 3 y 30 carácteres";
                }
                else {
                    $patron = "/^[a-zA-Z .ñáéióúÁÉÍÓÚñÑüÜ]+$/";
                    if (!preg_match($patron, $tmp_nombre)){
                        $err_nombre = "El nombre no puede incluir numeros ni carácteres especiales";
                    }
                    else {
                        $nombre = $tmp_nombre;  // hazle lo de poner las primeras mayúsculas
                    }
                }
            }

            // VALIDAR INICIALES
            if ($tmp_iniciales == ""){
                $err_iniciales = "Las iniciales son obligatorias";
            }
            else {
                if (strlen($tmp_iniciales) != 3){
                    $err_iniciales = "Las iniciales han de ser 3";
                }
                else {
                    $patron = "/^[a-zA-Z ñáéióúÁÉÍÓÚñÑüÜ]+$/";
                    if (!preg_match($patron, $tmp_iniciales)){
                        $err_iniciales = "Las iniciales no pueden incluir numeros ni carácteres especiales";
                    }
                    else {
                        $iniciales = $tmp_iniciales;
                    }
                }
            }

            // VALIDAR LIGA
            if ($tmp_liga == ""){
                $err_liga = "La liga no puede estar vacía";
            }
            else {
                $ligas_validas = ["ea_sports", "hypermotion", "primera_rfef"];
                if (!in_array($tmp_liga, $ligas_validas)){
                    $err_liga = "La liga indicada no es una liga válida";
                }
                else {
                    $liga = $tmp_liga;
                }
            }

            // VALIDAR CIUDAD
            if ($tmp_ciudad == ""){
                $err_ciudad = "La ciudad no puede quedar vacía";
            }
            else {
                if (strlen($tmp_ciudad) < 3 || strlen($tmp_ciudad) > 30){
                    $err_ciudad = "El nombre de la ciudad debe tener entre 3 y 40 carácteres";
                }
                else {
                    $patron = "/^[a-zA-Z ñçáéióúÁÉÍÓÚñÑüÜ]+$/";
                    if (!preg_match($patron, $tmp_ciudad)){
                        $err_ciudad = "La ciudad no puede contener numeros ni carácteres especiales";
                    }
                    else {
                        $ciudad = $tmp_ciudad;
                    }
                }
            }

            // VALIDAR SI TIENE TITULO DE LIGA O NO
            if ($tmp_tiene_liga == ""){
                $err_tiene_liga = "La respuesta no puede quedar vacía";
            }
            else {
                $respuestas_validas = ["si", "no"];
                if (!in_array($tmp_tiene_liga, $respuestas_validas)){
                    $err_tiene_liga = "La respuesta indicada no es válida";
                }
                else {
                    $tiene_liga = $tmp_tiene_liga;
                }
            }

            // VALIDAR FECHA DE FUNDACION
            if ($tmp_fecha_fundacion == ""){
                $err_fecha_fundacion = "La fecha de fundación no puede quedar vacío";
            }
            else {
                $patron = "/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/";           // IMPORTANTE
                if (!preg_match($patron, $tmp_fecha_fundacion)){
                    $err_fecha_fundacion = "Formato de fecha incorrecto";
                }
                else {
                    // fecha minima
                    $fecha_min = "1889-12-18";
                    list($anno_min, $mes_min, $dia_min) = explode('-', $fecha_min);

                    // fecha maxima
                    $fecha_actual = date("Y-m-d");
                    list($anno_actual, $mes_actual, $dia_actual) = explode('-', $fecha_actual);

                    // fecha del club
                    list($anno, $mes, $dia) = explode('-', $tmp_fecha_fundacion);

                    // COMPARACIONES
                    // por minimo
                    if ($anno < $anno_min) {
                        $err_fecha_fundacion = "La fecha de fundación no puede ser inferior a ".$dia_min."-".$mes_min."-".$anno_min;
                    }
                    elseif ($anno == $anno_min){
                        if ($mes < $mes_min){
                            $err_fecha_fundacion = "La fecha de fundación no puede ser inferior a ".$dia_min."-".$mes_min."-".$anno_min;
                        }
                        elseif ($mes > $mes_min){
                            $fecha_fundacion = $tmp_fecha_fundacion;
                        }
                        elseif ($mes == $mes_min){
                            if ($dia < $dia_min){
                                $err_fecha_fundacion = "La fecha de fundación no puede ser inferior a ".$dia_min."-".$mes_min."-".$anno_min;
                            }
                            elseif ($dia >= $dia_min){
                                $fecha_fundacion = $tmp_fecha_fundacion;
                            }
                        }
                    }
                    // por maximo
                    elseif ($anno > $anno_actual){
                        $err_fecha_fundacion = "La fecha de fundación no puede ser superior a ".$dia_actual."-".$mes_actual."-".$anno_actual;
                    }
                    elseif ($anno < $anno_actual){     
                        $fecha_fundacion = $tmp_fecha_fundacion;
                    }
                    elseif ($anno == $anno_actual){
                        if ($mes > $mes_actual){
                            $err_fecha_fundacion = "La fecha de fundación no puede ser superior a ".$dia_actual."-".$mes_actual."-".$anno_actual;
                        }
                        elseif ($mes < $mes_actual){
                            $fecha_fundacion = $tmp_fecha_fundacion;
                        }
                        elseif ($mes == $mes_actual){
                            if ($dia > $dia_actual){
                                $err_fecha_fundacion = "La fecha de fundación no puede ser superior a ".$dia_actual."-".$mes_actual."-".$anno_actual;
                            }
                            elseif ($dia <= $dia_actual){
                                $fecha_fundacion = $tmp_fecha_fundacion;
                            }
                        }
                    }
                }
            }

            // VALIDAR NUMERO DE JUGADORES
            if ($tmp_numero_jugadores == ""){
                $err_numero_jugadores = "El numero de jugadores no puede quedar vacío";
            }
            else {
                // si no es un numero entero..
                if (!filter_var($tmp_numero_jugadores, FILTER_VALIDATE_INT)){
                    $err_numero_jugadores = "El valor solo puede ser numérico";
                }
                else {
                    if ($tmp_numero_jugadores < 19 || $tmp_numero_jugadores > 32){
                        $err_numero_jugadores = "El número total de jugadores debe de estar entre 19 y 32";
                    }
                    else {
                        $numero_jugadores = $tmp_numero_jugadores;
                    }
                }
            }
        }
    ?>


    <!-- FORMULARIO -->
     <h2>Formulario para Equipos de Fútbol</h2>
        <form class="col-4" action="" method="post">
            <!-- NOMBRE -->
            <div class="mb-3">
                <label class="form-label"><i><b>Nombre:</b></i></label>
                <input class="form-control" type="text" name="nombre">
                <?php if (isset($err_nombre)) echo "<span class='error'>$err_nombre</span>" ?>
            </div>
            <!-- INICIALES -->
            <div class="mb-3">
                <label class="form-label"><i><b>Iniciales:</b></i></label>
                <input class="form-control" type="text" name="iniciales">
                <?php if (isset($err_iniciales)) echo "<span class='error'>$err_iniciales</span>" ?>
            </div>
            <!-- LIGA -->
            <div class="mb-3">
                <label class="form-label"><i><b>Liga:</b></i></label>
                <select class="form-select" name="liga">
                    <option class="form-option" value="ea_sports">Liga EA Sports</option>
                    <option class="form-option" value="hypermotion">Liga Hypermotion</option>
                    <option class="form-option" value="primera_rfef">Primera RFEF</option>
                </select>
                <?php if (isset($err_liga)) echo "<span class='error'>$err_liga</span>" ?>
            </div>
            <!-- CIUDAD -->
            <div class="mb-3">
                <label class="form-label"><i><b>Ciudad:</b></i></label>
                <input class="form-control" type="text" name="ciudad">
                <?php if (isset($err_ciudad)) echo "<span class='error'>$err_ciudad</span>" ?>
            </div>
            <!-- TIENE LIGA? -->
            <div class="mb-3">
                <label class="form-label"><i><b>Ha ganado alguna liga?:</b></i></label>
                Si<input class="form-radio" type="radio" value="si" name="tiene_liga">
                No<input class="form-radio" type="radio" value="no" name="tiene_liga" checked>
                <?php if (isset($err_tiene_liga)) echo "<span class='error'>$err_tiene_liga</span>" ?>
            </div>
            <!-- FECHA DE FUNDACION -->
            <div class="mb-3">
                <label class="form-label"><i><b>Fecha fundación:</b></i></label>
                <input class="form-date" type="date" name="fecha_fundacion">
                <?php if (isset($err_fecha_fundacion)) echo "<span class='error'>$err_fecha_fundacion</span>" ?>
            </div>
            <!-- NUMERO DE JUGADORES -->
            <div class="mb-3">
                <label class="form-label"><i><b>Número de jugadores:</b></i></label>
                <input class="form-control" type="text" name="numero_jugadores">
                <?php if (isset($err_numero_jugadores)) echo "<span class='error'>$err_numero_jugadores</span>" ?>
            </div>
            <!-- ENVIAR -->
            <div class="mb.3">
                <input class="btn btn-primary" type="submit" name="Enviar">
            </div>
        </form>
        <?php
            if (isset($nombre)&&isset($iniciales)&&isset($liga)&&isset($ciudad)&&isset($tiene_liga)
            &&isset($fecha_fundacion)&&isset($numero_jugadores)){   ?>
                <h2><?php echo $nombre ?></h2>
                <h2><?php echo $iniciales ?></h2>
                <h2><?php echo $liga ?></h2>
                <h2><?php echo $ciudad ?></h2>
                <h2><?php echo $tiene_liga ?></h2>
                <h2><?php echo $fecha_fundacion ?></h2>
                <h2><?php echo $numero_jugadores ?></h2>
        <?php   }  ?>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>