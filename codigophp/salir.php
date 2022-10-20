<?php
//Destruye la sesión y desloguea al usuario
session_start();
session_destroy();
header("Location: login.php");
?>