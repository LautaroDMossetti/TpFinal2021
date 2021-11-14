<?php

    use DAO\CompanyDAO;
    use Controllers\HomeController as HomeController;
    use DAO\JobOfferDao;
    use Models\Alert as Alert;
    use Models\CompanyUser as CompanyUser;
    use Controllers\CareerController as CareerController;
    use Controllers\JobPositionController as JobPositionController;
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
            <th>Puesto</th>
            <th>Empresa</th>
            <th>Descripcion</th>
            <th>Fecha de Publicacion</th>
            <th>Fecha de Expiracion</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if(isset($jobOfferToModify)){

                if($loggedUser instanceof CompanyUser && $loggedUser->getCompanyId() == $jobOfferToModify->getCompanyId()){
                    ?>
                        <form action="<?php echo FRONT_ROOT ?>JobOffer/SelfModify" method="POST">
                    <?php
                }else{
                    ?>
                        <form action="<?php echo FRONT_ROOT ?>JobOffer/Modify" method="POST">
                    <?php
                }
                
                ?>
                        <tr>
                            <td><input type="number" name="id" value="<?php echo $jobOfferToModify->getJobOfferId();?>" readonly></td>
                            <td><input list="jobPositions" name="jobPositionId" value="<?php echo $jobOfferToModify->getJobPositionId();?>"></td>
                            <datalist id="jobPositions">
                                <?php
                                    if(isset($jobPositionList)){
                                        foreach($jobPositionList as $row){
                                            ?> <option value="<?php echo $row->getJobPositionId(); ?>"><?php echo $row->getDescription(); ?></option> <?php
                                        }
                                    }
                                ?>
                            </datalist>
                            <td><input list="companies" name="companyId" value="<?php echo $jobOfferToModify->getCompanyId();?>" <?php if(! $loggedUser instanceof Admin){ ?> readonly <?php } ?>></td>
                            <datalist id="companies">
                            <?php
                            if(isset($companyList)){
                                foreach($companyList as $row){
                                ?> <option value="<?php echo $row->getCompanyId(); ?>"><?php echo $row->getNombre(); ?></option> <?php
                                }
                            }
                            ?>
                            </datalist>
                            <td><input type="text" size="50" name="description" value="<?php echo $jobOfferToModify->getDescription();?>"></td>
                            <td><input type="text" name="publicationDate" value="<?php echo $jobOfferToModify->getPublicationDate();?>" readonly></td>
                            <td><input type="date" name="expirationDate" value="<?php echo $jobOfferToModify->getExpirationDate();?>"></td>
                        </tr>
                <?php
            }
        ?>
    </tbody>
</table>
    <button type="submit">Confirmar cambios</button>
                    </form>
                    <?php if($loggedUser instanceof CompanyUser && $loggedUser->getCompanyId() == $jobOfferToModify->getCompanyId()){
                        ?>
                            <form action="<?php echo FRONT_ROOT ?>JobOffer/ShowPersonalListView">
                                <button type="submit" name="id" value="<?php echo $loggedUser->getCompanyId();?>">Volver</button>
                            </form>
                        <?php
                    }else{
                        ?>
                            <form action="<?php echo FRONT_ROOT ?>JobOffer/ShowListView">
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