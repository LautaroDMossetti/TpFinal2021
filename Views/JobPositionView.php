<?php
use Controllers\HomeController as HomeController;
use Models\Admin as Admin;

    if(isset($_SESSION['loggedUser'])){
        $loggedUser = $_SESSION['loggedUser'];


        require_once("nav.php");
    
?>
<main>
    <div class="conteiner">
        <table class="table bg-light-alpha">
            <thead>
                <tr>
                    <th>Detalle</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($jobPositionList)){
                        foreach($jobPositionList as $row){
                            ?>
                                <tr>
                                    <td><?php echo $row->getDescripcion() ?></td>
                                    <td>
                                        <form action="<?php echo FRONT_ROOT?>JobOffer/ShowAddView" metod="POST" style="text-aling: end;">
                                            <button type="submit" name="idJobPosition" value="<?php echo $row->getIdJobPosition()?>">Crear Oferta</button>
                                        </form>
                                    </td>
                                </tr>

                            <?php
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</main>
<?php
    require_once("footer.php");
    }
?>