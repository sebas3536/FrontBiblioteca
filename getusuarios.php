<?php
// Api para retornar un usuario o un listado de usuarios
//---------- getusuario-----------------
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requestes-Whit, Content-Type, Accept');
header("Content-Type: application/json; charset=UTF-8");
header('Content-Type: application/json');
//header("Access-Control-Allow-Headers", "Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
//header("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE, OPTIONS");
$json=file_get_contents('php://input');//captura el parametro en json {'id':118}
$params=json_decode($json);//paramteros
require('conexion.php');

$respuesta['codigo']='-1';
$respuesta['mensaje']='No hay registros';
$method = $_SERVER['REQUEST_METHOD'];//Cual es el metdodo de acceso (GET,PUT,POST,DELET PATCH)
if($method!='GET')
{
  $respuesta['mensaje']='Erros acceso no permitido por este método..';
  echo json_encode($respuesta);
  exit(1);
}
// si le enviamos parametros
$sql="select * from usuarios order by id";
if(isset($params))//si recibe una variable por get llamada 'id'
{
    $id=$params->id;
    $sql="select * from usuarios where id=".$id;
}

$result=$mysqli->query($sql);//hace la consulta en la BD
if(mysqli_num_rows($result)>0)//si trajo registro
{
    $registros=mysqli_fetch_all($result,MYSQLI_ASSOC);//registr['id']=1,registr['nombres']='pedro'
    // conv los reg en array asociativos
    echo json_encode($registros);// {'id':1,'nombres':'pedro'}
}
else
{
    echo json_encode($respuesta);//{'codigo':'-1','mensaje':'No hay reg'}
}
?>
