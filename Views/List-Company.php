<?php

    use Controllers\HomeController as HomeController;
    use Models\Admin as Admin;
    use Models\Alert as Alert;

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

    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Listado de Empresas</h2>

            <form action="<?php echo FRONT_ROOT ?>Company/FilterByName">
                <input type="text" name="nombre" placeholder="Buscar por nombre">
            </form>
            <table class="table bg-light-alpha">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Cuit</th>
                        <th>Link</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(isset($companyList)){
                            foreach($companyList as $row){
                                ?>
                                    <tr>
                                        <td><?php echo $row->getNombre();?></td>
                                        <td><?php echo $row->getCuit();?></td>
                                        <td><?php echo $row->getCompanyLink();?></td>
                                        <td>
                                            <form action="<?php echo FRONT_ROOT ?>Company/ShowCompanyProfileView" method="POST" style="display: inline;">
                                                <button type="submit" name="id" value="<?php echo $row->getCompanyId(); ?>">Ver Perfil</button>
                                            </form>

                                            <?php if($loggedUser instanceof Admin){
                                                ?>
                                                    <form action="<?php echo FRONT_ROOT ?>Company/ShowModifyView" method="POST" style="display: inline;">
                                                        <button type="submit" name="id" value="<?php echo $row->getCompanyId(); ?>">Modificar</button>
                                                    </form>
                                                    <form action="<?php echo FRONT_ROOT ?>Company/Remove" method="POST" style="display: inline;">
                                                        <button type="submit" name="id" value="<?php echo $row->getCompanyId(); ?>">Eliminar</button>
                                                    </form>
                                                <?php
                                            }
                                            ?>
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
    require_once('footer.php');
    
    }else{
        $alert = new Alert("", "");

        $alert->setType("danger");
        $alert->setMessage("Acceso no autorizado");

        $homeController = new HomeController();

        $homeController->Index($alert);
    }
?>