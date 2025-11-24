<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td>
          <table width="100%" border="0" cellpadding="0" cellspacing="0" class="subTab">
            <tr>
                  <th style="width: 10%;"><label>Date livraison</label></th>
                  <?php if (sfConfig::get('app_no_metrage')) : ?>
                     <th style="width: 10%;"><label>Référence</label></th>
                  <?php endif; ?>
                  <th style="width: 12%;"><label>Colori</label></th>
                  <th style="width: 8%;"><label>Quantité</label></th>
                  <th style="width: 8%;"><label>Prix de vente</label></th>
                  <th style="width: 12%;"><label>Escompte</label></th>
                  <th><label>Adresse de livraison</label></th>
                  <th style="width: 8%;"><label>Num facture</label></th>
                  <th style="width: 10%;"><label>PDF facture</label></th>
                  <th style="width: 10%;"><label>Packing list</label></th>
                  <th style="width: 1%;"><label>&nbsp;</label></th>
              </tr>
              <tbody id="form_livraisons_container">
                  <?php foreach($form['livraisons'] as $item_form): ?>
                          <?php echo include_partial('production/relationLivraisonsItem', array('form' => $item_form)); ?>
                  <?php endforeach; ?>
              </tbody>
            </table>
          </td>
        </tr>
  </table>
