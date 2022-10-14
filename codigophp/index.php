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
    //echo "Conexión satisfactoria";
} catch(PDOException $e) {
    echo ( "Error de conexión: " . $e->getMessage());
    exit(0);
}

print("<h1>Usuarios de la protectora</h1>");

$usuarios = $conn->query("SELECT * FROM usuarios");
/* while($usuario = $usuarios->fetchObject()){
    print("<p>$usuario->nombre</p>");
    //print("<br>");
} */

//Si en la consulta ya ha habido un fetch, no se vuelve a ejecutar. Solo se imprimen los nombres de usuario, una vez.
$usuarios_asociativo = $usuarios->fetchAll(PDO::FETCH_ASSOC);
foreach($usuarios_asociativo as $user){
    print($user["nombre"]);
    print("<br>");
}

print("<h1>Mascotas sin acoger :( </h1>");

$mascotas = $conn->query("SELECT * FROM `mascotas` WHERE id_usuario IS NULL;");
while($mascota = $mascotas->fetchObject()){
    if($mascota->tipo == "gato"){
        print("<p>$mascota->nombre: $mascota->tipo 🐱</p>");
    }else{
        print("<p>$mascota->nombre: $mascota->tipo 🐶</p>");
    }
    //print("<br>");
}
?>



