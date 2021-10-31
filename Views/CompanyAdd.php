<?php

    use Controllers\HomeController as HomeController;

    if(isset($_SESSION['loggedUser'])){
        $loggedUser = $_SESSION['loggedUser'];

    require_once('header.php');
    require_once("nav.php");
?>
<form action="<?php echo(FRONT_ROOT)?>Company/Add" method="POST">
    <div style="text-align: center; padding-top: 150px">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre">
        </div>
        <div class="form-group">
            <label for="cuit">Cuit</label>
            <input type="number" name="cuit">
        </div>
        <div class="form-group">
            <label for="link">Link</label>
            <input type="text" name="link">
        </div>
        <div class="form-group">
            <label for="descripcion">Descripcion</label>
            <input type="text" name="descripcion">
        </div>
        <div class="form-group">
            <label for="estado">Estado</label>
            <input type="text" name="estado">
        </div>
        <button type="submit">Agregar</button>
    </div>
</form>
<?php
    require_once('footer.php');
    
    }else{
        $homeController = new HomeController();

        $homeController->Index("Acceso no autorizado");
    }
?>