<?php

    use Controllers\HomeController as HomeController;
    use Models\Admin as Admin;
    use Models\Alert as Alert;

    if(isset($_SESSION['loggedUser'])){
        $loggedUser = $_SESSION['loggedUser'];

    require_once('header.php');
    require_once("nav.php");
?>
<main class="py-5">

    <?php
    if($alert != null && $alert instanceof Alert){
        ?>
        <h5 class="alert-<?php echo $alert->getType();?>" > <?php echo $alert->getMessage(); ?></h5>
        <?php
    }
    ?>

    <h2>Empresa: <?php echo $company->getNombre()?></h2>

    <ul style="list-style-type: none; background: gray; width: 66%; margin: 2px">
        <li style="margin: 2px; background: white;">Nombre: <?php echo $company->getNombre(); ?></li>
        <li style="margin: 2px; background: white;">Estado: <?php echo $company->getEstado(); ?></li>
        <li style="margin: 2px; background: white;">Link de Empresa: <?php echo $company->getCompanyLink(); ?></li>
        <li style="margin: 2px; background: white;">Cuit: <?php echo $company->getCuit(); ?></li>

        <li style="margin: 2px; background: white;">
                <p> Descripcion: <?php echo $company->getDescripcion(); ?> </p>
        </li>

    </ul>

</main>
<?php
    require_once('footer.php');
    
    }else{
        $homeController = new HomeController();

        $homeController->Index("Acceso no autorizado");
    }
?>