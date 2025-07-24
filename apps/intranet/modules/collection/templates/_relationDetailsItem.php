<tr class="relation_item_form ligne_calcul_marges">
    <td>
        <img height="50" src="<?php echo CollectionDetailTable::getInstance()->getUploadPath(false).$form['image']->getValue() ?>" />
    </td>
    <td class="uploadFile">
        <?php echo $form['image']->render(array('class' => 'input')) ?>
        <?php echo $form['image']->renderError() ?>
    </td>
    <td>
        <?php echo $form['colori']->render(array('class' => 'colori')); ?>
        <?php echo $form['colori']->renderError(); ?>
    </td>
    <td>
        <?php echo $form['piece']->render(array('class' => 'quantite')); ?>
        <?php echo $form['piece']->renderError(); ?>
    </td>
    <td>
        <?php echo $form['prix_achat']->render(array('class' => 'input-float prix_achat')); ?>
        <?php echo $form['prix_achat']->renderError(); ?>
    </td>
    <td>
        <?php echo $form['prix']->render(array('class' => 'input-float prix_vente')); ?>
        <?php echo $form['prix']->renderError(); ?>
    </td>
    <td><span class="marge_usd">0</span>&nbsp;$ / <span class="marge_eur">0</span>&nbsp;€</td>
    <td><span class="marge_coef">0</span> / <span class="marge_part">0</span>&nbsp;%</td>
    <td><span class="marge_client_coef">0</span> / <span class="marge_client_part">0</span>&nbsp;%</td>
    <td class="px-1">
        <a class="lien_supprimer_ligne" href="#">X</a>
    </td>
    <td class="px-1">
      <a class="lien_ajouter_ligne_livraison" href="#"><i class="bi bi-truck"></i></a>
    </td>
</tr>
