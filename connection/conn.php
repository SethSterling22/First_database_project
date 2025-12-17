<?php
    $db_password = "";
    $db_username = "";
    $db_hostname = "";
    $db_database = "Sistema_reserva_BAE";
    try {
    	$conexion = mysqli_connect('db', $db_username, $db_password, $db_database) or $error = 1;
    }
    catch(Exception $ex){
        die("No pude conectar a la base: " . $ex->getMessage());
    }
    mysqli_set_charset($conexion, "utf8");
?>