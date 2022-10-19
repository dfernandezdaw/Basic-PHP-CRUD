<?php
    session_start();
include "conecta.php";

if(isset($_GET["id"])){
    $id = $_GET["id"];

    //$sql = $conn->query("SELECT * FROM usuarios WHERE id = $id");
    $sql = "SELECT * FROM usuarios WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $_GET["id"]);
    $stmt->execute();
    $usuario = $stmt->fetch();
    //print_r($usuario);
    print_r("<br>");
    ?>
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

    <?php
} else{
    print_r("Error. No se ha proporcionado un ID");
    exit(0);
}

if(isset($_POST["actualizar"])){
    $sql = "UPDATE usuarios SET nombre=:nombre, apellidos=:apellidos, dni=:dni WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt -> bindParam(":nombre", $_POST["nombre"]);
    $stmt -> bindParam(":apellidos", $_POST["apellidos"]);
    $stmt -> bindParam(":dni", $_POST["dni"]);
    $stmt -> bindParam(":id", $_POST["id"]);

    if($stmt->execute()){
        $_SESSION["mensaje"] = "Usuario actualizado correctamente";
        header("Location: index.php");
    }else{
        $_SESSION["mensaje"] = "Error al actualizar el usuario";
        header("Location: index.php");
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica Usuario</title>
</head>
<body>
<!--     <form action="" method="post" enctype="multipart/form-data">
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" id="nombre">
        <label for="edad">Apellidos: </label>
        <input type="text" name="apellidos" id="apellidos">
        <label for="dni">DNI: </label>
        <input type="text" name="dni" id="dni">
        <button type="submit" name="enviar">Enviar</button>
    </form> -->
</body>
</html>