<?php
//recordar la variable de sesión
session_start();
include 'includes/conecta.php';

//validar que se cree una variable de sesion al pasar por el login
$visitante = $_SESSION['correo'];
if(!isset($visitante)){
    header("location:log.php");
}

$id = $_GET['idmascota'];
$consulta = "SELECT * FROM mascotas WHERE idmascota = '$id'";
$ejecuta = $conecta->query($consulta);
//asocia toda la linea donde se encuentre la variable de sesion del correo del usuario
$row = $ejecuta->fetch_assoc();

//consultas de las distintas tablas de analisis de consulta de la mascota
//Datos de la Tabla alimentacion
$alimento = "SELECT * FROM alimentacion WHERE id_mascota = '$id'";
$food = $conecta -> query($alimento); 
$datos_alimento = $food->fetch_array();

//Datos de la Tabla vacunacion
$v = "SELECT * FROM vacunacion WHERE id_mascota = '$id'";
$seleccionar_vacuna = $conecta -> query($v); 
$datos_vacuna = $seleccionar_vacuna->fetch_array();

//Datos de la Tabla digestivo
$digestivo = "SELECT * FROM digestivo WHERE id_mascota = '$id'";
$dig = $conecta -> query($digestivo); 
$datos_digestivo = $dig->fetch_array();

//Datos de la Tabla cardiovascular
$cardiovascular = "SELECT * FROM cardiovascular WHERE id_mascota = '$id'";
$car_vas = $conecta -> query($cardiovascular); 
$datos_car_vas = $car_vas->fetch_array();

//Datos de la Tabla respiratorio
$respiratorio = "SELECT * FROM respiratorio WHERE id_mascota = '$id'";
$respi = $conecta -> query($respiratorio); 
$datos_respi= $respi->fetch_array();

//Datos de la Tabla reproductor
$reproductor = "SELECT * FROM reproductor WHERE id_mascota = '$id'";
$repro = $conecta -> query($reproductor); 
$datos_repro= $repro->fetch_array();

//Datos de la Tabla exafisico
$exafisico= "SELECT * FROM exafisico WHERE id_mascota = '$id'";
$ef = $conecta -> query($exafisico); 
$datos_ef= $ef->fetch_array();

//Datos de la Tabla bucal
$bucal= "SELECT * FROM bucal WHERE id_mascota = '$id'";
$cav_buc = $conecta -> query($bucal); 
$datos_cb= $cav_buc->fetch_array();

//Datos de la Tabla ojos
$ojos= "SELECT * FROM ojos WHERE id_mascota = '$id'";
$eyes = $conecta -> query($ojos); 
$datos_ojos= $eyes->fetch_array();

//Datos de la Tabla mucosas
$mucosas= "SELECT * FROM mucosas WHERE id_mascota = '$id'";
$muc = $conecta -> query($mucosas); 
$datos_muc= $muc->fetch_array();

//Datos de la Tabla auscultacion_r
$auscultacion_r= "SELECT * FROM auscultacion_r WHERE id_mascota = '$id'";
$au_r = $conecta -> query($auscultacion_r); 
$datos_au_r= $au_r->fetch_array();

//Datos de la Tabla auscultacion_c
$auscultacion_c= "SELECT * FROM auscultacion_c WHERE id_mascota = '$id'";
$au_c = $conecta -> query($auscultacion_c); 
$datos_au_c= $au_c->fetch_array();

//Datos de la Tabla palpacion
$palpacion= "SELECT * FROM palpacion WHERE id_mascota = '$id'";
$palp = $conecta -> query($palpacion); 
$datos_palp= $palp->fetch_array();

//Datos de la Tabla constantes
$constantes= "SELECT * FROM constantes WHERE id_mascota = '$id'";
$const = $conecta -> query($constantes); 
$datos_const= $const->fetch_array();

//Datos de la Tabla constantes
$constantes= "SELECT * FROM constantes WHERE id_mascota = '$id'";
$const = $conecta -> query($constantes); 
$datos_const= $const->fetch_array();

//Datos de la Tabla mus_esqueletico
$mus_esqueletico= "SELECT * FROM mus_esqueletico WHERE id_mascota = '$id'";
$me = $conecta -> query($mus_esqueletico); 
$datos_me= $me->fetch_array();

