<?php

    use Controllers\HomeController as HomeController;
    use Models\Alert as Alert;

    if(isset($_SESSION['loggedUser'])){
        $loggedUser = $_SESSION['loggedUser'];

    require_once('header.php');
    require_once("nav.php");
?>

<?php
    if($alert != null && $alert instanceof Alert){
        ?>
        <h5 class="alert-<?php echo $alert->getType();?>" > <?php echo $alert->getMessage(); ?></h5>
        <?php
    }
?>

<form action="<?php echo FRONT_ROOT?>Student/Add" method="POST">
    <div style="text-align: center; padding-top: 150px">
        <div class="form-group">
            <label for="careerId">Carrera</label>
            <select name="careerId" id="careerId">
                <?php    
                if(isset($careersList)){                    
                    foreach($careersList as $row){
                        ?>
                            <option value="<?php echo $row->getCareerId(); ?>"><?php echo $row->getDescription(); ?></option>
                        <?php
                    }
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="firstName">Nombre</label>
            <input type="text" name="firstName">
        </div>
        <div class="form-group">
            <label for="lastName">Apellido</label>
            <input type="text" name="lastName">
        </div>
        <div class="form-group">
            <label for="dni">DNI</label>
            <input type="text" name="dni">
        </div>
        <div class="form-group">
            <label for="fileNumber">Numero de Archivo</label>
            <input type="text" name="fileNumber">
        </div>
        <div class="form-group">
            <label for="gender">Genero</label>
            <input type="text" name="gender">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password">
        </div>
        <div class="form-group">
            <label for="birthDate">Fecha de Nacimiento</label>
            <input type="text" name="birthDate">
        </div>
        <div class="form-group">
            <label for="phoneNumber">Numero de Telefono</label>
            <input type="text" name="phoneNumber">
        </div>
        <div class="form-group">
            <label for="active">Activo</label>
            <input type="number" name="active" min="0" max="1">
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