<?php

    use Controllers\HomeController as HomeController;
    use Models\Alert as Alert;
    use Models\CompanyUser as CompanyUser;
    use Models\Student as Student;

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

<h2>Oferta de Trabajo</h2>

<ul style="list-style-type: none; background: gray; width: 66%; margin: 2px">
    <li style="margin: 2px; background: white;">Empresa: <?php echo $company->getNombre(); ?></li>
    <li style="margin: 2px; background: white;">Carrera: <?php echo $career->getDescription(); ?></li>
    <li style="margin: 2px; background: white;">Puesto: <?php echo $jobPosition->getDescription(); ?></li>
    <li style="margin: 2px; background: white;">Descripcion del Empleo: <?php echo $jobOffer->getDescription(); ?></li>
    <li style="margin: 2px; background: white;">Link de la Empresa: <?php echo $company->getCompanyLink(); ?></li>
    <li style="margin: 2px; background: white;">
            <p> Descripcion de la Empresa: <?php echo $company->getDescripcion(); ?> </p>
    </li>

</ul>

<?php 
    if($loggedUser instanceof Student){
        ?>
            <form action="<?php echo FRONT_ROOT ?>StudentXJobOffer/Add" method="POST" style="display: inline;">
                <button type="submit" name="studentId" value="<?php echo $loggedUser->getStudentId(); ?>">Postularse</button>
                <input type="hidden" name="jobOfferId" value="<?php echo $jobOffer->getJobOfferId(); ?>" readonly>
            </form>
        <?php
    } 
    if($loggedUser instanceof CompanyUser && $jobOffer->getCompanyId() == $loggedUser->getCompanyId()){
        ?>
            <form action="<?php echo FRONT_ROOT ?>CompanyUser/ShowJobOfferApplications" method="POST" style="display: inline;">
                <button type="submit" name="jobOfferId" value="<?php echo $jobOffer->getJobOfferId(); ?>">Ver Postulantes</button>
            </form>
        <?php
    }  
?>


</main>
<?php
    require_once('footer.php');
    
    }else{
        $alert = new Alert("", "");

        $alert->setType("danger");
        $alert->setMessage("Acceso no autorizado");

        $homeController = new HomeController();

        $homeController->Index($alert);
    }
?>