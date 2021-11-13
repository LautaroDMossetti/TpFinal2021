<?php

    use Controllers\CompanyController;
    use Controllers\HomeController as HomeController;
    use Models\Admin as Admin;
    use Models\Alert as Alert;

    if(isset($_SESSION['loggedUser'])){
        $loggedUser = $_SESSION['loggedUser'];

        $companyController = new CompanyController();

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
            <h2 class="mb-4">Listado de Usuarios Empresa</h2>

            <form action="<?php echo FRONT_ROOT ?>CompanyUser/FilterByEmail" style="display: inline;">
                <input type="text" name="email" placeholder="Buscar por email">
            </form>
            <?php if($loggedUser instanceof Admin){
                ?>
                    <form action="<?php echo FRONT_ROOT ?>CompanyUser/ShowAddView" style="display: inline;">
                        <button type="submit">Crear Usuario Empresa</button>
                    </form>
                <?php
                }
            ?>
            <table class="table bg-light-alpha">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Empresa</th>
                        <th>Cuit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(isset($companyUsersList)){
                            foreach($companyUsersList as $row){
                                $userCompany = $companyController->GetOne($row->getCompanyId());

                                ?>
                                    <tr>
                                        <td><?php echo $row->getEmail();?></td>
                                        <td><?php echo $userCompany->getNombre();?></td>
                                        <td><?php echo $userCompany->getCuit();?></td>
                                        <td>
                                            <form action="<?php echo FRONT_ROOT ?>Company/ShowCompanyProfileView" method="POST" style="display: inline;">
                                                <button type="submit" name="id" value="<?php echo $userCompany->getCompanyId(); ?>">Ver Perfil</button>
                                            </form>

                                            <?php if($loggedUser instanceof Admin){
                                                ?>
                                                    <form action="<?php echo FRONT_ROOT ?>CompanyUser/ShowModifyView" method="POST" style="display: inline;">
                                                        <button type="submit" name="id" value="<?php echo $row->getCompanyUserId(); ?>">Modificar</button>
                                                    </form>
                                                    <form action="<?php echo FRONT_ROOT ?>CompanyUser/Remove" method="POST" style="display: inline;">
                                                        <button type="submit" name="id" value="<?php echo $row->getCompanyUserId(); ?>">Eliminar</button>
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