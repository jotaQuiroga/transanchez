<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Transanchez_ingreso</title>
	<!--<link rel="shortuct icon" href="images/MILLENIAL.jpg">-->
	<!--<link rel="stylesheet" href="../css/registroCSS.css">-->
	<link rel="stylesheet" href="css/registroCSS.css">

</head>
<body class = "imagenFondo">
	<div class="container">	
		<div class="form__top">
			<h2>Formulario <span>Registro</span></h2>
		</div>
		<form class="form__reg" action="CreaEmple.php" method="POST">
			<label>Crear Usuario</label>
			<h3><input class="input" name = "tipEmpl" type="radio" value= "1">Administrador</h3>
			<h3><input class="input" name = "tipEmpl" type="radio" value= "0" checked>Subordinado</h3>

			<!-- MENU DESPLEGABLE PARA SELECCIONAR EL CARGO DEL EMPLEADO NUEVO-->
			<select class="input" name="cargo">
				
				<!-- 
					LA PÁGINA DEBE CONSTRUIR PREVIAMENTE UN MENU DESPLEGABLE PARA SELECCIONAR EL CARGO DEL EMPLEADO NUEVO.
					POR LO TANTO, DEBE REALIZAR UNA CONSULTA PREVIA A LA BASE DE DATOS Y POR ELLO DENTRO DE ESTE ARCHIVO HTML
					SE DEBEN GENERAR VARIAS SECCIONES DE CODIGO DE PHP PARA OBTENER LA INFORMACIÓN Y CONSTRUIR EL MENU
				-->

				<?php
				//SE CREAN VARIABLES DE CONEXION A SERVIDOR Y DE CONEXIÓN A BD
				//variables de conexion
				    $svr_conexion=@mysqli_connect("localhost", "root", '');
				    $db_conexion= mysqli_select_db($svr_conexion, 'transanchez');

				//SE CREAN LOS DIFERENTES "<OPTION>" SEGÚN LAS OPCIONES DE LA BD
				//sentencia a la base de datos
			    	$sentencia = "SELECT NOMBRE_CARGO, ID_CARGO FROM CARGO ORDER BY NOMBRE_CARGO ASC";
			    //se ejecuta sentencia sql y se construye rutina WHILE
			    	$ejecuta_Select = mysqli_query($svr_conexion, $sentencia);
			    	while ($dato_menu=mysqli_fetch_array($ejecuta_Select))
			    	{
				?>
						<option value = "<?php echo $dato_menu['ID_CARGO']; ?>">
							<?php 
									echo $dato_menu["NOMBRE_CARGO"]; 
							?>				
						</option>

				<?php
					}
				?>

			</select>

			<input class="input" name = "docum" type="text" placeholder="&#128101; No. Identificación" required autofocus>
			<input class="input" name = "nombre" type="text" placeholder="&#128101; Nombres" required>
			<input class="input" name = "apell_1" type="text" placeholder="&#128101; Primer Apellido" required>
            <input class="input" name = "apell_2" type="text" placeholder="&#128101; Segundo Apellido" required>
			<input class="input" name = "email" type="email" placeholder="&#9993; E-mail" required>
			<input class="input" name = "telef" type="text" placeholder="&#128222; Teléfono" required>
			<input class="input" name = "direc" type="text" placeholder="&#127969; Dirección" required>
			<div class="btn__form">
				<input  href="login.html" class="btn__submit" type="submit" value="GUARDAR">
				<input class="btn__reset" type="reset" value="LIMPIAR">
			</div>
		</form>
	</div>
</body>
</html>



