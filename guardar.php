<?php

require_once ("funciones/conexiones.php");
$ced = $_POST['txtcedula'];
$nom = $_POST['txtnombres'];
$apel = $_POST['txtapellidos'];
$nac = $_POST['txtfechanac'];
$tel = $_POST['txttel'];
$dir = $_POST['txtdir'];

	echo "hasta aqui donde paso los valores por post voy bien";
	$con=conectar();
	$sql="INSERT INTO datospersonales (cedula,nombres,apellidos,fecha_nac,telefono,dir) VALUES ('$ced','$nom','$apel','$nac','$tel','$dir')";
	$q = mysql_query($sql,$con);
	echo "aqui terminamos la consulta";
	if (!$q)
	{
		echo "ha ocurrido un error en el procesamiento de la informacion";
	}
	else
	{
		echo "El estudiante ha sido almacenado satisfactoriamente...";
	}
?>