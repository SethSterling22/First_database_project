<?php
    // Establecer la conexión a la base de datos
	include("connection/conn.php");

    // Consulta SQL
    
// Consultar los préstamos
$query = "SELECT p.ID_Pres, c.Num_Prop, 
COALESCE(e.Nombre, pr.Nombre) AS Nombre, 
COALESCE(e.Apellido, pr.Apellido) AS Apellido, p.Fecha_fin AS 'Prestado Hasta'
FROM Prestamo p
INNER JOIN Comp_FAE c ON p.BARCODE = c.BARCODE
LEFT JOIN Estudiante e ON p.ID_E = e.ID_E
LEFT JOIN Profesor pr ON p.ID_PROF = pr.ID_PROF";

    // Ejecución de la consulta
    $resultado = mysqli_query($conexion, $query);

    // Creación del arreglo de filas
    $filas = array();
    if (mysqli_num_rows($resultado) > 0) {
        // El resultado de la consulta no está vacío, procesar las filas
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $filas[] = $fila;
        }
    }

    // Cierre de la conexión
    mysqli_close($conexion);

?>


<!DOCTYPE html>
<html>
<head>
<?php include("header.html"); ?>
</head>
	
<body>
		<style>
			
			.rectangulo{
				background-image: url('images/bpat.png'), url('images/bpat.png');
			} 

			.logo{
				width: 95%;
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
  min-height: 100%; 
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

			 <h1>Computadoras Prestadas</h1>
			
	 <p style="margin-top: 20px;"><nav>
         		<p style="margin-right: 40px;"><hacia><a href="Nusuario.php">Agregar</a></hacia></p>
            <p style="margin-right: 1px;"><hacia><a href="elimin.php">Eliminar</a></hacia</p>
    </nav></p>



		<p style="margin-bottom: 40px;">
			
		<?php

	$datos = array(
        array('#', 'Número de Propiedad', 'Nombre', 'Apellido', 'Prestado Hasta')
    );
        foreach ($filas as $fila) {
            $datos[] = array(
                $fila['ID_Pres'],
                $fila['Num_Prop'],
                $fila['Nombre'],
                $fila['Apellido'],
                $fila['Prestado Hasta']
            );
        }
    
?>

<!-- Creación de la tabla -->
<table>
    <?php foreach ($datos as $fila) { ?>
        <tr>
            <?php foreach ($fila as $celda) { ?>
                <td><?php echo $celda; ?></td>
            <?php } ?>
        </tr>
    <?php } ?>
</table>
			
	
	<p style="margin-top: 20px;"><nav>
         		<p style="margin-right: 40px;"><hacia><a href="prestamo.php">Realizar&nbsp;Préstamo</a></hacia></p>
            <p style="margin-right: 40px;"><hacia><a href="recibo.php">Recibir&nbsp;Computadora</a></hacia</p>
            <p style="margin-right: 1px;"><hacia><a href="reserva.php">Reservar&nbsp;Salón</a></hacia</p>
    </nav></p>

<style>			
a {
  text-decoration: none;
}
</style>					
			<div style="margin-top: 15%;"><div style="text-align: left;"><a href="easteregg.php"><footer style="color: #888;"><p style="margin-left: 10%">&copy; Sebastián H. Sterling</p></footer></a></div></div>
	</div>
	</div>
	</div>
</body>
</html>
