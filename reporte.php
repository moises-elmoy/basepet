<?php
//recordar la variable de sesión
session_start();
include 'includes/conecta.php';

//validar que se cree una variable de sesion al pasar por el login
$visitante = $_SESSION['correo'];
if(!isset($visitante)){
    header("location:log.php");
}

//generar la consulta para extraer los datos de la tabla mascotas
$id = $_GET['idmascota'];
$m = "SELECT * FROM mascotas WHERE idmascota = '$id'";
$seleccionar = $conecta -> query($m); 
$datos = $seleccionar->fetch_array();

//esta variable es para ponerle nombre al archivo
$n_archivo = $datos['nombre'];
//variable para buscar nombre del dueño de la mascota
$n_cliente = $datos['id_dueno'];
//generar la consulta para extraer los datos de la tabla clientes
$c = "SELECT * FROM clientes WHERE idcliente = '$n_cliente'";
$seleccionar_cliente = $conecta -> query($c); 
$datos_cliente = $seleccionar_cliente->fetch_array();

//generar la consulta para extraer los datos de la tabla vacunacion
$v = "SELECT * FROM vacunacion WHERE id_mascota = '$id'";
$seleccionar_vacuna = $conecta -> query($v); 
$datos_vacuna = $seleccionar_vacuna->fetch_array();

//Datos de la Tabla alimentacion
$alimento = "SELECT * FROM alimentacion WHERE id_mascota = '$id'";
$food = $conecta -> query($alimento); 
$datos_alimento = $food->fetch_array();

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

//Datos de la Tabla donde se almacenan las radiografias 
$radiografias= "SELECT * FROM imagenes WHERE id_paciente = '$id'";
$radio = $conecta -> query($radiografias); 
$datos_radio= $radio->fetch_array();


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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind:wght@300&display=swap" rel="stylesheet">
    <link rel="icon" href="images/logo_basepet_2.png">

