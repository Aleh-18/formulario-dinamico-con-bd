<?php
    include 'config.php'; 


    // Crear la tabla 
    $sql_crear = "
    CREATE TABLE SelectValues (
        dato VARCHAR(255)
    )";
    $resultado = $conexion->query($sql_crear);

    if ($resultado) {
        echo "Tabla 'SelectValues' creada correctamente.<br><br>";
    } else {
        echo "Error al crear la tabla.<br>";
    }

    // Insertar datos en la tabla
    $acciones = [
        "El oso polar",
        "Biodiversidad",
        "Soluciones",
        "Datos"
    ];

    foreach ($acciones as $accion) {
        $sql_insertar = "INSERT INTO SelectValues (dato) VALUES ('$accion')";
        $resultado = $conexion->query($sql_insertar);

        if ($conexion->affected_rows) {
            echo "Insertado: $accion<br>";
        } else {
            echo "Error al insertar: $accion<br>";
        }
    }

    $conexion->close();
?>