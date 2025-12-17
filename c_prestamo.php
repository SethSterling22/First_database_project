<?php
  // Establecer la conexión a la base de datos
  include("connection/connection.php");

	if(isset($_POST['Tipo_Usuario']) && isset($_POST['Nombre']) && isset($_POST['Apellido']) && isset($_POST['BARCODE']) && isset($_POST['Fecha_ini']) && isset($_POST['Fecha_fin'])){

  // Obtener los valores de los campos
  $tipoUsuario = $_POST['Tipo_Usuario'];
  $nombre = $_POST['Nombre'];
  $apellido = $_POST['Apellido'];
  $barcode = $_POST['BARCODE'];
  $fechaIni = $_POST['Fecha_ini'];
  $fechaFin = $_POST['Fecha_fin'];

 

  // Verificar si el usuario es un estudiante
  if($tipoUsuario == "Estudiante"){
    if(isset($_POST['Num_Estudiante'])){
      $numEstudiante = $_POST['Num_Estudiante'];

      // Verificar si el estudiante existe en la tabla Estudiante
      $queryEstudiante = "SELECT * FROM Estudiante WHERE ID_E = '$numEstudiante'";
      $resultEstudiante= $conn->query($queryEstudiante);

      if($resultEstudiante->num_rows == 0){
        // Si el estudiante no existe, mostrar un mensaje de error
        echo "El número de estudiante ingresado no existe en la base de datos.";
      } else {
        // Obtener el ID_E del estudiante
        $rowEstudiante = $resultEstudiante->fetch_assoc();
        $idE = $rowEstudiante['ID_E'];

        // Verificar si el libro fue prestado anteriormente
        $queryPrestamo = "SELECT * FROM Prestamo WHERE ID_E = '$idE' AND BARCODE = '$barcode'";
        $resultPrestamo = $conn->query($queryPrestamo);

        if($resultPrestamo->num_rows > 0){
          // Si el libro fue prestado anteriormente, actualizar la fecha de entrega y el estado
          $rowPrestamo = $resultPrestamo->fetch_assoc();
          $idPres = $rowPrestamo['ID_Pres'];
          $queryUpdate = "UPDATE Prestamo SET Fecha_fin = '$fechaFin', Devuelto = 'Prestado' WHERE ID_Pres = '$idPres'";

          if($conn->query($queryUpdate) === TRUE){
            echo "El préstamo ha sido actualizado correctamente.";
          } else {
            echo "Error al actualizar el préstamo: " .$conn->error;
          }
        } else {
          // Si el libro no fue prestado anteriormente, agregar un nuevo registro en la tabla Prestamo
          $queryInsert = "INSERT INTO Prestamo (Fecha_ini, Fecha_fin, Devuelto, ID_E, BARCODE) VALUES ('$fechaIni', '$fechaFin', 'Prestado', '$idE', '$barcode')";

          if($conn->query($queryInsert) === TRUE){
            echo "El préstamo ha sido registrado correctamente.";
          } else {
            echo "Error al registrar el préstamo: " . $conn->error;
          }
        }
      }
    } else {
      echo "El número de estudiante es obligatorio para los préstamos de estudiantes.";
    }
  } else {
    // Si el usuario es un profesor, verificar si existe en la tabla Profesor
    $queryProfesor = "SELECT * FROM Profesor WHERE Nombre = '$nombre' AND Apellido = '$apellido'";
    $resultProfesor = $conn->query($queryProfesor);

    if($resultProfesor->num_rows == 0){
      // Si el profesor no existe, mostrar un mensaje de error
      echo "El nombre y apellido del profesor ingresados no existen en la base de datos.";
    } else {
      // Obtener el ID_PROF del profesor
      $rowProfesor = $resultProfesor->fetch_assoc();
$idProf = $rowProfesor['ID_PROF'];

      // Verificar si el libro fue prestado anteriormente
      $queryPrestamo = "SELECT * FROM Prestamo WHERE ID_PROF = '$idProf' AND BARCODE = '$barcode'";
      $resultPrestamo = $conn->query($queryPrestamo);

      if($resultPrestamo->num_rows > 0){
        // Si el libro fue prestado anteriormente, actualizar la fecha de entrega y el estado
        $rowPrestamo = $resultPrestamo->fetch_assoc();
        $idPres = $rowPrestamo['ID_Pres'];
        $queryUpdate = "UPDATE Prestamo SET Fecha_fin = '$fechaFin', Devuelto = 'Prestado' WHERE ID_Pres = '$idPres'";

        if($conn->query($queryUpdate) === TRUE){
          echo "El préstamo ha sido actualizado correctamente.";
        } else {
          echo "Error al actualizar el préstamo: " .$conn->error;
        }
      } else {
        // Si el libro no fue prestado anteriormente, agregar un nuevo registro en la tabla Prestamo
        $queryInsert = "INSERT INTO Prestamo (Fecha_ini, Fecha_fin, Devuelto, ID_PROF, BARCODE) VALUES ('$fechaIni', '$fechaFin', 'Prestado', '$idProf', '$barcode')";

        if($conn->query($queryInsert) === TRUE){
          echo "El préstamo ha sido registrado correctamente.";
        } else {
          echo "Error al registrar el préstamo: " . $conn->error;
        }
      }
    }
  }

  // Cerrar la conexión a la base de datos
  $conn->close();

} else {
  // Si no se reciben todos los campos requeridos, mostrar un mensaje de error
  echo "Debe completar todos los campos requeridos.";
}

?>

