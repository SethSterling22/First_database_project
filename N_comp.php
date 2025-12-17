<?php
   // Establecer la conexión a la base de datos
   include("connection/conn.php");

    // Verificar la conexión
    if (!$conexion) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Procesamiento de los datos del formulario
    $tipo = $_POST['Computadora_type'];
    $num_prop = $_POST['Num_prop'];
    $num = $_POST['Num'];
    $barcode = isset($_POST['Comp_FAE']) ? $_POST['Comp_FAE'] : null;

    // Verificar si la computadoraya existe en la base de datos
    if ($tipo === 'Comp_SIST') {
        $consulta = "SELECT * FROM Comp_SIST WHERE Num_Prop='$num_prop'";
    } else {
        $consulta = "SELECT * FROM Comp_FAE WHERE BARCODE='$barcode'";
    }

    $resultado = mysqli_query($conexion, $consulta);

    if (mysqli_num_rows($resultado) > 0) {
        // La computadora ya existe, actualizar los datos existentes
        if ($tipo === 'Comp_SIST') {
            $consulta = "UPDATE Comp_SIST SET Modelo_S='modelo_sist', Num_S=$num WHERE Num_Prop='$num_prop'";
        } else {
            $consulta = "UPDATE Comp_FAE SET Num_F=$num, Modelo_F='modelo_fae' WHERE BARCODE='$barcode'";
        }
    } else {
        // La computadora es nueva, agregarla a la base de datos
        if ($tipo === 'Comp_SIST') {
            $consulta = "INSERT INTO Comp_SIST (Num_Prop, Modelo_S, Num_S) VALUES ('$num_prop', 'modelo_sist', $num)";
        } else {
            $consulta = "INSERT INTO Comp_FAE (BARCODE, Num_Prop, Num_F, Modelo_F) VALUES ('$barcode', '$num_prop', $num, 'modelo_fae')";
        }
    }

    // Ejecución de la consulta
    $resultado= mysqli_query($conexion, $consulta);

    // Verificación del resultado
    if ($resultado) {
        if (mysqli_affected_rows($conexion) > 0) {
            echo "La información de la computadora ha sido actualizada correctamente.";
        } else {
            echo "La información de la computadora no ha sido actualizada.";
        }
    } else {
        echo "Ha ocurrido un error al actualizar la información de la computadora: " . mysqli_error($conexion);
    }

    // Cierre de la conexión
    mysqli_close($conexion);
?>