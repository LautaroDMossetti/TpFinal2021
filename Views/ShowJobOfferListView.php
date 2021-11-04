<?php
use Controllers\HomeController as HomeController;
use DAO\CompanyDAO;
use DAO\JobPositionDao;
use Models\Admin as Admin;

    if(isset($_SESSION['loggedUser'])){
        $loggedUser = $_SESSION['loggedUser'];


        require_once("nav.php");
    
?>
<main>
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
                                            $companyDao=new CompanyDAO();
                                            $company=$companyDao->getOne($row->getIdCompany());
                                            echo $company->getNombre();
                                        ?>
                                    </td>
                                    <td><?php echo $row->getFecha() ?></td>
                                    <td>
                                        <?php //el unico modo que se me ocurrio
                                            $aux=new JobPositionDao();
                                            $ids=$aux->getPositionById($row->getPositionById());
                                            echo $ids->getDetalle();
                                        ?>
                                    </td>
                                    <td><?php echo $row->getDetalle() ?></td>
                                    <td>
                                    <form action="<?php echo FRONT_ROOT?>JobOffer/Modify" metod="POST" style="text-aling: end;">
                                            <button type="submit" name="idJobOffer" value="<?php echo $row->getIdJobOffer()?>">Crear Oferta</button>
                                        </form>
                                    </td>
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
        $homeController = new HomeController();

        $homeController->Index("Acceso no autorizado");
    }
?>