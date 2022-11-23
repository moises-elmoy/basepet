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

$where="";
//revisa que exista algo escrito en el método POST 
if(!empty($_POST)){
    //si existe entonces la variable valor toma el texto que exista en la caja de busqueda 
    $valor = $_POST['buscar'];
    if(!empty($valor)){
        //si la variable contiene algo entonces la variable where toma la consulta que nos dice
        //que muestre los registros que en el campo nombre concuerden con el nombre escrito en la caja de busqueda
        //oh cualquier letra que tenga dentro de el la relaciona con los nombres existentes que la contengan
        $where = "WHERE nombre LIKE '%$valor%'";
    }

}

//consulta
//la variable where es para la busqueda, completa la consulta para mostrar el resultado en la tabla 
$registrosM = "SELECT * FROM mascotas $where";
$guardar = $conecta->query($registrosM);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mascotas</title>
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
                <a class="nav-link active" aria-current="page" href="principal.php" title="Aquí puede observar las mascotas registradas">Mascotas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="citas.php" title="Aquí puede visualizar las citas que tiene pendientes">Citas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="clientes.php" title="Ver tabla de clientes y agregar mascotas">Clientes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="perfil.php" title="Aquí puede revisar su perfil">Perfil</a>
            </li>
        </ul>
        <form class="d-flex" role="search" style="margin-left:30%;" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search" name="buscar" id="buscar">
            <button class="btn btn-outline-success me-2" type="submit" title="Iniciar busqueda">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
            </button>
        </form>
        <ul class="navbar-nav" style="margin-left: 30%;">
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

    <!--botón para refresacar la página-->
    <a class="btn btn-primary mt-3" style="margin-left:80%;" href="refrescarM.php" role="button" title="Regargar tabla para ver todos los registros">
    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
        <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
        <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
    </svg>
    </a>

    <!--Inicio de tabla -->
    <div class="container">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <h3 class="text-center mb-3" style="margin-top:3%;">Mascotas Registradas</h3>
            <div class="table-responsive table-hover" id="TablaConsulta">
                <table class="table">
                    <thead class="text-muted">
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Color</th>
                        <th class="text-center">Género</th>
                        <th class="text-center">Raza</th>
                        <th class="text-center">Especie</th>
                        <th class="text-center">Peso</th>
                        <th class="text-center">Edad</th>
                        <th class="text-center">Fecha de Nacimiento</th>
                        <th class="text-center">Opciones</th>
                    </thead>
                    <tbody>
                        <?php while($row = $guardar->fetch_assoc()){?>
                        <tr>
                            <td class="text-center"><?php echo $row['nombre'];?></td>
                            <td class="text-center"><?php echo $row['color'];?></td>
                            <td class="text-center"><?php echo $row['genero'];?></td>
                            <td class="text-center"><?php echo $row['raza'];?></td>
                            <td class="text-center"><?php echo $row['especie'];?></td>
                            <td class="text-center"><?php echo $row['peso'];?></td>
                            <td class="text-center"><?php echo $row['edad'];?></td>
                            <td class="text-center"><?php echo $row['fecha'];?></td>
                            <td>
                                <!--inicio botón de opciones-->
                                <div class="dropdown">
                                    <a class="btn btn-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                        </svg>
                                    </a>
                                    <!--Menú de opciones para cada mascota de la tabla-->
                                    <ul class="dropdown-menu">
                                        <!--Boton de eliminar-->
                                        <a class="dropdown-item" href="eliminar.php?idmascota=<?php echo $row['idmascota'];?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-trash3-fill text-danger me-3" viewBox="0 0 16 16">
                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                            </svg>Eliminar
                                        </a>

                                        <!--Botón de editar-->
                                        <li>
                                            <a class="dropdown-item" href="modificar.php?idmascota=<?php echo $row['idmascota'];?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill text-warning me-3" viewBox="0 0 16 16">
                                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                </svg>Editar
                                            </a>
                                        </li>

                                        <!--Botón para agendar una cita-->
                                        <li>
                                            <a class="dropdown-item" href="agregarCita.php?idmascota=<?php echo $row['idmascota'];?>">
                                                <svg style="color:darkviolet;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal-bookmark-fill me-3" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M6 1h6v7a.5.5 0 0 1-.757.429L9 7.083 6.757 8.43A.5.5 0 0 1 6 8V1z"/>
                                                <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
                                                <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
                                                </svg>Agendar cita
                                            </a>
                                        </li>

                                        <!--Botón para registrar una consulta-->
                                        <li>
                                            <a class="dropdown-item" href="consulta.php?idmascota=<?php echo $row['idmascota'];?>">
                                                <svg style="color: indianred;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-pulse me-3" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053.918 3.995.78 5.323 1.508 7H.43c-2.128-5.697 4.165-8.83 7.394-5.857.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17c3.23-2.974 9.522.159 7.394 5.856h-1.078c.728-1.677.59-3.005.108-3.947C13.486.878 10.4.28 8.717 2.01L8 2.748ZM2.212 10h1.315C4.593 11.183 6.05 12.458 8 13.795c1.949-1.337 3.407-2.612 4.473-3.795h1.315c-1.265 1.566-3.14 3.25-5.788 5-2.648-1.75-4.523-3.434-5.788-5Zm8.252-6.686a.5.5 0 0 0-.945.049L7.921 8.956 6.464 5.314a.5.5 0 0 0-.88-.091L3.732 8H.5a.5.5 0 0 0 0 1H4a.5.5 0 0 0 .416-.223l1.473-2.209 1.647 4.118a.5.5 0 0 0 .945-.049l1.598-5.593 1.457 3.642A.5.5 0 0 0 12 9h3.5a.5.5 0 0 0 0-1h-3.162l-1.874-4.686Z"/>
                                                </svg>Agregar Consulta
                                            </a>
                                        </li>

                                        <!--Botón para mostrar el historial clínico de la mascota en cuestión-->
                                        <li>
                                            <a class="dropdown-item" href="perfilM.php?idmascota=<?php echo $row['idmascota'];?>">
                                                <svg style="color:limegreen;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard2-data-fill me-3" viewBox="0 0 16 16">
                                                <path d="M10 .5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5.5.5 0 0 1-.5.5.5.5 0 0 0-.5.5V2a.5.5 0 0 0 .5.5h5A.5.5 0 0 0 11 2v-.5a.5.5 0 0 0-.5-.5.5.5 0 0 1-.5-.5Z"/>
                                                <path d="M4.085 1H3.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1h-.585c.055.156.085.325.085.5V2a1.5 1.5 0 0 1-1.5 1.5h-5A1.5 1.5 0 0 1 4 2v-.5c0-.175.03-.344.085-.5ZM10 7a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0V7Zm-6 4a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0v-1Zm4-3a1 1 0 0 1 1 1v3a1 1 0 1 1-2 0V9a1 1 0 0 1 1-1Z"/>
                                                </svg>Historial
                                            </a>
                                        </li>

                                        <!--Botón para agregar ya sea una radiografía o analísis del paciente-->
                                        <li>
                                            <a class="dropdown-item" href="agregarImagen.php?idmascota=<?php echo $row['idmascota'];?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-image text-primary me-3" viewBox="0 0 16 16">
                                                <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                                                </svg>Anexar Radiografía
                                            </a>
                                        </li>

                                    </ul>
                                    <!--fin de menú de opciones-->
                                </div>
                                <!--fin botón de opciones-->
                                
                            </td>
                           
                        </tr>  

                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>     
    </div>
    <!--fin de tabla-->

    <!--script de bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <!--Script del modal para eliminar-->
    <script>
			$('#confirm-delete').on('show.bs.modal', function(e) {
				$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
				
				$('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
			});
		</script>	
</body>
</html>