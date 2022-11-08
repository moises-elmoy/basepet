<?php
$mascota_upg = "CREATE TRIGGER `mascota_upg` AFTER UPDATE ON `mascotas` FOR EACH ROW INSERT INTO eventos (usuario, accion) VALUES (USER(),(concat('Registro actualizado para:',old.nombre,' ',old.color,' ',old.genero,' ',old.raza,' ',old.especie,' ',old.peso,' ',old.edad,' ','-->',new.nombre, ' ',new.color,' ',new.genero,' ',new.raza,' ',new.especie,' ',new.peso,' ',new.edad)))"

echo "Success";
?>



