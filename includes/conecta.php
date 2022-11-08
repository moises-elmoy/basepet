<?php
//declarar las variables donde se guardaran los valores de la conexión
$servidor = "localhost";
$usuario = "root";
$password = "";
$db = "basepet";

$conecta = mysqli_connect($servidor, $usuario, $password, $db);
if($conecta->connect_error){
    die("error al conectar la base de datos de la pagina".$conecta->connect_error);
}

?>