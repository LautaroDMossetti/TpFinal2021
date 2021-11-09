<?php
?>
<form action="<?php echo(FRONT_ROOT)?>/JobOffer/Add" method="POST">
<div style="text-align: center; padding-top: 150px">
    <div class="form-group">
        <label for="companyName">Nombre de la compania</label>
        <input type="text" name="companyName">
    </div>
    <div class="form-group">
        <label for="descripcion">Descripcion</label>
        <input type="text" name="descripcion">
    </div>
    <div class="form-group">
        <label for="estado">Fecha</label>
        <input type="date" name="estado">
    </div>
    <div class="form-grup">
        <label for="idJobPosition">IdJobPosition</label>
        <input type="number"name="idJobPosition"value" <?php echo $jobPositionId?>">
    </div>
    <button type="submit">Agregar</button>
</div>
</form>
<?php
require_once('footer.php');
?>