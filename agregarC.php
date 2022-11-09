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

//Validar que exista un botón de enviar
if(isset($_POST['registrar'])){
    $mensaje =" ";
    $nombre = $conecta->real_escape_string($_POST['Nombre']);
    $apellido1 = $conecta->real_escape_string($_POST['Apellido1']);
    $apellido2 = $conecta->real_escape_string($_POST['Apellido2']);
    $correo = $conecta->real_escape_string($_POST['Correo']);
    // $contra = $conecta->real_escape_string(md5($_POST['Contra']));
    $telefono = $conecta->real_escape_string($_POST['Telefono']);
    $direccion = $conecta->real_escape_string($_POST['Direccion']);
    $colonia = $conecta->real_escape_string($_POST['Colonia']);

    $default = $conecta->real_escape_string(md5("bienvenido"));

//verificar que no exista el usuario que se va a insertar en la tabla 
$verificar = "SELECT * FROM clientes WHERE correo = '$correo'";
$validando = $conecta->query($verificar);

//si el numero de columnas es mayor a cero quiere decir que coincidio el correo y por lo tanto el usuario ya fue registrado
if($validando->num_rows > 0){
    $mensaje.="<div class='alert alert-danger d-flex align-items-center' role='alert'>
    <svg class='bi flex-shrink-0 me-2' role='img' aria-label='Success:'><use xlink:href='#check-circle-fill'/></svg>
        <div>
            El usuario ya existe y no es posible realizar el registro 
        </div>
    </div>
    "; 
}else{
    //si da cero entonces pasa a esta parte donde ya se agrega 
    //consulta para insertar los datos 
    $insertar = "INSERT INTO clientes (nombre_cliente,apellido1,apellido2,correo,pass,telefono,direccion,colonia)VALUES('$nombre','$apellido1','$apellido2','$correo','$default','$telefono','$direccion','$colonia');";
    $guardando = $conecta->query($insertar);
    if($guardando > 0){
        $mensaje.="<div class='alert alert-success d-flex align-items-center' role='alert'>
        <svg class='bi flex-shrink-0 me-2' role='img' aria-label='Success:'><use xlink:href='#check-circle-fill'/></svg>
            <div>
                El registro se realizo con exito
            </div>
        </div>
        ";
        header("location:clientes.php");
    }else{
        $mensaje.="<div class='alert alert-danger d-flex align-items-center' role='alert'>
        <svg class='bi flex-shrink-0 me-2' role='img' aria-label='Success:'><use xlink:href='#check-circle-fill'/></svg>
            <div>
                El registro no se pudo realizar con exito
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
    <title>Registrar Nuevo Cliente</title>
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
        <h4 class="text-center">Registrar Cliente</h4>
        <div class="col-sm-12 col-md-12 col-lg-12">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                <label for="nombre" class="mt-2"><strong>Nombre:</strong></label>        
                    <div class="row">
                        <input type="text" id="nombre" name="Nombre" class="form-control" placeholder="Nombre" require>
                    </div>
                <label for="A1" class="mt-2"><strong>Primer Apellido:</strong></label>
                    <div class="row">
                        <input type="text" id="A1" name="Apellido1" class="form-control" placeholder="Primer Apellido" require>
                    </div>
                <label for="A2" class="mt-2"><strong>Segundo Apellido:</strong></label>
                    <div class="row">
                        <input type="text" id="A2" name="Apellido2" class="form-control" placeholder="Segundo Apellido">
                    </div>
                <label for="correo" class="mt-2"><strong> electrónico:</strong></label>
                    <div class="row">
                        <input type="email" id="correo" name="Correo" class="form-control" placeholder="correo@ejemplo.com" require>
                    </div>
                <label for="telefono" class="mt-2"><strong>Telefono:</strong></label>
                    <div class="row">
                        <input type="number" id="telefono" name="Telefono" class="form-control" max="99999999999" placeholder="Télefono celular o de casa " require>
                    </div>
                <label for="direccion" class="mt-2"><strong>Dirección:</strong></label>
                    <div class="row">
                        <input type="text" id="direccion" name="Direccion" class="form-control" placeholder="calle ejemplo #123" require>
                    </div>
                <label for="colonia" class="mt-2"><strong>Colonia:</strong></label>
                    <div class="row">
                        <input type="text" id="colonia" name="Colonia" class="form-control" placeholder="Colonia Centro" require>
                    </div>

                    <a class="btn btn-danger mt-5 mb-3 me-2" href="clientes.php" role="button" style="margin-left:68%;">Cancelar</a>
                    <input type="submit" name="registrar" class="btn btn-success mt-5 mb-3" value="Registrar" require>

            </form>
        </div>
    </div>
    <?php echo $mensaje;?>
    <!--script de bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>