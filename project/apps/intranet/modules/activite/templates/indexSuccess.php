<div id="containerCA" class="container">

<h1 class="text-center p-3 text-dark">Commercial Activity</h1>
<div id="containerCards">
	<div class="card-deck">
		<a href="<?php echo url_for('activiteRapport') ?>" class="card bg-dark text-white text-center">
		  <img class="card-img" style="height: 140px; width: 100%; display: block;" src="/images/bg/a.jpg" alt="Société">
		  <span class="card-img-overlay">
		    <strong>Société</strong>
		  </span>
		</a>
	
		<a href="#" class="card bg-dark text-white text-center" data-toggle="modal" data-target="#clientModal" data-url="<?php echo url_for('modalClient', array('parameters' => $parameters->getRawValue())) ?>">
		  <img class="card-img" style="height: 140px; width: 100%; display: block;" src="/images/bg/b.jpg" alt="Client">
		  <span class="card-img-overlay">
		    <strong>Client</strong>
		  </span>
		</a>
	
		<a href="#" class="card bg-dark text-white text-center" data-toggle="modal" data-target="#fournisseurModal" data-url="<?php echo url_for('modalFournisseur', array('parameters' => $parameters->getRawValue())) ?>">
		  <img class="card-img" style="height: 140px; width: 100%; display: block;" src="/images/bg/c.jpg" alt="Fournisseur">
		  <span class="card-img-overlay">
		    <strong>Fournisseur</strong>
		  </span>
		</a>
	</div>
</div>

<?php include_partial('activite/clientModal'); ?>
<?php include_partial('activite/fournisseurModal'); ?>
	
</div>