<tr class="relation_item_form ligne_calcul_marges">
    <td>
	<?php if($form['image']->getValue()): ?>
	<a href="<?php echo CollectionDetailTable::getInstance()->getUploadPath(false).$form['image']->getValue() ?>" target="_blank"><img height="50" src="<?php echo CollectionDetailTable::getInstance()->getUploadPath(false).$form['image']->getValue() ?>" /></a>
	<?php else: ?>
	  <img height="50" width="1" />
	<?php endif; ?>
    </td>
    <td class="uploadFile pt-1">
	<label for=<?php echo $form['image']->renderId() ?> style="padding:8px 5px;">
		<span class="btn btn-sm btn-outline-secondary"> <i class="bi bi-upload"></i></span>
	</label>
	<?php echo $form['image']->render() ?>
	<?php echo $form['image']->renderError() ?>
    </td>
    <td class="">
        <?php echo $form['colori']->render(array('class' => 'colori form-control-sm')); ?>
        <?php echo $form['colori']->renderError(); ?>
    </td>
    <td>
        <?php echo $form['piece']->render(array('class' => 'quantite input-float form-control form-control-sm')); ?>
        <?php echo $form['piece']->renderError(); ?>
    </td>
    <?php if(isset($form['prix_achat'])): ?>
    <td>
        <div class="input-group input-group-sm">
            <?php echo $form['prix_achat']->render(array('class' => 'input-float prix_achat form-control')); ?>
            <?php echo $form['prix_achat']->renderError(); ?>
            <span class="input-group-text devise-symbol"></span>
        </div>
    </td>
    <?php endif; ?>
    <td>
        <div class="input-group input-group-sm">
            <?php echo $form['prix']->render(array('class' => 'input-float prix_vente form-control')); ?>
            <?php echo $form['prix']->renderError(); ?>
            <span class="input-group-text devise-symbol"></span>
        </div>
    </td>
    <td><span class="marge_usd">0</span>&nbsp;$ / <span class="marge_eur">0</span>&nbsp;€</td>
    <td><span class="marge_coef">0</span> / <span class="marge_part">0</span>&nbsp;%</td>
    <td><span class="marge_client_coef">0</span> / <span class="marge_client_part">0</span>&nbsp;%</td>
    <td style="text-align:left;">
        <?php echo $form['date_livraison_prevue']->render(array('class' => 'form-control form-control-sm')) ?>
        <?php echo $form['date_livraison_prevue']->renderError() ?>
    </td>
    <td>
        <?php echo $form['reste_a_livrer_produit']->render(array('class' => 'quantite input-float form-control form-control-sm')); ?>
        <?php echo $form['reste_a_livrer_produit']->renderError(); ?>
    </td>
    <td class="px-1">
        <a class="lien_supprimer_ligne" href="#"><i class="bi bi-trash3"></i></a>
    </td>
    <td class="px-1">
      <a class="lien_ajouter_ligne_livraison" href="#"><i class="bi bi-truck"></i></a>
    </td>
</tr>
