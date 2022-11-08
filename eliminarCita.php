<?php
include 'includes/conecta.php';
$id = $_GET['id_citas'];
$eliminar = "DELETE FROM citas WHERE id_citas='$id'";
$elimina = $conecta->query($eliminar);
header("location:citas.php");
$conecta->close();
?>