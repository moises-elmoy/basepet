<?php
//recordar la variable de sesión
session_start();
include 'includes/conecta.php';

//validar que se cree una variable de sesion al pasar por el login
$visitante = $_SESSION['correo'];
if(!isset($visitante)){
    header("location:log.php");
}

//generar la consulta para extraer los datos
$id = $_GET['idmascota'];
$m = "SELECT * FROM mascotas WHERE idmascota = '$id'";
$modificar = $conecta -> query($m); 
$datos = $modificar->fetch_array();

//se llena el bufer para guardar la pagina html en una variable y de esta manera poder convertirlo con DOMPDF
ob_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte</title>
    <link rel="stylesheet" href="principal.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="icon" href="images/logo_basepet_2.png">

</head>
<body>
    
    <h1 class="text-center">Historial Médico</h1>

    <h4>Nombre: <small class="text-muted"><?php echo $datos['nombre']?></small> </h4>
    <h4>Raza: <small class="text-muted"><?php echo $datos['raza']?></small> </h4>
    <h4>Color: <small class="text-muted"><?php echo $datos['color']?></small> </h4>
    <h4>Género: <small class="text-muted"><?php echo $datos['raza']?></small> </h4>
    <h4>Especie: <small class="text-muted"><?php echo $datos['especie']?></small> </h4>
    <h4>Peso: <small class="text-muted"><?php echo $datos['peso']?> Kg</small> </h4>
    <h4>Edad: <small class="text-muted"><?php echo $datos['edad']?> Años</small> </h4>
    <h4>Fecha de nacimiento: <small class="text-muted"><?php echo $datos['fecha']?></small> </h4>

    <!--script de bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    
</body>
</html>
<?php
//aqui termina de guardar toda la pagina en la variable llamada html
$html = ob_get_clean();


?>