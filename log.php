<?php
session_start();
error_reporting(0);
//llama a la conexion de la base de datos
include 'includes/conecta.php';
if(isset($_POST['button_enviar'])){
	//limpiar los campos de texto de alguna inyeccion mysql
$user = $conecta->real_escape_string($_POST['correo']);
$pass = $conecta->real_escape_string(md5($_POST['contra']));
//generar una consulta que extraiga los datos de la base de datos de la tabla empleados
$consulta = "SELECT * FROM empleados WHERE correo = '$user' AND contra = '$pass'";
//generar una consulta que extraiga los datos de la base de datos de la tabla clientes
$consulta_cliente = "SELECT * FROM clientes WHERE correo = '$user' AND pass = '$pass'";

if($resultado = $conecta->query($consulta)){
	while($row = $resultado->fetch_array()){
		$userok = $row['correo'];
		$passwordok = $row['contra'];
	}
	$resultado->close();
}

if($resultado = $conecta->query($consulta_cliente)){
	while($row = $resultado->fetch_array()){
		$clienteok = $row['correo'];
		$password_clienteok = $row['pass'];
	}
	$resultado->close();
}

$visitante = $userok;
$cliente = $clienteok;
$conecta->close();
if(isset($user) && isset($pass)){
	if($user == $userok && $pass == $passwordok){
		$_SESSION['login'] = TRUE;
		$_SESSION['correo'] = $visitante;
		header("location:principal.php");
	}
}else{
	$mensaje.="<h1 style='color:red;'>Hubo un problema con los datos, intente de nuevo</h1>";
}

if(isset($user) && isset($pass)){
	if($user == $clienteok && $pass == $password_clienteok){
		$_SESSION['login'] = TRUE;
		$_SESSION['correo'] = $cliente;
		header("location:viewbasic.php");
	}
}else{
	$mensaje.="<h1 style='color:red;'>Hubo un problema con los datos, intente de nuevo</h1>";
}

}
?>

<!DOCTYPE html>
<html>
    
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>BasePet</title>
    <meta charset="UTF-8">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="log.css" >
  	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="icon" href="images/logo_basepet_2.png">
</head>

<body>
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="images/logo_basepet_2.png" class="brand_logo" alt="Logo">
					</div>
				</div>
				<div class="d-flex justify-content-center form_container">
				<h1 class="text-white">Iniciar Sesión</h1>
				</div>
					<div class="d-flex justify-content-center form_container" style="margin-top:10%;">
						<form action="<?php echo $SERVER['PHP_SELF']?>" method="post">
						<div class="input-group mb-3">
							<div class="input-group-append">
								<div class="input-group-text">
									<span class="material-icons" >account_circle</span>
								</div>						
							</div>
							<input type="email" name="correo" class="form-control input_user" placeholder="correo">
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<div class="input-group-text">
									<span class="material-icons" >vpn_key</span>
								</div>	
							</div>
							<input type="password" name="contra" class="form-control input_pass" placeholder="contraseña">
						</div>
						<div class="d-flex justify-content-center mt-3 login_container">
							<button type="submit" name="button_enviar" class="btn btn-outline-primary" style="width:80%;">Entrar</button>
						</div>
						</form>	
					</div>
			</div>
		</div>
		<?php echo $mensaje?>
	</div>
	<!--script de bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>
