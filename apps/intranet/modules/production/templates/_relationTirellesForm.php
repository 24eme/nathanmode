<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td>
            <table width="100%" border="0" cellpadding="0" cellspacing="0" class="subTab">
                <tr>
                    <th><label>Date exp.</label></th>
                    <th><label>Colori</label></th>
                    <th><label>Métrage</label></th>
                    <th><label>Bain</label></th>
                    <th><label>Validé</label></th>
                    <th><label>Refusé</label></th>
                    <th><label>Retraitement</label></th>
                    <th>&nbsp;</th>
                </tr>
                <tbody id="form_tirelles_container">
                    <?php foreach($form['tirelles'] as $item_form): ?>
                        <?php echo include_partial('production/relationTirellesItem', array('form' => $item_form)); ?>
                    <?php endforeach; ?>
                </tbody>
                <tr>
                    <td colspan="8">
                        <a href="#" class="btPlus right lien_ajouter_ligne" data-template="#template_tirelles" data-container="#form_tirelles_container">+</a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<script id="template_tirelles" type="text/x-jquery-tmpl">
    <?php echo include_partial('production/relationTirellesItem', array('form' => $form->getTemplate('tirelles'))); ?>
</script>
