<?php
//sirve en este caso para que no mande error por la variable de mensaje ya que no tiene valor hasta que se presiona el boton enviar
error_reporting(0);
//recordar la variable de sesión
session_start();
include 'includes/conecta.php';

//validar que se cree una variable de sesion al pasar por el login
$visitante = $_SESSION['correo'];
if(!isset($visitante)){
    header("location:log.php");
}

//generar la consulta para extraer el id del cliente y de esta manera conectarlo con la mascota que se esta agregando
$id = $_GET['idcliente'];
$m = "SELECT idcliente FROM clientes WHERE idcliente = '$id'";
$modificar = $conecta -> query($m); 
$datos = $modificar->fetch_array();

//Validar que exista un botón de enviar
if(isset($_POST['registrar'])){
    $mensaje =" ";
    $nombre = $conecta->real_escape_string($_POST['Nombre']);
    $color = $conecta->real_escape_string($_POST['Color']);
    $genero = $conecta->real_escape_string($_POST['Genero']);
    $raza = $conecta->real_escape_string($_POST['Raza']);
    $especie = $conecta->real_escape_string($_POST['Especie']);
    $peso = $conecta->real_escape_string($_POST['Peso']);
    $edad = $conecta->real_escape_string($_POST['Edad']);
    $fecha = $conecta->real_escape_string($_POST['Fecha']);
    $iddueno = $conecta->real_escape_string($_POST['id']);

//consulta para insertar los datos 
$insertar = "INSERT INTO mascotas (nombre,color,genero,raza,especie,peso,edad,fecha,id_dueno)VALUES('$nombre','$color','$genero','$raza','$especie','$peso','$edad','$fecha',$iddueno);";
$guardando = $conecta->query($insertar);
if($guardando > 0){
    header("location:principal.php");
}else{
    $mensaje.="<div class='alert alert-success d-flex align-items-center' role='alert'>
    <svg class='bi flex-shrink-0 me-2' role='img' aria-label='Success:'><use xlink:href='#check-circle-fill'/></svg>
        <div>
            El registro se realizo con exito
        </div>
    </div>
    ";
}

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Nueva Mascota</title>
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
        <h4 class="text-center">Registrar Mascota</h4>
        <div class="col-sm-12 col-md-12 col-lg-12">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                    <!--el tipo hidden en el input es para que no sea visible pero el campo exista para poder recuperar datos al momento añadir el id del cliente-->
                    <input type="hidden" name="id" value="<?php echo $datos['idcliente'];?>">
                <label class="mt-2"><strong>Nombre:</strong></label>
                    <input type="text" name="Nombre" placeholder="Rocky" class="form-control" required>
                <label class="mt-2"><strong>Color:</strong></label>
                    <input type="text" name="Color" placeholder="Negro" class="form-control" required>
                <label class="mt-2"><strong>Género:</strong></label>
                    <select class="form-select" name="Genero" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">HEMBRA</option>
                        <option value="2">MACHO</option>
                    </select>
                <label class="mt-2"><strong>Raza:</strong></label>
                    <input type="text" name="Raza" placeholder="Bulldog" class="form-control" required>
                <label class="mt-2"><strong>Especie:</strong></label>
                    <select class="form-select" name="Especie" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">CONEJO</option>
                        <option value="2">CUYO</option>
                        <option value="3">ERIZO</option>
                        <option value="4">GATO</option>
                        <option value="5">PERRO</option>
                        <option value="6">REPTIL</option>
                        <option value="7">URON</option>
                    </select>
                <label class="mt-2"><strong>Peso(kg):</strong></label>
                    <input type="number" name="Peso" placeholder="6.5" class="form-control" min="0" max="120" step="0.1" required>
                <label class="mt-2"><strong>Edad(años):</strong></label>
                    <input type="number" name="Edad" placeholder="1" class="form-control" min="0" max="50" step="0.1" required>
                <label class="mt-2"><strong>Fecha de Nacimiento:</strong></label>
                    <input type="date" name="Fecha" class="form-control" placeholder="Fecha" require>

                    <a class="btn btn-danger mt-5 mb-3 me-2" href="clientes.php" role="button" style="margin-left:68%;">Cancelar</a>
                    <input type="submit" name="registrar" value="Registrar" class="btn btn-success mt-5 mb-3">
            </form>
        </div>
    </div>
    <?php echo $mensaje;?>
    <!--script de bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>