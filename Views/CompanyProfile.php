<?php

    use Controllers\HomeController as HomeController;
    use Models\Alert as Alert;
    use Models\CompanyUser as CompanyUser;

    if(isset($_SESSION['loggedUser'])){
        $loggedUser = $_SESSION['loggedUser'];

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

    <h2>Empresa: <?php echo $company->getNombre()?></h2>

    <ul style="list-style-type: none; background: gray; width: 66%; margin: 2px">
        <li style="margin: 2px; background: white;">Nombre: <?php echo $company->getNombre(); ?></li>
        <?php
        if($loggedUser instanceof CompanyUser && $loggedUser->getCompanyId() == $company->getCompanyId() && isset($companyUser)){
            ?>
            <li style="margin: 2px; background: white;">Email: <?php echo $companyUser->getEmail(); ?></li>
            <?php
        }
        ?>
        <li style="margin: 2px; background: white;">Estado: <?php echo $company->getEstado(); ?></li>
        <li style="margin: 2px; background: white;">Link de Empresa: <?php echo $company->getCompanyLink(); ?></li>
        <li style="margin: 2px; background: white;">Cuit: <?php echo $company->getCuit(); ?></li>

        <li style="margin: 2px; background: white;">
                <p> Descripcion: <?php echo $company->getDescripcion(); ?> </p>
        </li>

    </ul>

    <?php
    if($loggedUser instanceof CompanyUser && $loggedUser->getCompanyId() == $company->getCompanyId()){
        ?>
            <form action="<?php echo FRONT_ROOT ?>CompanyUser/ShowModifyView" method="POST" style="display: inline;">
                <button type="submit" name="id" value="<?php echo $loggedUser->getCompanyUserId(); ?>">Modificar Cuenta</button>
            </form>
            <form action="<?php echo FRONT_ROOT ?>Company/ShowModifyView" method="POST" style="display: inline;">
                <button type="submit" name="id" value="<?php echo $loggedUser->getCompanyId(); ?>">Modificar Empresa</button>
            </form>
            <form action="<?php echo FRONT_ROOT ?>JobOffer/ShowPersonalListView" method="POST" style="display: inline;">
                <button type="submit" name="id" value="<?php echo $loggedUser->getCompanyId(); ?>">Ver Ofertas de Trabajo</button>
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