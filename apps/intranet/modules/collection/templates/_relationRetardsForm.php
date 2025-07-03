
<div id="form_retards_container">
    <?php foreach($form['retards'] as $item_form): ?>
        <?php echo include_partial('collection/relationRetardsItem', array('form' => $item_form)); ?>
    <?php endforeach; ?>
</div>
<div class="setAdd">
    <a href="#" class="btAdd lien_ajouter_ligne" data-template="#template_retards" data-container="#form_retards_container">Ajouter un retard</a>
</div>

<script id="template_retards" type="text/x-jquery-tmpl">
    <?php echo include_partial('collection/relationRetardsItem', array('form' => $form->getTemplate('retards'))); ?>
</script>