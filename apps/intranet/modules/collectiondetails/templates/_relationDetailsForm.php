 <table width="100%" border="0" cellpadding="0" cellspacing="0" class="subTab">
    <tr>
        <th><label>Colori</label></th>
        <th><label>Métrage</label></th>
        <th><label>PF Catégorie</label></th>
        <th><label>PF</label></th>
        <th><label>Prix</label></th>
        <th><label>&nbsp;</label></th>
        <th><label>&nbsp;</label></th>
    </tr>
    <tbody id="form_details_container">
        <?php foreach($form['details'] as $item_form): ?>
                <?php echo include_partial('collection/relationDetailsItem', array('form' => $item_form)); ?>
        <?php endforeach; ?>
    </tbody>
    <tr>
        <td colspan="5">
            <a class="btPlus right lien_ajouter_ligne" data-template="#template_details" data-container="#form_details_container" href="#">+</a>
        </td>
    </tr>
</table>

<script id="template_details" type="text/x-jquery-tmpl">
    <?php echo include_partial('collection/relationDetailsItem', array('form' => $form->getTemplate('details'))); ?>
</script>