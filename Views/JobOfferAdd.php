<?php

    use Controllers\HomeController as HomeController;
    use Models\Admin as Admin;
    use Models\Alert as Alert;

    if(isset($_SESSION['loggedUser'])){
        $loggedUser = $_SESSION['loggedUser'];

    require_once('header.php');
    require_once('nav.php');
?>
<form action="<?php echo FRONT_ROOT ?>JobOffer/Add" method="POST">
<div style="text-align: center; padding-top: 150px">
    <div class="form-group">
        <label for="companyName">Nombre de la compania</label>
        <input type="text" name="companyName">
    </div>
    <div class="form-group">
        <label for="detalle">Detalle</label>
        <input type="text" name="detalle">
    </div>
    <div class="form-group">
        <label for="fecha">Fecha</label>
        <input type="date" name="fecha">
    </div>
    <div class="form-group">
        <label for="idJobPosition">IdJobPosition</label>
        <input type="number" name="idJobPosition" value="<?php echo $idJobPosition;?>" readonly>
    </div>
    <button type="submit">Agregar</button>
</div>
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