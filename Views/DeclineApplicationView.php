<?php

    use Controllers\HomeController as HomeController;
    use Models\Admin as Admin;
    use Models\Alert as Alert;
    use Controllers\CareerController as CareerController;
    use Controllers\JobPositionController as JobPositionController;
    use Models\JobOffer as JobOffer;
    use Models\CompanyUser as CompanyUser;
    use Models\Company as Company;
    use Controllers\CompanyController as CompanyController;

    if(isset($_SESSION['loggedUser'])){
        $loggedUser = $_SESSION['loggedUser'];

        $careerController = new CareerController();
        $jobPositionController = new JobPositionController();
        $companyController = new CompanyController();

    require_once('header.php');
    require_once("nav.php");
?>
<main class="py-5">

<h2>Oferta laboral correspondiente</h2>
<table class="table bg-light-alpha">
                <thead>
                    <tr>
                        <th>Carrera</th>
                        <th>Puesto</th>
                        <th>Compania</th>
                        <th>Descripcion</th>
                        <th>Fecha de publicacion</th>
                        <th>Fecha de caducacion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(isset($jobOffer)){
                                $jobPosition = $jobPositionController->GetOne($jobOffer->getJobPositionId());
                                $jobOfferCareer = $careerController->GetOne($jobPosition->getCareerId());
                                $company = $companyController->GetOne($jobOffer->getCompanyId());

                                    ?>
                                    <tr>
                                        <td><?php echo $jobOfferCareer->getDescription();?></td>
                                        <td><?php echo $jobPosition->getDescription();?></td>
                                        <td><?php echo $company->getNombre();?></td>
                                        <td><?php echo $jobOffer->getDescription();?></td>
                                        <td><?php echo $jobOffer->getPublicationDate();?></td>
                                        <td><?php echo $jobOffer->getExpirationDate();?></td>
                                        <td>
                                            <form action="<?php echo FRONT_ROOT ?>JobOffer/ShowJobOfferDetailsView" method="POST" style="display: inline;">
                                                <button type="submit" name="id" value="<?php echo $jobOffer->getJobOfferId(); ?>">Mas Info</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php
                        }
                    ?>
                </tbody>
            </table>

    <h2>Estudiante postulado</h2>
    <table class="table bg-light-alpha">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Dni</th>
                        <th>Carrera</th>
                        <th>Numero de Archivo</th>
                        <th>Genero</th>
                        <th>Fecha de nacimiento</th>
                        <th>Numero de telefono</th>
                        <th>Activo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(isset($student)){
                                $studentCareer = $careerController->GetOne($student->getCareerId());

                                    ?>
                                        <tr>
                                            <td><?php echo $student->getFirstName();?></td>
                                            <td><?php echo $student->getLastName();?></td>
                                            <td><?php echo $student->getDni();?></td>
                                            <td><?php if($studentCareer->getDescription() != null){echo $studentCareer->getDescription();}?></td>
                                            <td><?php echo $student->getFileNumber();?></td>
                                            <td><?php echo $student->getGender();?></td>
                                            <td><?php echo $student->getBirthDate();?></td>
                                            <td><?php echo $student->getPhoneNumber();?></td>
                                            <td><?php echo $student->getActive();?></td>
                                            <td>
                                                <form action="<?php echo FRONT_ROOT ?>Student/ShowStudentProfileView" method="POST" style="display: inline;">
                                                    <button type="submit" name="id" value="<?php echo $student->getStudentId(); ?>">Ver Perfil</button>
                                                </form>
                                                    <?php if($loggedUser instanceof Admin){
                                                        ?>
                                                    <?php
                                                }
                                            ?>
                                            </td>
                                        </tr>
                                    <?php
                        }
                    ?>
                </tbody>
    </table>

    <form action="<?php echo FRONT_ROOT ?>Admin/DeclineApplication" method="POST" style="display: inline;">
    <label for="reason">Razon de decline:</label>
    <input type="text" id="reason" name="reason" size="50">

    <input type="number" id="jobOfferId" name="jobOfferId" value="<?php echo $jobOffer->getJobOfferId(); ?>" hidden readonly>
    <button type="submit" id="studentId" name="studentId" value="<?php echo $student->getStudentId(); ?>">Declinar Postulacion</button>
    </form>

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