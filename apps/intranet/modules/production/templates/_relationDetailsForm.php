<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td>
          <table width="100%" cellpadding="0" cellspacing="0" class="subTab collection-tables">
	      <tr>
                  <?php if (sfConfig::get('app_no_metrage')) : ?>
                    <th style="width: 0;" rowspan="2"><label>Image</label></th>
                  <?php endif ?>
                  <th class="large-column" rowspan="2"><label>Catégorie</label></th>
                  <th class="large-column" rowspan="2"><label>Référence</label></th>
                  <th class="large-column" rowspan="2"><label>Colori</label></th>
                  <th class="small-column" rowspan="2"><label>Quantité</label></th>
                  <?php if (sfConfig::get('app_no_metrage')) : ?>
                    <th class="medium-column" rowspan="2"><label>Prix d'achat factory</label></th>
                  <?php endif;  ?>
                  <th class="medium-column" rowspan="2"><label>Prix de vente factory</label></th>
                  <?php if (sfConfig::get('app_no_metrage')) : ?>
                    <th class="medium-column" rowspan="2"><label>Prix public TTC</label></th>
                    <th class="medium-column" rowspan="2"><label>Frais d'approche</label></th>
                  <?php endif; ?>
                    <th class="medium-column" colspan="3"><label>Marge</label></th>
                <?php if (sfConfig::get('app_no_metrage')) : ?>
                    <th class="medium-column" colspan="2"><label>Client</label></th>
                  <?php endif;  ?>
                  <th class="small-column" rowspan="2">ETD demandé</th>
                  <th class="small-column" rowspan="2">ETD confirmé</th>
                  <th class="small-column" rowspan="2"><label>Reste à livrer</label></th>
                  <th style="width: 0;" rowspan="2"><label>&nbsp;</label></th>
                  <th style="width: 0;" rowspan="2"><label>&nbsp;</label></th>
                  <th style="width: 0;" rowspan="2"><label>&nbsp;</label></th>
              </tr>
              <tr>
                  <th>mont.</th>
                  <th>coef</th>
                  <th>%</th>
                  <?php if (sfConfig::get('app_no_metrage')) : ?>
                  <th>coef</th>
                  <th>%</th>
                  <?php endif; ?>
              </tr>
              <tbody id="form_details_container">
                  <?php foreach($form['details'] as $item_form): ?>
                          <?php echo include_partial('production/relationDetailsItem', array('form' => $item_form, 'collection' => $collection)); ?>
                  <?php endforeach; ?>
              </tbody>
              <tr>
                  <td colspan="20" class="px-0">
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
