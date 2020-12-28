<div id="containerCA" class="container">

	<?php include_partial('activite/breadcrumb', array('commercial' => $commercial, 'client' => $client, 'fournisseur' => $fournisseur, 'parameters' => $parameters, 'devise' => $devise, 'tous' => true)); ?>

	<?php include_partial('activite/filtersForm', array('parameters' => $parameters, 'saison' => $saison, 'commercialId' => $commercialId, 'comFiltered' => $comFiltered, 'produit' => $produit, 'from' => $from, 'to' => $to)); ?>

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