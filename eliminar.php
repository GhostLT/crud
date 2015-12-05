<?php
$ced = $_POST['cedula'];
	require_once ('funciones/conexiones.php');
	$con=conectar();
	$sql="DELETE FROM datospersonales WHERE cedula ='$ced'";
	$q = mysql_query($sql,$con);
	echo "El estudiante ha sido eliminado satisfactoriamente...".mysql_error();
?>