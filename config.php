<?php

    $servername = "localhost";
    $username   = "root";
    $password   = ""; // en local normalmente no hay contraseña
    $database   = "selectdatos";

    // Crear conexión
    $conexion = new mysqli($servername, $username, $password, $database);

    // Comprobar conexión
    if ($conexion->connect_error) {
        die("Error al conectar con la base de datos: " . $conexion->connect_error);
    } else {
        echo "Conexión establecida correctamente.<br><br>";
    }
    
?>
