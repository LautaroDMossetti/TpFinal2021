<?php

    use DAO\CompanyDAO;
    use Controllers\HomeController as HomeController;
    use DAO\JobOfferDao;
    use Models\JobOffer;
    use Models\Alert as Alert;

    $companyDao=New CompanyDAO;
    $JobOfferDao=new JobOfferDao;
    $JobOffer=$JobOfferDao->SerchByJob($id);
    if(isset($_SESSION['loggedUser'])){
        $loggedUser = $_SESSION['loggedUser'];

    require_once('header.php');
    require_once('nav.php');
?>
<table class="table bg-light-alpha">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre de la empresa</th>
            <th>Fecha</th>
            <th>Descripcion</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if(isset($JobOffer)){
                ?>
                    <form action="<?php echo FRONT_ROOT ?>JobOffer/Modify" method="POST">
                        <tr>
                            <?php $companyName=$companyDao->getOne($JobOffer->getIdCompany())?>
                            <td><input type="number" name="id" value="<?php echo $JobOffer->getId();?>" readonly></td>
                            <td><input type="text" name="descripcion" value="<?php echo $JobOffer->getDescripcion();?>"></td>
                            <td><input type="date" name="descripcion" value="<?php echo $JobOffer->getFecha();?>"></td>
                        </tr>
                <?php
            }
        ?>
    </tbody>
</table>
    <button type="submit">Confirmar cambios</button>
                    </form>
                    <form action="<?php echo FRONT_ROOT ?>JobOffer/ShowListView">
                        <button type="submit">Cancelar</button>
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