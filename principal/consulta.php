<?php
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
$m = "SELECT * FROM mascotas WHERE idmascota = '$id'";
$seleccionar = $conecta -> query($m); 
$datos = $seleccionar->fetch_array();

//Validar que exista un botón de enviar
if(isset($_POST['registrar'])){
    $mensaje =" ";
    //datos alimentación
    $id_mascota = $conecta->real_escape_string($_POST['id']);
    $croquetas = $conecta->real_escape_string($_POST['Croquetas']);
    $comida_casera = $conecta->real_escape_string($_POST['Comida_casera']);
    $huesos = $conecta->real_escape_string($_POST['Huesos']);
    $frecuencia = $conecta->real_escape_string($_POST['Frecuencia']);
    $agua = $conecta->real_escape_string($_POST['Agua']);
    $marca = $conecta->real_escape_string($_POST['Marca']);
    $cantidad = $conecta->real_escape_string($_POST['Cantidad']);
    //datos vacunación
    $moquillo = $conecta->real_escape_string($_POST['Moquillo']);
    $parvo = $conecta->real_escape_string($_POST['Parvovirus']);
    $poli = $conecta->real_escape_string($_POST['Polivalente']);
    $borde = $conecta->real_escape_string($_POST['Bordetella']);
    $lep = $conecta->real_escape_string($_POST['Lep']);
    $triple = $conecta->real_escape_string($_POST['Trifelina']);
    $leucemia = $conecta->real_escape_string($_POST['Leucemia']);
    $rabia = $conecta->real_escape_string($_POST['Rabia']);
    //datos sistema digestivo
    $apetito = $conecta->real_escape_string($_POST['Apetito']);
    $vomito = $conecta->real_escape_string($_POST['Vomito']);
    $frecuencia_v = $conecta->real_escape_string($_POST['Frecuencia_vomito']);
    $evacuaciones = $conecta->real_escape_string($_POST['Evacuaciones']);
    $consistencia = $conecta->real_escape_string($_POST['Consistencia']);
    $cambio_color = $conecta->real_escape_string($_POST['Cambio_color']);
    $frecuencia_e = $conecta->real_escape_string($_POST['Frecuencia_evacuaciones']);
    $coproparasit = $conecta->real_escape_string($_POST['Coproparasit']);
    $resultadoD = $conecta->real_escape_string($_POST['ResultadoD']);
    $desparasitacion = $conecta->real_escape_string($_POST['Desparasitacion']);
    $productoD = $conecta->real_escape_string($_POST['ProductoD']);
    //datos sistema cardiovascular
    $disneaC = $conecta->real_escape_string($_POST['DisneaC']);
    $sincopesC = $conecta->real_escape_string($_POST['SincopesC']);
    $fatigaC = $conecta->real_escape_string($_POST['FatigaC']);
    $letargoC = $conecta->real_escape_string($_POST['LetargoC']);
    $ascitisC = $conecta->real_escape_string($_POST['AscitisC']);
    $edemaC = $conecta->real_escape_string($_POST['EdemaC']);
    $palidezC = $conecta->real_escape_string($_POST['PalidezC']);
    $cianosisC = $conecta->real_escape_string($_POST['CianosisC']);
    //datos sistema respiratorio
    $tos_res = $conecta->real_escape_string($_POST['Tos_res']);
    $disnea_res = $conecta->real_escape_string($_POST['Disnea_res']);
    $estornudos_res = $conecta->real_escape_string($_POST['Estornudos_res']);
    $mocos_res = $conecta->real_escape_string($_POST['Mocos_res']);
    $secrecion_res = $conecta->real_escape_string($_POST['Secrecion_res']);
    $polipnea_res = $conecta->real_escape_string($_POST['Polipnea_res']);
    $cianosis_res = $conecta->real_escape_string($_POST['Cianosis_res']);
    $laganas_res = $conecta->real_escape_string($_POST['Laganas_res']);
    //datos sistema reproductor
    $ovh_rep = $conecta->real_escape_string($_POST['Ovh_rep']);
    $desecho_vulvar = $conecta->real_escape_string($_POST['Desecho_vulvar']);
    $lamido_excesivo = $conecta->real_escape_string($_POST['Lamido_excesivo']);
    $castrado_rep = $conecta->real_escape_string($_POST['Castrado_rep']);
    $celos_regulares = $conecta->real_escape_string($_POST['Celos_regulares']);
    $fecha_ultimo = $conecta->real_escape_string($_POST['Fecha_ultimo']);
    //datos examen físico
    $actitud_exafis = $conecta->real_escape_string($_POST['Actitud_exafis']);
    $condicion_exafis = $conecta->real_escape_string($_POST['Condicion_exafis']);
    $hidratacion_exafis = $conecta->real_escape_string($_POST['Hidratacion_exafis']);
    $madibulares_exafis = $conecta->real_escape_string($_POST['Madibulares_exafis']);
    $preescapulares_exafis = $conecta->real_escape_string($_POST['Preescapulares_exafis']);
    $subaxilares_exafis = $conecta->real_escape_string($_POST['Subaxilares_exafis']);
    $ingunales_exafis = $conecta->real_escape_string($_POST['Ingunales_exafis']);
    $popliteos_exafis = $conecta->real_escape_string($_POST['Popliteos_exafis']);
    $parpados_exafis = $conecta->real_escape_string($_POST['Parpados_exafis']);
    $piel_exafis = $conecta->real_escape_string($_POST['Piel_exafis']);
    //datos cavidad bucal
    $dentadura_bu = $conecta->real_escape_string($_POST['Dentadura_Bu']);
    $sarro_dental = $conecta->real_escape_string($_POST['Sarro_dental']);
    $encias_bu = $conecta->real_escape_string($_POST['Encias_Bu']);
    //datos ojos
    $humedad_o = $conecta->real_escape_string($_POST['Humedad_O']);
    $cornea_o = $conecta->real_escape_string($_POST['Cornea_O']);
    $cristalino_o = $conecta->real_escape_string($_POST['Cristalino_O']);
    $episcrerales_o = $conecta->real_escape_string($_POST['Episcrerales_O']);
    $epifora_o = $conecta->real_escape_string($_POST['Epifora_O']);
    //datos mucosas
    $conjuntiva_mu = $conecta->real_escape_string($_POST['Conjuntiva_mu']);
    $oral_mu = $conecta->real_escape_string($_POST['Oral_mu']);
    $vaginal_mu = $conecta->real_escape_string($_POST['Vaginal_mu']);
    $prepucial_mu = $conecta->real_escape_string($_POST['Prepucial_mu']);
    //datos auscultación sistema respiratorio
    $tipo_asr = $conecta->real_escape_string($_POST['Tipo_asr']);
    $profundidad_asr = $conecta->real_escape_string($_POST['Profundidad_asr']);
    $ritmo_asr = $conecta->real_escape_string($_POST['Ritmo_asr']);
    $sinodos_asr = $conecta->real_escape_string($_POST['Sinodos_asr']);
    $describa_asr = $conecta->real_escape_string($_POST['Describa_asr']);
    //datos auscultación sistema cardiaco
    $sonidos_asc = $conecta->real_escape_string($_POST['Sonidos_asc']);
    $soplos_asc = $conecta->real_escape_string($_POST['Soplos_asc']);
    //datos palpación
    $organo_p = $conecta->real_escape_string($_POST['Organo_p']);
    $descripcion_p = $conecta->real_escape_string($_POST['Descripcion_p']);
    //datos constantes
    $frespiratoria_cons = $conecta->real_escape_string($_POST['Frespiratoria_cons']);
    $fcardiaca_cons = $conecta->real_escape_string($_POST['Fcardiaca_cons']);
    $rcapilar_cons = $conecta->real_escape_string($_POST['Rcapilar_cons']);
    $pulso_cons = $conecta->real_escape_string($_POST['Pulso_cons']);
    $rpupilar_cons = $conecta->real_escape_string($_POST['Rpupilar_cons']);
    $temperatura_cons = $conecta->real_escape_string($_POST['Descripcion_p']);
    //datos musculo esqueletico
    $claudicacion_me = $conecta->real_escape_string($_POST['Claudicacion_me']);
    $manormal_me = $conecta->real_escape_string($_POST['Manormal_me']);
    $mafectado_me = $conecta->real_escape_string($_POST['Mafectado_me']);
    $dincorporarse_me = $conecta->real_escape_string($_POST['Dincorporarse_me']);
    $amuscular_me = $conecta->real_escape_string($_POST['Amuscular_me']);
    //datos tegumentario
    $Lpiel_te = $conecta->real_escape_string($_POST['Lpiel_te']);
    $Lcaracteristicas_te = $conecta->real_escape_string($_POST['Lcaracteristicas_te']);
    $Prurito_te = $conecta->real_escape_string($_POST['Prurito_te']);
    $Pulgas_te = $conecta->real_escape_string($_POST['Pulgas_te']);
    $Scabeza_te = $conecta->real_escape_string($_POST['Scabeza_te']);
    $Fducha_te = $conecta->real_escape_string($_POST['Fducha_te']);
    $Producto_te = $conecta->real_escape_string($_POST['Producto_te']);
    //datos sistema nervioso
    $convulsiones_ne = $conecta->real_escape_string($_POST['Convulsiones_ne']);
    $letargo_ne = $conecta->real_escape_string($_POST['Letargo_ne']);
    $infecal_ne = $conecta->real_escape_string($_POST['Infecal_ne']);
    $ceguera_ne = $conecta->real_escape_string($_POST['Ceguera_ne']);
    $inurinaria_ne = $conecta->real_escape_string($_POST['Inurinaria_ne']);
    $sordera_ne = $conecta->real_escape_string($_POST['Sordera_ne']);
    $incabeza_ne = $conecta->real_escape_string($_POST['Incabeza_ne']);
    $paresia_ne = $conecta->real_escape_string($_POST['Paresia_ne']);
    $mioclonias_ne = $conecta->real_escape_string($_POST['Mioclonias_ne']);
    $paralisis_ne = $conecta->real_escape_string($_POST['Paralisis_ne']);
    //datos conducta
    $aofensiva_co = $conecta->real_escape_string($_POST['Aofensiva_co']);
    $adefensiva_co = $conecta->real_escape_string($_POST['Adefensiva_co']);
    $cdestructiva_co = $conecta->real_escape_string($_POST['Cdestructiva_co']);
    $einadecuada_co = $conecta->real_escape_string($_POST['Einadecuada_co']);
    $adepravado_co = $conecta->real_escape_string($_POST['Adepravado_co']);
    $sociable_co = $conecta->real_escape_string($_POST['Sociable_co']);
    $timidez_co = $conecta->real_escape_string($_POST['Timidez_co']);
    $tespecifico_co = $conecta->real_escape_string($_POST['Tespecifico_co']);
    //datos diagnostico
    $pdiagnosticas_dia = $conecta->real_escape_string($_POST['Pdiagnosticas_dia']);
    $pruebas_dia = $conecta->real_escape_string($_POST['Pruebas_dia']);
    $receta_dia = $conecta->real_escape_string($_POST['Receta_dia']);
    $dieta_dia = $conecta->real_escape_string($_POST['Dieta_dia']);

//consulta para insertar los datos en alimentación
$insertarA = "INSERT INTO alimentacion (id_mascota,croquetas,comida_casera,huesos,frecuencia,agua,marcas,cantidad)VALUES('$id_mascota','$croquetas','$comida_casera','$huesos','$frecuencia','$agua','$marca','$cantidad');";
$guardandoA = $conecta->query($insertarA);

//consulta para insertar los datos en vacunación
$insertarV = "INSERT INTO vacunacion (moquillo,parvovirus,polivalente,bordetella,leptospira,triple_felina,leucemia,rabia,id_mascota)VALUES('$moquillo','$parvo','$poli','$borde','$lep','$triple','$leucemia','$rabia','$id_mascota');";
$guardandoV = $conecta->query($insertarV);

//consulta para insertar los datos digestivos
$insertarD = "INSERT INTO digestivo (id_mascota,apetito,vomito,frecuencia_v,evacuaciones,consistencia,cambio_color,frecuencia_e,coproparasit,resultado,desparasitacion,producto)VALUES
('$id_mascota','$apetito','$vomito','$frecuencia_v','$evacuaciones','$consistencia','$cambio_color','$frecuencia_e','$coproparasit','$resultadoD','$desparasitacion','$productoD');";
$guardandoD = $conecta->query($insertarD);

//consulta para insertar los datos cardiovasculares
$insertarC = "INSERT INTO cardiovascular (id_mascota,disnea,sincopes,fatiga,letargo,ascitis,edema,palidez,cianosis)VALUES
('$id_mascota','$disneaC','$sincopesC','$fatigaC','$letargoC','$ascitisC','$edemaC','$palidezC','$cianosisC');";
$guardandoC = $conecta->query($insertarC);

//consulta para insertar los datos respiratorios
$insertarRes = "INSERT INTO respiratorio (id_mascota,tos,disnea,estornudos,mocos,secrecion,polipnea,cianosis,leganas)VALUES
('$id_mascota','$tos_res','$disnea_res','$estornudos_res','$mocos_res','$secrecion_res','$polipnea_res','$cianosis_res','$laganas_res');";
$guardandoRes = $conecta->query($insertarRes);

//consulta para insertar los datos sistema reproductor
$insertarRep = "INSERT INTO reproductor (id_mascota,ovh,des_vulvar,lamido_exc,castrado,celos_reg,fecha_ultimo)VALUES
('$id_mascota','$ovh_rep','$desecho_vulvar','$lamido_excesivo','$castrado_rep','$celos_regulares','$fecha_ultimo');";
$guardandoRep = $conecta->query($insertarRep);

//consulta para insertar los datos de examen fisico
$insertarExafis = "INSERT INTO exafisico (id_mascota,actitud,condicion,hidratacion,madibulares,preescapulares,subaxilares,ingunales,popliteos,parpados,piel)VALUES
('$id_mascota','$actitud_exafis','$condicion_exafis','$hidratacion_exafis','$madibulares_exafis','$preescapulares_exafis','$subaxilares_exafis','$ingunales_exafis','$popliteos_exafis','$parpados_exafis','$piel_exafis');";
$guardandoExafis = $conecta->query($insertarExafis);

//consulta para insertar los datos de cavidad bucal
$insertarBu = "INSERT INTO bucal (id_mascota,dentadura,sarro,encias)VALUES('$id_mascota','$dentadura_bu','$sarro_dental','$encias_bu');";
$guardandoBu = $conecta->query($insertarBu);

//consulta para insertar los datos de ojos
$insertarO = "INSERT INTO ojos (id_mascota,humedad,cornea,cristalino,episcrerales,epifora)VALUES('$id_mascota','$humedad_o','$cornea_o','$cristalino_o','$episcrerales_o','$epifora_o');";
$guardandoO = $conecta->query($insertarO);

//consulta para insertar los datos de mucosas
$insertarMu = "INSERT INTO mucosas (id_mascota,conjuntiva,oral,vaginal,prepucial)VALUES('$id_mascota','$conjuntiva_mu','$oral_mu','$vaginal_mu','$prepucial_mu');";
$guardandoMu = $conecta->query($insertarMu);

//consulta para insertar los datos de auscultación sistema respiratorio
$insertarASR = "INSERT INTO auscultacion_r (id_mascota,tipo,profundidad,ritmo,sinodos,describa)VALUES('$id_mascota','$tipo_asr','$profundidad_asr','$ritmo_asr','$sinodos_asr','$describa_asr');";
$guardandoASR = $conecta->query($insertarASR);

//consulta para insertar los datos de auscultación sistema cardiaco
$insertarASC = "INSERT INTO auscultacion_c (id_mascota,sonidos_v,soplos_v)VALUES('$id_mascota','$sonidos_asc','$soplos_asc');";
$guardandoASC = $conecta->query($insertarASC);

//consulta para insertar los datos de palpacion
$insertarP = "INSERT INTO palpacion (id_mascota,organo,descripcion)VALUES('$id_mascota','$organo_p','$descripcion_p');";
$guardandoP = $conecta->query($insertarP);

//consulta para insertar los datos de constantes
$insertarCONS = "INSERT INTO constantes (id_mascota,frec_cardiaca,frec_respiratoria,retorno_capilar,pulso,ref_pupilar,temperatura)VALUES
('$id_mascota','$fcardiaca_cons','$frespiratoria_cons','$rcapilar_cons','$pulso_cons','$rpupilar_cons','$temperatura_cons');";
$guardandoCONS = $conecta->query($insertarCONS);

//consulta para insertar los datos de musculo esqueletico
$insertarME = "INSERT INTO mus_esqueletico (id_mascota,claudicacion,m_anormal,miembro_afectado,dif_incorporarse,atro_muscular)VALUES
('$id_mascota','$claudicacion_me','$manormal_me','$mafectado_me','$dincorporarse_me','$amuscular_me');";
$guardandoME = $conecta->query($insertarME);

//consulta para insertar los datos de tegumentario
$insertarTE = "INSERT INTO tegumentario (id_mascota,les_piel,car_lesiones,prurito,bichos,sac_cabeza,frec_bano,prod_utilizado)VALUES
('$id_mascota','$Lpiel_te','$Lcaracteristicas_te','$Prurito_te','$Pulgas_te','$Scabeza_te','$Fducha_te','$Producto_te');";
$guardandoTE = $conecta->query($insertarTE);

//consulta para insertar los datos de sistema nervioso
$insertarNE = "INSERT INTO nervioso (id_mascota,convulsiones,letargo,inc_fecal,inc_urinaria,inclinacion_cabeza,mioclonia,ceguera,sordera,paresia,paralisis)VALUES
('$id_mascota','$convulsiones_ne','$letargo_ne','$infecal_ne','$inurinaria_ne','$incabeza_ne','$mioclonias_ne','$ceguera_ne','$sordera_ne','$paresia_ne','$paralisis_ne');";
$guardandoNE = $conecta->query($insertarNE);

//consulta para insertar los datos de conducta
$insertarCO = "INSERT INTO conducta (id_mascota,agr_ofensiva,agr_defensiva,cond_destructiva,elim_inadecuada,ape_depravado,sociable,timidez,temor_especifico)VALUES
('$id_mascota','$aofensiva_co','$adefensiva_co','$cdestructiva_co','$einadecuada_co','$adepravado_co','$sociable_co','$timidez_co','$tespecifico_co');";
$guardandoCO = $conecta->query($insertarCO);

//consulta para insertar los datos de diagnostico
$insertarDIA = "INSERT INTO diagnostico (id_mascota,posibilidad_d,pruebas,receta,dieta)VALUES('$id_mascota','$pdiagnosticas_dia','$pruebas_dia','$receta_dia','$dieta_dia');";
$guardandoDIA = $conecta->query($insertarDIA);

if($guardandoNE > 0 && $guardandoTE > 0 && $guardandoME > 0 && $guardandoCONS > 0 && $guardandoP > 0 
&& $guardandoASC > 0 && $guardandoASR > 0 && $guardandoMu > 0 && $guardandoO > 0 && $guardandoBu > 0 
&& $guardandoA > 0 && $guardandoV > 0 && $guardandoD > 0 && $guardandoC > 0 && $guardandoRes > 0 
&& $guardandoRep > 0 && $guardandoExafis > 0 && $guardandoCO > 0 && $guardandoDIA > 0){
    header("location:principal.php");
}

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de consulta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="icon" href="images/logo_basepet_2.png">
</head>
<body style="background-color: #A3D2CA;">

    <div class="container-fluid shadow p-3 w-50 mt-5 mb-5" style="background-color: lightgray;">
        <h4 class="text-center">Alimentación del paciente</h4>
        <div class="col-sm-12 col-md-12 col-lg-12">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                    <!--el tipo hidden en el input es para que no sea visible pero el campo exista para poder recuperar datos al momento añadir el id del cliente-->
                    <input type="hidden" name="id" value="<?php echo $datos['idmascota'];?>">
                <!--formulario alimentación-->
                <label class="mt-2"><strong>¿Comé croquetas?</strong></label>
                    <select class="form-select" name="Croquetas" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>¿Comé comida casera?</strong></label>
                    <select class="form-select" name="Comida_casera" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>¿Comé huesos?</strong></label>
                    <select class="form-select" name="Huesos" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Frecuencia(Días por semana):</strong></label>
                    <input type="number" name="Frecuencia" class="form-control" min="0" max="7" step="1" required>
                <label class="mt-2"><strong>Consumo de agua:</strong></label>
                    <select class="form-select" name="Agua" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Incremento</option>
                        <option value="2">Normal</option>
                        <option value="3">Disminucion</option>
                    </select>
                <label class="mt-2"><strong>Marca de croquetas:</strong></label>
                    <input type="text" name="Marca" class="form-control">
                <label class="mt-2"><strong>Cantidad:</strong></label>
                    <input type="text" name="Cantidad" class="form-control"> 
                     
                <!--Formulario vacunas-->
                <span class="placeholder col-12 bg-info mt-3" style="height: 5px;"></span>
                <h4 class="text-center mt-3 mb-3">Vacunas vigentes</h4> 
                <label class="mt-2"><strong>Moquillo:</strong></label>
                    <select class="form-select" name="Moquillo" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Parvovirus:</strong></label>
                    <select class="form-select" name="Parvovirus" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Polivalente:</strong></label>
                    <select class="form-select" name="Polivalente" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Bordetella:</strong></label>
                    <select class="form-select" name="Bordetella" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Leptospira:</strong></label>
                    <select class="form-select" name="Lep" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Triple felina:</strong></label>
                    <select class="form-select" name="Trifelina" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Leucemia:</strong></label>
                    <select class="form-select" name="Leucemia" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Rabia:</strong></label>
                    <select class="form-select" name="Rabia" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>

                <!--Formulario sistema digestivo-->
                <span class="placeholder col-12 bg-info mt-3" style="height: 5px;"></span>
                <h4 class="text-center mt-3 mb-3">Sistema digestivo</h4>
                <label class="mt-2"><strong>Apetito:</strong></label>
                    <select class="form-select" name="Apetito" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Normal</option>
                        <option value="2">Selectivo</option>
                        <option value="3">Bajo general</option>
                        <option value="4">Anorexia</option>
                        <option value="5">Coprofagia</option>
                        <option value="6">Alotrofagia</option>
                    </select>
                <label class="mt-2"><strong>Vomito:</strong></label>
                    <select class="form-select" name="Vomito" aria-label="Default select example">
                        <option selected>Seleccione...</option>
                        <option value="1">No</option>
                        <option value="2">Central</option>
                        <option value="3">Digestivo</option>
                    </select>
                <label class="mt-2"><strong>Frecuencia del vomito al día:</strong></label>
                    <input type="number" name="Frecuencia_vomito" class="form-control" min="0" max="9" step="1" required>
                <label class="mt-2"><strong>Evacuaciones:</strong></label>
                    <select class="form-select" name="Evacuaciones" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Moco</option>
                        <option value="2">Estreñimiento</option>
                        <option value="2">Diarrea</option>
                    </select>
                <label class="mt-2"><strong>Consistencia:</strong></label>
                    <input class="form-control" name="Consistencia" type="text" require>
                <label class="mt-2"><strong>Cambio de color:</strong></label>
                    <select class="form-select" name="Cambio_color" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Frecuencia del evacuaciones al día:</strong></label>
                    <input type="number" name="Frecuencia_evacuaciones" class="form-control" min="0" max="9" step="1" required>
                <label class="mt-2"><strong>Coproparasit. vigente:</strong></label>
                    <select class="form-select" name="Coproparasit" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Resultado:</strong></label>
                    <input class="form-control" name="ResultadoD" type="text" require>
                <label class="mt-2"><strong>Desparasitación:</strong></label>
                    <select class="form-select" name="Desparasitacion" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Producto utilizado:</strong></label>
                    <input class="form-control" name="ProductoD" type="text" require>

                <!--Formulario sistema cardiovascular-->
                <span class="placeholder col-12 bg-info mt-3" style="height: 5px;"></span>
                <h4 class="text-center mt-3 mb-3">Sistema cardiovascular</h4>
                <label class="mt-2"><strong>Disnea:</strong></label>
                    <select class="form-select" name="DisneaC" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Sincopes:</strong></label>
                    <select class="form-select" name="SincopesC" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Fatiga:</strong></label>
                    <select class="form-select" name="FatigaC" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Letargo:</strong></label>
                    <select class="form-select" name="LetargoC" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Ascitis:</strong></label>
                    <select class="form-select" name="AscitisC" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Edema:</strong></label>
                    <select class="form-select" name="EdemaC" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Palidez:</strong></label>
                    <select class="form-select" name="PalidezC" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Cianosis:</strong></label>
                    <select class="form-select" name="CianosisC" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <!--Formulario sistema cardiovascular-->
                <span class="placeholder col-12 bg-info mt-3" style="height: 5px;"></span>
                <h4 class="text-center mt-3 mb-3">Sistema Respiratorio</h4>
                <label class="mt-2"><strong>Tos:</strong></label>
                    <select class="form-select" name="Tos_res" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Disnea:</strong></label>
                    <select class="form-select" name="Disnea_res" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Estornudos:</strong></label>
                    <select class="form-select" name="Estornudos_res" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Mocos:</strong></label>
                    <select class="form-select" name="Mocos_res" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Secreción nasal:</strong></label>
                    <select class="form-select" name="Secrecion_res" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Polipnea:</strong></label>
                    <select class="form-select" name="Polipnea_res" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Cianosis:</strong></label>
                    <select class="form-select" name="Cianosis_res" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Legañas:</strong></label>
                    <select class="form-select" name="Laganas_res" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                
                <!--Formulario sistema cardiovascular-->
                <span class="placeholder col-12 bg-info mt-3" style="height: 5px;"></span>
                <h4 class="text-center mt-3 mb-3">Sistema Reproductor</h4>
                <label class="mt-2"><strong>OVH:</strong></label>
                    <select class="form-select" name="Ovh_rep" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Desecho vulvar:</strong></label>
                    <select class="form-select" name="Desecho_vulvar" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Lamido excesivo:</strong></label>
                    <select class="form-select" name="Lamido_excesivo" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Castrado:</strong></label>
                    <select class="form-select" name="Castrado_rep" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Celos regulares:</strong></label>
                    <select class="form-select" name="Celos_regulares" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Fecha último:</strong></label>
                    <input type="date" name="Fecha_ultimo" class="form-control">
                
                <!--Formulario sistema cardiovascular-->
                <span class="placeholder col-12 bg-info mt-3" style="height: 5px;"></span>
                <h4 class="text-center mt-3 mb-3">Examen físico</h4>
                <label class="mt-2"><strong>Actitud:</strong></label>
                    <select class="form-select" name="Actitud_exafis" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">APN</option>
                        <option value="2">Indiferente</option>
                        <option value="3">Socializa</option>
                        <option value="4">Temeroso</option>
                        <option value="5">Agresivo</option>
                        <option value="6">Estereotipias</option>
                    </select>
                <label class="mt-2"><strong>Condición corporal:</strong></label>
                    <select class="form-select" name="Condicion_exafis" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Ideal</option>
                        <option value="2">Bajo peso</option>
                        <option value="3">Caquexia</option>
                        <option value="4">Sobrepeso</option>
                        <option value="5">Obeso</option>
                    </select>
                <label class="mt-2"><strong>Hidratación:</strong></label>
                    <select class="form-select" name="Hidratacion_exafis" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Normal</option>
                        <option value="2">Deshidratacion</option>
                        <option value="3">5%</option>
                        <option value="4">6-8%</option>
                        <option value="5">10%</option>
                        <option value="6">12%</option>
                    </select>
                <label class="mt-2"><strong>Madibulares:</strong></label>
                    <select class="form-select" name="Madibulares_exafis" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">APN</option>
                        <option value="2">Aumento</option>
                    </select>
                <label class="mt-2"><strong>Preescapulares:</strong></label>
                    <select class="form-select" name="Preescapulares_exafis" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">APN</option>
                        <option value="2">Aumento</option>
                    </select>
                <label class="mt-2"><strong>Subaxilares:</strong></label>
                    <select class="form-select" name="Subaxilares_exafis" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">APN</option>
                        <option value="2">Aumento</option>
                    </select>
                <label class="mt-2"><strong>Ingunales:</strong></label>
                    <select class="form-select" name="Ingunales_exafis" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">APN</option>
                        <option value="2">Aumento</option>
                    </select>
                <label class="mt-2"><strong>Popliteos:</strong></label>
                    <select class="form-select" name="Popliteos_exafis" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">APN</option>
                        <option value="2">Aumento</option>
                    </select>
                <label class="mt-2"><strong>Parpados:</strong></label>
                    <select class="form-select" name="Parpados_exafis" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">APN</option>
                        <option value="2">Blefaritis</option>
                        <option value="3">Entropion</option>
                        <option value="4">Ectoprion</option>
                    </select>
                <label class="mt-2"><strong>Piel:</strong></label>
                    <select class="form-select" name="Piel_exafis" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">APN</option>
                        <option value="2">Macuas</option>
                        <option value="3">Papulas</option>
                        <option value="4">Escamas</option>
                        <option value="5">Costras</option>
                        <option value="6">Hiperpigmentacion</option>
                    </select>

                <!--Formulario cavidad bucal-->
                <span class="placeholder col-12 bg-info mt-3" style="height: 5px;"></span>
                <h4 class="text-center mt-3 mb-3">Cavidad bucal</h4>
                <label class="mt-2"><strong>Dentadura:</strong></label>
                    <select class="form-select" name="Dentadura_Bu" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">APN</option>
                        <option value="2">Desgaste</option>
                        <option value="3">Perdida</option>
                    </select>
                <label class="mt-2"><strong>Sarro dental:</strong></label>
                    <select class="form-select" name="Sarro_dental" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">No</option>
                        <option value="2">Poco</option>
                        <option value="3">Abundante</option>
                    </select>
                <label class="mt-2"><strong>Encias:</strong></label>
                    <select class="form-select" name="Encias_Bu" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">APN</option>
                        <option value="2">Gingivitis</option>
                        <option value="3">Estomatitis</option>
                    </select>

                <!--Formulario ojos-->
                <span class="placeholder col-12 bg-info mt-3" style="height: 5px;"></span>
                <h4 class="text-center mt-3 mb-3">Ojos</h4>
                <label class="mt-2"><strong>Humedad:</strong></label>
                    <select class="form-select" name="Humedad_O" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">APN</option>
                        <option value="2">Seco</option>
                    </select>
                <label class="mt-2"><strong>Cornea:</strong></label>
                    <select class="form-select" name="Cornea_O" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">APN</option>
                        <option value="2">Seco</option>
                    </select>
                <label class="mt-2"><strong>Cristalino:</strong></label>
                    <select class="form-select" name="Cristalino_O" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">APN</option>
                        <option value="2">Catarata</option>
                    </select>
                <label class="mt-2"><strong>Vasos Episcrerales:</strong></label>
                    <select class="form-select" name="Episcrerales_O" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">APN</option>
                        <option value="2">Congestion</option>
                    </select>
                <label class="mt-2"><strong>Epifora:</strong></label>
                    <select class="form-select" name="Epifora_O" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>

                <!--Formulario mucosas-->
                <span class="placeholder col-12 bg-info mt-3" style="height: 5px;"></span>
                <h4 class="text-center mt-3 mb-3">Mucosas</h4>
                <label class="mt-2"><strong>Conjuntiva:</strong></label>
                    <select class="form-select" name="Conjuntiva_mu" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Rosa</option>
                        <option value="2">Palida</option>
                        <option value="3">Roja</option>
                        <option value="4">Blanca</option>
                        <option value="5">Icterica</option>
                        <option value="6">Cianotica</option>
                    </select>
                <label class="mt-2"><strong>Oral:</strong></label>
                    <select class="form-select" name="Oral_mu" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Rosa</option>
                        <option value="2">Palida</option>
                        <option value="3">Roja</option>
                        <option value="4">Blanca</option>
                        <option value="5">Icterica</option>
                        <option value="6">Cianotica</option>
                    </select>
                <label class="mt-2"><strong>Vaginal:</strong></label>
                    <select class="form-select" name="Vaginal_mu" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Rosa</option>
                        <option value="2">Palida</option>
                        <option value="3">Roja</option>
                        <option value="4">Blanca</option>
                        <option value="5">Icterica</option>
                        <option value="6">Cianotica</option>
                    </select>
                <label class="mt-2"><strong>Prepucial:</strong></label>
                    <select class="form-select" name="Prepucial_mu" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Rosa</option>
                        <option value="2">Palida</option>
                        <option value="3">Roja</option>
                        <option value="4">Blanca</option>
                        <option value="5">Icterica</option>
                        <option value="6">Cianotica</option>
                    </select>

                <!--Formulario auscultación sistema respiratorio-->
                <span class="placeholder col-12 bg-info mt-3" style="height: 5px;"></span>
                <h4 class="text-center mt-3 mb-3">Auscultación: <small class="text-dark">Sistema respiratorio</small></h4>
                <label class="mt-2"><strong>Tipo:</strong></label>
                    <select class="form-select" name="Tipo_asr" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Costal</option>
                        <option value="2">Costoabdominal</option>
                    </select>
                <label class="mt-2"><strong>Profundidad:</strong></label>
                    <select class="form-select" name="Profundidad_asr" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Profunda</option>
                        <option value="2">Superficial</option>
                    </select>
                <label class="mt-2"><strong>Ritmo:</strong></label>
                    <select class="form-select" name="Ritmo_asr" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">APN</option>
                        <option value="2">Polipnea</option>
                    </select>
                <label class="mt-2"><strong>Sinodos respiratorios:</strong></label>
                    <select class="form-select" name="Sinodos_asr" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">APN</option>
                        <option value="2">Polipnea</option>
                    </select>
                <label class="mt-2"><strong>Describa:</strong></label>
                    <input class="form-control" name="Describa_asr" type="text" require>

                <!--Formulario auscultación sistema cardiaco-->
                <span class="placeholder col-12 bg-info mt-3" style="height: 5px;"></span>
                <h4 class="text-center mt-3 mb-3">Auscultación: <small class="text-dark">Sistema cardiaco</small></h4>
                <label class="mt-2"><strong>Sonidos valvulares:</strong></label>
                    <select class="form-select" name="Sonidos_asc" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">APN</option>
                        <option value="2">Patologico</option>
                    </select>
                <label class="mt-2"><strong>Soplos valvulares:</strong></label>
                    <select class="form-select" name="Soplos_asc" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">No</option>
                        <option value="2">Sistolico</option>
                        <option value="3">Diastolico</option>
                        <option value="4">Arritmias</option>
                    </select>

                <!--Formulario palpación-->
                <span class="placeholder col-12 bg-info mt-3" style="height: 5px;"></span>
                <h4 class="text-center mt-3 mb-3">Palpación</h4>
                <label class="mt-2"><strong>Organo(s):</strong></label>
                    <input class="form-control" name="Organo_p" type="text" require>
                <label class="mt-2"><strong>Describa:</strong></label>
                    <input class="form-control" name="Descripcion_p" type="text" require>

                <!--Formulario constantes-->
                <span class="placeholder col-12 bg-info mt-3" style="height: 5px;"></span>
                <h4 class="text-center mt-3 mb-3">Constantes</h4>
                <label class="mt-2"><strong>Frecuencia cardiaca:</strong></label>
                    <input class="form-control" name="Fcardiaca_cons" type="text" require>
                <label class="mt-2"><strong>Frecuencia respiratoria:</strong></label>
                    <input class="form-control" name="Frespiratoria_cons" type="text" require>
                <label class="mt-2"><strong>T. retorno capilar:</strong></label>
                    <input class="form-control" name="Rcapilar_cons" type="text" require>
                <label class="mt-2"><strong>Pulso:</strong></label>
                    <input class="form-control" name="Pulso_cons" type="text" require>
                <label class="mt-2"><strong>Ref. pupilar:</strong></label>
                    <input class="form-control" name="Rpupilar_cons" type="text" require>
                <label class="mt-2"><strong>Temperatura:</strong></label>
                    <input class="form-control" name="Temperatura_cons" type="text" require>

                <!--Formulario musculo esqueletico-->
                <span class="placeholder col-12 bg-info mt-3" style="height: 5px;"></span>
                <h4 class="text-center mt-3 mb-3">Músculo esquelético</h4>
                <label class="mt-2"><strong>Claudicación:</strong></label>
                    <select class="form-select" name="Claudicacion_me" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Marcha anormal:</strong></label>
                    <select class="form-select" name="Manormal_me" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Miembro(s) afectado:</strong></label>
                    <input class="form-control" name="Mafectado_me" type="text" require>
                <label class="mt-2"><strong>Dificultad al incorporarse:</strong></label>
                    <select class="form-select" name="Dincorporarse_me" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Atrofia muscular:</strong></label>
                    <select class="form-select" name="Amuscular_me" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                
                <!--Formulario Tegumengtario-->
                <span class="placeholder col-12 bg-info mt-3" style="height: 5px;"></span>
                <h4 class="text-center mt-3 mb-3">Tegumentario</h4> 
                <label class="mt-2"><strong>Lesiones en piel:</strong></label>
                    <select class="form-select" name="Lpiel_te" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Características de las lesiones:</strong></label>
                    <input class="form-control" name="Lcaracteristicas_te" type="text" require>
                <label class="mt-2"><strong>Prurito:</strong></label>
                    <select class="form-select" name="Prurito_te" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Pulgas/Garrapatas:</strong></label>
                    <select class="form-select" name="Pulgas_te" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Sacude la cabeza:</strong></label>
                    <select class="form-select" name="Scabeza_te" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Frecuencia de baño:</strong></label>
                    <input class="form-control" name="Fducha_te" type="text" require>
                <label class="mt-2"><strong>Producto utilizado:</strong></label>
                    <input class="form-control" name="Producto_te" type="text" require>
                
                <!--Formulario sistema nervioso-->
                <span class="placeholder col-12 bg-info mt-3" style="height: 5px;"></span>
                <h4 class="text-center mt-3 mb-3">Sistema nervioso</h4> 
                <label class="mt-2"><strong>Convulsiones:</strong></label>
                    <select class="form-select" name="Convulsiones_ne" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Letargo:</strong></label>
                    <select class="form-select" name="Letargo_ne" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Incontinencia fecal:</strong></label>
                    <select class="form-select" name="Infecal_ne" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Ceguera:</strong></label>
                    <select class="form-select" name="Ceguera_ne" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Incontinencia urinaria:</strong></label>
                    <select class="form-select" name="Inurinaria_ne" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Sordera:</strong></label>
                    <select class="form-select" name="Sordera_ne" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Inclinación de cabeza:</strong></label>
                    <select class="form-select" name="Incabeza_ne" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Paresia:</strong></label>
                    <select class="form-select" name="Paresia_ne" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Mioclonias:</strong></label>
                    <select class="form-select" name="Mioclonias_ne" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Paralisís:</strong></label>
                    <select class="form-select" name="Paralisis_ne" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>

                <!--Formulario conducta-->
                <span class="placeholder col-12 bg-info mt-3" style="height: 5px;"></span>
                <h4 class="text-center mt-3 mb-3">Conducta</h4> 
                <label class="mt-2"><strong>Agresión ofensiva:</strong></label>
                    <select class="form-select" name="Aofensiva_co" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Agresión defensiva:</strong></label>
                    <select class="form-select" name="Adefensiva_co" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Conducta destructiva:</strong></label>
                    <select class="form-select" name="Cdestructiva_co" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Eliminación inadecuada:</strong></label>
                    <select class="form-select" name="Einadecuada_co" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Apetito depravado:</strong></label>
                    <select class="form-select" name="Adepravado_co" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Sociable:</strong></label>
                    <select class="form-select" name="Sociable_co" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Timidez:</strong></label>
                    <select class="form-select" name="Timidez_co" aria-label="Default select example" require>
                        <option selected>Seleccione...</option>
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                <label class="mt-2"><strong>Temor específico:</strong></label>
                    <input class="form-control" name="Tespecifico_co" type="text" require>

                <!--Formulario diagnostico-->
                <span class="placeholder col-12 bg-info mt-3" style="height: 5px;"></span>
                <h4 class="text-center mt-3 mb-3">Diagnostico Final</h4> 
                <label class="mt-2"><strong>Posibilidades diagnosticas:</strong></label>
                    <input class="form-control" name="Pdiagnosticas_dia" type="text" require>
                <label class="mt-2"><strong>Pruebas de apoyo al diagnostico:</strong></label>
                    <input class="form-control" name="Pruebas_dia" type="text" require>
                <label class="mt-2"><strong>Receta:</strong></label>
                    <input class="form-control" name="Receta_dia" type="text" require>
                <label class="mt-2"><strong>Dieta a seguir:</strong></label>
                    <input class="form-control" name="Dieta_dia" type="text" require>

                <!--Botones de cancelar y enviar formulario-->
                    <span class="placeholder col-12 bg-info mt-3" style="height: 5px;"></span>
                    <a class="btn btn-danger mt-5 mb-3 me-2" href="principal.php" role="button" style="margin-left:68%;">Cancelar</a>
                    <input type="submit" name="registrar" value="Guardar" class="btn btn-success mt-5 mb-3">
            </form>
        </div>
    </div>
    <!--script de bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>