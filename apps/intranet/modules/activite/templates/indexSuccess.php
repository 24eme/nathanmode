<div id="containerCA" class="container" style="max-width: 1140px;">

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
