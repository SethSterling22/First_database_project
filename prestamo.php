<?php
  // Establecer la conexión a la base de datos
  include("connection/conn.php");

// Consulta SQL para obtener los programas relacionados con los computadores
$query = "SELECT cf.Num_F AS '#', cf.BARCODE, cf.Num_Prop AS 'Número de Propiedad', p.NOMBRE AS 'Nombre Programa'
FROM Comp_FAE cf
JOIN Tiene t ON cf.BARCODE = t.BARCODE
JOIN Programas p ON t.ID_P = p.ID_P
UNION
SELECT cs.Num_S AS '#', NULL, cs.Num_Prop AS 'Número de Propiedad', p.NOMBRE AS 'Nombre Programa'
FROM Comp_SIST cs
JOIN Tiene t ON cs.Num_Prop = t.Num_Prop
JOIN Programas p ON t.ID_P = p.ID_P
ORDER BY '#';";

// Ejecutar la consulta y almacenar los resultados en una variable
$resultado = mysqli_query($conexion, $query);

// Creación del arreglo de datos
$datos = array(
  array('#', 'BARCODE', 'Número de Propiedad', 'Nombre Programa')
);

// Agregar cada fila de datos a la matriz
while ($fila = mysqli_fetch_assoc($resultado)) {
  $num_f = $fila['#'];
  $barcode = $fila['BARCODE'];
  $num_prop = $fila['Número de Propiedad'];
  $nombre_programa = $fila['Nombre Programa'];
  

  // Verificar si ya se ha agregado esta computadora
  $encontrado = false;
  foreach ($datos as $indice => $fila_existente) {
      if ($fila_existente[2] == $num_prop) { // Verificar si la fila existente tiene el mismo número de propiedad
          // Agregar el programa a la lista de programas de la computadora existente
          $datos[$indice][3] .= ', ' . $nombre_programa;
          $encontrado = true;
          break;
      }
  }

  // Si la computadora no ha sido encontrada y tiene Número de Propiedad, agregarla a los datos
  if (!$encontrado && $num_prop != null) {
$datos[] = array($num_f, $barcode, $num_prop, $nombre_programa);
  }
}
    // Cierre de la conexión
    mysqli_close($conexion);
?>


<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="cent.css">
	<meta charset="UTF-8">
  <title>Sistema de Préstamo BAE</title>
	<link rel="shortcut icon" href="images/baelogo.png" type="image/x-icon">
	<meta charset="UTF-8">
	</head>
	
<body>
		<style>
			.rectangulo{
				background-image: url('images/bpat.png'), url('images/bpat.png');
			}
			.logo{
				width: 95%;
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
  min-width: 800px;
	font-family: Arial, sans-serif; 
  background-image: url('images/fondomain.png');
  }
	
		table {
   		border-collapse: collapse;
			display: flex;
   		justify-content: center;
		}
    td {
        border: 1px solid black;
        padding: 10px;
		}
			
		tr:nth-child(odd) {
    	background-color: #f2f2f2;
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
	
	</style>


	
		<div class="contenedor">
		<div class="rectangulo">
		<div class="centrar">
	
   
  <a href="main.php"><h1><img src="images/Head.png" alt="Computadoras prestadas" class="logo"></h1></a>
	
<body>

	
    <h1>Préstamo de Computadoras</h1>


	<p style="margin-bottom: 40px;">
	
	<form action="c_prestamo.php" method="post">
  <!-- Campos del formulario -->


<div id="formulario" style="text-align: left;">
  <form action="c_prestamo.php" method="post">
    <p style="margin-left: 10%;">
      <label for="Tipo_Usuario">Tipo de usuario:</label>
      <select id="Tipo_Usuario" name="Tipo_Usuario" required>
        <option value="Profesor">Profesor</option>
        <option value="Estudiante">Estudiante</option>
      </select><br><br>

      <label for="Nombre">Nombre del usuario:</label>
      <input type="text" id="Nombre" name="Nombre" required><br><br>

      <label for="Apellido">Apellido del usuario:</label>
      <input type="text" id="Apellido" name="Apellido" required><br><br>

      <label for="BARCODE">BARCODE:</label>
      <input type="char(13)" id="BARCODE" name="BARCODE" required><br><br>

			<label for="Fecha_ini">Fecha de inicio:</label>
			<input type="DATE" id="Fecha_ini" name="Fecha_ini" required><br><br>
			
			<label for="Fecha_fin">Fecha de entrega:</label>
			<input type="DATE" id="Fecha_fin" name="Fecha_fin" required><br>

      <div id="numero_estudiante" style="display:block;">
        <p style="margin-left: 10%;">
          <label for="Num_Estudiante">Número de estudiante:</label>
          <input type="text" id="Num_Estudiante" name="Num_Estudiante"><br><br>
        </p>
      </div>

      <script>
        var tipoUsuario = document.getElementById('Tipo_Usuario');
        var numeroEstudiante = document.getElementById('numero_estudiante');

        tipoUsuario.selectedIndex = 1;

        tipoUsuario.addEventListener('change', function(){
          if(this.value === 'Estudiante'){
            numeroEstudiante.style.display = 'block';
          } else {
            numeroEstudiante.style.display = 'none';
          }
        });
      </script>

      <p style="margin-left: 10%;">
        <input type="submit" value="Realizar Préstamo">
      </p>
    </p>
  </form>
</div>


		

		<!-- Agregar una barra de búsqueda -->
    <input type="text" id="buscar-programa" placeholder="Buscar programa...">
<br><br>


<table id="tabla-programas">
    <?php foreach ($datos as $fila) { ?>
        <tr>
            <?php foreach ($fila as $celda) { ?>
                <td><?php echo $celda; ?></td>
            <?php } ?>
        </tr>
    <?php } ?>
</table>
<br><br>

<!-- JavaScript para filtrar la tabla -->
<script>
    // Obtener la barra de búsqueda y la tabla
    var input = document.getElementById("buscar-programa");
    var tabla = document.getElementById("tabla-programas");

    // Agregar un evento de entrada a la barra de búsqueda
    input.addEventListener("input", function() {
        // Obtener el término de búsqueda ingresado por el usuario
        var filtro = input.value.toUpperCase();

        // Filtrar las filas de la tabla según el término de búsqueda
        for (var i = 1; i < tabla.rows.length; i++) {
            var programa =tabla.rows[i].cells[3].innerText.toUpperCase();
            if (programa.indexOf(filtro) > -1) {
                tabla.rows[i].style.display = "";
            } else {
                tabla.rows[i].style.display = "none";
            }
        }
    });
</script>
	
</body>
		<div style="text-align: left;"><footer style="color: #888;"><p style="margin-left: 10%">&copy; Sebastián H. Sterling</p></footer></div>
		</div>
		</div>
		</div>
</html>