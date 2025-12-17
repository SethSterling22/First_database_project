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
  <p style="margin-bottom: 50px;">
	
<body>
    <h1>Recibo de Computadoras</h1>

	<p style="margin-bottom: 40px;">
	
	<form action="c_recibo.php" method="post">
  <!-- Campos del formulario -->

<div id="formulario" style="text-align: center;">
  <form action="c_recibo.php" method="post">

      <label for="BARCODE">BARCODE:</label>
      <input type="char(13)" id="BARCODE" name="BARCODE" required><br><br><br>

        <input type="submit" value="Recibir Computadora"><br><br>
  </form>
</div>

</body>
	<div style="margin-top: 15%;"><div style="text-align: left;"><footer style="color: #888;"><p style="margin-left: 10%">&copy; Sebastián H. Sterling</p></footer></div></div>
		</div>
		</div>
		</div>
</html>
