<?php
$host='xxxx'; #Direccion del host (si es local se vera asi localhost:xxxx)
$user='xxxx'; #usuario de la base de datos
$password='xxxx'; #Contraseña que se tiene en la base de datos
$database='xxxx'; #Nombre de la base de datos con la que se va a trabajar
$mysqli= new mysqli($host,$user,$password,$database);
if($mysqli->connect_errno)
{
  echo "Error - No se pudo conectar a la BD: ".$mysqli->connect_errno.'<br>';
}