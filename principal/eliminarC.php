<?php
include 'includes/conecta.php';
$id = $_GET['idcliente'];

$eliminar = "DELETE FROM clientes WHERE idcliente='$id'";
$elimina = $conecta->query($eliminar);
header("location:clientes.php");
$conecta->close();
?>