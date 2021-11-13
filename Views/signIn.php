<?php

use Models\Alert;

require_once('header.php');
?>
    <div style="text-align: center; padding-top: 100px">
        <h2>Registrar una cuenta</h2>
            <strong>Tipo de cuenta:</strong>
            <form action="<?php echo FRONT_ROOT ?>Account/ShowSignInView" method="POST">
                <button type="submit" id="alumno" value="alumno" name="accountType">Alumno</button>
                <button type="submit" id="empresa" value="empresa" name="accountType">Empresa</button>
            </form>
        <?php
        if(isset($accountType)){
            if($accountType == "alumno"){
                ?>
                    <form action="<?php echo FRONT_ROOT ?>Account/SignInAsStudent" method="POST" style="margin-top: 40px;">
                    
                    <label for="email">Email</label>
                    <input type="text" name="email" required>
                    
                    <label for="dni">DNI</label>
                    <input type="text" name="dni" required>
                    
                    <button type="submit">Registrarse</button>
                    </form>
                    <form action="<?php echo FRONT_ROOT ?>Home/Index" method="POST" style="margin-top: 10px;">
                    <button type="submit">Cancelar</button>
                    </form>
                <?php

            }elseif($accountType == 'empresa'){
                ?>
                <form action="<?php echo FRONT_ROOT ?>Account/SignInAsCompanyUser" method="POST" style="margin-top: 40px;">
                    
                    <label for="email">Email de Empresa</label>
                    <input type="text" name="email" required>
                    
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" required>

                    <label for="cuit">CUIT de Empresa</label>
                    <input type="number" name="cuit" required>
                    
                    <button type="submit">Registrarse</button>
                </form>
                <form action="<?php echo FRONT_ROOT ?>Home/Index" method="POST" style="margin-top: 10px;">
                    <button type="submit">Cancelar</button>
                </form>
                <?php
            }elseif($accountType == "empresaSinRegistrar"){
                ?>
                <form action="<?php echo FRONT_ROOT ?>Account/SignInAsUnregisteredCompanyUser" method="POST" style="margin-top: 40px;">
                    
                    <label for="email">Email de Empresa</label>
                    <input type="text" name="email" value="<?php echo $email;?>" required>
                    
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" value="<?php echo $password;?>" required>

                    <label for="cuit">CUIT de Empresa</label>
                    <input type="number" name="cuit" value="<?php echo $cuit;?>" required>

                    <br>

                    <label for="nombre">Nombre de la Empresa</label>
                    <input type="text" name="nombre" required>

                    <label for="estado">Estado</label>
                    <input type="text" name="estado">

                    <label for="companyLink">Link de la Empresa</label>
                    <input type="text" name="companyLink">

                    <br>

                    <label for="descripcion">Descripcion</label>
                    <input type="text" name="descripcion">
                    
                    <button type="submit">Registrarse</button>
                </form>
                <form action="<?php echo FRONT_ROOT ?>Home/Index" method="POST" style="margin-top: 10px;">
                    <button type="submit">Cancelar</button>
                </form>
                <?php
            }
        }
        ?>
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