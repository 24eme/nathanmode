<table width="92%" border="0" cellspacing="0" cellpadding="0" style="margin:0 0 0 5px;" class="subTab">
	<thead>
		<tr>
	        <th><label>Date</label></th>
	        <th><label>Statut</label></th>
	        <th><label>Référence</label></th>
	        <th><label>&nbsp;</label></th>
        </tr>
	</thead>
	<tbody id="form_details_container">
        <?php foreach($form['details'] as $item_form): ?>
            <?php echo include_partial('relationDetailsItem', array('form' => $item_form)); ?>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
    	<tr>
			<td colspan="4">
				<a href="#" class="lien_ajouter_ligne btPlus right" data-template="#template_details" data-container="#form_details_container" data->+</a>
			</td>
		</tr>
    </tfoot>
</table>

<script id="template_details" type="text/x-jquery-tmpl">
    <?php echo include_partial('relationDetailsItem', array('form' => $form->getTemplate('details'))); ?>
</script>