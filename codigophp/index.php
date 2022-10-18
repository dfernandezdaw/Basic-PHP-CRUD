<?php
session_start();
if(isset($_SESSION["usuario"])){

    include "conecta.php";

    $nombre = $_SESSION["nombre"];

    print("<p>Bienvenido a la protectora <b>$nombre</b></p>");

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
}else{
    header("Location: login.php");
}
?>

<form action="salir.php" method="post">
    <input type="submit" value="Salir">
</form>

