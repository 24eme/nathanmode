<div id="containerCA" class="container" style="max-width: 1140px;">

	<?php include_partial('activite/breadcrumb', array('commercial' => $commercial, 'client' => $client, 'fournisseur' => $fournisseur, 'parameters' => $parameters, 'devise' => $devise, 'tous' => true, 'type' => $type)); ?>

	<?php include_partial('activite/filtersForm', array('parameters' => $parameters, 'saison' => $saison, 'commercialId' => $commercialId, 'comFiltered' => $comFiltered, 'produit' => $produit, 'from' => $from, 'to' => $to)); ?>

	<div class="p-3 mb-2 bg-info text-white text-center rounded" style="margin-top: 24px; font-size: 1.25rem; padding: 0.5rem !important; "><strong><?php if ($client) echo $client; elseif($fournisseur) echo $fournisseur; elseif($commercial) echo $commercial; ?></strong></div>
	<?php
	$clientId = null;
	$fournisseurId = null;
	if ($client) {
			$clientId = $client->getId();
		}

	if($fournisseur) {
			$fournisseurId = $fournisseur->getId();
	}
	?>
	<?php include_partial('activite/rapportPeriodique', array('comFiltered' => $comFiltered, 'from' => $from, 'to' => $to, 'detailsLink' => $detailsLink, 'activites' => $activitePeriode, 'devise' => $devise, 'clientId' => $clientId, 'fournisseurId' => $fournisseurId, 'activites1' => $activitePeriode1, 'activites2' => $activitePeriode2, 'parameters' => $parameters, 'titre' => 'Rapport périodique global')); ?>

	<?php include_partial('activite/rapportPeriodique', array('comFiltered' => $comFiltered, 'from' => $from, 'to' => $to, 'activites' => $activiteAnnuel, 'devise' => $devise, 'clientId' => $clientId, 'fournisseurId' => $fournisseurId, 'activites1' => $activiteAnnuel1, 'activites2' => $activiteAnnuel2, 'titre' => 'Rapport annuel global', 'annuel' => true)); ?>

	<div class="p-3 text-dark text-center" style="margin-top: 24px">
		<h4>---------- Détail par <?php if($client || $type == 'fournisseur'): ?>fournisseur<?php else: ?>client<?php endif; ?> ----------</h4>
	</div>

	<?php
		foreach ($items->getRawValue() as $item):
			if ($item instanceof Fournisseur) {
				$fournisseurId = $item->getId();
			} elseif($item instanceof Client) {
				$clientId = $item->getId();
			}
	?>

	<div class="p-3 mb-2 bg-info text-white text-center rounded" style="margin-top: 24px; font-size: 1.25rem; padding: 0.5rem !important; "><strong><?php if ($client): ?><?php echo $client ?>&nbsp;/&nbsp;<?php elseif($fournisseur): ?><?php echo $fournisseur ?>&nbsp;/&nbsp;<?php endif; ?><?php echo $item ?> <?php if($commercial): ?><small>(<?php echo $commercial; ?>)</small><?php endif; ?></strong></div>

	<?php include_partial('activite/rapportPeriodique', array('comFiltered' => $comFiltered, 'from' => $from, 'to' => $to, 'detailsLink' => $detailsLink, 'activites' => $activitePeriode, 'devise' => $devise, 'clientId' => $clientId, 'fournisseurId' => $fournisseurId, 'activites1' => $activitePeriode1, 'activites2' => $activitePeriode2, 'parameters' => $parameters, 'titre' => 'Rapport périodique')); ?>


	<?php include_partial('activite/rapportPeriodique', array('comFiltered' => $comFiltered, 'from' => $from, 'to' => $to, 'activites' => $activiteAnnuel, 'devise' => $devise, 'clientId' => $clientId, 'fournisseurId' => $fournisseurId, 'activites1' => $activiteAnnuel1, 'activites2' => $activiteAnnuel2, 'titre' => 'Rapport annuel', 'annuel' => true)); ?>

	<?php endforeach; ?>
</div>
<script type="text/javascript">
 $(function() {
	 $( ".dp" ).datepicker($.datepicker.regional[ "fr" ]);
	 });
</script>