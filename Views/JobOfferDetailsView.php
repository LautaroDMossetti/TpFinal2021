<?php

    use Controllers\HomeController as HomeController;
    use Models\Alert as Alert;
    use Models\CompanyUser as CompanyUser;
    use Controllers\StudentXJobOfferController as StudentXJobOfferController;
    use Models\Student as Student;
    use Models\Admin as Admin;

    if(isset($_SESSION['loggedUser'])){
        $loggedUser = $_SESSION['loggedUser'];

        $studentXJobOfferController = new StudentXJobOfferController();

        if($loggedUser instanceof Student){
            $studentXJobOffer = $studentXJobOfferController->GetOneByBothIds($loggedUser->getStudentId(),$jobOffer->getJobOfferId());
        }

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

<?php if(isset($jobOfferImage)){
        ?>
            <img src="../Uploads/Images/<?php echo $jobOfferImage->getImage(); ?>" width="500" height="500" alt="jobOfferImage">
        <?php
    } ?>

<ul style="list-style-type: none; background: gray; width: 66%; margin: 2px">
    <li style="margin: 2px; background: white;">Empresa: <?php echo $company->getNombre(); ?></li>
    <li style="margin: 2px; background: white;">Carrera: <?php echo $career->getDescription(); ?></li>
    <li style="margin: 2px; background: white;">Puesto: <?php echo $jobPosition->getDescription(); ?></li>
    <li style="margin: 2px; background: white;">Descripcion del Empleo: <?php echo $jobOffer->getDescription(); ?></li>
    <li style="margin: 2px; background: white;">Fecha de Publicacion: <?php echo $jobOffer->getPublicationDate(); ?></li>
    <li style="margin: 2px; background: white;">Fecha de Expiracion: <?php echo $jobOffer->getExpirationDate(); ?></li>
    <li style="margin: 2px; background: white;">Link de la Empresa: <?php echo $company->getCompanyLink(); ?></li>
    <li style="margin: 2px; background: white;">
            <p> Descripcion de la Empresa: <?php echo $company->getDescripcion(); ?> </p>
    </li>

</ul>

<?php 
    if($loggedUser instanceof Student){
        if($studentXJobOffer->getStudentXJobOfferId() == null){
            ?>
                <form action="<?php echo FRONT_ROOT ?>StudentXJobOffer/Add" method="POST" style="display: inline;">
                    <button type="submit" name="studentId" value="<?php echo $loggedUser->getStudentId(); ?>">Postularse</button>
                    <input type="hidden" name="jobOfferId" value="<?php echo $jobOffer->getJobOfferId(); ?>" readonly>
                </form>
            <?php
        }else{
            ?>
                <button style="color: gray;" disabled>Postulado</button>
            <?php
        }
    } 
    if($loggedUser instanceof Admin || ($loggedUser instanceof CompanyUser && $jobOffer->getCompanyId() == $loggedUser->getCompanyId())){
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