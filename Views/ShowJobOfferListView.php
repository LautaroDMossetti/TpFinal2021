<?php
use Controllers\HomeController as HomeController;
use DAO\CompanyDAO;
use DAO\JobPositionDao;
use Models\Admin as Admin;
use Models\Alert as Alert;

    if(isset($_SESSION['loggedUser'])){
        $loggedUser = $_SESSION['loggedUser'];

        

        require_once('header.php');
        require_once("nav.php");
    
?>
<main>

    <?php
    if($alert != null && $alert instanceof Alert){
        ?>
        <h5 class="alert-<?php echo $alert->getType();?>" > <?php echo $alert->getMessage(); ?></h5>
        <?php
    }
    ?>

    <?php
        if($loggedUser instanceof Admin){
            ?>
                <form action= "<?php echo FRONT_ROOT ?>JobPosition/ShowListView" method="POST" Style="text-aling: end;">
                    <button type="submit">Crear Oferta</button>
                </form>
            <?php
        }
    ?>
    <div class="conteiner">
        <table class="table bg-light-alpha">
            <thead>
                <tr>
                    <th>Compania</th>
                    <th>Fecha de publicacion</th>
                    <th>Puesto</th>
                    <th>Detalle</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($jobOfferList)){
                        foreach($jobOfferList as $row){
                            ?>
                                <tr>
                                    <td>
                                        <?php 
                                            $companyDao = new CompanyDAO();
                                            $company = $companyDao->getOne($row->getIdCompany());
                                            echo $company->getNombre();
                                        ?>
                                    </td>
                                    <td><?php echo $row->getFecha() ?></td>
                                    <td>
                                        <?php
                                            $jobPosDao = new JobPositionDao();
                                            $jobPos = $jobPosDao->getOne($row->getIdJobPosition());

                                            echo $jobPos->getDescription();
                                        ?>
                                    </td>
                                    <td><?php echo $row->getDetalle() ?></td>
                                    
                                    <?php
                                        if($loggedUser instanceof Admin){
                                            ?>
                                                <td>
                                                    <form action="<?php echo FRONT_ROOT?>JobOffer/Remove" metod="POST" style="text-aling: end;">
                                                            <button type="submit" name="id" value="<?php echo $row->getIdJobOffer()?>">Eliminar Oferta</button>
                                                    </form>
                                                </td>
                                            <?php
                                        }
                                    ?>
                                </tr>
                               
                            <?php
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</main>
<?php
    require_once("footer.php");

    }else{
        $alert = new Alert("", "");

        $alert->setType("danger");
        $alert->setMessage("Acceso no autorizado");

        $homeController = new HomeController();

        $homeController->Index($alert);
    }
?>