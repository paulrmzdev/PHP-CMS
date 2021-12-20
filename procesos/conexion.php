<?php
$usuario = "";
$contrasena = "";
$servidor = "localhost";
$basededatos = "bdessencespa";
 try {
 	$mbd = new PDO('mysql:host='.$servidor.';dbname='.$basededatos, $usuario, $contrasena);
 	//foreach($mbd->query('SELECT * from servicios') as $fila){
 		//print_r($fila);
 	//	var_dump($fila[4]);
 	//}
 	//echo "<br/>Conexion exitosa";
 	//$mbd = null;
 } catch (PDOException $e) {
 	print "Error!: ". $e->getMessage()."<br/>";
 	die();
 }