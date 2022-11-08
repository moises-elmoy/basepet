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

$usuario = "SELECT * FROM empleados";
$guardar = $conecta->query($usuario);
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
$bus_emp = "SELECT * FROM empleados $where";
$guardar = $conecta->query($bus_emp);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados</title>
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
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
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

    <br><div class="btn-group" role="group" aria-label="Basic example" style="margin-left:80%;">
        <!--Boton recargar pagina-->
        <a class="btn btn-primary me-2" href="refrescarE.php" role="button" title="Regargar tabla para ver todos los registros">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
                <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
            </svg>
        </a>
        <!--Boton agregar empleado-->
        <a class="btn btn-outline-success me-2" href="agregarE.php" role="button" title="Agregar nuevo empleado">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
            </svg>
        </a>
    </div>

    <div class="container">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <h3 class="text-center" style="margin-top:3%;">Empleados</h3>
            <div class="table-responsive table-hover" id="TablaConsulta">
                <table class="table">
                    <thead class="text-muted">
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Apellido 1</th>
                        <th class="text-center">Apellido 2</th>
                        <th class="text-center">Correo</th>
                        <th class="text-center">Opciones</th>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php while($row = $guardar->fetch_assoc()){?>
                        <tr>
                            <td class="text-center"><?php echo $row['nombre'];?></td>
                            <td class="text-center"><?php echo $row['apellido1'];?></td>
                            <td class="text-center"><?php echo $row['apellido2'];?></td>
                            <td class="text-center"><?php echo $row['correo'];?></td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                        </svg>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="modificarE.php?idempleado=<?php echo $row['idempleado'];?>">Editar</a></li>
                                        <li><a class="dropdown-item" href="eliminarE.php?idempleado=<?php echo $row['idempleado'];?>">Eliminar</a></li>
                                    </ul>
                                </div>
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