<tr class="relation_item_form ligne_calcul_marges">
<?php if (sfConfig::get('app_no_metrage')) : ?>
    <td class="uploadFile pt-1" style="padding: 0;">
    <label for="<?php echo $form['image']->renderId() ?>"  style="cursor: pointer;">
	<?php if($form['image']->getValue()): ?>
	<img height="50" src="<?php echo CollectionDetailTable::getInstance()->getUploadPath(false).$form['image']->getValue() ?>" />
	<?php else: ?>
		<span class="btn btn-sm btn-outline-secondary"> <i class="bi bi-upload"></i></span>
	<?php endif; ?>
	</label>
	<?php echo $form['image']->render() ?>
	<?php echo $form['image']->renderError() ?>
    </td>
<?php endif; ?>
    <td class="large-column" style="text-align:left;">
        <?php echo $form['piece_categorie']->render(array('class' => 'chosen piece_categorie')) ?>
        <?php echo $form['piece_categorie']->renderError() ?>
    </td>
    <td>
        <?php echo $form['qualite']->render(array('list' => "liste_qualite", 'class' => 'form-control-sm reference', 'required' => 'required')); ?>
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
             <span class="input-group-text" style="font-size:13px;color: #444;border: 1px solid #aaa;">€</span>
         </div>
     </td>
     <?php endif; ?>
     <?php if(isset($form['part_frais'])): ?>
      <td>
    	<div class="input-group input-group-sm">
    		<?php echo $form['part_frais']->render(array('class' => 'input-float form-control part_frais')) ?>
    		<?php echo $form['part_frais']->renderError() ?>
    		<span class="input-group-text" style="font-size:13px;color: #444;border: 1px solid #aaa;">%</span>
    	</div>
     </td>
     <?php endif; ?>
     <td><strong class="marge_eur">0</strong></td>
    <td><span class="marge_coef coef-ind">0</span></td>
    <td><span class="marge_part coef-prct">0</span></td>
     <?php if (sfConfig::get('app_no_metrage')) : ?>
    <td><span class="marge_client_coef coef-ind">0</span></td>
    <td><span class="marge_client_part coef-prct">0</span>&nbsp;%</td>
    <?php endif; ?>
    <td style="text-align:left;">
        <?php echo $form['date_livraison_demandee']->render(array('class' => 'form-control form-control-sm', 'style' => 'width: 100px;')) ?>
        <?php echo $form['date_livraison_demandee']->renderError() ?>
    </td>
    <td style="text-align:left;">
        <?php echo $form['date_livraison_prevue']->render(array('class' => 'form-control form-control-sm date_livraison_prevue', 'style' => 'width: 100px;')) ?>
        <?php echo $form['date_livraison_prevue']->renderError() ?>
    </td>
    <td>
        <?php echo $form['reste_a_livrer_produit']->render(array('class' => 'input-float form-control form-control-sm reste-a-livrer')); ?>
        <?php echo $form['reste_a_livrer_produit']->renderError(); ?>
    </td>
    <td>
        <?php echo $form['commande_soldee']->render(array('class' => 'commande_soldee')); ?>
        <?php echo $form['commande_soldee']->renderError(); ?>
    </td>
    <td class="p-2">
        <a class="lien_supprimer_ligne fs-6 text-muted" href="#"><i class="bi bi-trash3"></i></a>
    </td>
    <td class="p-2">
      <a class="lien_ajouter_ligne_livraison fs-6" href="#" title="ajouter une livraison pour ce produit"><i class="bi bi-truck"></i></a>
    </td>
    <td class="p-2">
      <a class="lien_ajouter_ligne_retard fs-6" href="#" title="ajouter un retard de livraison pour ce produit"><i class="bi bi-clock-history"></i></a>
    </td>
</tr>
