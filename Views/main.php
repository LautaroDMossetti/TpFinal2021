<?php

    use Controllers\HomeController as HomeController;
    use Models\Admin as Admin;

    if(isset($_SESSION['loggedUser'])){
        $loggedUser = $_SESSION['loggedUser'];

    require_once('header.php');
    require_once('nav.php');
?>
    <div style="text-align: center; padding-top: 220px">

    <?php

    if($loggedUser instanceof Admin){
        ?> <h2>Welcome, Admin</h2> <?php
    }else{
        ?>
            <h2>Welcome, <?php echo $loggedUser->getFirstname() . ' ' . $loggedUser->getLastName(); ?></h2>
        
            <br>
        <?php
    }
    ?>    
            <form action="<?php echo FRONT_ROOT ?>Account/Logout" method="POST">
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