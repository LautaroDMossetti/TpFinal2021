<?php
    require_once("nav.php");
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Listado de Empresas</h2>
            <table class="table bg-light-alpha">
                <thead>
                    <ul>Nombre</ul>
                    <ul>Descripcion</ul>
                    <ul>Cuit</ul>
                    <ul>Estado</ul>
                    <ul>Link</ul>
                </thead>
                <tbody>
                    <?php
                        foreach($companyList as $row){
                            ?>
                            <tr>
                                <td><?php $row->getNombre() ?></td>
                                <td><?php $row->getDescripcion()?></td>
                                <td><?php $row->getCuit()?></td>
                                <td><?php $row->getEstado()?></td>
                                <td><?php $row->getLink()?></td>
                            </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</main>