//Datos de la Tabla tegumentario
$tegumentario= "SELECT * FROM tegumentario WHERE id_mascota = '$id'";
$teg = $conecta -> query($tegumentario); 
$datos_teg= $teg->fetch_array();

//Datos de la Tabla nervioso
$nervioso= "SELECT * FROM nervioso WHERE id_mascota = '$id'";
$sisner = $conecta -> query($nervioso); 
$datos_sisner= $sisner->fetch_array();

//Datos de la Tabla conducta
$conducta= "SELECT * FROM conducta WHERE id_mascota = '$id'";
$cond = $conecta -> query($conducta); 
$datos_cond= $cond->fetch_array();

//Datos de la Tabla diagnostico
$diagnostico= "SELECT * FROM diagnostico WHERE id_mascota = '$id'";
$df = $conecta -> query($diagnostico); 
$datos_df= $df->fetch_array();
?>

<?php
include 'includes/conecta.php';

//consulta
//la variable where es para la busqueda, completa la consulta para mostrar el resultado en la tabla 

// $eventos = "SELECT * FROM eventos";
// $save = $conecta->query($eventos);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial mascota</title>
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
                <a class="nav-link active" aria-current="page" href="principal.php" title="Volver al inicio"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z"/>
                </svg></a>
            </li>
        </ul>
        <ul class="navbar-nav" style="margin-left: 90%;">
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
            <h1 class="display-2 ms-2" style="margin-right: 5%;"><strong><?php echo $row['nombre'];?> <?php echo $row['especie'];?> <?php echo $row['raza'];?> <?php echo $row['color'];?> <?php echo 'Peso: '.$row['peso'].'Kg';?> <?php echo 'Edad: '.$row['edad'];?> </strong></h1>
        </div>
        <div class="col-5">
            <!--Editar perfil-->
            <a style="margin-top:40%;" class="btn btn-warning" href="modificarPerfil.php?idmascota=<?php echo $row['idmascota'];?>" role="button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill text-white me-2" viewBox="0 0 16 16">
            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
            </svg>Editar perfíl</a>
            <!--Agregar un nuevo empleado-->
            <a style="margin-top:40%;" class="btn btn-success" href="consulta.php?idmascota=<?php echo $row['idmascota'];?>" role="button"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-person-plus me-2" viewBox="0 0 16 16">
            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
            <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
            </svg>Agregar consulta</a>
            <!--ver los usuarios empleados que se tienen registrados-->
            <a style="margin-top:40%;" class="btn btn-primary" href="principal.php" role="button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye me-2" viewBox="0 0 16 16">
            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
            </svg>visualizar mascotas</a>
        </div>
    </div>
    <!--Separador-->
    <span class="placeholder col-10 mt-3" style="background-color: #A3D2CA; margin-left:8%;"></span>

    <!--botón para generar PDF-->
    <a class="btn btn-primary mt-3" style="margin-left:80%;" href="reporte.php?idmascota=<?php echo $row['idmascota'];?>" role="button" title="Reporte en pdf del historial de la mascota">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z"/>
    </svg>
    Generar reporte
    </a>

    <!-- Tabla de los datos alimentacion-->
    <div class="container">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <h4 class="text-center mt-3">Alimentación</h4>
            <div class="table-responsive table-hover" id="TablaConsulta">
                <table class="table">
                    <thead class="text-muted">
                        <th class="text-center">Croquetas</th>
                        <th class="text-center">Comida Casera</th>
                        <th class="text-center">Hueso</th>
                        <th class="text-center">Frecuencia</th>
                        <th class="text-center">Agua</th>
                        <th class="text-center">Marca</th>
                        <th class="text-center">Cantidad</th>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <td class="text-center"><?php echo $datos_alimento['croquetas'];?></td>
                            <td class="text-center"><?php echo $datos_alimento['comida_casera'];?></td>
                            <td class="text-center"><?php echo $datos_alimento['huesos'];?></td>
                            <td class="text-center"><?php echo $datos_alimento['frecuencia'];?></td>
                            <td class="text-center"><?php echo $datos_alimento['agua'];?></td>
                            <td class="text-center"><?php echo $datos_alimento['marcas'];?></td>
                            <td class="text-center"><?php echo $datos_alimento['cantidad'];?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>     
    </div>

    <!--Inicio de tabla vacunas-->
    <div class="container">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <h4 class="text-center mt-3">Vacunas vigentes</h4>
            <div class="table-responsive table-hover" id="TablaConsulta">
                <table class="table">
                    <thead class="text-muted">
                        <th class="text-center">Moquillo</th>
                        <th class="text-center">Parvovirus</th>
                        <th class="text-center">Polivalente</th>
                        <th class="text-center">Bordetella</th>
                        <th class="text-center">Leptospira</th>
                        <th class="text-center">Triple felina</th>
                        <th class="text-center">Leucemia</th>
                        <th class="text-center">Rabia</th>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <td class="text-center"><?php echo $datos_vacuna['moquillo'];?></td>
                            <td class="text-center"><?php echo $datos_vacuna['parvovirus'];?></td>
                            <td class="text-center"><?php echo $datos_vacuna['polivalente'];?></td>
                            <td class="text-center"><?php echo $datos_vacuna['bordetella'];?></td>
                            <td class="text-center"><?php echo $datos_vacuna['leptospira'];?></td>
                            <td class="text-center"><?php echo $datos_vacuna['triple_felina'];?></td>
                            <td class="text-center"><?php echo $datos_vacuna['leucemia'];?></td>
                            <td class="text-center"><?php echo $datos_vacuna['rabia'];?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>     
    </div>
    <!--fin de tabla vacunas-->

    <!--Inicio de tabla  de datos Digestivo-->
    <div class="container">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <h4 class="text-center mt-3">Sistema Digestivo</h4>
            <div class="table-responsive table-hover" id="TablaConsulta">
                <table class="table">
                    <thead class="text-muted">
                        <th class="text-center">Apetito</th>
                        <th class="text-center">Vómito</th>
                        <th class="text-center">Frecuencia del vómito</th>
                        <th class="text-center">Evacuaciones</th>
                        <th class="text-center">Consistencia</th>
                        <th class="text-center">Cambio de Color</th>
                        <th class="text-center">Frecuencia de evacuaciones</th>
                        <th class="text-center">Coproparasito</th>
                        <th class="text-center">Resultado</th>
                        <th class="text-center">Desparasitación</th>
                        <th class="text-center">Producto</th>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <td class="text-center"><?php echo $datos_digestivo['apetito'];?></td>
                            <td class="text-center"><?php echo $datos_digestivo['vomito'];?></td>
                            <td class="text-center"><?php echo $datos_digestivo['frecuencia_v'];?></td>
                            <td class="text-center"><?php echo $datos_digestivo['evacuaciones'];?></td>
                            <td class="text-center"><?php echo $datos_digestivo['consistencia'];?></td>
                            <td class="text-center"><?php echo $datos_digestivo['cambio_color'];?></td>
                            <td class="text-center"><?php echo $datos_digestivo['frecuencia_e'];?></td>
                            <td class="text-center"><?php echo $datos_digestivo['coproparasit'];?></td>
                            <td class="text-center"><?php echo $datos_digestivo['resultado'];?></td>
                            <td class="text-center"><?php echo $datos_digestivo['desparasitacion'];?></td>
                            <td class="text-center"><?php echo $datos_digestivo['producto'];?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>     
    </div>
    <!--fin de tabla  de datos Digestivo-->

    <!--Inicio de tabla cardiovascular-->
    <div class="container">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <h4 class="text-center mt-3">Cardiovascular</h4>
            <div class="table-responsive table-hover" id="TablaConsulta">
                <table class="table">
                    <thead class="text-muted">
                        <th class="text-center">Disnea</th>
                        <th class="text-center">Sincopes</th>
                        <th class="text-center">Fatiga</th>
                        <th class="text-center">Letargo</th>
                        <th class="text-center">Ascitis</th>
                        <th class="text-center">Edema</th>
                        <th class="text-center">Palidez</th>
                        <th class="text-center">Cianosis</th>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <td class="text-center"><?php echo $datos_car_vas['disnea'];?></td>
                            <td class="text-center"><?php echo $datos_car_vas['sincopes'];?></td>
                            <td class="text-center"><?php echo $datos_car_vas['fatiga'];?></td>
                            <td class="text-center"><?php echo $datos_car_vas['letargo'];?></td>
                            <td class="text-center"><?php echo $datos_car_vas['ascitis'];?></td>
                            <td class="text-center"><?php echo $datos_car_vas['edema'];?></td>
                            <td class="text-center"><?php echo $datos_car_vas['palidez'];?></td>
                            <td class="text-center"><?php echo $datos_car_vas['cianosis'];?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>     
    </div>
    <!--fin de tabla cardiovascular-->

    <!--Inicio de tabla respiratorio-->
    <div class="container">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <h4 class="text-center mt-3">Respiratorio</h4>
            <div class="table-responsive table-hover" id="TablaConsulta">
                <table class="table">
                    <thead class="text-muted">
                        <th class="text-center">Tos</th>
                        <th class="text-center">Disnea</th>
                        <th class="text-center">Estornudos</th>
                        <th class="text-center">Mocos</th>
                        <th class="text-center">Secreción</th>
                        <th class="text-center">Polipnea</th>
                        <th class="text-center">Cianosis</th>
                        <th class="text-center">Leganas</th>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <td class="text-center"><?php echo $datos_respi['tos'];?></td>
                            <td class="text-center"><?php echo $datos_respi['disnea'];?></td>
                            <td class="text-center"><?php echo $datos_respi['estornudos'];?></td>
                            <td class="text-center"><?php echo $datos_respi['mocos'];?></td>
                            <td class="text-center"><?php echo $datos_respi['secrecion'];?></td>
                            <td class="text-center"><?php echo $datos_respi['polipnea'];?></td>
                            <td class="text-center"><?php echo $datos_respi['cianosis'];?></td>
                            <td class="text-center"><?php echo $datos_respi['leganas'];?></td>respi
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>     
    </div>
    <!--fin de tabla respiratorio-->

    <!--Inicio de tabla reproductor-->
    <div class="container">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <h4 class="text-center mt-3">Reproductor</h4>
            <div class="table-responsive table-hover" id="TablaConsulta">
                <table class="table">
                    <thead class="text-muted">
                        <th class="text-center">OVH</th>
                        <th class="text-center">Desecho Vulvar</th>
                        <th class="text-center">Lamido Excesivo</th>
                        <th class="text-center">Castrado</th>
                        <th class="text-center">Celos Regulares</th>
                        <th class="text-center">Ultima Fecha</th>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <td class="text-center"><?php echo $datos_repro['ovh'];?></td>
                            <td class="text-center"><?php echo $datos_repro['des_vulvar'];?></td>
                            <td class="text-center"><?php echo $datos_repro['lamido_exc'];?></td>
                            <td class="text-center"><?php echo $datos_repro['castrado'];?></td>
                            <td class="text-center"><?php echo $datos_repro['celos_reg'];?></td>
                            <td class="text-center"><?php echo $datos_repro['fecha_ultimo'];?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>     
    </div>
    <!--fin de tabla reproductor-->

    <!--Inicio de tabla  de datos exafisico-->
    <div class="container">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <h4 class="text-center mt-3">Examen Físico</h4>
            <div class="table-responsive table-hover" id="TablaConsulta">
                <table class="table">
                    <thead class="text-muted">
                        <th class="text-center">Actitud</th>
                        <th class="text-center">Condución</th>
                        <th class="text-center">Hidratación</th>
                        <th class="text-center">Mandibulares</th>
                        <th class="text-center">Preescapulares</th>
                        <th class="text-center">Subaxilares</th>
                        <th class="text-center">Ingunales</th>
                        <th class="text-center">Popliteos</th>
                        <th class="text-center">Parpados</th>
                        <th class="text-center">Piel</th>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <td class="text-center"><?php echo $datos_ef['actitud'];?></td>
                            <td class="text-center"><?php echo $datos_ef['condicion'];?></td>
                            <td class="text-center"><?php echo $datos_ef['hidratacion'];?></td>
                            <td class="text-center"><?php echo $datos_ef['madibulares'];?></td>
                            <td class="text-center"><?php echo $datos_ef['preescapulares'];?></td>
                            <td class="text-center"><?php echo $datos_ef['subaxilares'];?></td>
                            <td class="text-center"><?php echo $datos_ef['ingunales'];?></td>
                            <td class="text-center"><?php echo $datos_ef['popliteos'];?></td>
                            <td class="text-center"><?php echo $datos_ef['parpados'];?></td>
                            <td class="text-center"><?php echo $datos_ef['piel'];?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>     
    </div>
    <!--fin de tabla  de datos exafisico-->

    <!--Inicio de tabla  de datos bucal-->
    <div class="container">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <h4 class="text-center mt-3">Cavidad Bucal</h4>
            <div class="table-responsive table-hover" id="TablaConsulta">
                <table class="table">
                    <thead class="text-muted">
                        <th class="text-center">Dentadura</th>
                        <th class="text-center">Sarro</th>
                        <th class="text-center">Encias</th>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <td class="text-center"><?php echo $datos_cb['dentadura'];?></td>
                            <td class="text-center"><?php echo $datos_cb['sarro'];?></td>
                            <td class="text-center"><?php echo $datos_cb['encias'];?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>     
    </div>
    <!--fin de tabla  de datos bucal-->

    <!--Inicio de tabla  de datos ojos-->
    <div class="container">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <h4 class="text-center mt-3">Ojos</h4>
            <div class="table-responsive table-hover" id="TablaConsulta">
                <table class="table">
                    <thead class="text-muted">
                        <th class="text-center">Humedad</th>
                        <th class="text-center">Córnea</th>
                        <th class="text-center">Cristalino</th>
                        <th class="text-center">Vasos Episclerales</th>
                        <th class="text-center">Epífora</th>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <td class="text-center"><?php echo $datos_ojos['humedad'];?></td>
                            <td class="text-center"><?php echo $datos_ojos['cornea'];?></td>
                            <td class="text-center"><?php echo $datos_ojos['cristalino'];?></td>
                            <td class="text-center"><?php echo $datos_ojos['episcrerales'];?></td>
                            <td class="text-center"><?php echo $datos_ojos['epifora'];?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>     
    </div>
    <!--fin de tabla  de datos ojos-->

    <!--Inicio de tabla  de datos mucosas-->
    <div class="container">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <h4 class="text-center mt-3">Mucosas</h4>
            <div class="table-responsive table-hover" id="TablaConsulta">
                <table class="table">
                    <thead class="text-muted">
                        <th class="text-center">Conjuntiva</th>
                        <th class="text-center">Oral</th>
                        <th class="text-center">Vaginal</th>
                        <th class="text-center">Prepucial</th>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <td class="text-center"><?php echo $datos_muc['conjuntiva'];?></td>
                            <td class="text-center"><?php echo $datos_muc['oral'];?></td>
                            <td class="text-center"><?php echo $datos_muc['vaginal'];?></td>
                            <td class="text-center"><?php echo $datos_muc['prepucial'];?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>     
    </div>
    <!--fin de tabla  de datos mucosas-->

    <!--Inicio de tabla  de datos auscultacion_r-->
    <div class="container">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <h4 class="text-center mt-3">Auscultación: Sistema Respiratorio</h4>
            <div class="table-responsive table-hover" id="TablaConsulta">
                <table class="table">
                    <thead class="text-muted">
                        <th class="text-center">Tipo</th>
                        <th class="text-center">Profundidad</th>
                        <th class="text-center">Ritmo</th>
                        <th class="text-center">Sínodos</th>
                        <th class="text-center">Descripción</th>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <td class="text-center"><?php echo $datos_au_r['tipo'];?></td>
                            <td class="text-center"><?php echo $datos_au_r['profundidad'];?></td>
                            <td class="text-center"><?php echo $datos_au_r['ritmo'];?></td>
                            <td class="text-center"><?php echo $datos_au_r['sinodos'];?></td>
                            <td class="text-center"><?php echo $datos_au_r['describa'];?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>     
    </div>
    <!--fin de tabla  de datos auscultacion_r-->

    <!--Inicio de tabla  de datos auscultacion_c-->
    <div class="container">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <h4 class="text-center mt-3">Auscultación: Sistema Cardíaco</h4>
            <div class="table-responsive table-hover" id="TablaConsulta">
                <table class="table">
                    <thead class="text-muted">
                        <th class="text-center">Sonidos Valvulares</th>
                        <th class="text-center">Soplos Valvulares</th>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <td class="text-center"><?php echo $datos_au_c['sonidos_v'];?></td>
                            <td class="text-center"><?php echo $datos_au_c['soplos_v'];?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>     
    </div>
    <!--fin de tabla  de datos auscultacion_c-->

    <!--Inicio de tabla  de datos palpacion-->
    <div class="container">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <h4 class="text-center mt-3">Palpación</h4>
            <div class="table-responsive table-hover" id="TablaConsulta">
                <table class="table">
                    <thead class="text-muted">
                        <th class="text-center">Órgano</th>
                        <th class="text-center">Descripción</th>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <td class="text-center"><?php echo $datos_palp['organo'];?></td>
                            <td class="text-center"><?php echo $datos_palp['descripcion'];?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>     
    </div>
    <!--fin de tabla  de datos palpacion -->

    <!--Inicio de tabla  de datos constantes -->
    <div class="container">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <h4 class="text-center mt-3">Constantes</h4>
            <div class="table-responsive table-hover" id="TablaConsulta">
                <table class="table">
                    <thead class="text-muted">
                        <th class="text-center">Frecuencia Cardíaca</th>
                        <th class="text-center">Frecuencia Respiratoria</th>
                        <th class="text-center">Retorno Capilar</th>
                        <th class="text-center">Pulso</th>
                        <th class="text-center">Reflejo Pupilar</th>
                        <th class="text-center">Temperatura</th>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <td class="text-center"><?php echo $datos_const['frec_cardiaca'];?></td>
                            <td class="text-center"><?php echo $datos_const['frec_respiratoria'];?></td>
                            <td class="text-center"><?php echo $datos_const['retorno_capilar'];?></td>
                            <td class="text-center"><?php echo $datos_const['pulso'];?></td>
                            <td class="text-center"><?php echo $datos_const['ref_pupilar'];?></td>
                            <td class="text-center"><?php echo $datos_const['temperatura'];?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>     
    </div>
    <!--fin de tabla  de datos constantes -->

    <!--Inicio de tabla  de datos mus_esqueletico -->
    <div class="container">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <h4 class="text-center mt-3">Músculo-Esquelético</h4>
            <div class="table-responsive table-hover" id="TablaConsulta">
                <table class="table">
                    <thead class="text-muted">
                        <th class="text-center">Claudicación</th>
                        <th class="text-center">Marcha Anormal</th>
                        <th class="text-center">Miembro(s) Afectado(s)</th>
                        <th class="text-center">Dificultad para incorporarse</th>
                        <th class="text-center">Atrofia Muscular</th>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <td class="text-center"><?php echo $datos_me['claudicacion'];?></td>
                            <td class="text-center"><?php echo $datos_me['m_anormal'];?></td>
                            <td class="text-center"><?php echo $datos_me['miembro_afectado'];?></td>
                            <td class="text-center"><?php echo $datos_me['dif_incorporarse'];?></td>
                            <td class="text-center"><?php echo $datos_me['atro_muscular'];?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>     
    </div>
    <!--fin de tabla  de datos mus_esqueletico -->

    <!--Inicio de tabla  de datos tegumentario -->
    <div class="container">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <h4 class="text-center mt-3">Tegumentario</h4>
            <div class="table-responsive table-hover" id="TablaConsulta">
                <table class="table">
                    <thead class="text-muted">
                        <th class="text-center">Lesiones en la piel</th>
                        <th class="text-center">Características de las Lesiones</th>
                        <th class="text-center">Prurito</th>
                        <th class="text-center">Púlgas/Garrapatas</th>
                        <th class="text-center">Sacude la cabeza</th>
                        <th class="text-center">Frecuencia de baño</th>
                        <th class="text-center">Próducto Usado</th>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <td class="text-center"><?php echo $datos_teg['les_piel'];?></td>
                            <td class="text-center"><?php echo $datos_teg['car_lesiones'];?></td>
                            <td class="text-center"><?php echo $datos_teg['prurito'];?></td>
                            <td class="text-center"><?php echo $datos_teg['bichos'];?></td>
                            <td class="text-center"><?php echo $datos_teg['sac_cabeza'];?></td>
                            <td class="text-center"><?php echo $datos_teg['frec_bano'];?></td>
                            <td class="text-center"><?php echo $datos_teg['prod_utilizado'];?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>     
    </div>
    <!--fin de tabla  de datos tegumentario -->

    <!--Inicio de tabla  de datos nervioso -->
    <div class="container">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <h4 class="text-center mt-3">Sistema Nervioso</h4>
            <div class="table-responsive table-hover" id="TablaConsulta">
                <table class="table">
                    <thead class="text-muted">
                        <th class="text-center">Convulsiones</th>
                        <th class="text-center">Letargo</th>
                        <th class="text-center">Incontinencia fecal</th>
                        <th class="text-center">Incontinencia urinaria</th>
                        <th class="text-center">Inclinación de cabeza</th>
                        <th class="text-center">Mioclonias</th>
                        <th class="text-center">Ceguera</th>
                        <th class="text-center">Sordera</th>
                        <th class="text-center">Paresia</th>
                        <th class="text-center">Parálisis</th>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <td class="text-center"><?php echo $datos_sisner['convulsiones'];?></td>
                            <td class="text-center"><?php echo $datos_sisner['letargo'];?></td>
                            <td class="text-center"><?php echo $datos_sisner['inc_fecal'];?></td>
                            <td class="text-center"><?php echo $datos_sisner['inc_urinaria'];?></td>
                            <td class="text-center"><?php echo $datos_sisner['inclinacion_cabeza'];?></td>
                            <td class="text-center"><?php echo $datos_sisner['mioclonia'];?></td>
                            <td class="text-center"><?php echo $datos_sisner['ceguera'];?></td>
                            <td class="text-center"><?php echo $datos_sisner['sordera'];?></td>
                            <td class="text-center"><?php echo $datos_sisner['paresia'];?></td>
                            <td class="text-center"><?php echo $datos_sisner['paralisis'];?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>     
    </div>
    <!--fin de tabla  de datos nervioso -->

    <!--Inicio de tabla  de datos conducta -->
    <div class="container">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <h4 class="text-center mt-3">Conducta</h4>
            <div class="table-responsive table-hover" id="TablaConsulta">
                <table class="table">
                    <thead class="text-muted">
                        <th class="text-center">Agresión Ofensiva</th>
                        <th class="text-center">Agresión Defensiva</th>
                        <th class="text-center">Conducta Destructiva</th>
                        <th class="text-center">Eliminación Inadecuada</th>
                        <th class="text-center">Apetito Depravado</th>
                        <th class="text-center">Sociable</th>
                        <th class="text-center">Timidez</th>
                        <th class="text-center">Temor Específico</th>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <td class="text-center"><?php echo $datos_cond['agr_ofensiva'];?></td>
                            <td class="text-center"><?php echo $datos_cond['agr_defensiva'];?></td>
                            <td class="text-center"><?php echo $datos_cond['cond_destructiva'];?></td>
                            <td class="text-center"><?php echo $datos_cond['elim_inadecuada'];?></td>
                            <td class="text-center"><?php echo $datos_cond['ape_depravado'];?></td>
                            <td class="text-center"><?php echo $datos_cond['sociable'];?></td>
                            <td class="text-center"><?php echo $datos_cond['timidez'];?></td>
                            <td class="text-center"><?php echo $datos_cond['temor_especifico'];?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>     
    </div>
    <!--fin de tabla  de datos conducta -->

    <!--Inicio de tabla  de datos diagnostico -->
    <div class="container">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <h4 class="text-center mt-3">Diagnóstico Final</h4>
            <div class="table-responsive table-hover" id="TablaConsulta">
                <table class="table">
                    <thead class="text-muted">
                        <th class="text-center">Posibilidades de Diagnóstico</th>
                        <th class="text-center">Pruebas</th>
                        <th class="text-center">Receta</th>
                        <th class="text-center">Dieta</th>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <td class="text-center"><?php echo $datos_df['posibilidad_d'];?></td>
                            <td class="text-center"><?php echo $datos_df['pruebas'];?></td>
                            <td class="text-center"><?php echo $datos_df['receta'];?></td>
                            <td class="text-center"><?php echo $datos_df['dieta'];?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>     
    </div>
    <!--fin de tabla  de datos diagnostico -->

    <!--script de bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    
</body>
</html>