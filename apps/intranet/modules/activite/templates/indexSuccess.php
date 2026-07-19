<?php if ($dashboard = sfConfig::get('app_commercial_activity_metabase_dashboard')): ?>
	<div class="text-end">
	<a class="btn btn-light btn-sm float-end mb-2" style="text-decoration: none;" href="<?php echo url_for('activiteRapport') ?>"><i class="bi bi-clipboard-data"></i> Rapport global</a>
	<a class="btn btn-light btn-sm float-end mb-2 me-1" style="text-decoration: none;" href="<?php echo url_for('activiteGraph') ?>"><i class="bi bi-graph-up"></i> Graphique du CA</a>
	</div>

  <iframe
  src="<?php echo sfConfig::get('app_commercial_activity_metabase_dashboard') ?>"
  frameborder="0"
  width="100%"
  height="5250px"
  allowtransparency
  ></iframe>
<?php endif; ?>

<div id="containerCA" class="container <?php if($dashboard): ?>d-none<?php endif; ?>" style="max-width: 1140px;">

<h1 class="text-center p-3 text-dark">Commercial Activity</h1>

<div class="row justify-content-md-center">

	<div class="col-3 position-relative">
		<a href="<?php echo url_for('activiteRapport') ?>">
			<img src="/images/bg/a.jpg" alt="Norway" style="height: 140px; width: 100%; display: block;" class="rounded img-fluid">
			<div class="centered text-white overlay-text d-flex justify-content-center align-items-center"><strong>Société</strong></div>
		</a>
	</div>

	<div class="col-3 position-relative">
		<a href="#" data-toggle="modal" data-target="#clientModal" data-url="<?php echo url_for('modalClient', array('parameters' => $parameters->getRawValue())) ?>">
			<img src="/images/bg/b.jpg" alt="Norway" style="height: 140px; width: 100%; display: block;" class="rounded img-fluid">
			<div class="centered text-white d-flex justify-content-center align-items-center"><strong>Client</strong></div>
		</a>
	</div>

	<div class="col-3 position-relative">
		<a href="#" data-toggle="modal" data-target="#fournisseurModal" data-url="<?php echo url_for('modalFournisseur', array('parameters' => $parameters->getRawValue())) ?>">
			<img src="/images/bg/c.jpg" alt="Norway" style="height: 140px; width: 100%; display: block;" class="rounded img-fluid">
			<div class="centered text-white d-flex justify-content-center align-items-center"><strong>Fournisseur</strong></div>
		</a>
	</div>

	<div class="col-3 position-relative">
		<a href="#" data-toggle="modal" data-target="#commercialModal" data-url="<?php echo url_for('modalCommercial', array('parameters' => $parameters->getRawValue())) ?>">
			<img src="/images/bg/d.jpg" alt="" style="height: 140px; width: 100%; display: block;" class="rounded img-fluid">
			<div class="centered text-white d-flex justify-content-center align-items-center"><strong>Commercial</strong></div>
		</a>
	</div>
</div>

<?php include_partial('activite/clientModal'); ?>
<?php include_partial('activite/fournisseurModal'); ?>
<?php include_partial('activite/commercialModal'); ?>
</div>
<?php if ($dashboard = sfConfig::get('app_commercial_activity_metabase_dashboard_'.sfConfig::get('sf_app'))): ?>
	<iframe
	src="<?php echo $dashboard ?>"
	frameborder="0"
	width="100%"
	height="4550px"
	allowtransparency
	></iframe>
<?php endif; ?>
