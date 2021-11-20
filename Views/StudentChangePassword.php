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
            <th>Email</th>
            <th>Password</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if(isset($studentToModify)){
                    ?>
                        <form action="<?php echo FRONT_ROOT ?>Student/ModifyPassword" method="POST">
                        <tr>
                            <input type="number" id="studentId" name="studentId" value="<?php echo $studentToModify->getStudentId();?>" hidden readonly>
                            <td><input type="text" value="<?php echo $studentToModify->getEmail();?>" readonly></td>
                            <td><input type="text" id="newPassword" name="newPassword" value="<?php echo $studentToModify->getPassword();?>"></td>
                        </tr>
                <?php
            }
        ?>
    </tbody>
</table>
    <?php
            if(isset($studentToModify)){
                    ?>
                <button type="submit">Confirmar cambios</button>
        <?php  } ?>
                    </form>
                    <?php if($loggedUser instanceof Student && $loggedUser->getStudentId() == $studentToModify->getStudentId()){
                        ?>
                            <form action="<?php echo FRONT_ROOT ?>Student/ShowStudentProfileView">
                                <button type="submit" name="id" value="<?php echo $loggedUser->getStudentId();?>">Volver</button>
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