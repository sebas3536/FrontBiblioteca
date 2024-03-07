<?php
// Api para retornar un usuario o un listado de usuarios
//---------- getusuario-----------------
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requestes-Whit, Content-Type, Accept');
header("Content-Type: application/json; charset=UTF-8");
header('Content-Type: application/json');
header("Access-Control-Allow-Headers", "Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE, OPTIONS");
$json=file_get_contents('php://input');//captura el parametro en json {'id':118}
$params=json_decode($json);//paramteros
require('conexion.php');

$respuesta['codigo']='-1';
$respuesta['mensaje']='No se puede actualizar el registro';
$method = $_SERVER['REQUEST_METHOD'];//Cual es el metdodo de acceso (GET,PUT,POST,DELET PATCH)
if($method!='PUT')
{
  $respuesta['mensaje']='Erros acceso no permitido por este método..';
  echo json_encode($respuesta);
  exit(1);
}
if(isset($params))//si recibe una variable por get llamada 'id'
{
     $id=$params->id;
     $documento = $params->documento;
     $nombres = $params->nombres;
     $apellidos = $params->apellidos;
     $direccion = $params->direccion;
     $telefono = $params->telefono;
     $correo = $params->correo;
     $fecha = date("Y-m-d H:i:s"); //2024-02-27:4:01:55
     $stmt = $mysqli->prepare("UPDATE usuarios set documento=?, nombres=?, apellidos=?, direccion=?, telefono=?, correo=?,modified=? where id=?");
    /* Bind variables to parameters */
    $numparam = "ssssssss"; //cantidad de caracteres debe ser igual al numero de parametros
    $stmt->bind_param($numparam,$documento,$nombres,$apellidos,$direccion,$telefono,$correo,$fecha,$id);
    $stmt->execute(); 
  if($stmt->affected_rows>0)//si elimino uno o mas reg
  {
    $respuesta['codigo']='OK';
    $respuesta['mensaje']='Registro Actualizado';
  }
}
 echo json_encode($respuesta);
?>
