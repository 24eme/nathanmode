<tr class="relation_item_form ligne_calcul_marges">
<?php if (sfConfig::get('app_no_metrage')) : ?>
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
<?php endif; ?>
    <td>
        <?php echo $form['piece_categorie']->render(array('class' => 'chosen')) ?>
        <?php echo $form['piece_categorie']->renderError() ?>
    </td>
    <td>
        <?php echo $form['qualite']->render(array('class' => 'form-control-sm reference')); ?>
        <?php echo $form['qualite']->renderError(); ?>
    </td>
    <td>
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
    <?php if(isset($form['prix_public'])): ?>
     <td>
        <div class="input-group input-group-sm">
             <?php echo $form['prix_public']->render(array('class' => 'input-float form-control prix_public')) ?>
             <?php echo $form['prix_public']->renderError() ?>
             <span class="input-group-text" style="font-size:13px;color: #444;border: 1px solid #aaa">€</span>
         </div>
     </td>
     <?php endif; ?>
     <?php if(isset($form['part_frais'])): ?>
      <td>
    	<div class="input-group input-group-sm">
    		<?php echo $form['part_frais']->render(array('class' => 'input-float form-control part_frais')) ?>
    		<?php echo $form['part_frais']->renderError() ?>
    		<span class="input-group-text" style="font-size:13px; width: 36px;">%</span>
    	</div>
     </td>
     <?php endif; ?>
     <?php if (sfConfig::get('app_no_metrage')) : ?>
    <td><span class="marge_usd">0</span>&nbsp;$ / <span class="marge_eur">0</span>&nbsp;€</td>
    <td><span class="marge_coef coef-ind">0</span>&nbsp;&nbsp;&nbsp;<span class="marge_part coef-prct">0</span>&nbsp;%</td>
    <td><span class="marge_client_coef coef-ind">0</span>&nbsp;&nbsp;&nbsp;<span class="marge_client_part coef-prct">0</span>&nbsp;%</td>
    <?php endif; ?>
    <td style="text-align:left;">
        <?php echo $form['date_livraison_prevue']->render(array('class' => 'form-control form-control-sm')) ?>
        <?php echo $form['date_livraison_prevue']->renderError() ?>
    </td>
    <td>
        <?php echo $form['reste_a_livrer_produit']->render(array('class' => 'input-float form-control form-control-sm reste-a-livrer')); ?>
        <?php echo $form['reste_a_livrer_produit']->renderError(); ?>
    </td>
    <td class="px-1">
        <a class="lien_supprimer_ligne" href="#"><i class="bi bi-trash3"></i></a>
    </td>
    <td class="px-1">
      <a class="lien_ajouter_ligne_livraison" href="#"><i class="bi bi-truck"></i></a>
    </td>
</tr>
