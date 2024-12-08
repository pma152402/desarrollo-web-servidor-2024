<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1 );    

        require('../util/conexion.php');
    ?>
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $tmp_usuario = $_POST["usuario"];
            $tmp_contrasena = $_POST["contrasena"]; 

            // USUARIO
            if (strlen($tmp_usuario) < 3 || strlen($tmp_usuario) > 15){
                $err_usuario = "El usuario debe de tener entre 3 y 15 carácteres";
            }
            else {
                $patron = "/[0-9a-zA-ZñçáéióúÁÉÍÓÚñÑüÜ]+$/";
                if (!preg_match($patron, $tmp_usuario)){
                    $err_usuario = "El usuario no puede contener espacios ni carácteres especiales";
                }
                else {
                    // Comprobar si se repite
                    $sql = "SELECT * FROM usuarios WHERE usuario = '$tmp_usuario'";
                    $resultado = $_conexion -> query($sql);
                    if ($resultado -> num_rows == 1) {
                        $err_usuario = "El usuario indicado ya existe"; 
                    } 
                    else {
                        $usuario = $tmp_usuario;
                    }
                }
            }

            // CONTRASEÑA
            if (strlen($tmp_contrasena) < 8 || strlen($tmp_contrasena) > 15){
                $err_contrasena = "La contraseña debe de tener entre 3 y 15 carácteres";
            }
            else {
                $patron = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/";  
                if (!preg_match($patron, $tmp_contrasena)){
                    $err_contrasena = "La contraseña debe de tener mayúsculas, minúsculas y números.";
                }
                else {
                    $contrasena_cifrada = password_hash($tmp_contrasena, PASSWORD_DEFAULT);
                }
            }
        }
    ?>

    <div class="container">
        <h1>Registro</h1>
     
        <form class="col-6" action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Usuario:</label>
                <input class="form-control" type="text" name="usuario">
                <?php if(isset($err_usuario)) echo "<span class='error'>$err_usuario</span>" ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Contraseña:</label>
                <input class="form-control" type="password" name="contrasena">
                <?php if(isset($err_contrasena)) echo "<span class='error'>$err_contrasena</span>" ?>
            </div>
            <div class="mb-3">
                <input class="btn btn-primary" type="submit" value="Registrarse">
                <a class="btn btn-secondary" href="../index.php">Volver</a>
                <a class="btn btn-secondary" href="iniciar_sesion.php">Iniciar sesión</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- INSERTAR EN LA BASE DE DATOS -->
    <?php
        if (isset($usuario) && isset($contrasena_cifrada)) {
            $sql = "INSERT INTO usuarios VALUES ('$usuario', '$contrasena_cifrada')";
            $_conexion -> query($sql);

            header("location: iniciar_sesion.php"); 
        }
    ?>

</body>
</html>