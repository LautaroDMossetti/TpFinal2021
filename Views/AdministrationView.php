<?php
use Controllers\HomeController as HomeController;
use Models\Alert as Alert;

    if(isset($_SESSION['loggedUser'])){
        $loggedUser = $_SESSION['loggedUser'];

        require_once('header.php');
        require_once("nav.php");
    
?>
<main>
    <div style="text-align: center; padding-top: 150px">
        <h2>Tipos de Gestion</h2>
            <form action="<?php echo FRONT_ROOT ?>Student/ShowListView" method="GET" style="display: inline;">
                <button type="submit">Listar Alumnos</button>
            </form>
            <form action="<?php echo FRONT_ROOT ?>Company/ShowListView" method="GET" style="display: inline;">
                <button type="submit">Listar Empresas</button>
            </form>
            <form action="<?php echo FRONT_ROOT ?>CompanyUser/ShowListView" method="GET" style="display: inline;">
                <button type="submit">Listar Usuarios Empresa</button>
            </form>
    </div>
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