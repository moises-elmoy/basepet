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
<body style="font-family: 'Hind', sans-serif;">
    
    <h1 class="text-center mt-2 mb-4 fw-bold">Historial Médico</h1>

    <div class="container">
        <div class="row row-cols-6">
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

        <div class="row row-cols-8">
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

        <div class="row row-cols-4">
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
    <div class="container ms-1 col-md-8">
        <div>
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