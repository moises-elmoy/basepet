<?php
//recordar la variable de sesión
session_start();
include 'includes/conecta.php';

//validar que se cree una variable de sesion al pasar por el login
$visitante = $_SESSION['correo'];
if(!isset($visitante)){
    header("location:log.php");
}

$consulta = "SELECT * FROM empleados WHERE correo = '$visitante'";
$ejecuta = $conecta->query($consulta);
//asocia toda la linea donde se encuentre la variable de sesion del correo del usuario
$row = $ejecuta->fetch_assoc();
?>

<?php
include 'includes/conecta.php';

//consulta
//la variable where es para la busqueda, completa la consulta para mostrar el resultado en la tabla 
$eventos = "SELECT * FROM eventos";
$save = $conecta->query($eventos);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi perfíl</title>
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
                <a class="nav-link" href="principal.php" title="Aquí puede observar las mascotas registradas">Mascotas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="citas.php" title="Aquí puede visualizar las citas que tiene pendientes">Citas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="clientes.php" title="Ver tabla de clientes y agregar mascotas">Clientes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="perfil.php" title="Aquí puede revisar su perfil">Perfil</a>
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

    <div class="row w-100 h-60" style="background-color: rgb(242, 244, 244);">
        <!--Foto perfil-->
        <div class="col-2">
        <div class="card ms-3 mt-2" style="width: 12rem;">
            <img src="images/fotopordefault.png" class="card-img-top" alt="...">
            <div class="card-body">
                <a href="#" class="btn btn-secondary me-3"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera text-white me-2" viewBox="0 0 16 16">
                <path d="M15 12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h1.172a3 3 0 0 0 2.12-.879l.83-.828A1 1 0 0 1 6.827 3h2.344a1 1 0 0 1 .707.293l.828.828A3 3 0 0 0 12.828 5H14a1 1 0 0 1 1 1v6zM2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2z"/>
                <path d="M8 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5zm0 1a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7zM3 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                </svg>Agregar foto</a>
            </div>
            </div>
        </div>
        <!--Nombre de usuario y botones-->
        <div class="col-5">
            <h1 class="display-2 ms-2" style="margin-right: 5%;"><strong><?php echo $row['nombre'];?> <?php echo $row['apellido1'];?> <?php echo $row['apellido2'];?></strong></h1>
        </div>
        <div class="col-5">
            <!--Editar perfil-->
            <a style="margin-top:40%;" class="btn btn-warning" href="modificarPerfil.php?idempleado=<?php echo $row['idempleado'];?>" role="button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill text-white me-2" viewBox="0 0 16 16">
            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
            </svg>Editar perfíl</a>
            <!--Agregar un nuevo empleado-->
            <a style="margin-top:40%;" class="btn btn-success" href="agregarPerfil.php" role="button"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-person-plus me-2" viewBox="0 0 16 16">
            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
            <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
            </svg>Agregar empleado</a>
            <!--ver los usuarios empleados que se tienen registrados-->
            <a style="margin-top:40%;" class="btn btn-primary" href="empleados.php" role="button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye me-2" viewBox="0 0 16 16">
            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
            </svg>visualizar empleados</a>
        </div>
    </div>
    <!--Separador-->
    <span class="placeholder col-10 mt-3" style="background-color: #A3D2CA; margin-left:8%;"></span>

    <!-- Tabla de Eventos -->

    <!--botón para eliminar elementos-->
    <a class="btn btn-danger mt-3" style="margin-left:80%;" href="eliminarEventos.php" role="button" title="Eliminar el historial">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
    </svg>
    </a>

    <div class="container">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <h3 class="text-center" style="margin-top:3%;">Historial</h3>
            <div class="table-responsive table-hover" id="TablaConsulta">
                <table class="table">
                    <thead class="text-muted">
                        <th class="text-center">Usuario</th>
                        <th class="text-center">Acción</th>
                        <th class="text-center">Fecha y Hora</th>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php while($row = $save->fetch_assoc()){?>
                        <tr>
                            <td class="text-center"><?php echo $row['usuario'];?></td>
                            <td class="text-center"><?php echo $row['accion'];?></td>
                            <td class="text-center"><?php echo $row['fecha_hora'];?></td>
                            </td>
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