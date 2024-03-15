<div id="containerCA" class="container">

<h1 class="text-center p-3 text-dark">Commercial Activity</h1>

<div class="row justify-content-md-center">

	<div class="col-3">
		<a href="<?php echo url_for('activiteRapport') ?>">
			<img src="/images/bg/a.jpg" alt="Norway" style="height: 140px; width: 100%; display: block;" class="rounded">
			<div class="centered text-white"><strong>Société</strong></div>
		</a>
	</div>

	<div class="col-3">
		<a href="#" data-toggle="modal" data-target="#clientModal" data-url="<?php echo url_for('modalClient', array('parameters' => $parameters->getRawValue())) ?>">
			<img src="/images/bg/b.jpg" alt="Norway" style="height: 140px; width: 100%; display: block;" class="rounded">
			<div class="centered text-white"><strong>Client</strong></div>
		</a>
	</div>

	<div class="col-3">
		<a href="#" data-toggle="modal" data-target="#fournisseurModal" data-url="<?php echo url_for('modalFournisseur', array('parameters' => $parameters->getRawValue())) ?>">
			<img src="/images/bg/c.jpg" alt="Norway" style="height: 140px; width: 100%; display: block;" class="rounded">
			<div class="centered text-white"><strong>Fournisseur</strong></div>
		</a>
	</div>
	<div class="col-3">
		<a href="#" data-toggle="modal" data-target="#commercialModal" data-url="<?php echo url_for('modalCommercial', array('parameters' => $parameters->getRawValue())) ?>">
			<img src="/images/bg/d.jpg" alt="" style="height: 140px; width: 100%; display: block;" class="rounded">
			<div class="centered text-white"><strong>Commercial</strong></div>
		</a>
	</div>
</div>

<?php include_partial('activite/clientModal'); ?>
<?php include_partial('activite/fournisseurModal'); ?>
<?php include_partial('activite/commercialModal'); ?>

<h2 class="text-center p-3">
	<a class="btn btn-light active" href="<?php echo url_for('activite') ?>" role="button" style="text-decoration:none;">24H</a>
	<a class="btn btn-light" href="<?php echo url_for('activite') ?>?periode=semaine" role="button" style="text-decoration:none;">Semaine</a>
	<a class="btn btn-light" href="<?php echo url_for('activite') ?>?periode=mois" role="button" style="text-decoration:none;">Mois</a>
	<a class="btn btn-light" href="<?php echo url_for('activite') ?>?periode=annee" role="button" style="text-decoration:none;">Année</a>
</h2>

<div class="row justify-content-md-center">
	<div class="col-12">
  	<canvas id="cacom"></canvas>
	</div>
</div>


<?php $items = $sf_data->getRaw('logs'); ?>
<script>
  const cacom = document.getElementById('cacom');
  new Chart(cacom, {
    type: 'line',
    data: {
      labels: ['<?php echo implode('\',\'', array_keys($items["ca"])) ?>'],
      datasets: [{
        label: 'CA',
        data: [<?php echo implode(',', $items["ca"]) ?>],
      	backgroundColor: 'rgb(75, 192, 192)'
      }]
		},
		options: {
    	scales: {
      	x: {
        	type: 'time',
					time: {
              unit: 'month'
          }
      	}
    	}
  	}
	});
</script>

</div>
