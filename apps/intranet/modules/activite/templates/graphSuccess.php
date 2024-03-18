<div id="containerCA" class="container">

<a href="<?php echo url_for('activiteRapport') ?>" style="text-decoration: none;"><span style="top: 2px;" class="oi oi-chevron-left"></span> Retour</a>

<h1 class="text-center p-3 text-dark">Commercial Activity</h1>

<h2 class="text-center p-3">
	<a class="btn btn-light<?php if ($periode == 'day'): ?> active<?php endif; ?>" href="<?php echo url_for('activiteGraph') ?>" role="button" style="text-decoration:none;">24H</a>
	<a class="btn btn-light<?php if ($periode == 'week'): ?> active<?php endif; ?>" href="<?php echo url_for('activiteGraph') ?>?periode=week" role="button" style="text-decoration:none;">Semaine</a>
	<a class="btn btn-light<?php if ($periode == 'month'): ?> active<?php endif; ?>" href="<?php echo url_for('activiteGraph') ?>?periode=month" role="button" style="text-decoration:none;">Mois</a>
	<a class="btn btn-light<?php if ($periode == 'year'): ?> active<?php endif; ?>" href="<?php echo url_for('activiteGraph') ?>?periode=year" role="button" style="text-decoration:none;">Année</a>
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
      	backgroundColor: 'rgb(75, 192, 192)',
				borderColor: 'rgb(75, 192, 192)',
				tension: 0.1,
        pointStyle: false
      }]
		},
		options: {
    	scales: {
      	x: {
        	type: 'time',
					time: {
              unit: '<?php if ($periode == 'year') echo 'week'; elseif($periode == 'month') echo 'day'; elseif($periode == 'week') echo 'hour'; else echo 'minute'; ?>',
							displayFormats: {
								minute: 'HH:mm',
								hour: 'dd/MM HH:mm',
								day: 'dd/MM',
								week: 'dd/MM',
              }
          }
      	},
			y: {
				ticks: {
						callback: function(value, index, ticks) {
							return new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(value);
						}
				}
			}
    	}
  	}
	});
</script>

</div>
