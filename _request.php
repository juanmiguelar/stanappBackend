
<?php
/*****************************/
/***DESARROLLO HIDROCALIDO****/
/*****************************/
require 'actualconnector.php';

// TOMAMOS NUESTRO JSON RECIBIDO DESDE LA PETICION DE ANGULAR JS Y LO LEEMOS
 
$JSON       = file_get_contents("php://input");
$request    = json_decode($JSON);
$nombre    = $request->nombre; 
$apellido = $request->apellido;
$email = $request->email;
 
registrarUsuario($nombre,$apellido, $email);
 
function registrarUsuario($nombre, $apellido,$email){

    $sql ="INSERT INTO USUARIO(NOMBRE, APELLIDO, EMAIL) VALUES(" . $nombre . ", " . $apellido . ", ". $email.")"; 
    
    $operation = insert($sql);
	echo $operation;
}
?>