<?php
function conectar()
{

$servidor = "127.0.0.1";
$usuario = "root";
$clave = "toor";
$bd = "estudiantes";


$con = mysql_connect($servidor,$usuario,$clave) or die("no se pudo conectar");
mysql_select_db($bd,$con) or die("problemas al seleccionar la bd");

return $con;



}

?>