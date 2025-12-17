<?php
// Establecer la conexión a la base de datos
include("connection/conn.php");

// Recibir los datos del formulario y validarlos
$tipoComputadora = isset($_POST['Computadora_type']) ? $_POST['Computadora_type'] : '';
$numPropiedad = isset($_POST['Num_prop']) ? mysqli_real_escape_string($conn, $_POST['Num_prop']) : '';
$barcode = isset($_POST['Comp_FAE']) ? mysqli_real_escape_string($conn, $_POST['Comp_FAE']) : '';

// Verificar la conexión
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Iniciar la transacción
mysqli_autocommit($conn, FALSE);

try {
  // Eliminar los programas relacionados con la computadora
  $sql = "DELETE FROM Tiene WHERE BARCODE='$barcode' OR Num_Prop='$numPropiedad'";
  if (mysqli_query($conn, $sql)) {
    $numRows = mysqli_affected_rows($conn);
    echo "Se han eliminado $numRows programas relacionados con la computadora.";
  } else {
    throw new Exception("Error al eliminar la relación de los programas con la computadora: " . mysqli_error($conn));
  }

  // Eliminar la computadora de la tabla correspondiente
  if ($tipoComputadora === 'Comp_FAE') {
    $sql = "DELETE FROM Comp_FAE WHERE Num_Prop='$numPropiedad' AND BARCODE='$barcode'";
  } else {
    $sql = "DELETE FROM Comp_SIST WHERE Num_Prop='$numPropiedad'"; 
  }

  if (mysqli_query($conn, $sql)) {
    $numRows = mysqli_affected_rows($conn);
    if ($numRows > 0) {
        // Confirmar la transacción
        mysqli_commit($conn);
        echo "La computadora y sus programas relacionados han sido eliminados correctamente.";
    } else {
        throw new Exception("No se encontró ninguna computadora que coincida con los datos proporcionados.");
    }
  } else {
    throw new Exception("Error al eliminar la computadora: " . mysqli_error($conn));
  }
} catch (Exception $e) {
  // En caso de error, deshacer la transacción
  mysqli_rollback($conn);
  echo $e->getMessage();
}
