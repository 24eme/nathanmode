<tr class="relation_item_form">
  <td style="text-align:left;">
      <?php echo $form['date']->render() ?>
      <?php echo $form['date']->renderError() ?>
  </td>
  <td>
      <?php echo $form['colori']->render(array('class' => 'colori')) ?>
      <?php echo $form['colori']->renderError() ?>
  </td>
  <td>
      <?php echo $form['piece']->render(array('class' => 'quantite input-float')) ?>
      <?php echo $form['piece']->renderError() ?>
  </td>
  <td>
      <?php echo $form['prix']->render(array('class' => 'input-float prix_vente')) ?>
      <?php echo $form['prix']->renderError() ?>
  </td>
  <td style="width: ">
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
  <td class="uploadFile">
      <?php echo $form['fichier']->render(array('class' => 'input')) ?>
      <?php echo $form['fichier']->renderError() ?>
  </td>
  <td class="uploadFile">
      <?php echo $form['packing_list']->render(array('class' => 'input')) ?>
      <?php echo $form['packing_list']->renderError() ?>
  </td>
  <td class="px-1">
      <a class="lien_supprimer_ligne" href="#">X</a>
  </td>
</tr>
