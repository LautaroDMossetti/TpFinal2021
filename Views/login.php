<?php

use Models\Alert;

require_once('header.php');
?>
    <div style="text-align: center; padding-top: 220px">
        <form action="<?php echo FRONT_ROOT ?>Account/Login" method="POST">
            <h2>TP Lab IV 2021</h2>

            <label for="email">Email</label>
            <input type="text" name="email">

            <label for="password">Password</label>
            <input type="password" name="password">

            <button type="submit">Login</button>
        </form>
    </div>

    <?php
    if($alert != null && $alert instanceof Alert){
        ?>
        <h5 class="alert-<?php echo $alert->getType();?>" > <?php echo $alert->getMessage(); ?></h5>
        <?php
    }
    if($alert2 != null && $alert2 instanceof Alert){
        ?>
        <h5 class="alert-<?php echo $alert2->getType();?>" > <?php echo $alert2->getMessage(); ?></h5>
        <?php
    }
    ?>
<?php
    require_once('footer.php');
?>