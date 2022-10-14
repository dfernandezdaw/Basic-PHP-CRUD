<?php
if(isset($_GET["id"])){

    include "conecta.php";

    $sql = "DELETE FROM usuarios WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt -> bindParam(":id", $_GET["id"]);

    if($stmt->execute()){
        print_r("Usuario borrado correctamente");
    }else{
        print_r("Error en el borrado del usuario");
    }
}

