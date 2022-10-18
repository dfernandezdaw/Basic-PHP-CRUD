<?php

include("conecta.php");

if(isset($_POST["usuario"])){
    session_start();
    $usuario = $_POST["usuario"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM usuarios WHERE usuario = :usuario && password = :password";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":usuario", $usuario);
    $stmt->bindParam(":password", $password);
    $stmt->execute();

    $data = $stmt->fetch();

    if($data){
        $_SESSION["usuario"] = $data["usuario"];
        $_SESSION["nombre"] = $data["nombre"];
        header("Location: index.php");
    }else{
        echo "Usuario o contraseña inválido";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login PHP</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="usuario" id="usuario" placeholder="Usuario">
        <input type="password" name="password" id="password" placeholder="Contraseña">
        <input type="submit" name="enviar" value="Iniciar sesión">
    </form>
</body>
</html>