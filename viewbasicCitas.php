<?php
//recordar la variable de sesión
session_start();
include 'includes/conecta.php';

//validar que se cree una variable de sesion al pasar por el login
$cliente = $_SESSION['correo'];
if(!isset($cliente)){
    header("location:log.php");
}

$consulta = "SELECT * FROM clientes WHERE correo = '$cliente'";
$ejecuta = $conecta->query($consulta);
//asocia toda la linea donde se encuentre la variable de sesion del correo del usuario
//$columna = $ejecuta->fetch_assoc();

?>

<?php
include 'includes/conecta.php';

//consulta
$registrosM = "SELECT * FROM mascotas AS m INNER JOIN clientes AS c ON m.id_dueno=c.idcliente AND c.correo = '$cliente';";
$guardar = $conecta->query($registrosM);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="principal.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="icon" href="images/logo_basepet_2.png">

</head>
<body>
    <!--Barra de navegación-->
    <nav class="navbar navbar-expand-lg" style="background-color: #A3D2CA;">
    <div class="container-fluid">
        <button class="navbar-toggler" style="background-color: white;" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
        </svg></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="viewbasic.php" title="Aquí puede observar las mascotas registradas">Mis mascotas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="viewbasicCitas.php" title="Aquí puede visualizar las citas que tiene pendientes">Mis citas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="viewbasicPerfil.php" title="Aquí puede revisar su perfil">Mi perfil</a>
            </li>
        </ul>
        <ul class="navbar-nav" style="margin-left: 75%;">
            <li class="nav-item">
                <a class="btn btn-danger me-2" role="button" href="includes/cerrars.php" title="Cerrar Sesión">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-power" viewBox="0 0 16 16" style="margin-left:1%;">
                        <path d="M7.5 1v7h1V1h-1z"/>
                        <path d="M3 8.812a4.999 4.999 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812z"/>
                    </svg>
                </a>
            </li>
        </ul>
        </div>
    </div>
    </nav>
    <!--Fin de barra de navegación-->
    <div class="container">
        <div class="col-sm-12 col-md-12 col-lg-12">
        <h3 class="text-center mt-3 mb-5" >Mis citas</h3>
            <div class="table-responsive table-hover" id="TablaConsulta">
                <table class="table">
                    <thead class="text-muted">
                        <th class="text-center">Nombre Mascota</th>
                        <th class="text-center">Descripción</th>
                        <th class="text-center">Fecha</th>
                        <th class="text-center">Hora</th>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php while($row = $guardar->fetch_assoc()){?>
                        <tr>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                        </tr>

                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>     
    </div>
    <!--script de bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>