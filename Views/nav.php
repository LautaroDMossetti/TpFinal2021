<?php
    use Models\Admin as Admin;
    use Models\Student as Student;
    use Models\CompanyUser as CompanyUser;
?>

<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
    <form action="<?php echo FRONT_ROOT ?>Account/ShowMainView" method="GET">
        <button type="submit" class="btn btn-dark ml-auto d-block">Home</button>
    </form>

    <?php

        if($loggedUser instanceof Student){
            ?>
            
            <form action="<?php echo FRONT_ROOT ?>Student/ShowStudentProfileView" method="GET">
                <button type="submit" class="btn btn-dark ml-auto d-block" name="id" value="<?php echo $loggedUser->getStudentId();?>">Perfil</button>
            </form>

            <?php
        }
        if($loggedUser instanceof CompanyUser){
            ?>
            
            <form action="<?php echo FRONT_ROOT ?>CompanyUser/ShowCompanyUserProfileView" method="GET">
                <button type="submit" name="id" value="<?php echo $loggedUser->getCompanyUserId();?>" class="btn btn-dark ml-auto d-block">Perfil Empresa</button>
            </form>

            <?php
        }

        
    ?>

    <?php
    if(! $loggedUser instanceof Admin){
        ?>
            <form action="<?php echo FRONT_ROOT ?>Company/ShowListView" method="GET">
                <button type="submit" class="btn btn-dark ml-auto d-block">Empresas</button>
            </form>
        <?php
    }
    ?>
    
    <?php

        if($loggedUser instanceof Admin){
            ?>
            
            <form action="<?php echo FRONT_ROOT ?>Admin/ShowAdminView" method="GET">
                <button type="submit" class="btn btn-dark ml-auto d-block">Gestion</button>
            </form>

            <?php
        }
    ?>

    <form action="<?php echo FRONT_ROOT ?>JobOffer/ShowListView" method="GET">
        <button type="submit" class="btn btn-dark ml-auto d-block">Ofertas de Trabajo</button>
    </form>
    
    <div style="position: absolute; right: 20px;">
        <form action="<?php echo FRONT_ROOT ?>Account/Logout" method="GET">
            <button type="submit" class="btn btn-dark ml-auto d-block">Logout</button>
        </form>
    </div>
</nav>