<?php
    use Controllers\AccountController as AccountController;
    use Models\Admin as Admin;
    use Models\Student as Student;
?>

<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
    <form action="<?php echo FRONT_ROOT ?>Account/ShowMainView" method="GET">
        <button type="submit" class="btn btn-dark ml-auto d-block">Home</button>
    </form>

    <?php

        if($loggedUser instanceof Student){
            ?>
            
            <form action="<?php echo FRONT_ROOT ?>Account/ShowProfileView" method="GET">
                <button type="submit" class="btn btn-dark ml-auto d-block">Perfil</button>
            </form>

            <?php
        }
    ?>

    <form action="<?php echo FRONT_ROOT ?>Company/ShowListView" method="GET">
        <button type="submit" class="btn btn-dark ml-auto d-block">Listar Empresas</button>
    </form>
    
    <?php

        if($loggedUser instanceof Admin){
            ?>
            
            <form action="<?php echo FRONT_ROOT ?>Company/ShowAddView" method="GET">
                <button type="submit" class="btn btn-dark ml-auto d-block">Agregar Empresa</button>
            </form>

            <?php
        }
    ?>
    
    <div style="position: absolute; right: 20px;">
        <form action="<?php echo FRONT_ROOT ?>Account/Logout" method="GET">
            <button type="submit" class="btn btn-dark ml-auto d-block">Logout</button>
        </form>
    </div>
</nav>