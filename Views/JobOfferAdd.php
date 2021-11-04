<?php
?>
<form action="<?php echo(FRONT_ROOT)?>" method="POST">
<div style="text-align: center; padding-top: 150px">
    <div class="form-group">
        <label for="nombre">Nombre de la compania</label>
        <input type="text" name="nombre">
    </div>
    <div class="form-group">
        <label for="descripcion">Descripcion</label>
        <input type="text" name="descripcion">
    </div>
    <div class="form-group">
        <label for="estado">Fecha</label>
        <input type="date" name="estado">
    </div>
    <button type="submit">Agregar</button>
</div>
</form>
<?php
require_once('footer.php');
?>