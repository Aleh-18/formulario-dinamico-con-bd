<?php
  include 'config.php'; // conexión con mysql

  // Consulta para obtener los datos del select
  $sql = "SELECT dato FROM SelectValues";
  $resultado = $conexion->query($sql);

  // Comprobar si da error la consulta
  if (!$resultado) {
      echo "Error en la consulta: " . $conexion->error;
  } else {
      $opciones = $resultado;
  }

  // Recorremos los resultados recogidos con la consulta anterior
  if ($opciones && $opciones->num_rows > 0) {
    $fila = $opciones->fetch_assoc();
    foreach ($fila as $indice => $valor) {
            echo "Índice: " . $indice . " - Valor: " . $valor . "<br>";
    }
  }

    // cerramos la conexión
    $conexion->close();
?>