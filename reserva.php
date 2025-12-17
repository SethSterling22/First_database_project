<!DOCTYPE html>
<html>
<head>
<?php include("header.html"); ?>

<style>
	.rectangulo{
				background-image: url('images/bpat.png'), url('images/bpat.png');
			} 
			.logo{
				width: 95%;
			}

	label:focus-within {
  background-color: #f1f1f1;
  color: #333;
  transform: scale(1.05);
  transform: scale(1.05);
}
			
label {
  border: 1px solid #ccc;
  border-radius: 5px;
  padding: 5px;
  transition: all 0.2s ease-in-out;
  color: #333;
  font-weight: bold;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 5px;
  padding: 5px;
  transition: all 0.2s ease-in-out;
}
input {
  background-color: #f1f1f1;
  border: 1px solid #ccc;
  border-radius: 5px;
  padding: 5px;
}
	input:hover {
  background-color: #ddd;
}
	input:focus {
  color: #333;
  cursor: pointer;
}

hacia {
  display: block;
  width: 170px;
  height: 40px;
  line-height: 40px;
  text-align: center;
  color: black;
  border-radius: 10px;
  text-decoration: none;
  border: 1px solid black;
}

hacia:hover {
  color: white;
  background-color: #80808080;
}

hacia:active {
  color: #80808080;
  background-color: white;
}		

		body {
  height: 100%;
  min-height: 100vh;
  min-width: 800px;
	font-family: Arial, sans-serif; 
  background-image: url('images/fondomain.png');
  }

		nav {
    	display: flex;
    	justify-content: center;
		}

		nav a {
    	display: inline-block;
   		margin: 0 10px;
    	text-decoration: none;
   		color: black;
		}

		#calendario {
      width: 100%;
      border-collapse: collapse;
    }

    #calendario td {
      padding: 10px;
      text-align: center;
      border: 1px solid #ccc;
    }

    #calendario td:not(.reservado) {
      background-color: #fff;
    }

    #calendario td.reservado {
      background-color: yellow;
    }

    #calendario tr:first-child td {
      background-color: #f2f2f2;
    }
	</style>

</head>

<body>

<div class="contenedor">
		<div class="rectangulo">
			<div class="centrar">
				<a href="main.php"><h1><img src="images/Head.png" alt="Computadoras prestadas" class="logo"></h1></a>


  <h1>Calendario con reservaciones</h1>

  <h2>Reservar una fecha</h2>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <label for="tipo">Tipo de Reservador:</label>
  <select id="tipo" name="tipo">
    <option value="profesor" selected>Profesor</option>
    <option value="estudiante">Estudiante</option>
  </select><br><br>

  <label for="nombre">Nombre:</label>
  <input type="text" name="nombre" id="nombre" required><br><br>

  <label for="apellido">Apellido:</label>
  <input type="text" name="apellido" id="apellido" required><br><br>

  <label for="telefono">Teléfono:</label>
  <input type="tel" name="telefono" id="telefono" required><br><br>

  <div id="num_estudiante" style="display:none;">
    <label for="num_est">Número de Estudiante:</label>
    <input type="text" name="num_est" id="num_est"><br><br>
  </div>

  <label for="fecha">Fecha de Reservación:</label>
  <input type="date" name="fecha" id="fecha" required><br><br>

  <label for="hora_ini">Hora de Inicio:</label>
  <input type="time" name="hora_ini" id="hora_ini" required><br><br>

  <label for="hora_fin">Hora de Fin:</label>
  <input type="time" name="hora_fin" id="hora_fin" required><br><br>

  <input type="submit" value="Reservar"><br><br>
  
</form>

<script>
  var tipoReservador = document.getElementById('tipo');
  var numEstudiante = document.getElementById('num_estudiante');

  tipoReservador.addEventListener('change', function(event) {
    if (event.target.value === 'estudiante') {
      numEstudiante.style.display = 'block';
    } else {
      numEstudiante.style.display = 'none';
    }
  });
</script>


<?php
include("connection/conn.php");


// Obtener las reservaciones de la base de datos
$sql = "SELECT r.fecha, r.hora_inicio, r.hora_fin, e.Nombre AS nom_est, e.Apellido AS ape_est, p.Nombre AS nom_prof, p.Apellido AS ape_prof
        FROM Reservacion_Salon r
        LEFT JOIN Estudiante e ON r.Reservado_Por_E = e.ID_E
        LEFT JOIN Profesor p ON r.Reservado_Por_P = p.ID_PROF";
$result = mysqli_query($conexion, $sql);
$reservaciones = array(); // Arreglo para almacenar las reservaciones
if ($result !== false && mysqli_num_rows($result) > 0) {
  // Almacenar las reservaciones en el arreglo
  while($row = mysqli_fetch_assoc($result)) {
    $reservaciones[] = $row;
  }
}

