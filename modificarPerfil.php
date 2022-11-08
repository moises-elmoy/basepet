<?php
session_start();
include 'includes/conecta.php';
$visitante = $_SESSION['correo'];
if(!isset($visitante)){
    header("location:log.php");
}

//generar la consulta para extraer los datos
$id = $_GET['idempleado'];
$m = "SELECT * FROM empleados WHERE idempleado = '$id'";
$modificar = $conecta -> query($m); 
$datos = $modificar->fetch_array();

if(isset($_POST['modificar'])){
//recuperar los datos que se encuentran en cada unos de los inputs del formulario
$id = $_POST['id'];
$nombre = $_POST['eNombre'];
$apellido1 = $_POST['eApellido1'];
$apellido2 = $_POST['eApellido2'];
$correo = $_POST['eCorreo'];
//consulta para modificar los datos
$edita = "UPDATE empleados SET nombre='$nombre', apellido1='$apellido1', apellido2='$apellido2', correo='$correo' WHERE idempleado='$id'";
$editar = $conecta -> query($edita);
header("location:perfil.php"); 

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BasePet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="icon" href="images/logo_basepet_2.png">
</head>
<body style="background-color: #A3D2CA;">
    <div class="container-fluid shadow p-3 w-50 h-60 mt-5" style="background-color: lightgray;">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <h3 class="text-center">Editar Perfil</h3>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                <div class="row mt-3">
                    <!--el tipo hidden en el input es para que no sea visible pero el campo exista para poder recuperar datos al momento de modificar-->
                    <input type="hidden" name="id" value="<?php echo $datos['idempleado'];?>">
                    <input type="text" name="eNombre" class="form-control" value="<?php echo $datos['nombre'];?>" require>
                </div>
                <div class="row mt-3">
                    <input type="text" name="eApellido1" class="form-control" value="<?php echo $datos['apellido1'];?>" require>
                </div>
                <div class="row mt-3">
                    <input type="text" name="eApellido2" class="form-control" value="<?php echo $datos['apellido2'];?>">
                </div>
                <div class=" mt-3">
                    <input type="email" name="eCorreo" class="form-control" value="<?php echo $datos['correo'];?>" require>
                </div>
                <a class="btn btn-danger mt-5 mb-3 me-2" href="perfil.php" role="button" style="margin-left:70%;">Cancelar</a>
                <input type="submit" name="modificar" class="btn btn-success mt-5 mb-3" value="Editar" require>
            </form>
        </div>
    </div>
    <!--script de bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>