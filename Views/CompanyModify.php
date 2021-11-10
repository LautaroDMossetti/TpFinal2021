<?php

    use Controllers\HomeController as HomeController;
    use Models\Admin as Admin;
    use Models\Company as Company;
    use DAO\CompanyDAO as CompanyDAO;
    use Models\Alert as Alert;

    if(isset($_SESSION['loggedUser'])){
        $loggedUser = $_SESSION['loggedUser'];

    require_once('header.php');
    require_once('nav.php');

    $companyDAO = new CompanyDAO();
    $companyToModify = new Company();

    $companyToModify = $companyDAO->getOne($id);

?>
<table class="table bg-light-alpha">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Cuit</th>
            <th>Estado</th>
            <th>Link</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if(isset($companyToModify)){
                ?>
                    <form action="<?php echo FRONT_ROOT ?>Company/Modify" method="POST">
                        <tr>
                            <td><input type="number" name="id" value="<?php echo $companyToModify->getCompanyId();?>" readonly></td>
                            <td><input type="text" name="nombre" value="<?php echo $companyToModify->getNombre();?>"></td>
                            <td><input type="text" name="descripcion" value="<?php echo $companyToModify->getDescripcion();?>"></td>
                            <td><input type="number" name="cuit" value="<?php echo $companyToModify->getCuit();?>"></td>
                            <td><input type="text" name="estado" value="<?php echo $companyToModify->getEstado();?>"></td>
                            <td><input type="text" name="companyLink" value="<?php echo $companyToModify->getCompanyLink();?>"></td>
                        </tr>
                <?php
            }
        ?>
    </tbody>
</table>
    <button type="submit">Confirmar cambios</button>
                    </form>
                    <form action="<?php echo FRONT_ROOT ?>Company/ShowListView">
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