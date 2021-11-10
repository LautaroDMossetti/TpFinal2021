<?php
    use Controllers\HomeController as HomeController;
    use Models\Admin as Admin;
    use Models\Alert as Alert;

    if(isset($_SESSION['loggedUser'])){
    $loggedUser = $_SESSION['loggedUser'];

    require_once('header.php');
    require_once('nav.php');
    
?>
<main>
    <section id="listado" class="mb-5">
        <div class="conteiner">
        <h2 class="mb-4">Listado de Puestos de Trabajo</h2>
            <table class="table bg-light-alpha">
                <thead>
                    <tr>
                        <th>Descripcion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(isset($jobPositionList)){
                            foreach($jobPositionList as $row){
                                ?>
                                    <tr>
                                        <td><?php echo $row->getDescription(); ?></td>
                                        <td>
                                            <form action="<?php echo FRONT_ROOT ?>JobOffer/ShowAddView" method="POST" style="display: inline;">
                                                <button type="submit" name="idJobPosition" value="<?php echo $row->getJobPositionId(); ?>">Crear Oferta</button>
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
    </section>
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