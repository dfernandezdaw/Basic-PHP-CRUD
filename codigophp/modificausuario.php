<?php
require("conecta.php");

if(isset($_POST['nombre'])) {
    // recupera los datos del formulario
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $dni = $_POST["dni"];

    // asocia valores a esos nombres
    $datos = array("id" => $id,
                   "nombre" => $nombre,
                   "apellidos" => $apellidos,
                   "dni" => $dni
                  );

    $sql = "UPDATE usuarios set nombre=:nombre, apellidos=:apellidos, dni=:dni WHERE id=:id";

    $stmt = $conn->prepare($sql);
    // ejecuta la sentencia usando los valores
    if($stmt->execute($datos) != 1) {
        session_start();
        $_SESSION["mensaje"] = "No se pudo actualizar usuario";
        session_write_close();
        header("Location: index.php");
        exit(0);
    }
    session_start();
    $_SESSION["mensaje"] = "Usuario actualizado correctamente";
    session_write_close();
    header("Location: index.php");
    exit(0);
}

if(!isset($_GET["id"])) {
    session_start();
    $_SESSION["mensaje"] = "Sin id no hay nada que hacer";
    session_write_close();
    header("Location: index.php");
    exit(0);
}

// prepara la sentencia SQL. Le doy un nombre a cada dato del formulario 
$sql = "SELECT * FROM usuarios WHERE id=:id";
// asocia valores a esos nombres
$datos = array("id" => $_GET['id']);
// comprueba que la sentencia SQL preparada está bien 
$stmt = $conn->prepare($sql);
$stmt->execute($datos);
$usuario = $stmt->fetch();
if(!$usuario) {
    session_start();
    $_SESSION["mensaje"] = "Lo siento, pero no hay usuario con ese id";
    session_write_close();
    header("Location: index.php");
    exit(0);
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
    <title>Actualiza Usuario</title>
</head>
<body>
<nav class="navbar navbar-light bg-light justify-content-between px-3">
        <a href="#" class="navbar-brand">
            <img src="fotos/logo.svg" alt="Logo" width="30" height="30" class="d-inline-block align-top">
            Cat & Dog 
        </a>
        <div class="">
            <a href="salir.php"><i class="fa-solid fa-power-off logout"></i></a>
        </div>
</nav>
<div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h4>Actualiza usuario</h4>    
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <label for="nombre" class="form-label">Nombre: </label>
                    <input type="text" class="form-control mb-3" name="nombre" id="nombre" value="<?=$usuario["nombre"]?>">
                    <label for="edad" class="form-label">Apellidos: </label>
                    <input type="text" class="form-control mb-3" name="apellidos" id="apellidos" value="<?=$usuario["apellidos"]?>">
                    <label for="dni" class="form-label">DNI: </label>
                    <input type="text" class="form-control mb-3" name="dni" id="dni" value="<?=$usuario["dni"]?>">
                    <input type="text" class="form-control mb-3" name="id" id="id" value="<?=$usuario["id"]?>" hidden>
                    <div class="d-flex justify-content-center mt-3">
                        <button type="submit" name="actualizar" class="btn btn-primary">Actualizar usuario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>