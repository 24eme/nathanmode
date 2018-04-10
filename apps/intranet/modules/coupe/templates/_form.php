<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="tableau">
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php //foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
      <?php //include_partial('coupe/form_fieldset', array('coupe' => $coupe, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
    <?php //endforeach; ?>
    
    <div class="titre"><span>Infos générales</span></div>
	<div class="contentLeft">
  		<table width="100%" border="0" cellspacing="0" cellpadding="0">
  			<tr>
			  <td width="30%"><?php echo $form['saison_id']->renderLabel() ?></td>
			  <td><?php echo $form['saison_id']->render() ?><br /><?php echo $form['saison_id']->renderError() ?></td>
			  <?php if ($help = $form['saison_id']->renderHelp()): ?>
			  <td class="help"><?php echo $help ?></td>
			  <?php endif; ?>
			</tr>
  			<tr>
			  <td><?php echo $form['fournisseur_id']->renderLabel() ?></td>
			  <td><?php echo $form['fournisseur_id']->render() ?><br /><?php echo $form['fournisseur_id']->renderError() ?></td>
			  <?php if ($help = $form['fournisseur_id']->renderHelp()): ?>
			  <td class="help"><?php echo $help ?></td>
			  <?php endif; ?>
			</tr>
  			<tr>
			  <td><?php echo $form['commercial_id']->renderLabel() ?></td>
			  <td><?php echo $form['commercial_id']->render() ?><br /><?php echo $form['commercial_id']->renderError() ?></td>
			  <?php if ($help = $form['commercial_id']->renderHelp()): ?>
			  <td class="help"><?php echo $help ?></td>
			  <?php endif; ?>
			</tr>
  			<tr>
			  <td><?php echo $form['client_id']->renderLabel() ?></td>
			  <td><?php echo $form['client_id']->render() ?><br /><?php echo $form['client_id']->renderError() ?></td>
			  <?php if ($help = $form['client_id']->renderHelp()): ?>
			  <td class="help"><?php echo $help ?></td>
			  <?php endif; ?>
			</tr>
  			<tr>
			  <td><?php echo $form['paiement']->renderLabel() ?></td>
			  <td><?php echo $form['paiement']->render() ?><br /><?php echo $form['paiement']->renderError() ?></td>
			  <?php if ($help = $form['paiement']->renderHelp()): ?>
			  <td class="help"><?php echo $help ?></td>
			  <?php endif; ?>
			</tr>
  			<tr>
			  <td><?php echo $form['montant_facture']->renderLabel() ?></td>
			  <td><?php echo $form['montant_facture']->render(array('class' => 'small')) ?>&nbsp;<?php echo $form['devise_id']->render(array('class' => 'small')) ?><br /><?php echo $form['montant_facture']->renderError() ?><?php echo $form['devise_id']->renderError() ?></td>
			  <?php if ($help = $form['montant_facture']->renderHelp()): ?>
			  <td class="help"><?php echo $help ?></td>
			  <?php endif; ?>
			</tr>
  			<tr>
			  <td><?php echo $form['num_facture']->renderLabel() ?></td>
			  <td><?php echo $form['num_facture']->render() ?><br /><?php echo $form['num_facture']->renderError() ?></td>
			  <?php if ($help = $form['num_facture']->renderHelp()): ?>
			  <td class="help"><?php echo $help ?></td>
			  <?php endif; ?>
			</tr>
  			<tr>
			  <td><?php echo $form['commission_fournisseur']->renderLabel() ?></td>
			  <td><?php echo $form['commission_fournisseur']->render(array('class' => 'small')) ?>&nbsp;<?php echo $form['fournisseur_devise_id']->render(array('class' => 'small')) ?><br /><?php echo $form['commission_fournisseur']->renderError() ?><?php echo $form['fournisseur_devise_id']->renderError() ?></td>
			  <?php if ($help = $form['commission_fournisseur']->renderHelp()): ?>
			  <td class="help"><?php echo $help ?></td>
			  <?php endif; ?>
			</tr>
  			<tr>
			  <td><?php echo $form['commission_commercial']->renderLabel() ?></td>
			  <td><?php echo $form['commission_commercial']->render(array('class' => 'small')) ?>&nbsp;<?php echo $form['commercial_devise_id']->render(array('class' => 'small')) ?><br /><?php echo $form['commission_commercial']->renderError() ?><?php echo $form['commercial_devise_id']->renderError() ?></td>
			  <?php if ($help = $form['commission_commercial']->renderHelp()): ?>
			  <td class="help"><?php echo $help ?></td>
			  <?php endif; ?>
			</tr>
  			<tr>
			  <td><?php echo $form['tissu']->renderLabel() ?></td>
			  <td><?php echo $form['tissu']->render() ?><br /><?php echo $form['tissu']->renderError() ?></td>
			  <?php if ($help = $form['tissu']->renderHelp()): ?>
			  <td class="help"><?php echo $help ?></td>
			  <?php endif; ?>
			</tr>
  			<tr>
			  <td><?php echo $form['colori']->renderLabel() ?></td>
			  <td><?php echo $form['colori']->render() ?><br /><?php echo $form['colori']->renderError() ?></td>
			  <?php if ($help = $form['colori']->renderHelp()): ?>
			  <td class="help"><?php echo $help ?></td>
			  <?php endif; ?>
			</tr>
  			<tr>
			  <td><?php echo $form['metrage']->renderLabel() ?></td>
			  <td><?php echo $form['metrage']->render() ?><br /><?php echo $form['metrage']->renderError() ?></td>
			  <?php if ($help = $form['metrage']->renderHelp()): ?>
			  <td class="help"><?php echo $help ?></td>
			  <?php endif; ?>
			</tr>
  			<tr>
			  <td><?php echo $form['piece']->renderLabel() ?></td>
			  <td><?php echo $form['piece']->render() ?><br /><?php echo $form['piece']->renderError() ?></td>
			  <?php if ($help = $form['piece']->renderHelp()): ?>
			  <td class="help"><?php echo $help ?></td>
			  <?php endif; ?>
			</tr>
  			<tr>
			  <td><?php echo $form['livre_le']->renderLabel() ?></td>
			  <td><?php echo $form['livre_le']->render() ?><br /><?php echo $form['livre_le']->renderError() ?></td>
			  <?php if ($help = $form['livre_le']->renderHelp()): ?>
			  <td class="help"><?php echo $help ?></td>
			  <?php endif; ?>
			</tr>	
  			<tr>
			  <td><?php echo $form['fichier']->renderLabel() ?></td>
			  <td><?php echo $form['fichier']->render() ?><br /><?php echo $form['fichier']->renderError() ?></td>
			  <?php if ($help = $form['fichier']->renderHelp()): ?>
			  <td class="help"><?php echo $help ?></td>
			  <?php endif; ?>
			</tr>
  		</table>
	</div>

</div>
<script id="dependent_select_url_template" type="text/x-jquery-tmpl">
	<?php echo url_for('client/paiement?id=var---id---'); ?>
</script>