<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formularios</title>
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
    <!-- PHP -->
        <?php 
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                // VARIABLES
                $tmp_dni = $_POST["dni"];
                $tmp_correo = $_POST["correo"];
                $tmp_usuario = $_POST["usuario"];
                $tmp_nombre = $_POST["nombre"];
                $tmp_apellidos = $_POST["apellidos"];
                $tmp_fecha = $_POST["fecha"];

                // DNI
                if ($tmp_dni == ""){
                    $err_dni = "El DNI no puede estar vacío.";
                }
                else {
                    $tmp_dni = strtoupper($tmp_dni); // pasamos a mayuscula 
                    $patron = "/^[0-9]{8}[A-Z]$/";

                    if (!preg_match($patron, $tmp_dni)){    // si no se cumple el patron
                        $err_dni = "Se ha ingresado un formato de DNI inválido.";
                    }
                    else {  // si todo va bien, dividimos el DNI en numeros y letras
                        $numeros_dni = (int)substr($tmp_dni, 0, 8); // lo castemos para hacerlo num
                        $letra_dni = substr($tmp_dni, 8, 1);

                        $letra_correcta = match($numeros_dni % 23){
                            1 => "R",
                            2 => "W",
                            3 => "A",
                            4 => "G",
                            5 => "M",
                            6 => "Y",
                            7 => "F",
                            8 => "P",
                            9 => "D",
                            10 => "X",
                            11 => "B",
                            12 => "N",
                            13 => "J",
                            14 => "Z",
                            15 => "S",
                            16 => "Q",
                            17 => "V",
                            18 => "H",
                            19 => "L",
                            20 => "C",
                            21 => "K",
                            22 => "E"     
                        };
                        // si no coincide la verificacion de letra..
                        if ($letra_dni != $letra_correcta){
                            $err_dni = "La letra indicada del DNI es incorrecta.";
                        }
                        else{
                            $dni = $tmp_dni;
                        }
                    }
                }

                // CORREO ELECTRÓNICO
                if ($tmp_correo == ""){
                    $err_correo = "El correo electrónico es un campo necesario.";
                }
                else {
                    $patron = "/^[a-zA-Z0-9_\-.+]+@([a-zA-Z0-9-]+.)+[a-zA-Z]+$/";
                    
                    if (!preg_match($patron, $tmp_correo)){
                        $err_correo = "El correo tiene un formato inválido";
                    }
                    else {
                        $palabras_baneadas = ["caca", "culo", "pedo"];
                        $palabras_encontradas = "";

                        foreach ($palabras_baneadas as $palabra_baneada){
                            if (str_contains($tmp_correo, $palabra_baneada)){   // revisa bien las letras que pones
                                $palabras_encontradas = $palabras_encontradas . " $palabra_baneada ";
                            }
                            if ($palabras_encontradas != ""){
                                $err_correo = "No se permiten palabras malsonantes. Se encontró: ". $palabras_encontradas;
                            }
                            else {
                                $correo = $tmp_correo;
                            }
                        }
                    }
                }

                // USUARIO
                if ($tmp_usuario == ""){
                    $err_usuario = "El usuario es un campo onligatorio";
                }
                else {
                    $patron = "/^[a-zA-Z0-9_]{4,12}$/";

                    if (!preg_match($patron, $tmp_usuario)){
                        $err_usuario = "El usuario debe de tener entre 4 y 12 letras, números o barra baja";
                    }
                    else {
                        $usuario = $tmp_usuario;
                    }
                }

                // NOMBRE
                if ($tmp_nombre == ""){
                    $err_nombre = "El nombre no puede quedar vacío";
                }
                if(strlen($tmp_nombre) < 2 || strlen($tmp_nombre) > 40) {
                    $err_nombre = "El nombre debe tener entre 2 y 40 caracteres";
                }
                else {
                    $patron = "/^[a-zA-Z áéióúÁÉÍÓÚñÑüÜ]+$/";   // el +   sino no funciona

                    if (!preg_match($patron, $tmp_nombre)){
                        $err_nombre = "El nombre no cumple el formato requerido";
                    }
                    else {
                        $primeraLetra = strtoupper(substr($tmp_nombre, 0, 1));
                        $longitud = strlen($tmp_nombre)-1;
                        $letrasRestantes = substr($tmp_nombre, 1, $longitud);
            
                        $nombre = $primeraLetra . $letrasRestantes;

                        $err_nombre = $nombre;
                    }
                }

                // APELLIDOS
                if ($tmp_apellidos == ""){
                    $err_apellidos = "Los apellidos no puede quedar vacío";
                }
                if(strlen($tmp_apellidos) < 2 || strlen($tmp_apellidos) > 40) {
                    $err_apellidos = "El nombre debe tener entre 2 y 40 caracteres";
                }
                else {
                    $patron = "/^[a-zA-Z áéióúÁÉÍÓÚñÑüÜ]+$/";   // el +   sino no funciona

                    if (!preg_match($patron, $tmp_apellidos)){
                        $err_apellidos = "Los apellidos no cumple el formato requerido";
                    }
                    else {
                        $primeraLetra = strtoupper(substr($tmp_apellidos, 0, 1));
                        $longitud = strlen($tmp_apellidos)-1;
                        $letrasRestantes = substr($tmp_apellidos, 1, $longitud);
            
                        $apellidos = $primeraLetra . $letrasRestantes;

                        $err_apellidos = $apellidos;
                    }
                }
            }
        ?>


    <!-- FORMULARIOS -->
        <h2>Formulario usuario</h2>
        <form class="col-4" action="" method="post">
            <!-- DNI -->
            <div class="mb-3">
                <label class="form-label">DNI</label>
                <input class="form-control" type="text" name="dni">
                <?php if (isset($err_dni)) echo "<span class='error'>$err_dni</span>" ?>
            </div>
            <!-- Correo -->
            <div class="mb-3">
                <label class="form-label">Correo electrónico</label>
                <input class="form-control" type="text" name="correo">
                <?php if (isset($err_correo)) echo "<span class='error'>$err_correo</span" ?>
            </div>
            <!-- Usuario -->
            <div class="mb-3">
                <label class="form-label">Usuario</label>
                <input class="form-control" type="text" name="usuario">
                <?php if (isset($err_usuario)) echo "<span class='error'>$err_usuario</span" ?>
            </div>
            <!-- Nombre -->
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input class="form-contorl" type="text" name="nombre">
                <?php if (isset($err_nombre)) echo "<span class='error'>$err_nombre</span>" ?>
            </div>
            <!-- Apellidos -->
            <div class="mb-3">
                <label class="form-label">Apellidos</label>
                <input class="form-contorl" type="text" name="apellidos">
                <?php if (isset($err_apellidos)) echo "<span class='error'>$err_apellidos</span>" ?>
            </div>
            <!-- Fecha de nacimiento -->
            <div class="mb-3">
                <label class="form-label">Fecha de nacimiento</label>
                <input class="form-contorl" type="date" name="fecha">
                <?php if (isset($err_fecha)) echo "<span class='error'>$err_fecha</span>" ?>
            </div>
            <!-- SUBMIT -->
            <div class="mb-3">
                    <input class="btn btn-primary" type="submit" value="Enviar">
            </div>
        </form>
        <?php // SI ESTA TODO CORRECTO LO SACAMOS POR PANTALLA
        if (isset($dni) && isset($correo) && isset($usuario) && isset($nombre) && isset($apellidos) && isset($fecha)){ ?>
            <h1><?php echo $dni ?></h1>
            <h1><?php echo $correo ?></h1>
            <h1><?php echo $usuario ?></h1>
            <h1><?php echo $nombre ?></h1>
            <h1><?php echo $apellidos ?></h1>
            <h1><?php echo $fecha ?></h1>
        <?php } ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>