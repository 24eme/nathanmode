<div id="form_livraisons_container">
    <?php foreach($form['livraisons'] as $item_form): ?>
        <?php echo include_partial('collection/relationLivraisonsItem', array('form' => $item_form)); ?>
    <?php endforeach; ?>
</div>

<div class="setAdd">
    <a href="#" class="btAdd lien_ajouter_ligne" data-template="#template_livraisons" data-container="#form_livraisons_container">Ajouter une livraison</a>
</div>

<script id="template_livraisons" type="text/x-jquery-tmpl">
    <?php echo include_partial('collection/relationLivraisonsItem', array('form' => $form->getTemplate('livraisons'))); ?>
</script>