</head>
<body style="margin-top:2px;margin-buttom:2px;border: darkcyan 2px solid;nfont-family: 'Hind', sans-serif;">
    
    <h1 class="text-center mt-2 mb-4 fw-bold">Historial Médico</h1>

    <div class="container text-center">
        <div class="row">
            <div class="col">
                <h4>Nombre:</h4>
            </div>
            <div class="col">
                <small class="text-muted"><?php echo $datos['nombre']?></small>
            </div>
            <div class="col">
                <h4>Raza:</h4>
            </div>
            <div class="col">
            <small class="text-muted"><?php echo $datos['raza']?></small> 
            </div>
            <div class="col">
                <h4>Nombre de dueño:</h4>
            </div>
            <div class="col">
            <small class="text-muted"><?php echo $datos_cliente['nombre_cliente']?> <?php echo $datos_cliente['apellido1']?> <?php echo $datos_cliente['apellido2']?></small> 
            </div>
        </div>

        <div class="row">
            <div class="col">
                <h4>Color:</h4>
            </div>
            <div class="col">
                <small class="text-muted"><?php echo $datos['color']?></small>
            </div>
            <div class="col">
                <h4>Género:</h4>
            </div>
            <div class="col">
            <small class="text-muted"><?php echo $datos['genero']?></small> 
            </div>
            <div class="col">
                <h4>Especie:</h4>
            </div>
            <div class="col">
            <small class="text-muted"><?php echo $datos['especie']?></small> 
            </div>
            <div class="col">
                <h4>Fecha de nacimiento:</h4>
            </div>
            <div class="col">
            <small class="text-muted"><?php echo $datos['fecha']?></small> 
            </div>
        </div>

        <div class="row">
            <div class="col">
                <h4>Edad:</h4>
            </div>
            <div class="col">
                <small class="text-muted"><?php echo $datos['edad']?> años</small>
            </div>
            <div class="col">
                <h4>Peso:</h4>
            </div>
            <div class="col">
            <small class="text-muted"><?php echo $datos['peso']?> kg</small> 
            </div>
        </div>
    </div>

    <!--Inicio de tabla vacunas-->
    <h4 class="text-center mt-3 mb-3">Vacunas vigentes</h4>
    <div class="container ms-1 me-5 col-md-8">
        <div>
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

    <!-- Tabla de los datos alimentacion-->
    <h4 class="text-center mt-5 mb-3">Alimentación</h4>
    <div class="container ms-3 me-5 col-md-8">
        <div>
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
    <!--Fin de tabla alimentación-->

    <!--Inicio de tabla  de datos Digestivo-->
    <h4 class="text-center mt-3 mb-3">Sistema Digestivo</h4>
    <div class="container ms-1 me-5 col-md-8">
        <div>
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
                        </tr>
                    </tbody>
                    </tbody>
                </table>
            </div>
        </div>     
    </div>

    <div class="container ms-3 me-5 mt-2 col-md-8">
        <div>
            <div class="table-responsive table-hover" id="TablaConsulta">
                <table class="table">
                    <thead class="text-muted">
                        <th class="text-center">Coproparasito</th>
                        <th class="text-center">Resultado</th>
                        <th class="text-center">Desparasitación</th>
                        <th class="text-center">Producto</th>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
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
    <h4 class="text-center mt-3 mb-3">Cardiovascular</h4>
    <div class="container ms-2 me-5 col-md-8">
        <div> 
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
    <h4 class="text-center mt-3 mb-3">Respiratorio</h4>
    <div class="container ms-2 me-5 col-md-8">
        <div>
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
    <h4 class="text-center mt-3 mb-3">Reproductor</h4>
    <div class="container ms-2 me-5 col-md-8">
        <div>
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
    <h4 class="text-center mt-3 mb-3">Examen Físico</h4>
    <div class="container ms-1 me-5 col-md-8">
        <div>
            <div class="table-responsive table-hover" id="TablaConsulta">
                <table class="table">
                    <thead class="text-muted">
                        <th class="text-center">Actitud</th>
                        <th class="text-center">Condución</th>
                        <th class="text-center">Hidratación</th>
                        <th class="text-center">Mandibulares</th>
                        <th class="text-center">Preescapulares</th>
                        <th class="text-center">Subaxilares</th>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <td class="text-center"><?php echo $datos_ef['actitud'];?></td>
                            <td class="text-center"><?php echo $datos_ef['condicion'];?></td>
                            <td class="text-center"><?php echo $datos_ef['hidratacion'];?></td>
                            <td class="text-center"><?php echo $datos_ef['madibulares'];?></td>
                            <td class="text-center"><?php echo $datos_ef['preescapulares'];?></td>
                            <td class="text-center"><?php echo $datos_ef['subaxilares'];?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>     
    </div>

    <div class="container ms-3 me-5 mt-2 col-md-8">
        <div>
            <div class="table-responsive table-hover" id="TablaConsulta">
                <table class="table">
                    <thead class="text-muted">
                        <th class="text-center">Ingunales</th>
                        <th class="text-center">Popliteos</th>
                        <th class="text-center">Parpados</th>
                        <th class="text-center">Piel</th>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
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
    <h4 class="text-center mt-3 mb-3">Cavidad Bucal</h4>
    <div class="container ms-3 me-5 col-md-8">
        <div>
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
    <h4 class="text-center mt-3 mb-3">Ojos</h4>
    <div class="container ms-3 me-5 col-md-8">
        <div>
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
    <h4 class="text-center mt-3 mb-3">Mucosas</h4>
    <div class="container ms-3 me-5 col-md-8">
        <div>
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
    <h4 class="text-center mt-3 mb-3">Auscultación: Sistema Respiratorio</h4>
    <div class="container ms-2 me-5 col-md-8">
        <div>
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
    <h4 class="text-center mt-5 mb-3">Auscultación: Sistema Cardíaco</h4>
    <div class="container ms-3 me-5 col-md-8">
        <div>
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
    <h4 class="text-center mt-3 mb-3">Palpación</h4>
    <div class="container ms-3 me-5 col-md-8">
        <div>
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
    <h4 class="text-center mt-3 mb-3">Constantes</h4>
    <div class="container ms-2 me-5 col-md-8">
        <div>
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
    <h4 class="text-center mt-3 mb-3">Músculo-Esquelético</h4>
    <div class="container ms-3 me-5 col-md-8">
        <div>
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
    <h4 class="text-center mt-3 mb-3">Tegumentario</h4>
    <div class="container ms-1 me-5 col-md-8">
        <div>
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
    <h4 class="text-center mt-3 mb-3">Sistema Nervioso</h4>
    <div class="container ms-1 me-5 col-md-8">
        <div>
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
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>     
    </div>

    <div class="container ms-3 me-5 mt-2 col-md-8">
        <div>
            <div class="table-responsive table-hover" id="TablaConsulta">
                <table class="table">
                    <thead class="text-muted">
                        <th class="text-center">Sordera</th>
                        <th class="text-center">Paresia</th>
                        <th class="text-center">Parálisis</th>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
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
    <h4 class="text-center mt-3 mb-3">Conducta</h4>
    <div class="container ms-1 me-5 col-md-8">
        <div>
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
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>     
    </div>

    <div class="container text-center mt-3 mb-3">
        <div class="row">
            <div class="col">
                <h6>Temor especifico:</h6>
            </div>
            <div class="col">
                <small class="text-muted"><?php echo $datos_cond['temor_especifico'];?></small>
            </div>
        </div>
    </div>
    <!--fin de tabla  de datos conducta -->

    <!--Inicio de tabla  de datos diagnostico -->
    <div class="container text-center mt-3 mb-3">
        <div class="row">
            <div class="col">
                <h4>Posibilidades de Diagnóstico</h4>
            </div>
            <div class="col">
                <small class="text-muted"><?php echo $datos_df['posibilidad_d'];?></small>
            </div>
            <div class="col">
                <h4>Receta</h4>
            </div>
            <div class="col">
            <small class="text-muted"><?php echo $datos_df['receta'];?></small> 
            </div>
            <div class="col">
                <h4>Dieta</h4>
            </div>
            <div class="col">
            <small class="text-muted"><?php echo $datos_df['dieta'];?></small> 
            </div>
        </div>
    </div>
                      
    <!--fin de tabla  de datos diagnostico -->

    <!--Muestra radiografias del animal-->
    <h4 class="text-center mt-5 mb-3">Radiografías</h4>
        <div class="card mt-3 mb-3" style="width: 30rem;margin-left:20%;">
            <!--indicamos el tipo de imagen que estamos extrayendo y tambien convertimos los binarios a base64 para que se pueda mostrar-->
            <img src="data:<?php echo $datos_radio['tipo'];?>;base64,<?php echo base64_encode($datos_radio['imagen']);?>" class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text"><b>Descripción:</b> <?php echo $datos_radio['descripcion_imagen'];?></p>
            </div>
        </div>

        <!--script de bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    
