<?php 
include("testlogin.php");
include("conecta.php");
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
    <title>Usuario y mascotas protectora</title>
</head>
<body>
    <nav class="navbar navbar-light bg-light justify-content-between px-3">
        <a href="#" class="navbar-brand">
            <img src="fotos/logo.svg" alt="Logo" width="30" height="30" class="d-inline-block align-top">
            Cat & Dog 
        </a>
        <div class="">
            <?php
            $nombre = $_SESSION["nombre"];
            print($nombre);
            ?>
            <a href="salir.php"><i class="fa-solid fa-power-off logout"></i></a>
        </div>
    </nav>
    <div class="container pt-3">
        <?php include("mensaje.php");?>
        <div>
            <h4>Usuarios
            <a href="registro.php" class="btn btn-primary float-end mb-2">Añadir Usuario</a>
            </h4>
        </div>
        <table class='table table-light table-striped'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>DNI</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $usuarios = $conn->query("SELECT * FROM usuarios");
                    $usuarios_asociativo = $usuarios->fetchAll(PDO::FETCH_ASSOC);
                    foreach($usuarios_asociativo as $user){
                        print("<tr>");
                        print("<td>");
                        print($user["id"]);
                        print("</td>");
                        print("<td>");
                        print($user["nombre"]);
                        print("</td>");
                        print("<td>");
                        print($user["apellidos"]);
                        print("</td>");
                        print("<td>");
                        print($user["dni"]);
                        print("</td>");
                        print("<td>");
                        print("<a href='modificausuario.php?id=".$user["id"]."'><i class='fa-solid fa-pen-to-square px-1'></i></a>");
                        print("<a href='borrausuario.php?id=".$user["id"]."'><i class='fa-solid fa-trash px-1'></i></a>");
                        print("</td>");
                    }
                 ?>
            </tbody>
        </table>
        <div>
            <h4>Mascotas
            <a href="#" class="btn btn-primary float-end mb-2">Añadir Mascota</a>
            </h4>
        </div>
        <table class='table table-light table-striped'>
            <thead>
                <th>ID</th>
                <th>Nombre</th>
                <th>Raza</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                <?php
                $mascotas = $conn->query("SELECT * FROM `mascotas` WHERE id_usuario IS NULL;");
                $listaMascotas = $mascotas->fetchAll();
                foreach($listaMascotas as $mascota){
                    print("<tr>");
                    print("<td>");
                    print($mascota["id"]);
                    print("</td>");
                    print("<td>");
                    print($mascota["nombre"]);
                    print("</td>");
                    print("<td>");
                    print(ucfirst($mascota["tipo"]));
                    if($mascota["tipo"] == "gato"){
                        print(" 🐱");
                    }else{
                        print(" 🐶");
                    }
                    print("</td>");
                    print("<td>");
                    print("<a href='actualizausuario.php?id=".$mascota["id"]."'><i class='fa-solid fa-pen-to-square px-1'></i></a>");
                    print("<a href='borrasuario.php?id=".$mascota["id"]."'><i class='fa-solid fa-trash px-1'></i></a>");
                    print("</td>");
                } 
                ?>
            </tbody>
        </table>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
</html>

<!-- PHP Antiguo con explicaciones -->
<!-- <?php
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
    print("<div class='container'>");
    print("<table class='table table-dark table-striped'>");
    print("<thead>");
    print("<tr>");
    print("<th>ID</th>");
    print("<th>Nombre</th>");
    print("<th>Apellidos</th>");
    print("<th>DNI</th>");
    print("<th>Acciones</th>");
    print("</tr>");
    print("<tbody>");
    foreach($usuarios_asociativo as $user){
        print("<tr>");
        print("<td>");
        print($user["id"]);
        print("</td>");
        print("<td>");
        print($user["nombre"]);
        print("</td>");
        print("<td>");
        print($user["apellidos"]);
        print("</td>");
        print("<td>");
        print($user["dni"]);
        print("</td>");
        print("<td>");
        print("<a href='actualizausuario.php?id=".$user["id"]."'><i class='fa-solid fa-pen-to-square'></i></a>");
        print("<a href='borrasuario.php?id=".$user["id"]."'><i class='fa-solid fa-trash'></i></a>");
        print("</td>");
    }
    print("</tbody>");
    print("</table>");

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
?> -->