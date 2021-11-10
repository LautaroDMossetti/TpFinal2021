<?php
    use Controllers\AccountController as AccountController;
    use Models\Admin as Admin;
?>

<nav class="navbar navbar-expand-lg  navbar-dark bg-dark" style="width: 100%;">
    
    <form action="<?php echo FRONT_ROOT ?>Account/ShowMainView" method="GET">
        <button type="submit" class="btn btn-dark ml-auto d-block">Home</button>
    </form>

    <form action="<?php echo FRONT_ROOT ?>Company/ShowListView" method="GET">
        <button type="submit" class="btn btn-dark ml-auto d-block">Listar Empresas</button>
    </form>
    
    <form action="<?php echo FRONT_ROOT ?>Student/viewInfo" method="GET">
        <button type="submit" class="btn btn-dark ml-auto d-block">Mostrar informacion del ususario</button>
    </form>
    <?php

    if($loggedUser instanceof Admin){
        ?>
        
        <form action="<?php echo FRONT_ROOT ?>Company/ShowAddView" method="GET">
            <button type="submit" class="btn btn-dark ml-auto d-block">Administrar Empresas</button>
        </form>

        <?php
    }

    ?>
</nav>