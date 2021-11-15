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
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Cuit</th>
            <th>Estado</th>
            <th>Link</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if(isset($companyToModify)){
                if($loggedUser instanceof CompanyUser && $loggedUser->getCompanyId() == $companyToModify->getCompanyId()){
                    ?>
                        <form action="<?php echo FRONT_ROOT ?>Company/SelfModify" method="POST">
                    <?php
                }else{
                    ?>
                        <form action="<?php echo FRONT_ROOT ?>Company/Modify" method="POST">
                    <?php
                }
                
                ?>
                        <tr>
                            <input type="number" name="id" value="<?php echo $companyToModify->getCompanyId();?>" hidden readonly>
                            <td><input type="text" name="nombre" value="<?php echo $companyToModify->getNombre();?>"></td>
                            <td><input type="text" size="50" name="descripcion" value="<?php echo $companyToModify->getDescripcion();?>"></td>
                            <td><input type="number" name="cuit" value="<?php echo $companyToModify->getCuit();?>" <?php if(! $loggedUser instanceof Admin){ ?> readonly <?php } ?>></td>
                            <td><input type="text" name="estado" value="<?php echo $companyToModify->getEstado();?>"></td>
                            <td><input type="text" name="companyLink" value="<?php echo $companyToModify->getCompanyLink();?>"></td>
                        </tr>
                <?php
            }
        ?>
    </tbody>
</table>
    <button type="submit">Confirmar cambios</button>
                    </form>
                    <?php if($loggedUser instanceof CompanyUser && $loggedUser->getCompanyId() == $companyToModify->getCompanyId()){
                        ?>
                            <form action="<?php echo FRONT_ROOT ?>CompanyUser/ShowCompanyUserProfileView">
                                <button type="submit" name="id" value="<?php echo $loggedUser->getCompanyUserId();?>">Volver</button>
                            </form>
                        <?php
                    }else{
                        ?>
                            <form action="<?php echo FRONT_ROOT ?>Company/ShowListView">
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