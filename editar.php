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
	$sql="UPDATE datospersonales SET nombres='$nom',apellidos='$apel',fecha_nac='$nac',telefono='$tel',dir='$dir' WHERE cedula = '$ced'";
	$q = mysql_query($sql,$con);
	echo "aqui terminamos la consulta";
	if (!$q)
	{
		echo "ha ocurrido un error en el procesamiento de la informacion".mysql_error();
	}
	else
	{
		echo "El estudiante ha actualizado satisfactoriamente...";
	}
?>