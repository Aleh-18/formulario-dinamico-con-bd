<?php
    include 'config.php';

    $ok = true;

    // Condiciones
    if (!isset($_POST['condiciones'])) {
        echo "<p>Debes aceptar los términos y condiciones para enviar el formulario</p>";
        $ok = false;
    }

    // Nombre
    if (!empty($_POST['nombre'])) {
        $nombre = $_POST['nombre'];
        echo "Nombre recibido: " . $nombre . "<br>";
    } else {
        echo "No se ha recibido ningún nombre.<br>";
        $ok = false;
    }

    // Apellidos
    if (!empty($_POST['apellidos'])) {
        $apellidos = $_POST['apellidos'];
        echo "Apellidos recibidos: " . $apellidos . "<br>";
    } else {
        echo "No se han recibido apellidos.<br>";
        $ok = false;
    }

    // Correo
    if (!empty($_POST['correo'])) {
        $correo = $_POST['correo'];
        echo "Correo recibido: " . $correo . "<br>";

        // comprobar si ya existe ese correo
        $sqlCheck = "SELECT id FROM datosformulario WHERE correo = '$correo' LIMIT 1";
        $resultadoCheck = $conexion->query($sqlCheck);
        if ($resultadoCheck && $resultadoCheck->num_rows > 0) {
            echo "<p>Correo ya registrado</p>";
            $ok = false;
        }
    } else {
        echo "No se ha recibido ningún correo.<br>";
        $ok = false;
    }

    // Contraseña
    if (!empty($_POST['pw'])) {
        $pw = $_POST['pw'];
        echo "Contraseña recibida: " . $pw . "<br>";
    } else {
        echo "No se ha recibido ninguna contraseña.<br>";
        $ok = false;
    }

    // Radio
    if (isset($_POST['impacto'])) {
        $radio = $_POST['impacto'];
        echo "Opción radio recibida: " . $radio . "<br>";
    } else {
        echo "No se ha recibido ninguna opción radio.<br>";
        $ok = false;
    }

    // Select
    if (isset($_POST['intereses'])) {
        $select = $_POST['intereses'];
        echo "Selección recibida: " . $select . "<br>";
    } else {
        echo "No se ha recibido ninguna selección.<br>";
        $ok = false;
    }

    // Sugerencias
    if (!empty($_POST['sugerencias'])) {
        $sugerencias = $_POST['sugerencias'];
        echo "Sugerencias recibidas: " . $sugerencias . "<br>";
    }else{

        echo "No se ha recibido ninguna sugerencia.<br>";
        $ok = false;
    }

    // Checkbox (pueden ser varios)
    $checkboxes = [];
    if (isset($_POST['acciones']) && count($_POST['acciones']) > 0) {
        foreach ($_POST['acciones'] as $accion) {
            $checkboxes[] = $accion;
        }
        echo "Checkbox seleccionados:<br>";
        foreach ($checkboxes as $checkbox) {
            echo "===>$checkbox<br>";
        }
    }else{
        echo "No se ha recibido ningun checkbox.<br>";
        $ok = false;
    }




    // Insertar todo
    if ($ok) {
        $sqlFormulario = "INSERT INTO datosformulario 
                (nombre, apellidos, correo, pw, radio_opcion, seleccionFK, sugerencias) 
                VALUES 
                ('$nombre', '$apellidos', '$correo', '$pw', '$radio', $select, '$sugerencias')";

        if ($conexion->query($sqlFormulario) === TRUE) {
            // Insertar checkboxes
            // Para ello necesitamos saber qué usuario ha seleccionado esos checkboxes
            // Usamos insert_id para mejorar rendimiento
            $idFormulario = $conexion->insert_id;
            foreach ($checkboxes as $idCheckbox) {
                $sqlFrCheck = "INSERT INTO FormularioCheckbox (idFormulario, idCheckbox) VALUES ($idFormulario, $idCheckbox)";
                if ($conexion->query($sqlFrCheck) === FALSE) {
                    echo "<br>Error al insertar checkbox" . $conexion->error;
                }
            }

            echo "<br>Datos del formulario insertados correctamente";

        } else {
            echo "<br>Error al insertar el formulario: " . $conexion->error;
        }
    } else {
        echo "<br>Faltan datos";
    }

    $conexion->close();
?>