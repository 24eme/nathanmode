<tr class="relation_item_form">
  <td style="text-align:left;">
      <?php echo $form['date']->render(array('class' => 'date_livraison_prevue')) ?>
      <?php echo $form['date']->renderError() ?>
  </td>
    <td class='read-only-livraison' style="text-align:left;">
        <?php echo $form['piece_categorie']->render(array('class' => 'chosen piece_categorie')); ?>
        <?php echo $form['piece_categorie_value']->render(array('class' => 'piece_categorie')); ?>
        <?php echo $form['piece_categorie']->renderError(); ?>
    </td>
    <td class='read-only-livraison'>
        <?php echo $form['qualite']->render(array('class' => 'form-control-sm reference')); ?>
        <?php echo $form['qualite']->renderError(); ?>
    </td>
  <td class='read-only-livraison'>
      <?php echo $form['colori']->render(array('class' => 'colori')) ?>
      <?php echo $form['colori']->renderError() ?>
  </td>
  <td>
      <?php echo $form['piece']->render(array('class' => 'quantite input-float')) ?>
      <?php echo $form['piece']->renderError() ?>
  </td>
  <td>
    <div class="input-group">
        <?php echo $form['prix']->render(array('class' => 'input-float prix_vente form-control')) ?>
        <?php echo $form['prix']->renderError() ?>
       <span class="input-group-text devise-symbol"></span>
    </div>
  </td>
  <td>
      <?php echo $form['escompte']->render(array('class' => 'small input-float')) ?>
      <?php echo $form['escompte_devise_id']->render(array('class' => 'smallchosen')) ?>
      <?php echo $form['escompte']->renderError() ?>
  </td>
  <td>
      <?php echo $form['adresse_livraison']->render() ?>
      <?php echo $form['adresse_livraison']->renderError() ?>
  </td>
  <td>
      <?php echo $form['num_facture']->render() ?>
      <?php echo $form['num_facture']->renderError() ?>
  </td>
  <td class="uploadFile" style="padding-top:4px;">
      <label for="<?php echo $form['fichier']->renderId(); ?>" style="cursor: pointer;">
        <?php if($form['fichier']->getValue()): ?>
            <a style="margin-bottom:10px;" href="<?php echo FactureTable::getInstance()->getUploadPath(false).$form['fichier']->getValue(); ?>" target="_blank">Voir la facture</a>
        <?php else: ?>
            <span class="btn btn-sm btn-outline-secondary"><i class="bi bi-upload"></i></span>
        <?php endif; ?>
	</label>
      <?php echo $form['fichier']->render(array('class' => 'input')) ?>
      <?php echo $form['fichier']->renderError() ?>
  </td>
  <td class="uploadFile" style="padding-top:4px;">
      <label for="<?php echo $form['packing_list']->renderId(); ?>" style="cursor: pointer;">
          <?php if($form['packing_list']->getValue()): ?>
          <a style="margin-bottom:10px;" href="<?php echo CollectionLivraisonTable::getInstance()->getUploadPath(false).$form['packing_list']->getValue(); ?>" target="_blank">Voir le PL</a>
          <?php else: ?>
            <span class="btn btn-sm btn-outline-secondary"><i class="bi bi-upload"></i></span>
          <?php endif; ?>
      </label>
      <?php echo $form['packing_list']->render(array('class' => 'input')) ?>
      <?php echo $form['packing_list']->renderError() ?>
  </td>
  <td class="p-2">
      <a class="lien_supprimer_ligne fs-6 text-muted" href="#"><i class="bi bi-trash3"></i></a>
  </td>
</tr>
