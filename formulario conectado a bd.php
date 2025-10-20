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
    <form class="boletin" method="post" action="">
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
          if ($opciones && $opciones->num_rows > 0) {
              while ($fila = $opciones->fetch_array()) {
                  $valor = $fila['dato'];
                  echo "<option value='$valor'>$valor</option>";
              }
              $opciones->free();
          }
        ?>
      </select>

      <span>Acciones que has realizado para combatir el cambio climático:</span>
      <div class="acciones">
        <p><input type="checkbox" name="acciones[]" value="Reciclaje">Reciclaje</p>
        <p><input type="checkbox" name="acciones[]" value="Reducir el uso de plásticos">Reducir el uso de plásticos</p>
        <p><input type="checkbox" name="acciones[]" value="Usar transporte sostenible">Usar transporte sostenible</p>
        <p><input type="checkbox" name="acciones[]" value="Ahorrar energía en casa">Ahorrar energía en casa</p>
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
