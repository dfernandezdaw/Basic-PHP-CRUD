<?php
if(isset($_GET["id"])){
    session_start();

    include "conecta.php";

    $sql = "DELETE FROM mascotas WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt -> bindParam(":id", $_GET["id"]);

    if($stmt->execute()){
        $_SESSION["mensaje"] = "Mascota borrada correctamente";
        header("Location: index.php");
        exit(0);
    }else{
        $_SESSION["mensaje"] = "Error en el borrado de la mascota";
        header("Location: index.php");
        exit(0);
    }
}

