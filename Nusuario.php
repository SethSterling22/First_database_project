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

	label:focus-within {
  background-color: #f1f1f1;
  color: #333;
  transform: scale(1.05);
  transform: scale(1.05);
}

 #Tipo_Usuario option {
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

	
<body>
		<div class="contenedor">
		<div class="rectangulo">
		<div class="centrar">
	
  
  <a href="main.php"><h1><img src="images/Head.png" alt="Computadoras prestadas" class="logo"></h1></a>
	

    <h1>Agregar Nuevo Usuario</h1><br><br>


	
	<form action="c_nusuario.php" method="post">
  <!-- Campos del formulario -->


<div id="formulario" style="text-align: left;"><p style="margin-left: 10%;">
<label for="Tipo_Usuario">Tipo de usuario:</label>
<select id="Tipo_Usuario" name="Tipo_Usuario" required>
  <option value="Profesor">Profesor</option>
  <option value="Estudiante">Estudiante</option>
</select><br><br>

<label for="Nombre">Nombre del usuario:</label>
<input type="text" id="Nombre" name="Nombre" required><br><br>

<label for="Apellido">Apellido del usuario:</label>
<input type="text" id="Apellido" name="Apellido" required><br><br>

<label for="Cel_Num">Teléfono:</label>
<input type="varchar(20)" id="Cel_Num" name="Cel_Num" required><br>

<div id="numero_estudiante" style="display:block;">
  <p style="margin-left: 10%;"><label for="ID_E">Número de estudiante:</label>
  <input type="char(9)" id="ID_E" name="ID_E"><br>
</div></p>

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
<p style="margin-left: 10%;"><input type="submit" value="Agregar"></p>	
</p>	
</form>
</div>	

    <h1>Agregar Programa</h1><br><br>

<form action="N_prog.php" method="post">
  <div id="formulario" style="text-align: left;">
    <p style="margin-left: 10%;">
      <br>
      <label for="NOMBRE">Nombre del programa:</label>
      <input type="text" id="NOMBRE" name="NOMBRE" required><br><br>
      <label for="ID">ID del Computador:</label>
      <input type="text" id="ID" name="ID" required><br><br>
      <label for="TIPO">Tipo de computadora:</label>
      <select id="TIPO" name="TIPO">
        <option value="FAE">FAE</option>
        <option value="SIST">SIST</option>
      </select><br><br>
      <input type="submit" value="Agregar">
    </p>
  </div>
</form>
		
		
    <h1>Agregar Nueva Computadora</h1><br><br>
	
	<form action="N_comp.php" method="post">
  <!-- Campos del formulario -->


<div id="formulario" style="text-align: left;"><p style="margin-left: 10%;">
<label for="Computadora_type">Tipo de computadora:</label>
<select id="Computadora_type" name="Computadora_type" required>
  <option value="Comp_SIST">SIST</option>
  <option value="Comp_FAE">FAE</option>
</select><br><br>

<label for="Num_prop">Número de Propiedad:</label>
<input type="text" id="Num_prop" name="Num_prop" required><br><br>

<label for="Num">Número de Máquina:</label>
<input type="text" id="Num" name="Num" required><br>

<div id="Comp_FAE" style="display:block;">
  <p style="margin-left: 10%;">
	
	<label for="Comp_FAE">BARCODE:</label>
  <input type="char(13)" id="Comp_FAE" name="Comp_FAE"><br>
</div></p>

<script>
  var tipocomp = document.getElementById('Computadora_type');
  var tipocompu = document.getElementById('Comp_FAE');

  tipocomp.selectedIndex = 1;

  tipocomp.addEventListener('change', function(){
    if(this.value === 'Comp_FAE'){
      tipocompu.style.display = 'block';
    } else {
      tipocompu.style.display = 'none';
    }
  });
</script>
<p style="margin-left: 10%"><input type="submit" value="Agregar"></p>
	<p style="margin-bottom: 15%"></p>	
</p>	
</form>
<div style="text-align: left;"><footer style="color: #888;"><p style="margin-left: 10%">&copy; Sebastián H. Sterling</p></footer></div>
</div>	
</div>
</div>
</div>
</body>
</html>