<?php
session_start();
include 'includes/conecta.php';
$visitante = $_SESSION['correo'];
if(!isset($visitante)){
    header("location:log.php");
}

//generar la consulta para extraer los datos
$id = $_GET['idmascota'];
$m = "SELECT * FROM mascotas WHERE idmascota = '$id'";
$modificar = $conecta -> query($m); 
$datos = $modificar->fetch_array();

if(isset($_POST['modificar'])){
//recuperar los datos que se encuentran en cada unos de los inputs del formulario
$id = $_POST['id'];
$nombre = $_POST['mNombre'];
$color = $_POST['mColor'];
$genero = $_POST['mGenero'];
$raza = $_POST['mRaza'];
$especie = $_POST['mEspecie'];
$peso = $_POST['mPeso'];
$edad = $_POST['mEdad'];
$fecha = $_POST['mFecha'];
//consulta para modificar los datos
$actualiza = "UPDATE mascotas SET nombre='$nombre', color='$color', genero='$genero', raza='$raza', especie='$especie', peso='$peso', edad='$edad', fecha='$fecha' WHERE idmascota='$id'";
$actuaizar = $conecta -> query($actualiza);
header("location:perfilM.php"); 

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

    <div class="container-fluid shadow p-3 w-50 h-60 mt-5 mb-5" style="background-color: lightgray;">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <h3 class="text-center">Editar Mascota</h3>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                <div class="row mt-4">
                    <!--el tipo hidden en el input es para que no sea visible pero el campo exista para poder recuperar datos al memento de modificar-->
                    <input type="hidden" name="id" value="<?php echo $datos['idmascota'];?>">
                    <input type="text" name="mNombre" class="form-control" value="<?php echo $datos['nombre'];?>" require>
                </div>
                <div class="row mt-3">
                    <input type="text" name="mColor" class="form-control" value="<?php echo $datos['color'];?>" require>
                </div>
                <div class="row mt-3">
                    <select class="form-select" name="mGenero" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">HEMBRA</option>
                        <option value="2">MACHO</option>
                    </select>
                </div>
                <div class="row mt-3">
                    <input type="text" name="mRaza" class="form-control" value="<?php echo $datos['raza'];?>" require>
                </div>
                <div class="row mt-3">
                    <select class="form-select" name="mEspecie" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">CONEJO</option>
                        <option value="2">CUYO</option>
                        <option value="3">ERIZO</option>
                        <option value="4">GATO</option>
                        <option value="5">PERRO</option>
                        <option value="6">REPTIL</option>
                        <option value="7">URON</option>
                    </select>
                </div>
                <div class="row mt-3">
                    <input type="number" name="mPeso" class="form-control" value="<?php echo $datos['peso'];?>" min="0" max="120" step="0.1" require>
                </div>
                <div class="row mt-3">
                    <input type="number" name="mEdad" class="form-control" value="<?php echo $datos['edad'];?>" min="0" max="50" step="0.1" require>
                </div>
                <div class="row mt-3">
                    <input type="date" name="mFecha" class="form-control" value="<?php echo $datos['fecha'];?>" placeholder="Fecha" require>
                </div>
                <a class="btn btn-danger mt-5 mb-3 me-2" href="perfilM.php?idmascota=<?php echo $datos['idmascota'];?>" role="button" style="margin-left:70%;">Cancelar</a>
                    <input type="submit" name="modificar" class="btn btn-success mt-5 mb-3" value="Editar" require>


            </form>
        </div>
    </div>
    <!--script de bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>