</body>
</html>
<?php
//aqui termina de guardar toda la pagina en la variable llamada html
$html = ob_get_clean();

//se incluye la liberia DOMPDF que esta en el archivo autoload.inc.php
require_once 'libreria/dompdf/autoload.inc.php';

//esto nos permite crear un objeto para poder utilizar todas las funcionalidades de dom
use Dompdf\Dompdf;
$dompdf = new Dompdf();

//las siguientes opciones nos permiten mostrar imagenes en nuestros pdf
$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));//aqui se activa la opcion de recuperar imagenes
$dompdf->setOptions($options);

//toma el contenido que esta en el html para poder guardarlo en pdf
$dompdf->loadHtml($html);
//en esta opcion indicamos el formato del documento, en este caso tamaño carta y forma vertical
$dompdf->setPaper('letter');
//aquí lo que se hace es tomar todo lo ya indicado en el html y lo pone en el pdf o visible
$dompdf->render();

//en la siguiente linea lo que se hace es indicar si se va a mostrar en el navegador o simplemente se descarga automatico
//tambien indicamos el nombre con el cual se va a descargar el archivo
$dompdf->stream("reporte_'$n_archivo'.pdf", array("Attachment" => false))//<- aqui si es falso se muestra en navegador y si es verdadero se descarga en automatico
?>