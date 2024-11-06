<!-- 
VIDEOJUEGOS
--------------------
- titulo = 1-80 caracteres, cualquier caracter
- Plataforma = Nintendo Switch, PS5, PS4, Xbox Series X/S, PC   (radio button)
- fecha de lanzamiento = el videojuego mas antiguo admisible sera del 1 de enero de 1947, y el mas
en el futuro no podra dentro de mas de 5 años (dinamico)
- pegi = 3,7,12,16,18 (select)
- descripcion = 0-255 caracteres, cualquier caracter (campo opcional)       filter var PARA UN NUMERICO SI O SI
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VIDEOJUEGOS</title>
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
    <h2>Formulario de Videojuegos</h2>
    <!-- PHP -->
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
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $tmp_titulo = depurar($_POST["titulo"]);
            $tmp_plataforma = depurar($_POST["plataforma"]);    
            $tmp_fecha_lanzamiento = depurar($_POST["fecha_lanzamiento"]);  
            $tmp_pegi = depurar($_POST["pegi"]);                
            $tmp_descripcion = depurar($_POST["descripcion"]);


            // TITULO
            if ($tmp_titulo == ""){
                $err_titulo = "El titulo no puede estar vacío.";
            }
            else {
                if (strlen($tmp_titulo) <= 1 || strlen($tmp_titulo) > 80){  // menor a 1 ya es 0
                    $err_titulo = "La longitud del titulo debe de ser de 1 a 80 carácteres.";
                }
                else {
                    $titulo = $tmp_titulo;
                }
            }

            // PLATAFORMA
            if ($tmp_plataforma == ""){
                $err_plataforma = "La plataforma no puede quedar vacía.";
            }
            else{
                $plataforma = $tmp_plataforma;
            }

            // FECHA
            if ($tmp_fecha_lanzamiento == ""){
                $err_fecha_lanzamiento = "La fecha es un campo obligatorio";
            }
            else{
                $annoMinimo = 1947;
                $mesMinimo = 1;
                $diaMinimo = 1;
                $fecha_actual = date("Y-m-d");

                list($anno_actual,$mes_actual,$dia_actual) = explode('-',$fecha_actual);
    
                list($anno,$mes,$dia) = explode('-',$tmp_fecha_lanzamiento);

                // anio minimo 1947
                if ($anno < $annoMinimo){   
                    $err_fecha_lanzamiento = "La fecha de lanzamiento no puede ser inferior a ".$diaMinimo."-".$mesMinimo."-".$annoMinimo;
                }
                // anio tope ahora mismo 2029
                elseif ($anno > ($anno_actual + 5)){
                    $err_fecha_lanzamiento = "OO La fecha de lanzamiento no puede ser superior a ".$dia_actual."-".$mes_actual."-".($anno_actual + 5);
                }
                // si es el mismo anio..
                elseif ($anno == ($anno_actual + 5)){
                    // si el mes es superior
                    if ($mes > $mes_actual){
                        $err_fecha_lanzamiento = "AA La fecha de lanzamiento no puede ser superior a ".$dia_actual."-".$mes_actual."-".($anno_actual + 5);
                    }
                    // si el mes es inferior es valido
                    elseif ($mes < $mes_actual){
                        $fecha_lanzamiento = $tmp_fecha_lanzamiento;
                    }
                    // si es el mismo mes..
                    elseif ($mes == $mes_actual){
                        // si el dia es superior
                        if ($dia > $dia_actual){
                            $err_fecha_lanzamiento = "JJ La fecha de lanzamiento no puede ser superior a ".$dia_actual."-".$mes_actual."-".($anno_actual + 5);
                        }
                        // si el dia es inferior
                        elseif ($dia < $dia_actual){
                            $fecha_lanzamiento = $tmp_fecha_lanzamiento;
                        }
                        // si es el mismo dia (vale)
                        else{
                            $fecha_lanzamiento = $tmp_fecha_lanzamiento;
                        }
                    }
                }
                // si el anio es inferior
                else {
                    $fecha_lanzamiento = $tmp_fecha_lanzamiento;
                }
            }

            // PEGI
            if ($tmp_pegi == ""){
                $err_pegi = "Debes seleccionar una opcion de PEGI";
            }
            else {
                $pegi = $tmp_pegi;
            }


            // DESCRIPCION
        //    if ($tmp_descripcion == ""){
        //        $tmp_descripcion = "La descripción no puede estar vacía.";
        //    }
        //    else {
                if (strlen($tmp_descripcion) > 255){  
                    $err_descripcion = "La longitud de la descripcion no puede ser superior a 250 carácteres";
                }
                else {
                    $descripcion = $tmp_descripcion;
                }
        //    }
        }
    ?>

    <!-- FORMULARIO -->
    <form class="col-4" action="" method="post">
        <!-- TITULO -->
        <div class="mb-3">
            <label class="form-label"><b><i>Titulo:</i></b></label>
            <input type="text" class="form-control" name="titulo">
            <?php if(isset($err_titulo)) echo "<span class='error'>$err_titulo</span>"?>
        </div> 
        <!-- PLATAFORMA -->
        <div class="mb-3">
            <label class="form-label"><b><i>Plataforma:</i></b></label><br>    
            <input type="radio" name="plataforma" value="switch" checked>Nintendo Switch</input><br>
            <input type="radio" name="plataforma" value="ps4">Play Station 4</input><br>
            <input type="radio" name="plataforma" value="ps5">Play Station 5</input><br>
            <input type="radio" name="plataforma" value="xbox">Xbox Series X/S</input><br>
            <input type="radio" name="plataforma" value="pc">PC</input>
            <?php if(isset($err_plataforma)) echo "<span class='error'>$err_plataforma</span>"?>
        </div>
        <!-- FECHA -->
        <div class="mb-3">
            <label class="form-label"><b><i>Fecha de lanzamiento:</i></b></label>
            <input type="date" class="form-control" name="fecha_lanzamiento">
            <?php if(isset($err_fecha_lanzamiento)) echo "<span class='error'>$err_fecha_lanzamiento</span>"?>
        </div>
        <!-- PEGI -->
        <div class="mb-3">
            <label class="form-label"><b><i>PEGI:</i></b></label>
            <select class="form-select" name="pegi">                 <!-- clase? -->
                <option value="3">3</option>
                <option value="7">7</option>
                <option value="12">12</option>
                <option value="16">16</option>
                <option value="18">18</option>
            </select>
            <?php if(isset($err_pegi)) echo "<span class='error'>$err_pegi</span>"?>
        </div>
        <!-- DESCRIPCION -->    
        <div class="mb-3">
            <label class="form-label"><b><i>Descripcion:</i></b></label>
            <textarea class="form-control" name="descripcion" rows="4"></textarea>
            <?php if(isset($err_descripcion)) echo "<span class='error'>$err_descripcion</span>"?>
        </div>
        <!-- ENVIAR -->
        <div class="mb-3">
            <input class="btn btn-primary" type="submit" value="Enviar">
        </div>
    </form> 
    <?php 
        if (isset($titulo)&&isset($plataforma)&&isset($fecha_lanzamiento)&&isset($pegi)&&isset($descripcion)){ ?>
            <h1>Titulo: <?php echo $titulo ?></h1>
            <h1>Plataforma: <?php echo $plataforma ?></h1>
            <h1>Fecha: <?php echo $fecha_lanzamiento ?></h1>
            <h1>PEGI: <?php echo $pegi ?></h1>
            <h1>Descripcion: <?php echo $descripcion ?></h1>
     <?php }?>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>