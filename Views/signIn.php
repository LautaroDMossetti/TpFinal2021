<?php

use Models\Alert;

require_once('header.php');
?>
    <div style="text-align: center; padding-top: 220px">
        <form action="<?php echo FRONT_ROOT ?>Account/SignIn" method="POST">
            <h2>Registrar una cuenta</h2>

            <label for="email">Email</label>
            <input type="text" name="email">

            <label for="dni">DNI</label>
            <input type="text" name="dni">

            <button type="submit">Registrarse</button>
        </form>
        <form action="<?php echo FRONT_ROOT ?>Home/Index" method="POST" style="margin-top: 10px;">
            <button type="submit">Cancelar</button>
        </form>
    </div>

    <?php
    if($alert != null && $alert instanceof Alert){
        ?>
        <h5 class="alert-<?php echo $alert->getType();?>" > <?php echo $alert->getMessage(); ?></h5>
        <?php
    }
    ?>
<?php
    require_once('footer.php');
?>