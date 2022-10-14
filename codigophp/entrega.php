<!-- <?php
if(isset($_POST["nombre"])){
    print_r($_POST);
    print_r($_FILES);
    file_put_contents("subida", file_get_contents($_FILES["foto"]["tmp_name"]));
    ?>
    <br><img src="/fotos/subida" alt=""><br>
    <?php
    exit(0);
}
?> -->

<?php
$servidor="db"; //Nombre del contenedor en Docker-Compose
$usuario="protectora";
$clave= "aitortilla";
$bd="protectora";
try {
    // mysql es el gestor de Base de datos
    $conn = new PDO("mysql:host=$servidor;dbname=$bd", $usuario, $clave);
    // Establece los atributos de los reportes de errores
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión satisfactoria";
} catch(PDOException $e) {
    echo ( "Error de conexión: " . $e->getMessage());
    exit(0);
}

//$usuarios = $conn->query("INSERT into usuarios (nombre, apellidos, dni)");

if(isset($_POST["nombre"])){
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $dni = $_POST["dni"];

    if($nombre != "" || $apellidos != "" || $dni != ""){
        $query = "INSERT INTO usuarios(nombre, apellidos, dni) VALUES ($nombre, $apellidos, $dni)";
        $conn->exec($query);
        print_r("Datos añadidos correctamente");
    }else{
        print_r("Datos no añadidos");
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
        <button type="submit" name="enviar">Enviar</button>
    </form>
</body>
</html>