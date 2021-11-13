<?php

    use Controllers\HomeController as HomeController;
    use Models\Alert as Alert;
    use Models\CompanyUser as CompanyUser;
    use Models\Admin as Admin;

    if(isset($_SESSION['loggedUser'])){
        $loggedUser = $_SESSION['loggedUser'];

    require_once('header.php');
    require_once('nav.php');
?>
<table class="table bg-light-alpha">
    <thead>
        <tr>
            <th>ID</th>
            <th>ID Empresa</th>
            <th>Email</th>
            <th>Contraseña</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if(isset($companyUserToModify)){
                if($loggedUser instanceof CompanyUser && $loggedUser->getCompanyUserId() == $companyUserToModify->getCompanyUserId()){
                    ?>
                        <form action="<?php echo FRONT_ROOT ?>CompanyUser/SelfModify" method="POST">
                    <?php
                }else{
                    ?>
                        <form action="<?php echo FRONT_ROOT ?>CompanyUser/Modify" method="POST">
                    <?php
                }
                
                ?>
                        <tr>
                            <td><input type="number" name="id" value="<?php echo $companyUserToModify->getCompanyUserId();?>" readonly></td>
                            <td><input type="number" name="companyId" value="<?php echo $companyUserToModify->getCompanyId();?>" <?php if(! $loggedUser instanceof Admin){ ?> readonly <?php } ?>></td>
                            <td><input type="text" name="email" value="<?php echo $companyUserToModify->getEmail();?>"></td>
                            <td><input type="text" name="password" value="<?php echo $companyUserToModify->getPassword();?>"></td>
                        </tr>
                <?php
            }
        ?>
    </tbody>
</table>
    <button type="submit">Confirmar cambios</button>
                    </form>
                    <?php if($loggedUser instanceof CompanyUser && $loggedUser->getCompanyUserId() == $companyUserToModify->getCompanyUserId()){
                        ?>
                            <form action="<?php echo FRONT_ROOT ?>Company/ShowCompanyProfileView">
                                <button type="submit" name="id" value="<?php echo $loggedUser->getCompanyId();?>">Volver</button>
                            </form>
                        <?php
                    }else{
                        ?>
                            <form action="<?php echo FRONT_ROOT ?>CompanyUser/ShowListView">
                                <button type="submit">Volver</button>
                            </form>
                        <?php
                    }

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