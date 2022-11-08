<?php
include 'includes/conecta.php';
$id = $_GET['idempleado'];

$eliminar = "DELETE FROM empleados WHERE idempleado='$id'";
$elimina = $conecta->query($eliminar);
header("location:empleados.php");
$conecta->close();
?>