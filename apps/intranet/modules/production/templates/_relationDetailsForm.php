<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td>
          <table width="100%" cellpadding="0" cellspacing="0" class="subTab collection-tables">
	      <tr>
                  <?php if (sfConfig::get('app_no_metrage')) : ?>
                    <th style="width: 0;"><label>Image</label></th>
                  <?php endif ?>
                  <th class="large-column"><label>Catégorie</label></th>
                  <th class="large-column"><label>Référence</label></th>
                  <th class="large-column"><label>Colori</label></th>
                  <th class="small-column"><label>Quantité</label></th>
                  <?php if (sfConfig::get('app_no_metrage')) : ?>
                    <th class="medium-column"><label>Prix d'achat factory</label></th>
                  <?php endif;  ?>
                  <th class="medium-column"><label>Prix de vente factory</label></th>
                  <?php if (sfConfig::get('app_no_metrage')) : ?>
                    <th class="medium-column"><label>Prix public TTC</label></th>
                    <th class="medium-column"><label>Frais d'approche</label></th>
                    <th class="small-column"><label>Marge<br /><small>(coef,%,montant)</small></label></th>
                    <th class="small-column"><label>Client<br /><small>(coef,%,montant)</small></label></th>
                    <?php endif;  ?>
                  <th class="small-column">ETD demandé</th>
                  <th class="small-column">ETD confirmé</th>
                  <th class="small-column"><label>Reste à livrer</label></th>
                  <th style="width: 0;"><label>&nbsp;</label></th>
                  <th style="width: 0;"><label>&nbsp;</label></th>
                  <th style="width: 0;"><label>&nbsp;</label></th>
              </tr>
              <tbody id="form_details_container">
                  <?php foreach($form['details'] as $item_form): ?>
                          <?php echo include_partial('production/relationDetailsItem', array('form' => $item_form, 'collection' => $collection)); ?>
                  <?php endforeach; ?>
              </tbody>
              <tr>
                  <td colspan="15" class="px-0">
                      <a class="btPlus right lien_ajouter_ligne" data-template="#template_details" data-container="#form_details_container" href="#">+</a>
                  </td>
              </tr>
            </table>
          </td>
        </tr>
  </table>
<datalist id="liste_qualite">
    <?php foreach(CollectionTable::getInstance()->getQualites() as $libelle): ?>
    <option value="<?php echo $libelle['qualite'] ?>">
    <?php endforeach; ?>
</datalist>
<script id="template_details" type="text/x-jquery-tmpl">
    <?php echo include_partial('production/relationDetailsItem', array('form' => $form->getTemplate('details') , 'collection' => $collection)); ?>
</script>
