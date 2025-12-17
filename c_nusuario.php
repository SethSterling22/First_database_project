<?php
 // Establecer la conexión a la base de datos
    include("connection/conn.php");

// Procesamiento de los datos del formulario
$tipoUsuario = $_POST['Tipo_Usuario'];
$nombre = $_POST['Nombre'];
$apellido = $_POST['Apellido'];
$telefono = $_POST['Cel_Num'];

if ($tipoUsuario === 'Estudiante') {
    $numEstudiante = $_POST['ID_E'];

    // Consulta SQL para verificar si el estudiante ya existe en la tabla "Estudiante"
    $consulta_existente = "SELECT * FROM Estudiante WHERE ID_E='$numEstudiante'";

    // Consulta SQL para insertar o actualizar en la tabla "Estudiante"
    $consulta = "INSERT INTO Estudiante (ID_E, Nombre, Apellido, Cel_Num, ID_R)
    VALUES ('$numEstudiante', '$nombre', '$apellido', '$telefono', 'ID_R_DEFAULT')
    ON DUPLICATE KEY UPDATE Nombre='$nombre', Apellido='$apellido', Cel_Num='$telefono'";

} else {
    // Consulta SQL para verificar si el profesor ya existe en la tabla "Profesor"
    $consulta_existente = "SELECT * FROM Profesor WHERE Nombre='$nombre' AND Apellido='$apellido'";

    // Consulta SQL para insertar o actualizar en la tabla "Profesor"
    $consulta = "INSERT INTO Profesor (Nombre, Apellido, Cel_Num, ID_R)
    VALUES ('$nombre', '$apellido', '$telefono', 'ID_R_DEFAULT')
    ON DUPLICATE KEY UPDATE Cel_Num='$telefono'";
}

// Ejecución de la consulta para verificar si el usuario ya existe
$resultado_existente = mysqli_query($conexion, $consulta_existente);

// Verificar si el usuario ya existe
if (mysqli_num_rows($resultado_existente) > 0) {
    // Ejecución de la consulta para actualizar la información del usuario
    $resultado = mysqli_query($conexion, $consulta);
    if ($resultado) {
        echo "La información del usuario ha sido actualizada correctamente.";
    } else {
        echo "Ha ocurrido un error al actualizar la información del usuario.";
    }
} else {
    // Ejecución de la consulta para insertar un nuevo usuario
    $resultado = mysqli_query($conexion, $consulta);
    if ($resultado) {
        echo "El usuario ha sido agregado correctamente.";
    } else {
        echo "Ha ocurrido un error al agregar el usuario.";
    }
}

// Cierre de la conexión
mysqli_close($conexion);
?>