<?php

    use Controllers\HomeController as HomeController;
    use Models\Alert as Alert;
    use Models\CompanyUser as CompanyUser;


    if(isset($_SESSION['loggedUser'])){
        $loggedUser = $_SESSION['loggedUser'];

    require_once('header.php');
    require_once('nav.php');

    if($alert != null && $alert instanceof Alert){
        ?>
        <h5 class="alert-<?php echo $alert->getType();?>" > <?php echo $alert->getMessage(); ?></h5>
        <?php
    }
?>

<form action="<?php echo FRONT_ROOT?>JobOffer/Add" method="POST">
    <div style="text-align: center; padding-top: 150px">
        <div class="form-group">
            <label for="jobPositionId">ID Puesto</label>
            <input list="jobPositions" name="jobPositionId" required>
            <datalist id="jobPositions">
                <?php
                    if(isset($jobPositionList)){
                        foreach($jobPositionList as $row){
                            ?> <option value="<?php echo $row->getJobPositionId(); ?>"><?php echo $row->getDescription(); ?></option> <?php
                        }
                    }
                ?>
            </datalist>
        </div>
        <div class="form-group">
            <label for="companyId">ID Empresa</label>
            <input list="companies" name="companyId" <?php if($loggedUser instanceof CompanyUser){ ?> value="<?php echo $loggedUser->getCompanyId(); ?>" readonly <?php } ?> required>
            <datalist id="companies">
                <?php
                    if(isset($companyList)){
                        foreach($companyList as $row){
                            ?> <option value="<?php echo $row->getCompanyId(); ?>"><?php echo $row->getNombre(); ?></option> <?php
                        }
                    }
                ?>
            </datalist>
        </div>
        <div class="form-group">
            <label for="description">Descripcion</label>
            <input type="text" name="description" size="50">
        </div>
        <div class="form-group">
            <label for="publicationDate">Fecha de Publicacion</label>
            <input type="text" name="publicationDate" value="<?php echo date("m/d/Y"); ?>" readonly>
        </div>
        <div class="form-group">
            <label for="expirationDate">Fecha de Expiracion</label>
            <input type="date" name="expirationDate">
        </div>
        <button type="submit">Agregar</button>
    </div>
</form>

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