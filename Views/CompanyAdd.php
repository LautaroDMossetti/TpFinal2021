<?php
    require_once("nav.php");
?>
<form action="<?php echo(FRONT_ROOT)?>Company/Add" method="POST">
    <div>
        <div class="form-grup">
            <label for="companyId">Id de la compania</label>
            <input type="number" name="companyId">
        </div>
        <div class="form-grup">
            <label for="cuit">Cuit</label>
            <input type="number" name="cuit">
        </div>
        <div class="form-grup">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre">
        </div>
        <div class="form-grup">
            <label for="link">Link</label>
            <input type="text" name="link">
        </div>
        <div class="form-grup">
            <label for="descripcion">Descripcion</label>
            <input type="text" name="descripcion">
        </div>
        <div class="form-grup">
            <label for="estado">Estado</label>
            <input type="text" name="estado">
        </div>
        <button type="submit" name="button">Agregar</button>
    </div>
</form>