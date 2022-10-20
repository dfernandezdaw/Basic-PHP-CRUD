<?php
require("conecta.php");

if(isset($_POST['nombre'])) {
    // recupera los datos del formulario
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $tipo = $_POST["tipo"];

    // asocia valores a esos nombres
    $datos = array("id" => $id,
                   "nombre" => $nombre,
                   "tipo" => $tipo,
                  );

    $sql = "UPDATE mascotas set nombre=:nombre, tipo=:tipo WHERE id=:id";

    $stmt = $conn->prepare($sql);
    // ejecuta la sentencia usando los valores
    if($stmt->execute($datos) != 1) {
        session_start();
        $_SESSION["mensaje"] = "No se pudo actualizar la mascota";
        session_write_close();
        header("Location: index.php");
        exit(0);
    }
    session_start();
    $_SESSION["mensaje"] = "Mascota actualizada correctamente";
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
$sql = "SELECT * FROM mascotas WHERE id=:id";
// asocia valores a esos nombres
$datos = array("id" => $_GET['id']);
// comprueba que la sentencia SQL preparada está bien 
$stmt = $conn->prepare($sql);
$stmt->execute($datos);
$mascota = $stmt->fetch();
if(!$mascota) {
    session_start();
    $_SESSION["mensaje"] = "Lo siento, pero no hay mascota con ese id";
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
    <link rel="apple-touch-icon" sizes="180x180" href="fotos/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="fotos/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="fotos/favicon-16x16.png">
    <link rel="manifest" href="fotos/site.webmanifest">
    <title>Actualiza Mascota</title>
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
                <h4>Actualiza mascota</h4>    
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <label for="nombre" class="form-label">Nombre: </label>
                    <input type="text" class="form-control mb-3" name="nombre" id="nombre" value="<?=$mascota["nombre"]?>">
                    <label for="edad" class="form-label">Raza: </label>
                    <input type="text" class="form-control mb-3" name="tipo" id="tipo" value="<?=$mascota["tipo"]?>">
                    <input type="text" class="form-control mb-3" name="id" id="id" value="<?=$mascota["id"]?>" hidden>
                    <div class="d-flex justify-content-center mt-3">
                        <button type="submit" name="actualizar" class="btn btn-primary">Actualizar mascota</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>