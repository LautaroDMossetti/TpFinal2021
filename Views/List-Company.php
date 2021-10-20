<?php

    use Controllers\HomeController as HomeController;
    use Models\Admin as Admin;

    if(isset($_SESSION['loggedUser'])){
        $loggedUser = $_SESSION['loggedUser'];


    require_once("nav.php");
?>
<main class="py-5">
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
                        <th>Descripcion</th>
                        <th>Cuit</th>
                        <th>Estado</th>
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
                                        <td><?php echo $row->getDescripcion();?></td>
                                        <td><?php echo $row->getCuit();?></td>
                                        <td><?php echo $row->getEstado();?></td>
                                        <td><?php echo $row->getCompanyLink();?></td>
                                        <td>
                                            <?php if($loggedUser instanceof Admin){
                                                ?>
                                                    <form action="<?php echo FRONT_ROOT ?>Company/ShowModifyView" method="POST" style="text-align: end;">
                                                        <button type="submit" name="id" value="<?php echo $row->getId(); ?>">Modificar</button>
                                                    </form>
                                                    <form action="<?php echo FRONT_ROOT ?>Company/Remove" method="POST" style="text-align: end;">
                                                        <button type="submit" name="id" value="<?php echo $row->getId(); ?>">Eliminar</button>
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
<<<<<<< HEAD
</main>
=======
</main>
<?php
    require_once('footer.php');
    
    }else{
        $homeController = new HomeController();

        $homeController->Index("Acceso no autorizado");
    }
?>
>>>>>>> 7598659b62f5917367bbdc8f122c57a47cdeb58c
