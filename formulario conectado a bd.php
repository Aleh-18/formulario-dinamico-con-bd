<?php
  include 'config.php'; // conexión con mysql

  
  // Consulta para obtener los datos del select
  $sqlSelect = "SELECT idDato, dato FROM SelectValues";
  $resultadoSelect = $conexion->query($sqlSelect);

  // Consulta para obtener los valores de los checkboxes
  $sqlCheckbox = "SELECT idCheckbox, valor FROM CheckboxValues";
  $resultadoCheckbox = $conexion->query($sqlCheckbox);

  // Comprobar si dan error las consultas
  if (!$resultadoCheckbox) {
    echo "Error en la consulta: " . $conexion->error;
  }

  if (!$resultadoSelect) {
      echo "Error en la consulta: " . $conexion->error;
  }
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="estiloformulario.css">
    <title>Formulario Dinámico con BD</title>
  </head>
  <body>
    <form class="boletin" method="post" action="enviar.php">
      <h3>Suscríbete para enterarte de nuevas novedades</h3>

      <p>Nombre:</p>
      <input type="text" id="nombre" name="nombre" placeholder="Tu nombre">

      <p>Apellidos:</p>
      <input type="text" id="apellidos" name="apellidos" placeholder="Tus apellidos">

      <p>Correo electrónico:</p>
      <input type="email" id="correo" name="correo" placeholder="Tu correo">

      <p>Contraseña:</p>
      <input type="password" placeholder="contraseña" name="pw">

      <div>¿Qué te impactó más?</div>
      <div class="opciones">
        <p><input type="radio" name="impacto" value="El oso polar">El oso polar</p>
        <p><input type="radio" name="impacto" value="Biodiversidad">Biodiversidad</p>
        <p><input type="radio" name="impacto" value="Soluciones">Soluciones</p>
        <p><input type="radio" name="impacto" value="Problemas agricolas">Problemas agricolas</p>
      </div>

      <div>Tema de interés</div>
      <select name="intereses" id="intereses">
        <?php
          // Recorremos los resultados recogidos con la consulta anterior
          if ($resultadoSelect && $resultadoSelect->num_rows > 0) {
              while ($fila = $resultadoSelect->fetch_array()) {
                  $valor = $fila['idDato'];
                  $texto = $fila['dato'];
                  echo "<option value='$valor'>$texto</option>";
              }
              $resultadoSelect->free();
          }
        ?>
      </select>

      <span>Acciones que has realizado para combatir el cambio climático:</span>
      <div class="acciones">
      <?php
        if ($resultadoCheckbox && $resultadoCheckbox->num_rows > 0) {
          while ($fila = $resultadoCheckbox->fetch_array()) {
            $id = $fila['idCheckbox'];
            $texto = $fila['valor'];
            echo "<p><input type='checkbox' name='acciones[]' value='$id'> $texto</p>";
          }
          $resultadoCheckbox->free();
        }
      ?>
      </div>

      <div>Sugerencias:</div>
      <input type="text" name="sugerencias" placeholder="Escribe aquí tu sugerencia">

      <div class="condiciones-p">
        <input type="checkbox" name="condiciones" value="acepto" id="condiciones">
        <p style="margin:0;">Acepto los términos y condiciones</p>
      </div>

      <div class="botones">
        <button type="submit" class="enviar">Enviar</button>
        <button type="reset" class="reset">Borrar todo</button>
      </div>
    </form>

  <?php
    // cerramos la conexión al final
    $conexion->close();
  ?>
  </body>
</html>
