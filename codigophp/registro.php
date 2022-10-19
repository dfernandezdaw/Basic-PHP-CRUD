<?php
if(isset($_POST["nombre"])){
    $servidor="db"; //Nombre del contenedor en Docker-Compose
    $usuario="protectora";
    $clave= "aitortilla";
    $bd="protectora";
    try {
        // mysql es el gestor de Base de datos
        $conn = new PDO("mysql:host=$servidor;dbname=$bd", $usuario, $clave);
        // Establece los atributos de los reportes de errores
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Conexión satisfactoria";
    } catch(PDOException $e) {
        echo ( "Error de conexión: " . $e->getMessage());
        exit(0);
    }

    $sql = "INSERT INTO usuarios(nombre, apellidos, dni, usuario, password) VALUES (:nombre, :apellidos, :dni, :usuario, :password)";
    $stmt = $conn->prepare($sql);
    $stmt -> bindParam(":nombre", $_POST["nombre"]);
    $stmt -> bindParam(":apellidos", $_POST["apellidos"]);
    $stmt -> bindParam(":dni", $_POST["dni"]);
    $stmt -> bindParam(":usuario", $_POST["usuario"]);
    $stmt -> bindParam(":password", $_POST["password"]);

    if($stmt->execute()){
        print_r("Usuario añadido correctamente");
    }else{
        print_r("Error en el alta de usuario");
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta Usuario</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" id="nombre">
        <label for="edad">Apellidos: </label>
        <input type="text" name="apellidos" id="apellidos">
        <label for="dni">DNI: </label>
        <input type="text" name="dni" id="dni">
        <label for="usuario">Usuario: </label>
        <input type="text" name="usuario" id="usuario">
        <label for="password">Contraseña: </label>
        <input type="text" name="password" id="password">
        <button type="submit" name="enviar">Enviar</button>
    </form>
</body>
</html>