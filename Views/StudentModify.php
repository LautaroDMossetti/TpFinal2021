<?php

    use Controllers\HomeController as HomeController;
    use Controllers\StudentController as StudentController;
    use Models\Alert as Alert;
    use Models\Student as Student;
    use Models\Admin as Admin;

    if(isset($_SESSION['loggedUser'])){
        $loggedUser = $_SESSION['loggedUser'];

    require_once('header.php');
    require_once('nav.php');

    $studentController = new StudentController();
    $studentToModify = new Student();

    $studentToModify = $studentController->GetOne($id);

?>
<table class="table bg-light-alpha">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Dni</th>
            <th>ID Carrera</th>
            <th>Numero de Archivo</th>
            <th>Genero</th>
            <th>Email</th>
            <th>Password</th>
            <th>Fecha de nacimiento</th>
            <th>Numero de telefono</th>
            <th>Activo</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if(isset($studentToModify)){
                if($loggedUser instanceof Student && $loggedUser->getStudentId() == $studentToModify->getStudentId()){
                    ?>
                        <form action="<?php echo FRONT_ROOT ?>Student/SelfModify" method="POST">
                    <?php
                }else{
                    ?>
                        <form action="<?php echo FRONT_ROOT ?>Student/Modify" method="POST">
                    <?php
                }
                ?>
                        <tr>
                            <input type="number" name="studentId" value="<?php echo $studentToModify->getStudentId();?>" hidden readonly>
                            <td><input type="text" name="firstName" value="<?php echo $studentToModify->getFirstName();?>"></td>
                            <td><input type="text" name="lastName" value="<?php echo $studentToModify->getLastname();?>"></td>
                            <td><input type="text" name="dni" value="<?php echo $studentToModify->getDni();?>" <?php if(! $loggedUser instanceof Admin){ ?> readonly <?php } ?>></td>
                            <td><input type="number" name="careerId" value="<?php echo $studentToModify->getCareerId();?>" <?php if(! $loggedUser instanceof Admin){ ?> readonly <?php } ?>></td>
                            <td><input type="text" name="fileNumber" value="<?php echo $studentToModify->getFileNumber();?>" <?php if(! $loggedUser instanceof Admin){ ?> readonly <?php } ?>></td>
                            <td><input type="text" name="gender" value="<?php echo $studentToModify->getGender();?>"></td>
                            <td><input type="text" name="email" value="<?php echo $studentToModify->getEmail();?>"></td>
                            <td><input type="text" name="password" value="<?php echo $studentToModify->getPassword();?>"></td>
                            <td><input type="text" name="birthDate" value="<?php echo $studentToModify->getBirthDate();?>"></td>
                            <td><input type="text" name="phoneNumber" value="<?php echo $studentToModify->getPhoneNumber();?>"></td>
                            <td><input type="number" name="active" value="<?php echo $studentToModify->getActive();?>" <?php if(! $loggedUser instanceof Admin){ ?> readonly <?php } ?>></td>
                        </tr>
                <?php
            }
        ?>
    </tbody>
</table>
    <button type="submit">Confirmar cambios</button>
                    </form>
                    <?php if($loggedUser instanceof Student && $loggedUser->getStudentId() == $studentToModify->getStudentId()){
                        ?>
                            <form action="<?php echo FRONT_ROOT ?>Student/ShowStudentProfileView">
                                <button type="submit" name="id" value="<?php echo $loggedUser->getStudentId();?>">Volver</button>
                            </form>
                        <?php
                    }else{
                        ?>
                            <form action="<?php echo FRONT_ROOT ?>Student/ShowListView">
                                <button type="submit">Volver</button>
                            </form>
                        <?php
                    }
                ?>
                <?php
    if($alert != null && $alert instanceof Alert){
        ?>
        <h5 class="alert-<?php echo $alert->getType();?>" > <?php echo $alert->getMessage(); ?></h5>
        <?php
    }
    ?>
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