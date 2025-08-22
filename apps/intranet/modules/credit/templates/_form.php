<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="tableau">
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>
    
    <div class="titre"><span>Infos générales</span></div>
	<div class="contentLeft">
  		<table width="100%" border="0" cellspacing="0" cellpadding="0">
  			<tr>
			  <td width="20%"><?php echo $form['saison_id']->renderLabel() ?></td>
			  <td><?php echo $form['saison_id']->render() ?><br /><?php echo $form['saison_id']->renderError() ?></td>
			  <?php if ($help = $form['saison_id']->renderHelp()): ?>
			  <td class="help"><?php echo $help ?></td>
			  <?php endif; ?>
			</tr>
  			<tr>
			  <td width="20%"><?php echo $form['fournisseur_id']->renderLabel() ?></td>
			  <td><?php echo $form['fournisseur_id']->render() ?><br /><?php echo $form['fournisseur_id']->renderError() ?></td>
			  <?php if ($help = $form['fournisseur_id']->renderHelp()): ?>
			  <td class="help"><?php echo $help ?></td>
			  <?php endif; ?>
			</tr>
  			<tr>
			  <td width="20%"><?php echo $form['commercial_id']->renderLabel() ?></td>
			  <td><?php echo $form['commercial_id']->render() ?><br /><?php echo $form['commercial_id']->renderError() ?></td>
			  <?php if ($help = $form['commercial_id']->renderHelp()): ?>
			  <td class="help"><?php echo $help ?></td>
			  <?php endif; ?>
			</tr>
  			<tr>
			  <td width="20%"><?php echo $form['client_id']->renderLabel() ?></td>
			  <td><?php echo $form['client_id']->render() ?><br /><?php echo $form['client_id']->renderError() ?></td>
			  <?php if ($help = $form['client_id']->renderHelp()): ?>
			  <td class="help"><?php echo $help ?></td>
			  <?php endif; ?>
			</tr>
  			<tr>
			  <td width="20%"><?php echo $form['montant']->renderLabel() ?></td>
			  <td><?php echo $form['montant']->render(array('class' => 'small input-float')) ?>&nbsp;<?php echo $form['devise_montant_id']->render(array('class' => 'small')) ?><br /><?php echo $form['montant']->renderError() ?><?php echo $form['devise_montant_id']->renderError() ?></td>
			  <?php if ($help = $form['montant']->renderHelp()): ?>
			  <td class="help"><?php echo $help ?></td>
			  <?php endif; ?>
			</tr>
  			<tr>
			  <td width="20%"><?php echo $form['numero']->renderLabel() ?></td>
			  <td><?php echo $form['numero']->render() ?><br /><?php echo $form['numero']->renderError() ?></td>
			  <?php if ($help = $form['numero']->renderHelp()): ?>
			  <td class="help"><?php echo $help ?></td>
			  <?php endif; ?>
			</tr>
  			<tr>
			  <td width="20%"><?php echo $form['date']->renderLabel() ?></td>
			  <td><?php echo $form['date']->render() ?><br /><?php echo $form['date']->renderError() ?></td>
			  <?php if ($help = $form['date']->renderHelp()): ?>
			  <td class="help"><?php echo $help ?></td>
			  <?php endif; ?>
			</tr>

			<?php if (! sfConfig::get('app_devise_dollar')) : ?>
                <tr>
                    <td width="20%"><?php echo $form['prix_fournisseur']->renderLabel() ?></td>
                    <td><?php echo $form['prix_fournisseur']->render(array('class' => 'small input-float')) ?>&nbsp;<?php echo $form['devise_fournisseur_id']->render(array('class' => 'small')) ?><br /><?php echo $form['devise_fournisseur_id']->renderError() ?><?php echo $form['devise_fournisseur_id']->renderError() ?></td>
                    <?php if ($help = $form['prix_fournisseur']->renderHelp()): ?>
                    <td class="help"><?php echo $help ?></td>
                    <?php endif; ?>
                </tr>
                <tr>
                    <td width="20%"><?php echo $form['prix_commercial']->renderLabel() ?></td>
                    <td><?php echo $form['prix_commercial']->render(array('class' => 'small input-float')) ?>&nbsp;<?php echo $form['devise_commercial_id']->render(array('class' => 'small')) ?><br /><?php echo $form['devise_commercial_id']->renderError() ?><?php echo $form['devise_commercial_id']->renderError() ?></td>
                    <?php if ($help = $form['prix_commercial']->renderHelp()): ?>
                    <td class="help"><?php echo $help ?></td>
                    <?php endif; ?>
                </tr>
			<?php endif; ?>
  			<tr>
			  <td width="20%"><?php echo $form['statut']->renderLabel() ?></td>
			  <td><?php echo $form['statut']->render() ?><br /><?php echo $form['statut']->renderError() ?></td>
			  <?php if ($help = $form['statut']->renderHelp()): ?>
			  <td class="help"><?php echo $help ?></td>
			  <?php endif; ?>
			</tr>
  			<tr>
			  <td width="20%"><?php echo $form['date_debit']->renderLabel() ?></td>
			  <td><?php echo $form['date_debit']->render() ?><br /><?php echo $form['date_debit']->renderError() ?></td>
			  <?php if ($help = $form['date_debit']->renderHelp()): ?>
			  <td class="help"><?php echo $help ?></td>
			  <?php endif; ?>
			</tr>
  			<tr>
			  <td width="20%"><?php echo $form['fichier']->renderLabel() ?></td>
			  <td><?php echo $form['fichier']->render() ?><br /><?php echo $form['fichier']->renderError() ?></td>
			  <?php if ($help = $form['fichier']->renderHelp()): ?>
			  <td class="help"><?php echo $help ?></td>
			  <?php endif; ?>
			</tr>
  		</table>
	</div>

</div>
