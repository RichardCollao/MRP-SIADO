<h3>Cuentas de costos</h3>
<hr />
<div style="margin-bottom: 15px;">
    <div style="float: left">
        <a href="<?php echo $data['link_create'] ?>">
            <button type="button" class="btn btn-primary">Crear</button>
        </a>
    </div>
    <!--Boton de la barra de busqueda-->
    <?php echo HelperWebIconFontAwesome::btnSearchBar(); ?>

    <!--Paginador-->
    <div style="margin-bottom: 15px;float: right">
        <?php echo $data['pagination']; ?>
    </div>    
    <div style="clear: both"></div>
</div>

<?php echo $data['bar_filters']; ?>

<table class="table table-bordered table-condensed table-hover table-striped">
    <thead>
        <tr class="thead">
            <th style="width:40%">Número de cuenta</th>
            <th style="width:40%">Nombre de cuenta</th>
            <th>Operacion</th>        
        </tr>
    </thead>            
    <?php if (!is_empty($data['rows'])): ?>
        <?php foreach ($data['rows'] as $row): ?>
            <tr>
                <td><?php echo $row['number']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td style="text-align: right;">
                    <?php echo HelperWebIconFontAwesome::btnEdit($data['link_edit'] . $row['id_expense_account']); ?>
                    &nbsp;
                    <?php echo HelperWebIconFontAwesome::btnDelete($data['link_delete'] . $row['id_expense_account']); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="3">
                No se encontró ningún dato...
            </td>
        </tr>
    <?php endif; ?>
</table>