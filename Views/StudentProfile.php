<?php

    use Controllers\HomeController as HomeController;
    use Models\Admin as Admin;

    if(isset($_SESSION['loggedUser'])){
        $loggedUser = $_SESSION['loggedUser'];

    require_once('header.php');
    require_once("nav.php");
?>
<main class="py-5">
    <h2>Alumno: <?php echo $loggedUser->getFirstName() . " " . $loggedUser->getLastName(); ?></h2>

    <ul style="list-style-type: none; background: gray; width: 66%; margin: 2px">
        <li style="margin: 2px; background: white;">Nombre: <?php echo $loggedUser->getFirstName(); ?></li>
        <li style="margin: 2px; background: white;">Apellido: <?php echo $loggedUser->getLastName(); ?></li>
        <li style="margin: 2px; background: white;">DNI: <?php echo $loggedUser->getDni(); ?></li>
        <li style="margin: 2px; background: white;">Numero de Archivo: <?php echo $loggedUser->getFileNumber(); ?></li>
        <li style="margin: 2px; background: white;">Genero: <?php echo $loggedUser->getGender(); ?></li>
        <li style="margin: 2px; background: white;">Fecha de Nacimiento: <?php echo $loggedUser->getBirthDate(); ?></li>
        <li style="margin: 2px; background: white;">Email: <?php echo $loggedUser->getEmail(); ?></li>
        <li style="margin: 2px; background: white;">Numero de Telefono: <?php echo $loggedUser->getPhoneNumber(); ?></li>
    </ul>

</main>
<?php
    require_once('footer.php');
    
    }else{
        $homeController = new HomeController();

        $homeController->Index("Acceso no autorizado");
    }
?>