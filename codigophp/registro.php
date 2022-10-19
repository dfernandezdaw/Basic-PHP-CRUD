<?php
if(isset($_POST["nombre"])){
    session_start();
    require("conecta.php");

    $sql = "INSERT INTO usuarios(nombre, apellidos, dni, usuario, password) VALUES (:nombre, :apellidos, :dni, :usuario, :password)";
    $stmt = $conn->prepare($sql);
    $stmt -> bindParam(":nombre", $_POST["nombre"]);
    $stmt -> bindParam(":apellidos", $_POST["apellidos"]);
    $stmt -> bindParam(":dni", $_POST["dni"]);
    $stmt -> bindParam(":usuario", $_POST["usuario"]);
    $stmt -> bindParam(":password", $_POST["password"]);

    if($stmt->execute()){
        $_SESSION["mensaje"] = "Se ha dado de alta un nuevo usuario";
        header("Location: login.php");
        exit(0);
    }else{
        $_SESSION["mensaje"] = "Error en el alta del usuario";
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
    <title>Alta Usuario</title>
</head>
<body>
<nav class="navbar navbar-light bg-light justify-content-between px-3">
        <a href="#" class="navbar-brand">
            <img src="fotos/logo.svg" alt="Logo" width="30" height="30" class="d-inline-block align-top">
            Cat & Dog 
        </a>
        <div>
            <a href="login.php"><button class="btn btn-primary">Iniciar sesión</button></a>
        </div>
</nav>
<!-- Bootstrap: container(aplica efectos css para añadir margenes y que todo esté más centrado, no tan pegado a los bordes)
form-control: Efectos para los inputs
form-label: Efectos para los label
card: Efectos tarjeta(Coloca el formulario dentro de un recuadro)
car-header: Título del recuadro
car-body: Contenido del recuadro, en este caso un formulario
-->
<div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h4>Registro usuario</h4>    
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <label for="nombre" class="form-label">Nombre: </label>
                    <input type="text" name="nombre" id="nombre" class="form-control mb-3">
                    <label for="edad" class="form-label">Apellidos: </label>
                    <input type="text" name="apellidos" id="apellidos" class="form-control mb-3">
                    <label for="dni" class="form-label">DNI: </label>
                    <input type="text" name="dni" id="dni" class="form-control mb-3">
                    <label for="usuario" class="form-label">Usuario: </label>
                    <input type="text" name="usuario" id="usuario" class="form-control mb-3">
                    <label for="password" class="form-label">Contraseña: </label>
                    <input type="password" name="password" id="password" class="form-control mb-3">
                    <div class="d-flex justify-content-center mt-3">
                        <button class="btn btn-primary" type="submit" name="enviar">Registrarse</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>