// Insertar una nueva reservación
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nombre = $_POST["nombre"];
  $apellido = $_POST["apellido"];
  $telefono = $_POST["telefono"];
  $num_est = $_POST["num_est"];
  $fecha = $_POST["fecha"];
  $hora_inicio = $_POST["hora_ini"];
  $hora_fin = $_POST["hora_fin"];

  // Calcular la duración de la reserva en segundos
  date_default_timezone_set('America/Puerto_Rico');
  $duracion = strtotime($hora_fin) - strtotime($hora_inicio);
  $duracion_en_horas = $duracion / 3600;

  // Verificar si se ingresó el número de estudiante
  if ($num_est != null) {
    // Obtener el ID del estudiante en base al número
    $sql = "SELECT ID_E FROM Estudiante WHERE ID_E='$num_est'";
    $result = mysqli_query($conexion, $sql);
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $reservado_por_e = $row["ID_E"];
    } else {
      // Si no se encontró un estudiante con ese número, mostrar un mensaje de error
      echo "No se encontró un estudiante con ese número.";
      exit;
    }
    $sql = "INSERT INTO Reservacion_Salon (Duracion, Hora_ini, Hora_fin, Reservado_Por_E, Fecha)
          VALUES ('$duracion', '$hora_inicio', '$hora_fin', '$reservado_por_e', '$fecha')";
  } else {
    // Obtener el ID del profesor en base al nombre y apellido
    $sql = "SELECT ID_PROF FROM Profesor WHERE Nombre='$nombre' AND Apellido='$apellido'";
    $result = mysqli_query($conexion,$sql);
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $reservado_por_p = $row["ID_PROF"];
    } else {
      // Si no se encontró un profesor con ese nombre y apellido, mostrar un mensaje de error
      echo "No se encontró un profesor con ese nombre y apellido.";
      exit;
    }
    $sql = "INSERT INTO Reservacion_Salon (Duracion, Hora_ini, Hora_fin, Reservado_Por_P, Fecha)
          VALUES ('$duracion', '$hora_inicio', '$hora_fin', '$reservado_por_p', '$fecha')";
  }

  // Insertar el registro en la tabla "Reservacion_Salon"
  
  if (mysqli_query($conexion, $sql)) {
    echo "La reserva ha sido creada exitosamente.";
  } else {
    echo "Error al crear la reserva: " . mysqli_error($conexion);
  }
}

// // Cerrar conexión a la base de datos
mysqli_close($conexion);
?>
<br><br>

<table id="calendario">
    <thead>
      <tr>
        <th colspan="7">
          <button id="anterior">Anterior</button>
          <span id="mes-anio"></span>
          <button id="siguiente">Siguiente</button>
          <br><br>
        </th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>

<script>
  var reservaciones = <?php echo json_encode($reservaciones); ?>;

  function generarCalendario(mes, anio, reservaciones) {
  var primerDia = new Date(anio, mes, 1);
  var diaSemana = primerDia.getDay();

  var ultimoDia = new Date(anio, mes + 1, 0);
  var numDias = ultimoDia.getDate();

  var tbody = document.querySelector('#calendario tbody');
  tbody.innerHTML = '';

  // Crear fila para los días de la semana
  var diasSemana = ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'];
  var filaDiasSemana = document.createElement('tr');
  for (var i = 0; i < 7; i++) {
    var celdaDiaSemana = document.createElement('td');
    celdaDiaSemana.textContent = diasSemana[i];
    filaDiasSemana.appendChild(celdaDiaSemana);
  }
  tbody.appendChild(filaDiasSemana);

  var diaActual = 1;
  var numFilas = Math.ceil((numDias + diaSemana) / 7);

  for (var i = 0; i < numFilas; i++) {
    var fila = document.createElement('tr');
    for (var j = 0; j < 7; j++) {
      var celda = document.createElement('td');
      if (i === 0 && j < diaSemana) {
        celda.textContent = '';
      } else if (diaActual > numDias) {
        celda.textContent = '';
      } else {
        celda.textContent = diaActual;

        // Crear objeto Date para la fecha actual
        var fechaActual = new Date(anio, mes, diaActual);

        // Verificar si hay una reservación para la fecha actual
        var reservacionEncontrada = reservaciones.find(function(reservacion) {
          // Crear objeto Date para la fecha de la reservación
          var fechaReservacion = new Date(reservacion.fecha);

          // Comparar las fechas
          return fechaReservacion.getFullYear() === fechaActual.getFullYear() &&
            fechaReservacion.getMonth() === fechaActual.getMonth() &&
            fechaReservacion.getDate() === fechaActual.getDate();
        });

        if (reservacionEncontrada) {
          celda.classList.add('reservado');
          var reservacionInfo = document.createElement('div');
          reservacionInfo.textContent = reservacionEncontrada.nom_est + ' ' + reservacionEncontrada.ape_est + ' ' +
            reservacionEncontrada.hora_inicio + ' - ' + reservacionEncontrada.hora_fin;
          celda.appendChild(reservacionInfo);
        }

        diaActual++;
      }
      fila.appendChild(celda);
    }
    tbody.appendChild(fila);
  }
}

  function cambiarMes(direccion) {
    mes += direccion;
    if (mes < 0) {
      mes = 11;
      anio--;
    } else if (mes > 11) {
      mes = 0;
      anio++;
    }
    generarCalendario(mes, anio, reservaciones);
  }

  var fechaActual = new Date();
  var mes = fechaActual.getMonth();
  var anio = fechaActual.getFullYear();

  generarCalendario(mes, anio, reservaciones);

  document.querySelector('#anterior').addEventListener('click', function() {
    cambiarMes(-1);
  });

  document.querySelector('#siguiente').addEventListener('click', function() {
    cambiarMes(1);
  });
</script>
<br><br>

<br><br>

<div style="text-align: left;">
  <footer style="color: #888;">
    <p style="margin-left: 10%">&copy; Sebastián H. Sterling</p>
  </footer>

  </div>
	</div>
	</div>

</body>
</html>