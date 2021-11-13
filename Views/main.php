<?php

    use Controllers\HomeController as HomeController;
    use Models\Admin as Admin;
    use Models\Alert as Alert;
    use Models\Student as Student;
    use Models\CompanyUser as CompanyUser;
    use Controllers\CompanyController as CompanyController;

    if(isset($_SESSION['loggedUser'])){
        $loggedUser = $_SESSION['loggedUser'];

    require_once('header.php');
    require_once('nav.php');
?>
    <div style="text-align: center; padding-top: 220px">

    <?php

    if($loggedUser instanceof Admin){
        ?> <h2>Welcome, Admin <?php echo $loggedUser->getAdminId()?></h2> <?php
    }elseif($loggedUser instanceof Student){
        ?>
            <h2>Welcome, <?php echo $loggedUser->getFirstname() . ' ' . $loggedUser->getLastName(); ?></h2>
        <?php
    }elseif($loggedUser instanceof CompanyUser){
        $companyController = new CompanyController();
        $userCompany = $companyController->GetOne($loggedUser->getCompanyId());

        ?> <h2>Welcome, <?php echo $userCompany->getNombre()?> Company</h2> <?php
    }
    ?>    
    </div>

    <?php
    if($alert != null && $alert instanceof Alert){
        ?>
        <h5 class="alert-<?php echo $alert->getType();?>" > <?php echo $alert->getMessage(); ?></h5>
        <?php
    }
    if($alert != null && $alert2 instanceof Alert){
        ?>
        <h5 class="alert-<?php echo $alert2->getType();?>" > <?php echo $alert2->getMessage(); ?></h5>
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