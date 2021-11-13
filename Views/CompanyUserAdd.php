<?php

    use Controllers\HomeController as HomeController;
    use Models\Alert as Alert;

    if(isset($_SESSION['loggedUser'])){
        $loggedUser = $_SESSION['loggedUser'];

    require_once('header.php');
    require_once("nav.php");
?>
<form action="<?php echo FRONT_ROOT?>CompanyUser/Add" method="POST">
    <div style="text-align: center; padding-top: 150px">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email">
        </div>
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" name="password">
        </div>
        <div class="form-group">
            <label for="companyId">Empresa</label>
            <input list="companyId" name="companyId">
            <datalist id="companyId">
                <?php
                    if(isset($companiesList)){
                        foreach($companiesList as $row){
                            ?> <option value="<?php echo $row->getCompanyId(); ?>"><?php echo $row->getNombre(); ?></option> <?php
                        }
                    }
                ?>
            </datalist>
        </div>
        <button type="submit">Agregar</button>
    </div>
</form>

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