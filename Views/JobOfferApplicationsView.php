<?php

    use Controllers\HomeController as HomeController;
    use Models\Admin as Admin;
    use Models\Alert as Alert;
    use Controllers\CareerController as CareerController;
    use Models\JobOffer as JobOffer;

    if(isset($_SESSION['loggedUser'])){
        $loggedUser = $_SESSION['loggedUser'];

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
            <h2 class="mb-4">Listado de Postulantes para: [<?php echo $jobOffer->getDescription(); ?>]</h2>
            <form action="<?php echo FRONT_ROOT ?>CompanyUser/FilterApplicationsListByLastName" style="display: inline;">
                <input type="text" name="lastName" placeholder="Buscar por apellido">
                <input type="hidden" name="jobOfferId" value="<?php echo $jobOffer->getJobOfferId();?>" readonly>
            </form>
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
                        if(isset($studentList)){
                            foreach($studentList as $row){
                                $studentCareer = $careerController->GetOne($row->getCareerId());

                                if(isset($lastName) && stristr($row->getLastName(),$lastName) != false){
                                    ?>
                                        <tr>
                                            <td><?php echo $row->getFirstName();?></td>
                                            <td><?php echo $row->getLastName();?></td>
                                            <td><?php echo $row->getDni();?></td>
                                            <td><?php if($studentCareer->getDescription() != null){echo $studentCareer->getDescription();}?></td>
                                            <td><?php echo $row->getFileNumber();?></td>
                                            <td><?php echo $row->getGender();?></td>
                                            <td><?php echo $row->getBirthDate();?></td>
                                            <td><?php echo $row->getPhoneNumber();?></td>
                                            <td><?php echo $row->getActive();?></td>
                                            <td>
                                                <form action="<?php echo FRONT_ROOT ?>Student/ShowStudentProfileView" method="POST" style="display: inline;">
                                                    <button type="submit" name="id" value="<?php echo $row->getStudentId(); ?>">Ver Perfil</button>
                                                </form>

                                                <?php if($loggedUser instanceof Admin){
                                                    ?>
                                                        <form action="<?php echo FRONT_ROOT ?>" method="POST" style="display: inline;">
                                                            <button type="submit" name="id" value="<?php echo $row->getStudentId(); ?>">Eliminar</button>
                                                        </form>
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php
                                }elseif(!isset($lastName)){
                                    ?>
                                        <tr>
                                            <td><?php echo $row->getFirstName();?></td>
                                            <td><?php echo $row->getLastName();?></td>
                                            <td><?php echo $row->getDni();?></td>
                                            <td><?php if($studentCareer->getDescription() != null){echo $studentCareer->getDescription();}?></td>
                                            <td><?php echo $row->getFileNumber();?></td>
                                            <td><?php echo $row->getGender();?></td>
                                            <td><?php echo $row->getBirthDate();?></td>
                                            <td><?php echo $row->getPhoneNumber();?></td>
                                            <td><?php echo $row->getActive();?></td>
                                            <td>
                                                <form action="<?php echo FRONT_ROOT ?>Student/ShowStudentProfileView" method="POST" style="display: inline;">
                                                    <button type="submit" name="id" value="<?php echo $row->getStudentId(); ?>">Ver Perfil</button>
                                                </form>

                                                <?php if($loggedUser instanceof Admin){
                                                    ?>
                                                        <form action="<?php echo FRONT_ROOT ?>" method="POST" style="display: inline;">
                                                            <button type="submit" name="id" value="<?php echo $row->getStudentId(); ?>">Eliminar</button>
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
    require_once('footer.php');
    
    }else{
        $alert = new Alert("", "");

        $alert->setType("danger");
        $alert->setMessage("Acceso no autorizado");

        $homeController = new HomeController();

        $homeController->Index($alert);
    }
?>