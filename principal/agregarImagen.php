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
$id = $_GET['idmascota'];

$m = "SELECT idmascota FROM mascotas WHERE idmascota = '$id'";
$recuperar = $conecta -> query($m); 
$datos = $recuperar->fetch_array();

//Validar que exista un botón de enviar
if(isset($_POST['registrar'])){
    $mensaje =" ";
    $id_mascota = $conecta->real_escape_string($_POST['Idmascota']);
    $fecha_cita = $conecta->real_escape_string($_POST['FechaC']);
    $descripcion = $conecta->real_escape_string($_POST['Descripcion']);
    $horario = $conecta->real_escape_string($_POST['Horario']);
    $nombre_mascota = $conecta->real_escape_string($_POST['Nmascota']);
    $n_cliente = $conecta->real_escape_string($_POST['Ncliente']);

//verificar que no exista el usuario que se va a insertar en la tabla 
$verificar = "SELECT * FROM citas WHERE fecha_cita = '$fecha_cita' AND horario = '$horario'";
$validando = $conecta->query($verificar);

//si el numero de columnas es mayor a cero quiere decir que coincidio el correo y por lo tanto el usuario ya fue registrado
if($validando->num_rows > 0){
    $mensaje.="<div class='alert alert-danger d-flex align-items-center' role='alert'>
    <svg class='bi flex-shrink-0 me-2' role='img' aria-label='Success:'><use xlink:href='#check-circle-fill'/></svg>
        <div>
            cita no disponible
        </div>
    </div>
    "; 
}else{

//consulta para insertar los datos 
$insertar = "INSERT INTO citas (id_mascota,fecha_cita,descripcion,horario,nombre_mascota,n_cliente)VALUES('$id_mascota','$fecha_cita','$descripcion','$horario','$nombre_mascota','$n_cliente');";
$guardando = $conecta->query($insertar);
if($guardando > 0){
    $mensaje.="<div class='alert alert-success d-flex align-items-center' role='alert'>
    <svg class='bi flex-shrink-0 me-2' role='img' aria-label='Success:'><use xlink:href='#check-circle-fill'/></svg>
        <div>
            Su cita se agendo con exito
        </div>
    </div>
    ";
    header("location:citas.php");
}else{
    $mensaje.="<div class='alert alert-danger d-flex align-items-center' role='alert'>
    <svg class='bi flex-shrink-0 me-2' role='img' aria-label='Success:'><use xlink:href='#check-circle-fill'/></svg>
        <div>
            Su cita no pudo ser agendada
        </div>
    </div>
    ";

}
}

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Radiografía</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="icon" href="images/logo_basepet_2.png">
</head>
<body style="background-color: #A3D2CA;">
    <div class="container-fluid shadow p-3 w-50 h-40 mt-5" style="background-color: lightgray;">

        <h4 class="text-center">Anexar Radiografía</h4>
        <div class="col-sm-12 col-md-12 col-lg-12">
            <!--El encriptado debe estar en el formulario para subir imagenes ya que sin el no es posible agregarlas a la base de datos-->
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
                <label class="mt-2"><strong>Seleccione una imágen:</strong></label>
                    <input type="file" name="Radio" class="form-control-file" require>
                <label class="mt-2"><strong>Descripción:</strong></label>
                    <input type="text" name="DescripcionI" style="width:70%; height:200px;" autocorrect="on" class="form-control" require>
                    <!--el tipo hidden en el input es para que no sea visible pero el campo exista para poder recuperar datos-->
                    <input type="hidden" name="Idmascota" value="<?php echo $datos['idmascota'];?>">
                    <!--Botones de subir imagen y cancelar-->
                    <a class="btn btn-danger mt-5 mb-3 me-2" href="principal.php" role="button" style="margin-left:65%;">Cancelar</a>
                    <input type="submit" name="AgregarI" value="Guardar" class="btn btn-success mt-5 mb-3">
            </form>
        </div>
    </div>
    <?php //echo $mensaje;?> 
    <!--script de bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>