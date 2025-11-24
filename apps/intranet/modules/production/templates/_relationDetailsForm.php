<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td>
          <table width="100%" cellpadding="0" cellspacing="0" class="subTab collection-tables">
	      <tr>
                  <?php if (sfConfig::get('app_no_metrage')) : ?>
                    <th colspan="2"><label>Image</label></th>
                  <?php endif ?>
                  <th><label>Catégorie</label></th>
                  <th><label>Référence</label></th>
                  <th><label>Colori</label></th>
                  <th><label>Quantité</label></th>
                  <?php if (sfConfig::get('app_no_metrage')) : ?>
                    <th><label>Prix d'achat factory</label></th>
                  <?php endif;  ?>
                  <th><label>Prix de vente factory</label></th>
                  <?php if (sfConfig::get('app_no_metrage')) : ?>
                    <th><label>Prix public TTC</label></th>
                    <th><label>Frais d'approche</label></th>
                    <th><label>Marge&nbsp;montant</label></th>
                    <th><label>Marge&nbsp;coef&nbsp;/&nbsp;%</label></th>
                    <th><label>Client&nbsp;coef&nbsp;/&nbsp;%</label></th>
                  <?php endif;  ?>
                  <th>Date livr. prévue</th>
                  <th><label>Reste à livrer</label></th>
                  <th><label>&nbsp;</label></th>
                  <th><label>&nbsp;</label></th>
              </tr>
              <tbody id="form_details_container">
                  <?php foreach($form['details'] as $item_form): ?>
                          <?php echo include_partial('production/relationDetailsItem', array('form' => $item_form, 'collection' => $collection)); ?>
                  <?php endforeach; ?>
              </tbody>
              <tr>
                  <td colspan="16" class="px-0">
                      <a class="btPlus right lien_ajouter_ligne" data-template="#template_details" data-container="#form_details_container" href="#">+</a>
                  </td>
              </tr>
            </table>
          </td>
        </tr>
  </table>

<script id="template_details" type="text/x-jquery-tmpl">
    <?php echo include_partial('production/relationDetailsItem', array('form' => $form->getTemplate('details') , 'collection' => $collection)); ?>
</script>
