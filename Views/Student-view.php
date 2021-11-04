<?php
use Controllers\HomeController as HomeController;
use Models\Admin as Admin;

    if(isset($_SESSION['loggedUser'])){
        $loggedUser = $_SESSION['loggedUser'];


        require_once("nav.php");
    
?>
<main class="py-5">
    <div class="conteiner">
        <h2 class="mb-4">Informacion del alumno</h2>
        <table class="table bg-ligth-alpha">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Dni</th>
                    <th>Genero</th>
                    <th>Telefono</th>
                    <th>Cumpleaños</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th><?php echo($loggedUser->getFirstName()) ?></th>
                    <th><?php echo($loggedUser->getLastName())?></th>
                    <th><?php echo($loggedUser->getDni())?></th>
                    <th><?php echo($loggedUser->getGender())?></th>
                    <th><?php echo($loggedUser->getPhoneNumber())?></th>
                    <th><?php echo($loggedUser->getBirthDate())?></th>
                </tr>
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