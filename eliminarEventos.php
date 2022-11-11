<?php
include 'includes/conecta.php';

$eliminar = "DELETE FROM eventos";
$elimina = $conecta->query($eliminar);
header("location:perfil.php");
$conecta->close();
?>