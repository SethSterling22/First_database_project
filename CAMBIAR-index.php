<!DOCTYPE html>
<html>
<head>
<?php include("header.html"); ?>
</head>
<body>
	<!-- Estilo de los "label" -->
	<style>
	.rectangulo {
		min-width: 80%;
		height: 120vh;
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
		body {
  height: 100%; 
  min-width: 800px;
	font-family: Arial, sans-serif; 
  background-image: url('images/loglib.jpg');
  }
	</style>
	<div class="contenedor">
	
	<div class="contenedor">
  <div class="rectangulo">

		<form action="login.php" method="post">

<?php
// Comprobamos si hay un mensaje de error en la URL
if (isset($_GET['mensaje'])) {
    // Mostramos el mensaje de error en rojo y negrita
    echo '<p style="color: red; font-weight: bold;">' . htmlspecialchars($_GET['mensaje']) . '</p>';
}
?>

			<header>
  <img src="images/baelogo.png" alt="Logo Bib" class="logo">
</header>
			
		<h1>Iniciar sesión</h1>
			
		<label for="username">Nombre de usuario:</label>
		<input type="text" id="username" name="username" required><br><br>
		<label for="password">Contraseña:</label>
		<input type="password" id="password" name="password" required><br><br>
		<input type="submit" value="Iniciar sesión">

			
<div style="margin-top: 40%;"><div style="text-align: left;"><footer style="color: #888;"><p style="margin-left: 10%">&copy; Sebastián H. Sterling</p></footer></div></div>
		</div>		
		</div>
	</form>
		
</body>
		
		
</html>