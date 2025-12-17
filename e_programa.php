<?php

// Establecer la conexión a la base de datos
include("connection/conn.php");

// Recibir los datos del formulario
$nombrePrograma = $_POST['NOMBRE'];
$idPrograma = $_POST['ID'];
$tipoComputadora = $_POST['TIPO'];

// Verificar la conexión
if (!$conexion) {
  die("Connection failed: " . mysqli_connect_error());
}

// Eliminar el programa de la tabla Programas
$sql = "DELETE FROM Programas WHERE ID_P='$idPrograma' AND NOMBRE='$nombrePrograma'";

if (!mysqli_query($conexion, $sql)) {
  echo "Error al eliminar el programa: " . mysqli_error($conexion);
}

// Eliminar la relación del programa con la computadora correspondiente
if ($tipoComputadora === 'FAE') {
  $sql = "DELETE FROM Tiene WHERE ID_P='$idPrograma' AND BARCODE_F IN (SELECT BARCODE FROM Comp_FAE)";
  if (!mysqli_query($conexion, $sql)) {
    echo "Error al eliminar la relación del programa con la computadora FAE: " . mysqli_error($conexion);
  }
} else {
  $sql = "DELETE FROM Tiene WHERE ID_P='$idPrograma' AND Num_Prop_S IN (SELECT Num_Prop FROM Comp_SIST)";
  if (!mysqli_query($conexion, $sql)) {
    echo "Error al eliminar la relación del programa con la computadora SIST: " . mysqli_error($conexion);
  }
}

echo "El programa y su relación han sido eliminados correctamente.";

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>