<?php

    use Controllers\HomeController as HomeController;
    use Models\Alert as Alert;
    use Models\Student as Student;
    use Models\CompanyUser as CompanyUser;
    use Models\Admin as Admin;

    if(isset($_SESSION['loggedUser'])){
        $loggedUser = $_SESSION['loggedUser'];
        $_SESSION['studentId'] = $student->getStudentId();

    require_once('header.php');
    require_once("nav.php");
?>

<?php
    if($alert != null && $alert instanceof Alert){
        ?>
        <h5 class="alert-<?php echo $alert->getType();?>" > <?php echo $alert->getMessage(); ?></h5>
        <?php
    }
    ?>
<main class="py-5">
    <h2>Alumno: <?php echo $student->getFirstName() . " " . $student->getLastName(); ?></h2>

    <ul style="list-style-type: none; background: gray; width: 66%; margin: 2px">
        <li style="margin: 2px; background: white;">Nombre: <?php echo $student->getFirstName(); ?></li>
        <li style="margin: 2px; background: white;">Apellido: <?php echo $student->getLastName(); ?></li>
        <li style="margin: 2px; background: white;">DNI: <?php echo $student->getDni(); ?></li>
        <li style="margin: 2px; background: white;">Carrera: <?php if($studentCareer->getDescription() != null){echo $studentCareer->getDescription();} ?></li>
        <li style="margin: 2px; background: white;">Numero de Archivo: <?php echo $student->getFileNumber(); ?></li>
        <li style="margin: 2px; background: white;">Genero: <?php echo $student->getGender(); ?></li>
        <li style="margin: 2px; background: white;">Fecha de Nacimiento: <?php echo $student->getBirthDate(); ?></li>
        <li style="margin: 2px; background: white;">Email: <?php echo $student->getEmail(); ?></li>
        <li style="margin: 2px; background: white;">Numero de Telefono: <?php echo $student->getPhoneNumber(); ?></li>
    </ul>

    <?php
    if($loggedUser instanceof Student && $loggedUser->getStudentId() == $student->getStudentId()){
        ?>
            <form action="<?php echo FRONT_ROOT ?>Student/ShowModifyPasswordView" method="POST" style="display: inline;">
                <button type="submit" name="id" value="<?php echo $loggedUser->getStudentId(); ?>">Cambiar Contraseña</button>
            </form>
        <?php
    }
    if($studentCv->getStudentCvId() != null){
        ?>
            <a href="../Uploads/StudentCvs/<?php echo $studentCv->getCv(); ?>" target="_blank">Ver Cv</a>
        <?php
    }
    if(! $loggedUser instanceof CompanyUser){
        ?>
            <form action="<?php echo FRONT_ROOT ?>Student/ShowStudentApplications" method="POST" style="display: inline;">
                <button type="submit" name="id" value="<?php echo $student->getStudentId(); ?>">Ver Postulaciones</button>
            </form>
        <?php
    }

    if(($loggedUser instanceof Student && $loggedUser->getStudentId() == $student->getStudentId())){
        ?>     
            <br><br><br><br><br>

            <?php if($studentCv->getStudentCvId() != null){
                ?>
                    <h3>Modificar Curriculum</h3>
                <?php 
                }else{
                ?>
                    <h3>Subir Curriculum</h3>
                <?php
            } ?>

            <form action="<?php echo FRONT_ROOT ?>StudentCv/UploadCv" method="POST" enctype="multipart/form-data" style="display: inline;">
                <input type="file" name="cv">
                <button type="submit">Subir CV</button>
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