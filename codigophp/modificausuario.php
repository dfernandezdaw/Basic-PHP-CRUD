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
    <title>Document</title>
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" id="nombre" value="<?=$usuario["nombre"]?>">
        <label for="edad">Apellidos: </label>
        <input type="text" name="apellidos" id="apellidos" value="<?=$usuario["apellidos"]?>">
        <label for="dni">DNI: </label>
        <input type="text" name="dni" id="dni" value="<?=$usuario["dni"]?>">
        <input type="text" name="id" id="id" value="<?=$usuario["id"]?>" hidden>
        <input type="submit" name="actualizar" value="Actualizar Usuario"></input>
    </form>
</body>
</html>