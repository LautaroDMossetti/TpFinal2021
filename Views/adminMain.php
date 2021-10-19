<?php

    use Controllers\HomeController;

    if(isset($_SESSION['loggedUser'])){
        $loggedUser = $_SESSION['loggedUser'];

    require_once('header.php');
    require_once('adminNav.php');
?>
    <div style="text-align: center; padding-top: 220px">
        <h2>Welcome, Admin</h2>
        
        <br>

        <form action="<?php echo FRONT_ROOT ?>Account/Logout">
            <button type="submit">Logout</button>
        </form>
    </div>
<?php
    require_once('footer.php');
    
    }else{
        $homeController = new HomeController();

        $homeController->Index("Acceso no autorizado");
    }
?>