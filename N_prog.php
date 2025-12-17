<?php
// Establecer la conexión a la base de datos
$servername = "localhost";
$username = "Sist_Res_BIBE";
$password = "QwsQk9Q^x+S4";
$dbname = "Sist_Res_BIBE";

$conexion = mysqli_connect($servername, $username, $password, $dbname);
mysqli_set_charset($conexion, "utf8"); // Añadir tildes

// Procesamiento de los datos del formulario
$nombre = $_POST['NOMBRE'];
$id_computadora = $_POST['ID'];
$tipo_computadora = $_POST['TIPO'];

// Verificación del tipo de computadora y modificación del campo correspondiente
if ($tipo_computadora == "FAE") {
    $tabla_computadora = "Comp_FAE";
    $campo_computadora = "BARCODE";
    $valor_computadora = $id_computadora;
} else {
    $tabla_computadora = "Comp_SIST";
    $campo_computadora = "Num_Prop";
    $valor_computadora = $id_computadora;
}

// Consulta SQL para verificar si la computadora existe en la tabla correspondiente
$consulta_computadora_existente = "SELECT $campo_computadora FROM $tabla_computadora WHERE $campo_computadora='$valor_computadora'";

// Ejecución de la consulta para verificar sila computadora ya existe
$resultado_computadora_existente = mysqli_query($conexion, $consulta_computadora_existente);

if (mysqli_num_rows($resultado_computadora_existente) == 0) {
    // La computadora no existe, se debe mostrar un mensaje de error y terminar la ejecución del script
    echo "La computadora no existe en la tabla correspondiente.";
    exit();
}

// Consulta SQL para verificar si el programa ya existe en la tabla de programas
$consulta_prog_existente = "SELECT ID_P FROM Programas WHERE NOMBRE='$nombre'";

// Ejecución de la consulta para verificar si el programa ya existe
$resultado_prog_existente = mysqli_query($conexion, $consulta_prog_existente);

if (mysqli_num_rows($resultado_prog_existente) > 0) {
    // El programa ya existe, se debe actualizar su información
    $fila_prog = mysqli_fetch_assoc($resultado_prog_existente);
    $id_p = $fila_prog['ID_P'];

    // Consulta SQL para actualizar la información del programa
    $consulta_prog = "UPDATE Programas SET Costo_licencia=10.0, Fecha_ven_lic='2024-12-31' WHERE ID_P='$id_p'";

    // Ejecución de la consulta para actualizar la información del programa
    $resultado_prog = mysqli_query($conexion, $consulta_prog);
} else {
    // El programano existe, se debe insertar una nueva fila en la tabla
    // Consulta SQL para insertar el programa en la tabla de programas
    $consulta_prog = "INSERT INTO Programas (NOMBRE, Costo_licencia, Fecha_ven_lic) VALUES ('$nombre', 10.0, '2024-12-31')";

    // Ejecución de la consulta para insertar el programa
    $resultado_prog = mysqli_query($conexion, $consulta_prog);

    // Consulta SQL para obtener el ID del programa recién insertado
    $consulta_id_p = "SELECT ID_P FROM Programas ORDER BY ID_P DESC LIMIT 1";

    // Ejecución de la consulta para obtener el ID del programa
    $resultado_id_p = mysqli_query($conexion, $consulta_id_p);
    $fila_id_p = mysqli_fetch_assoc($resultado_id_p);
    $id_p = $fila_id_p['ID_P'];
}

// Consulta SQL para verificar si la relación entre el programa y la computadora ya existe
$consulta_relacion_existente = "SELECT ID_P FROM Tiene WHERE $campo_computadora='$valor_computadora' AND ID_P='$id_p'";

// Ejecución de la consulta para verificar si la relación ya existe
$resultado_relacion_existente = mysqli_query($conexion, $consulta_relacion_existente);

if (mysqli_num_rows($resultado_relacion_existente) > 0) {
    // La relación ya existe, se debe actualizar
    // Consulta SQL para actualizar la relación entre el programa y la computadora correspondiente
    $consulta_tiene = "UPDATE Tiene SET $campo_computadora='$valor_computadora' WHERE ID_P='$id_p'";
} else {
    // La relación no existe, se debe insertar una nueva fila en la tabla de relación
    // Consulta SQL para insertar la relación entre el programa y la computadora correspondiente
    $consulta_tiene = "INSERT INTO Tiene (ID_P, $campo_computadora) VALUES ('$id_p', '$valor_computadora')";
}

// Ejecución de la consulta para insertar o actualizar la relación entre el programa y la computadora
$resultado_tiene = mysqli_query($conexion, $consulta_tiene);

// Verificación de los resultados
if ($resultado_prog && $resultado_tiene) {
    echo "El programa y la relación han sido agregados o actualizados correctamente.";
} else {
    echo "Ha ocurrido un error al agregar o actualizar el programa o la relación.";
}

// Cierre de la conexión
mysqli_close($conexion);
?>