<?php
include("conecta.php");
session_start();

if(isset($_POST["usuario"])){
    $usuario = $_POST["usuario"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM usuarios WHERE usuario = :usuario && password = :password";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":usuario", $usuario);
    $stmt->bindParam(":password", $password);
    $stmt->execute();

    $data = $stmt->fetch();

    if($data){
        //Guardamos en un sesión el usuario para mantener la sesión iniciada y el nombre para poder mostrarlo posteriormente en el navbar
        $_SESSION["usuario"] = $data["usuario"];
        $_SESSION["nombre"] = $data["nombre"];
        header("Location: index.php");
    }else{
        $_SESSION["mensaje"] = "Usuario o contraseña inválido";
        header("Location: login.php");
        exit(0);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="apple-touch-icon" sizes="180x180" href="fotos/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="fotos/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="fotos/favicon-16x16.png">
    <link rel="manifest" href="fotos/site.webmanifest">
    <title>Login PHP</title>
</head>
<body>
    <nav class="navbar navbar-light bg-light justify-content-between px-3">
        <a href="#" class="navbar-brand">
            <img src="fotos/logo.svg" alt="Logo" width="30" height="30" class="d-inline-block align-top">
            Cat & Dog 
        </a>
        <div>
            <a href="registro.php"><button class="btn btn-primary">Registrarse</button></a>
        </div>
    </nav>
    <div class="container mt-5">
        <?php include("mensaje.php");?> <!-- Muestra un mensaje formateado con un alert de Bootstrap -->
        <div class="card">
            <div class="card-header">
                <h4>Iniciar sesión</h4>    
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <input type="text" name="usuario" id="usuario" placeholder="Usuario" class="form-control mb-3">
                    <input type="password" name="password" id="password" placeholder="Contraseña" class="form-control mb-3">
                    <!-- Bootstrap Flexbox -->
                    <div class="d-flex justify-content-center">
                    <button class="btn btn-primary" type="submit" name="enviar">Iniciar sesión</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<!-- Import del JS de Bootstrap para poder cerrar los mensajes de alerta -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
</html>