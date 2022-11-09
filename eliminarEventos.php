<?php
include 'includes/conecta.php';
// $id = $_GET['id_ev'];

$eliminar = "DELETE FROM eventos";
$elimina = $conecta->query($eliminar);
header("location:perfil.php");
$conecta->close();
?>