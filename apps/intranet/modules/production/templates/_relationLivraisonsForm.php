<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td>
          <table width="100%" border="0" cellpadding="0" cellspacing="0" class="subTab">
            <tr>
                  <th style="width: 8%;"><label>Date livraison</label></th>
                  <th style="width: 8%;"><label>Catégorie</label></th>
                  <th style="width: 10%;"><label>Référence</label></th>
                  <th style="width: 10%;"><label>Colori</label></th>
                  <th style="width: 8%;"><label>Quantité</label></th>
                  <th style="width: 8%;"><label>Prix de vente</label></th>
                  <th style="width: 6%;"><label>Escompte</label></th>
                  <th><label>Adresse de livraison</label></th>
                  <th style="width: 8%;"><label>Num facture</label></th>
                  <th style="width: 6%;"><label style="text-align:left;">PDF facture</label></th>
                  <th style="width: 6%;"><label style="text-align:left;">Packing list</label></th>
                  <th style="width: 0;"><label>&nbsp;</label></th>
              </tr>
              <tbody id="form_livraisons_container">
                  <?php foreach($form['livraisons'] as $item_form): ?>
                          <?php echo include_partial('production/relationLivraisonsItem', array('form' => $item_form)); ?>
                  <?php endforeach; ?>
              </tbody>
              <tr style="display: none;">
                  <td colspan="12" class="px-0">
                      <a id="ajouter_livraison" class="btPlus right lien_ajouter_ligne" data-template="#template_livraisons" data-container="#form_livraisons_container" href="#">+</a>
                  </td>
              </tr>
            </table>
          </td>
        </tr>
  </table>

<script id="template_livraisons" type="text/x-jquery-tmpl">
    <?php echo include_partial('production/relationLivraisonsItem', array('form' => $form->getTemplate('livraisons'))); ?>
</script>
