<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td>
          <table width="100%" cellpadding="0" cellspacing="0" class="subTab">
              <tr>
                  <th>Date livr. prévue</th>
                  <?php if (sfConfig::get('app_devise_dollar')) : ?>
                    <th></th>
                    <th><label>Image</label></th>
                  <?php endif ?>
                  <th><label>Colori</label></th>
                  <th><label>Quantité</label></th>
                  <th><label>Prix d'achat factory</label></th>
                  <th><label>Prix de vente factory</label></th>
                  <th><label>Marge&nbsp;montant</label></th>
                  <th><label>Marge&nbsp;coef&nbsp;/&nbsp;%</label></th>
                  <th><label>Client&nbsp;coef&nbsp;/&nbsp;%</label></th>
                  <th><label>&nbsp;</label></th>
                  <th><label>&nbsp;</label></th>
              </tr>
              <tbody id="form_details_container">
                  <?php foreach($form['details'] as $item_form): ?>
                          <?php echo include_partial('collection/relationDetailsItem', array('form' => $item_form)); ?>
                  <?php endforeach; ?>
              </tbody>
              <tr>
                  <td colspan="10" class="px-0">
                      <a class="btPlus right lien_ajouter_ligne" data-template="#template_details" data-container="#form_details_container" href="#">+</a>
                  </td>
              </tr>
            </table>
          </td>
        </tr>
  </table>

<script id="template_details" type="text/x-jquery-tmpl">
    <?php echo include_partial('collection/relationDetailsItem', array('form' => $form->getTemplate('details'))); ?>
</script>
