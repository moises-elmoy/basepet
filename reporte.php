<?php
//recordar la variable de sesión
session_start();
include 'includes/conecta.php';

//validar que se cree una variable de sesion al pasar por el login
$visitante = $_SESSION['correo'];
if(!isset($visitante)){
    header("location:log.php");
}

//generar la consulta para extraer los datos
$id = $_GET['idmascota'];
$m = "SELECT * FROM mascotas WHERE idmascota = '$id'";
$modificar = $conecta -> query($m); 
$datos = $modificar->fetch_array();

$n_archivo = $datos['nombre'];

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
    <link rel="stylesheet" href="pdf.css">
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
<body style="margin: 5px; border:darkcyan 5px solid; font-family: 'Hind', sans-serif;">
    
    <h1 class="text-center mt-2 mb-2 fw-bold">Historial Médico</h1>

    <p>
        <h4 style="font-family: 'Hind', sans-serif;" class="ms-3 me-3 fw-semibold">Nombre: <small class="text-muted"><?php echo $datos['nombre']?></small> </h4>
        <h4 style="font-family: 'Hind', sans-serif;" class="ms-3 me-3 fw-semibold">Raza: <small class="text-muted"><?php echo $datos['raza']?></small> </h4>
        <h4 style="font-family: 'Hind', sans-serif;" class="ms-3 me-3 fw-semibold">Color: <small class="text-muted"><?php echo $datos['color']?></small> </h4>
        <h4 style="font-family: 'Hind', sans-serif;" class="ms-3 me-3 fw-semibold">Género: <small class="text-muted"><?php echo $datos['raza']?></small> </h4>
        <h4 style="font-family: 'Hind', sans-serif;" class="ms-3 me-3 fw-semibold">Especie: <small class="text-muted"><?php echo $datos['especie']?></small> </h4>
        <h4 style="font-family: 'Hind', sans-serif;" class="ms-3 me-3 fw-semibold">Peso: <small class="text-muted"><?php echo $datos['peso']?> Kg</small> </h4>
        <h4 style="font-family: 'Hind', sans-serif;" class="ms-3 me-3 fw-semibold">Edad: <small class="text-muted"><?php echo $datos['edad']?> Años</small> </h4>
        <h4 style="font-family: 'Hind', sans-serif;" class="ms-3 me-3 fw-semibold">Fecha de nacimiento: <small class="text-muted"><?php echo $datos['fecha']?></small> </h4>
    </p>
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