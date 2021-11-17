<?php
use Controllers\HomeController as HomeController;
use Controllers\CompanyController as CompanyController;
use Controllers\JobPositionController as JobPositionController;
use Controllers\CareerController as CareerController;
use Models\Company as Company;
use Models\JobOffer as JobOffer;
use Models\Career as Career;
use DAO\CompanyDAO;
use DAO\JobPositionDao;
use Models\Student as Student;
use Models\Admin as Admin;
use Models\Alert as Alert;
use Models\CompanyUser as CompanyUser;

if(isset($_SESSION['loggedUser'])){
        $loggedUser = $_SESSION['loggedUser'];

        $companyController = new CompanyController();
        $jobPositionController = new JobPositionController();
        $careerController = new CareerController();

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

    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Listado de Postulaciones del Alumno: <?php echo $student->getFirstName()." ".$student->getLastName();?></h2>

            <form action="<?php echo FRONT_ROOT ?>Student/FilterApplicationListByCareer" style="display: inline;">
                <input type="text" name="careerDescription" placeholder="Buscar por Carrera">
                <input type="hidden" name="id" value="<?php echo $student->getStudentId(); ?>" readonly>
            </form>
            <form action="<?php echo FRONT_ROOT ?>Student/FilterApplicationListByJobPosition" style="display: inline;">
                <input type="text" name="jobPositionDescription" placeholder="Buscar por Puesto">
                <input type="hidden" name="id" value="<?php echo $student->getStudentId(); ?>" readonly>
            </form>
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
                        if(isset($jobOfferList)){
                            foreach($jobOfferList as $row){
                                $jobPosition = $jobPositionController->GetOne($row->getJobPositionId());
                                $career = $careerController->GetOne($jobPosition->getCareerId());
                                $company = $companyController->GetOne($row->getCompanyId());

                                if(isset($careerDescription) && stristr($career->getDescription(),$careerDescription) != false){
                                    ?>
                                    <tr>
                                        <td><?php echo $career->getDescription();?></td>
                                        <td><?php echo $jobPosition->getDescription();?></td>
                                        <td><?php echo $company->getNombre();?></td>
                                        <td><?php echo $row->getDescription();?></td>
                                        <td><?php echo $row->getPublicationDate();?></td>
                                        <td><?php echo $row->getExpirationDate();?></td>
                                        <td>
                                            <form action="<?php echo FRONT_ROOT ?>JobOffer/ShowJobOfferDetailsView" method="POST" style="display: inline;">
                                                <button type="submit" name="id" value="<?php echo $row->getJobOfferId(); ?>">Mas Info</button>
                                            </form>
                                            <?php
                                            if($loggedUser instanceof Student){
                                                ?>
                                                    <form action="<?php echo FRONT_ROOT ?>Student/CancelApplication" method="POST" style="display: inline;">
                                                        <button type="submit" name="id" value="<?php echo $row->getJobOfferId(); ?>">Cancelar Postulacion</button>
                                                        <input type="hidden" name="studentId" value="<?php echo $student->getStudentId(); ?>" readonly>
                                                    </form>
                                                <?php
                                            }elseif($loggedUser instanceof Admin){
                                                ?>
                                                    <form action="<?php echo FRONT_ROOT ?>Admin/ShowDeclineApplicationView" method="POST" style="display: inline;">
                                                        <button type="submit" id="studentId" name="studentId" value="<?php echo $student->getStudentId(); ?>">Declinar Postulacion</button>
                                                        <input type="hidden" id="jobOfferId" name="jobOfferId" value="<?php echo $row->getJobOfferId(); ?>" readonly>
                                                    </form>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php
                                }elseif(isset($jobPositionDescription) && stristr($jobPosition->getDescription(),$jobPositionDescription) != false){
                                    ?>
                                    <tr>
                                        <td><?php echo $career->getDescription();?></td>
                                        <td><?php echo $jobPosition->getDescription();?></td>
                                        <td><?php echo $company->getNombre();?></td>
                                        <td><?php echo $row->getDescription();?></td>
                                        <td><?php echo $row->getPublicationDate();?></td>
                                        <td><?php echo $row->getExpirationDate();?></td>
                                        <td>
                                            <form action="<?php echo FRONT_ROOT ?>JobOffer/ShowJobOfferDetailsView" method="POST" style="display: inline;">
                                                <button type="submit" name="id" value="<?php echo $row->getJobOfferId(); ?>">Mas Info</button>
                                            </form>

                                            <?php
                                            if($loggedUser instanceof Student){
                                                ?>
                                                    <form action="<?php echo FRONT_ROOT ?>Student/CancelApplication" method="POST" style="display: inline;">
                                                        <button type="submit" name="id" value="<?php echo $row->getJobOfferId(); ?>">Cancelar Postulacion</button>
                                                        <input type="hidden" name="studentId" value="<?php echo $student->getStudentId(); ?>" readonly>
                                                    </form>
                                                <?php
                                            }elseif($loggedUser instanceof Admin){
                                                ?>
                                                    <form action="<?php echo FRONT_ROOT ?>Admin/ShowDeclineApplicationView" method="POST" style="display: inline;">
                                                        <button type="submit" id="studentId" name="studentId" value="<?php echo $student->getStudentId(); ?>">Declinar Postulacion</button>
                                                        <input type="hidden" id="jobOfferId" name="jobOfferId" value="<?php echo $row->getJobOfferId(); ?>" readonly>
                                                    </form>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php
                                }elseif(!isset($careerDescription) && !isset($jobPositionDescription)){
                                ?>
                                    <tr>
                                        <td><?php echo $career->getDescription();?></td>
                                        <td><?php echo $jobPosition->getDescription();?></td>
                                        <td><?php echo $company->getNombre();?></td>
                                        <td><?php echo $row->getDescription();?></td>
                                        <td><?php echo $row->getPublicationDate();?></td>
                                        <td><?php echo $row->getExpirationDate();?></td>
                                        <td>
                                            <form action="<?php echo FRONT_ROOT ?>JobOffer/ShowJobOfferDetailsView" method="POST" style="display: inline;">
                                                <button type="submit" name="id" value="<?php echo $row->getJobOfferId(); ?>">Mas Info</button>
                                            </form>

                                            <?php
                                            if($loggedUser instanceof Student){
                                                ?>
                                                    <form action="<?php echo FRONT_ROOT ?>Student/CancelApplication" method="POST" style="display: inline;">
                                                        <button type="submit" name="id" value="<?php echo $row->getJobOfferId(); ?>">Cancelar Postulacion</button>
                                                        <input type="hidden" name="studentId" value="<?php echo $student->getStudentId(); ?>" readonly>
                                                    </form>
                                                <?php
                                            }elseif($loggedUser instanceof Admin){
                                                ?>
                                                    <form action="<?php echo FRONT_ROOT ?>Admin/ShowDeclineApplicationView" method="POST" style="display: inline;">
                                                        <button type="submit" id="studentId" name="studentId" value="<?php echo $student->getStudentId(); ?>">Declinar Postulacion</button>
                                                        <input type="hidden" id="jobOfferId" name="jobOfferId" value="<?php echo $row->getJobOfferId(); ?>" readonly>
                                                    </form>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php
                                }
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </section>

</main>
<?php
    require_once("footer.php");

    }else{
        $alert = new Alert("", "");

        $alert->setType("danger");
        $alert->setMessage("Acceso no autorizado");

        $homeController = new HomeController();

        $homeController->Index($alert);
    }
?>