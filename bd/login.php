<?php
session_start(); //permite acceder a los valores guardados dentro de las variables de la sesion
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
//print_r($conexion);  //con esto verificamos si hay conexion devuelve objeto PDO

// Recepción de los datos enviados mediante POST desde AJAX



// Recepción de los datos enviados mediante POST desde el JS   
$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$password = (isset($_POST['password'])) ? $_POST['password'] : '';

$pass = md5($password); //encripta la clave enviada por el usuario para compararla con la clave encriptada y almacenada en bd

$consulta = "SELECT * FROM usuarios WHERE usuario='$usuario' AND password='$pass' ";

//$consulta = "SELECT usuarios.idRol AS idRol, roles.descripcion AS rol FROM usuarios JOIN roles ON usuarios.idRol = roles.id WHERE usuario='$usuario' AND password='$pass' ";	
$resultado = $conexion->prepare($consulta);
$resultado->execute(); 


if($resultado->rowCount() >= 1){ //rowCount devuelve el numero de filas afectadas por la consulta
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);    
    $_SESSION["s_usuario"] = $usuario;    
    //$_SESSION["s_idRol"] = $data[0]["idRol"];
    
    //$_SESSION["s_rol_descripcion"] = $data[0]["rol"];
}else{
    $_SESSION["s_usuario"] = null;  
    $data=null;
}

print json_encode($data);//envio el array final el formato json a AJAX
$conexion=null;