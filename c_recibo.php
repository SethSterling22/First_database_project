<?php
    // Establecer la conexión a la base de datos
    include("connection/conn.php");

    // Procesamiento de los datos del formulario
    $barcode = $_POST['BARCODE'];

    // Consulta SQL para actualizar el estado de la computadora
    $consulta = "DELETE FROM Prestamo WHERE BARCODE = '$barcode'";

    // Ejecución de la consulta
    $resultado = mysqli_query($conexion, $consulta);

    // Verificación del resultado
    if ($resultado) {
        echo "La computadora ha sido recibida correctamente.";
    } else {
        echo "Ha ocurrido un error al recibir la computadora.";
    }

    // Cierre de la conexión
    mysqli_close($conexion);
?>