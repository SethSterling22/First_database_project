<?php

// Establecer la conexión a la base de datos
include("connection/conn.php");

// Recibir los datos del formulario
$tipoUsuario = $_POST['Tipo_Usuario'];
$nombre = $_POST['Nombre'];
$apellido = $_POST['Apellido'];
$celNum = $_POST['Cel_Num'];
$idEstudiante = $_POST['ID_E'];

// Verificar la conexión
if (!$conexion) {
  die("Connection failed: " . mysqli_connect_error());
}

// Eliminar el usuario de la tabla correspondiente
if ($tipoUsuario === 'Estudiante') {
  $sql = "DELETE FROM Estudiante WHERE ID_E='$idEstudiante'";
} else {
  $sql = "DELETE FROM Profesor WHERE Nombre='$nombre' AND Apellido='$apellido' AND Cel_Num='$celNum'";
}

if (mysqli_query($conexion, $sql)) {
  echo "El usuario ha sido eliminado correctamente.";
} else {
  echo "Error al eliminar el usuario: " . mysqli_error($conexion);
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>