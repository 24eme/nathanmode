<div id="containerCA" class="container">

<?php include_partial('activite/breadcrumb', array('commercial' => $commercial, 'client' => $client, 'fournisseur' => $fournisseur, 'parameters' => $parameters, 'devise' => $devise, 'tous' => true)); ?>

	<form method="get" action="<?php echo url_for('activiteRapports', $parameters->getRawValue()) ?>">
		<?php foreach ($parameters as $key => $value): ?>
		<?php if (!in_array($key, array('from', 'to')) && $value): ?>
		<input type="hidden" name="<?php echo $key?>" value="<?php echo $value ?>" />
		<?php endif; ?>
		<?php endforeach; ?>	
		<div class="activity_date activity_content">
			<span class="activity_title"></span>
			<div class="activity_date_input">
				Saison&nbsp;
				<select id="activite_filters_saison_id" name="saison">
					<option value=""<?php if (!$saison): ?> selected="selected"<?php endif; ?>></option>
					<?php foreach (SaisonTable::getInstance()->findAll() as $s): ?>
					<option value="<?php echo $s->getId() ?>"<?php if ($s->getId() == $saison): ?> selected="selected"<?php endif; ?>><?php echo $s ?></option>
					<?php endforeach; ?>
				</select>
				Commercial&nbsp;
				<?php if (!$comFiltered): ?>
				<select id="activite_filters_commercial_id" name="commercial">
					<option value=""<?php if (!$commercial): ?> selected="selected"<?php endif; ?>></option>
					<?php foreach (CommercialTable::getInstance()->findAll() as $c): ?>
					<option value="<?php echo $c->getId() ?>"<?php if ($c->getId() == $commercial): ?> selected="selected"<?php endif; ?>><?php echo $c ?></option>
					<?php endforeach; ?>
				</select>
				<?php else: ?>
				<span style="font-weight: normal"><?php echo $comFiltered ?></span>
				<?php endif; ?>
				Produit&nbsp;
				<select id="activite_filters_produit" name="produit">
					<option value=""<?php if (!$produit): ?> selected="selected"<?php endif; ?>>Tout</option>
					<option value="mts"<?php if ($produit == 'mts'): ?> selected="selected"<?php endif; ?>>MTS</option>
					<option value="pcs"<?php if ($produit == 'pcs'): ?> selected="selected"<?php endif; ?>>PCS</option>
				</select>
				&nbsp;Période du&nbsp;
				<input type="text" class="dp" name="from" value="<?php echo $from->format('d/m/Y') ?>" />
				&nbsp;au&nbsp;
				<input type="text" class="dp" name="to" value="<?php echo $to->format('d/m/Y') ?>" />
				&nbsp;<input type="submit" value="OK" class="activity_date_bt" />
			</div>
		</div>
	</form>
	
	<div class="p-3 mb-2 bg-info text-white text-center rounded" style="margin-top: 24px; font-size: 1.25rem; padding: 0.5rem !important; "><strong><?php if ($client) echo $client; else echo $fournisseur; ?></strong></div>
	<?php 
	if ($client) {
			$clientId = $client->getId();
			$fournisseurId = null;
		} else {
			$clientId = null;
			$fournisseurId = $fournisseur->getId();
		}
	?>
	<?php include_partial('activite/rapportPeriodique', array('from' => $from, 'to' => $to, 'detailsLink' => $detailsLink, 'activites' => $activitePeriode, 'devise' => $devise, 'clientId' => $clientId, 'fournisseurId' => $fournisseurId, 'activites1' => $activitePeriode1, 'activites2' => $activitePeriode2, 'parameters' => $parameters, 'titre' => 'Rapport périodique global')); ?>

	<?php include_partial('activite/rapportPeriodique', array('from' => $from, 'to' => $to, 'activites' => $activiteAnnuel, 'devise' => $devise, 'clientId' => $clientId, 'fournisseurId' => $fournisseurId, 'activites1' => $activiteAnnuel1, 'activites2' => $activiteAnnuel2, 'titre' => 'Rapport annuel global', 'annuel' => true)); ?>

	<div class="p-3 text-dark text-center" style="margin-top: 24px">
		<h4>---------- Détail par <?php if($client): ?>fournisseur<?php else: ?>client<?php endif; ?> ----------</h4>
	</div>
	
	<?php 
		foreach ($items as $item): 
		
		if ($client) {
			$clientId = $client->getId();
			$fournisseurId = $item->getId();
		} else {
			$clientId = $item->getId();
			$fournisseurId = $fournisseur->getId();
		}
	?>
	
	<div class="p-3 mb-2 bg-info text-white text-center rounded" style="margin-top: 24px; font-size: 1.25rem; padding: 0.5rem !important; "><strong><?php if ($client) echo $client; else echo $fournisseur; ?> / <?php echo $item ?></strong></div>

	<?php include_partial('activite/rapportPeriodique', array('from' => $from, 'to' => $to, 'detailsLink' => $detailsLink, 'activites' => $activitePeriode, 'devise' => $devise, 'clientId' => $clientId, 'fournisseurId' => $fournisseurId, 'activites1' => $activitePeriode1, 'activites2' => $activitePeriode2, 'parameters' => $parameters, 'titre' => 'Rapport périodique')); ?>


	<?php include_partial('activite/rapportPeriodique', array('from' => $from, 'to' => $to, 'activites' => $activiteAnnuel, 'devise' => $devise, 'clientId' => $clientId, 'fournisseurId' => $fournisseurId, 'activites1' => $activiteAnnuel1, 'activites2' => $activiteAnnuel2, 'titre' => 'Rapport annuel', 'annuel' => true)); ?>

	<?php endforeach; ?>
</div>
<script type="text/javascript">
 $(function() {
	 $( ".dp" ).datepicker($.datepicker.regional[ "fr" ]);
	 });
</script>