<!-- 
VIDEOJUEGOS
--------------------
- titulo = 1-80 caracteres, cualquier caracter
- Plataforma = Nintendo Switch, PS5, PS4, Xbox Series X/S, PC   (radio button)
- fecha de lanzamiento = el videojuego mas antiguo admisible sera del 1 de enero de 1947, y el mas
en el futuro no podra dentro de mas de 5 años (dinamico)
- pegi = 3,7,12,16,18 (select)
- descripcion = 0-255 caracteres, cualquier caracter (campo opcional)
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
            $tmp_plataforma = depurar($_POST["plataforma"]);    // necesita depuracion ??
            $tmp_fecha = depurar($_POST["fecha_lanzamiento"]);  // necesita depuracion ??
            $tmp_pegi = depurar($_POST["pegi"]);                // necesita depuracion ??
            $tmp_descripcion = depurar($_POST["descripcion"]);

            // TITULO


            // PLATAFORMA


            // FECHA


            // PEGI


            // DESCRIPCION
        }



    ?>






    <!-- FORMULARIO -->
    <form class="col-4" action="" method="post">
        <!-- TITULO -->
        <div class="mb-3">
            <label class="form-label"><b><i>Titulo:</i></b></label>
            <input type="text" class="form-control" name="titulo">
        </div> 
        <!-- PLATAFORMA -->
        <div class="mb-3">
            <label class="form-label"><b><i>Plataforma:</i></b></label><br>    
            <input type="radio" name="opcion" value="switch">Nintendo Switch</input><br>
            <input type="radio" name="opcion" value="ps4">Play Station 4</input><br>
            <input type="radio" name="opcion" value="ps5">Play Station 5</input><br>
            <input type="radio" name="opcion" value="xbox">Xbox Series X/S</input><br>
            <input type="radio" name="opcion" value="pc">PC</input>
        </div>
        <!-- FECHA -->
        <div class="mb-3">
            <label class="form-label"><b><i>Fecha de lanzamiento:</i></b></label>
            <input type="date" class="form-control" name="fecha_lanzamiento">
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
        </div>
        <!-- DESCRIPCION -->    
        <div class="mb-3">
            <label class="form-label"><b><i>Descripcion:</i></b></label>
            <textarea class="form-control" name="descripcion" rows="4"></textarea>
        </div>
        <!-- ENVIAR -->
        <div class="mb-3">
            <input type="submit" value="Enviar">
        </div>
    </form> 
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>