<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1);
        
        require("../util/conexion.php");
        
        // Si al comenzar la sesión no se encuentra al usuario..
        session_start();
        if (isset($_SESSION["usuario"])){
            echo "<h2>Bienvenid@" . $_SESSION["usuario"] . "</h2>";
            //exit;
        } 
        else {
            header("location: ../index.php");
        }
    ?>
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>

    <?php

        $usuario = $_SESSION["usuario"];
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $tmp_actual = $_POST["actual"];
            $tmp_nueva = $_POST["nueva"];
            $tmp_confirmar = $_POST["confirmar"];

            $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
            $resultado = $_conexion -> query($sql);

            while ($fila = $resultado -> fetch_assoc()) {
                $contrasena = $fila["contrasena"];
            }


            $comparar = password_verify($tmp_actual, $contrasena);
            if (!$comparar) {
                $err_actual = "La contraseña no es correcta.";
            } 
            else {
                if ($tmp_nueva == "" || $tmp_confirmar == "") {
                    $err_nueva = "No puede haber campos vacíos.";
                } 
                else {
                    if ($tmp_nueva !== $tmp_confirmar) {
                        $err_nueva = "Las contraseñas no coinciden.";
                    } 
                    else {
                        if (strlen($tmp_nueva) < 8 || strlen($tmp_nueva) > 15) {
                            $err_nueva = "La contraseña debe tener entre 8 y 15 caracteres.";
                        } 
                        else {
                            $patron = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/";
                            if (!preg_match($patron, $tmp_nueva)) {
                                $err_nueva = "La contraseña debe contener como minimo una mayuscula, números y letras.";
                            } 
                            else {
                                $contrasena_cifrada = password_hash($tmp_nueva,PASSWORD_DEFAULT);
                            }
                        }
                    }
                }
            }
        }
    ?>
        <a class="btn btn-info" href="../index.php">Inicio</a>
          
    <div class="container">
        
        <h1>Cambiar contraseña</h1>

        <form class="col-4" action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <input class="form-control" type="text" name="usuario" value="<?php echo "$usuario" ?>" disabled>
                <label class="form-label">Usuario</label>
            </div>

            <div class="mb-3">
                <input class="form-control" type="password" name="actual">
                <label class="form-label">Contraseña actual</label>
                <?php
                    if(isset($err_actual)){
                        echo "<span class='error'>$err_actual</span>";
                    }
                ?>
            </div>
            <br>

            <div class="mb-3">
                <input class="form-control" type="password" name="nueva">
                <label class="form-label">Nueva contraseña</label>
            </div>

            <div class="mb-3">
                <input class="form-control" type="password" name="confirmar">
                <label class="form-label">Confirmar contraseña</label>
                <?php 
                    if(isset($err_nueva)){
                        echo "<span class='error'>$err_nueva</span>";
                    }
                ?>
            </div>

            <div class="custom-button-group">
                <input type="hidden" name="usuario" value="<?php echo $usuario ?>">
                <input class="btn btn-success" type="submit" value="Guardar">
                <a class="btn btn-danger" href="../index.php">Cancelar</a>
            </div>
        </form>
    </div>
    <?php
        if (isset($contrasena_cifrada)) {
            $sql = "UPDATE usuarios SET contrasena = '$contrasena_cifrada' WHERE usuario = '$usuario'";
            $_conexion -> query($sql);
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>