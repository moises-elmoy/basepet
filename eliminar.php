<?php
include 'includes/conecta.php';
$id = $_GET['idmascota'];

$eliminar = "DELETE FROM mascotas WHERE idmascota='$id'";
$elimina = $conecta->query($eliminar);
header("location:principal.php");
$conecta->close();
?>