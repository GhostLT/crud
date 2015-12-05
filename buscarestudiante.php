<?php
	$ced=$_POST['cedula'];
	require_once('funciones/conexiones.php');
	$con=conectar();
	$sql="SELECT cedula,nombres,apellidos,fecha_nac,telefono,dir FROM datospersonales WHERE cedula='$ced'";
	$q=mysql_query($sql,$con);
	$info=array();
	while($datos=mysql_fetch_array($q))
	{
		$nombres=$datos['nombres'];
		$apellidos=$datos['apellidos'];
		$fn=$datos['fecha_nac'];
		$tel=$datos['telefono'];
		$dir=$datos['dir'];
	}


	$info['ced'] = $ced;
	$info['nom'] = $nombres;
	$info['apel'] = $apellidos;
	$info['fn'] = $fn;
	$info['tel'] = $tel;
	$info['dir'] = $dir;

	echo json_encode($info);


?>