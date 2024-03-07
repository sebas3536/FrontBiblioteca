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
$respuesta['mensaje']='No se puede eliminar el registro';
$method = $_SERVER['REQUEST_METHOD'];//Cual es el metdodo de acceso (GET,PUT,POST,DELET PATCH)
if($method!='DELETE')
{
  $respuesta['mensaje']='Erros acceso no permitido por este método..';
  echo json_encode($respuesta);
  exit(1);
}
if(isset($params))//si recibe una variable por get llamada 'id'
{
    $id=$params->id;
    $sql="delete from usuarios where id=".$id;
}
$result=$mysqli->query($sql);//hace la consulta en la BD
if($mysqli->affected_rows>0)//si elimino uno o mas reg
{
  $respuesta['codigo']='OK';
  $respuesta['mensaje']='Registro eliminado';
}
 echo json_encode($respuesta);
?>
