<?php
require_once('funciones/conexiones.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="latin1">
	<title>Document</title>
	<!-- impoprtamos la libreria jquery y datatables-->
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
	<!-- importamos los estilos -->
	<link rel="stylesheet" href="css/demo_page.css">
	<link rel="stylesheet" href="css/demo_table.css">
		<script type="text/javascript">
		var procedimiento="nuevo";
			$( document ).ready(function() {
   				//alert("jquery esta cargando correctamente")
   				
   				var num = 1;
   				$("#loader").hide();
   				$("#formularioregistrar").hide();
   				 $('#tabla').dataTable();

   				 
   				 $("#btnnuevo").click(function(){
   				 	$("#leyenda").html("Registrar nuevo Estudiante");
   				 	procedimiento="nuevo";
   				 	num = num +1;
   				 	if (num %2 == 0) {
   				 		$("#formularioregistrar").show();
   				 		$("#btnnuevo").val("Cancelar");
   				 	}
   				 	else{
   				 		$("#formularioregistrar").hide();
   				 		$("#btnnuevo").val("Agregar Nuevo Estudiante");	
   				 	}

   				 })

   				 $("#btnprocesar").click(function(){
   				 	$("loader").show();
   				 	alert("jquery esta cargando procesar correctamente")
   				 		var datos=$("#frmregistrar").serialize();

   				 		if (procedimiento=="nuevo")
   				 		{

   				 		$.ajax({
   				 			url:"guardar.php",
   				 			type: "POST",
   				 			data:datos,
   				 			success:
   				 				function(r)
   				 				{
   				 					alert(r);
   				 					$("loader").hide();
   				 					location.reload(true);
   				 				}
   				 			})
   				 		}
   				    	else if(procedimiento == "editar")
   				    	{

   				 		$.ajax({
   				 			url:"editar.php",
   				 			type: "POST",
   				 			data:datos,
   				 			success:
   				 				function(r)
   				 				{
   				 					alert(r);
   				 					$("loader").hide();
   				 					location.reload(true);
   				 				}
   				 		})
   				    	}
   				 })

		});

			 function eliminar(cedula)
			 {
			 	if(confirm("Esta seguro que desea eliminar este estudiante"))
			 	{
			 		//cedula=987899
			 		var ced = "cedula="+cedula;
			 		$.ajax({
			 			url:"eliminar.php",
			 			data: ced,
			 			type: "POST",
			 			success:
			 				function(respuesta)
			 				{
			 					alert(respuesta);
			 					document.location.reload(true);
			 				}
			 		})
			 	}


			 }

			 function editar(cedula)
			 {
			 			//alert("editar esta cargando correctamente")
			 			$("#leyenda").html("Actualizar Estudiante");
			 			procedimiento="editar";
			 			var ced = "cedula="+cedula;
			 		$.ajax({
			 			url:"buscarestudiante.php",
			 			data: ced,
			 			type: "POST",
			 			dataType:"json",
			 			success:
			 				function(respuesta)
			 				{

			 					$("#formularioregistrar").show();
   				 				$("#btnnuevo").val("Cancelar");
			 					$('#txtcedula').val(respuesta.ced);
			 					$('#txtnombres').val(respuesta.nom);
			 					$('#txtapellidos').val(respuesta.apel);
			 					$('#txtfechanac').val(respuesta.fn);
			 					$('#txttel').val(respuesta.tel);
			 					$('#txtdir').val(respuesta.dir);
			 				}
			 		})
			 }
	</script>
</head>
<body>
		
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="tabla">
	<thead> <!-- cabecera de la tabla -->
		<tr>
			<th>Cedula</th> <!-- Coloca en negrita el encabezado de la columna -->
			<th>Nombres</th>
			<th>Apellidos</th>
			<th>Fecha Nacimiento</th>
			<th>Telefono</th>
			<th>Direccion</th>
			<th></th>
		</tr>
	</thead>
	<tbody> <!-- cuerpo de la tabla imprime cada fila -->

		<?php
			$con=conectar();
			$sql="SELECT cedula, nombres, apellidos, fecha_nac, telefono, dir FROM datospersonales ORDER BY nombres, apellidos";
			$q = mysql_query($sql,$con) or die ("problemas al conectar la consulta");
		
		?>

		<?php
				while ($datos = mysql_fetch_array($q))
			{
		?>
		<tr class="odd gradeX">
			<td><?php echo $datos['cedula'];?></td>
			<td><?php echo $datos['nombres'];?></td>
			<td><?php echo $datos['apellidos'];?></td>
			<td><?php echo $datos['fecha_nac'];?></td>
			<td><?php echo $datos['telefono'];?></td>
			<td><?php echo $datos['dir'];?></td>
			<td>
				<img src="images/modificar.png" style="cursor:pointer;" onclick="editar('<?php echo $datos['cedula'];?>')" alt="modificar">
				<img src="images/borrar.png" style="cursor:pointer;" onclick="eliminar('<?php echo $datos['cedula'];?>')" alt="borrar">
			</td>
		</tr>
		<?php
			}
		?>
	</tbody>
	<tfoot> <!-- pie de la tabla -->
		<tr>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
		</tr>
	</tfoot>
</table>
			<div id="botonnuevo" align="center">
				<input type="button" id="btnnuevo" name="btnnuevo" value="Agregar Estudiante">
			</div>
			<br />
			<div id="formularioregistrar" align="center">
				<div id="procedimiento"></div>
				<form name="frmregistrar" id="frmregistrar">
					<fieldset style="display:inline;">
					<legend id="leyenda">Registrar Nuevo Estudiante</legend>
					<table>
						<tr>
							<td>Cedula : </td>
							<td>
								<input type="text" id="txtcedula" name="txtcedula">
							</td>
						</tr>
						<tr>
							<td>Nombres : </td>
							<td>
								<input type="text" id="txtnombres" name="txtnombres">
							</td>
						</tr>
						<tr>
							<td>Apellidos : </td>
							<td>
								<input type="text" id="txtapellidos" name="txtapellidos">
							</td>
						</tr>
						<tr>
							<td>Fecha de Nacimiento : </td>
							<td>
								<input type="text" id="txtfechanac" name="txtfechanac">
							</td>
						</tr>
						<tr>
							<td>Telefono : </td>
							<td>
								<input type="text" id="txttel" name="txttel">
							</td>
						</tr>
						<tr>
							<td>Direccion : </td>
							<td>
								<input type="text" id="txtdir" name="txtdir">
							</td>
						</tr>
						<tr>
							<td>
								<button id="btnprocesar" name="btnprocesar">Procesar Estudiante</button>
							</td>
							<td>
								<input type="reset" name="btnborrar" id="btnborrar" value="Borrar formulario">
							</td>
						</tr>
						<tr>
							<td colspan="2" align="center">
								<div id="loader">
									<img src="images/loader.gif" alt="procesando">
								</div>
							</td>
						</tr>
					</table>
					</fieldset>
				</form>

			</div>

</body>
</html>