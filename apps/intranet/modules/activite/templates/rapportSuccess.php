<div id="containerCA" class="container">

<?php include_partial('activite/breadcrumb', array('commercial' => $commercial, 'client' => $client, 'fournisseur' => $fournisseur, 'parameters' => $parameters, 'devise' => $devise )); ?>

	<form method="get" action="<?php echo url_for('activiteRapport', $parameters->getRawValue()) ?>">
		<?php foreach ($parameters as $key => $value): ?>
		<?php if (!in_array($key, array('from', 'to', 'saison')) && $value): ?>
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
					<option value=""<?php if (!$commercialId): ?> selected="selected"<?php endif; ?>></option>
					<?php foreach (CommercialTable::getInstance()->findAll() as $c): ?>
					<option value="<?php echo $c->getId() ?>"<?php if ($c->getId() == $commercialId): ?> selected="selected"<?php endif; ?>><?php echo $c ?></option>
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

	<?php include_partial('activite/rapportPeriodique', array('from' => $from, 'to' => $to, 'detailsLink' => $detailsLink, 'activites' => $activitePeriode, 'devise' => $devise, 'clientId' => $clientId, 'fournisseurId' => $fournisseurId, 'activites1' => $activitePeriode1, 'activites2' => $activitePeriode2, 'parameters' => $parameters, 'titre' => 'Rapport périodique')); ?>

	<?php if ($client && $fournisseur): ?>

	<div class="p-3 text-dark"><h4>Détails</h4></div>


	<ul class="nav nav-tabs row" id="detailsTabs" role="tablist">
  		<li class="nav-item col-sm-4">
    		<h5><a class="nav-link active" id="home-tab" data-toggle="tab" href="#current" role="tab" aria-controls="currentTab" aria-selected="true">du <?php echo $from->format('d/m/Y') ?> au <?php echo $to->format('d/m/Y') ?></a></h5>
  		</li>
	  	<li class="nav-item col-sm-4">
	    	<h5><a class="nav-link" id="profile-tab" data-toggle="tab" href="#n1Tab" role="tab" aria-controls="n1Tab" aria-selected="false">Période <?php echo $from->format('Y')-1 ?></a></h5>
	  	</li>
	  	<li class="nav-item col-sm-4">
	    	<h5><a class="nav-link" id="contact-tab" data-toggle="tab" href="#n2Tab" role="tab" aria-controls="n2Tab" aria-selected="false">Période <?php echo $from->format('Y')-2 ?></a></h5>
	  	</li>
	</ul>
	
	
	<div class="tab-content" id="detailsTabsContent">
	  	<div class="tab-pane fade show active" id="current" role="tabpanel" aria-labelledby="current-tab">
	  	
		  	<table class="table table-striped table-bordered table-hover text-dark">
		  		<thead>
		    		<tr>
		      			<th scope="col">Saison</th>
		      			<th scope="col">Qualité</th>
		      			<th scope="col">Métrage</th>
		      			<th scope="col">Pièce</th>
		      			<th scope="col">Prix</th>
		    		</tr>
		  		</thead>
		  		<tbody>
		  			<?php 
		  			$totMetrage = 0;
		  			$totPiece = 0;
		  			$totMontant = 0;
		  			foreach ($activitePeriode->getDetails($devise, $client->getId(), $fournisseur->getId()) as $detail): 
		  			$totMetrage += (is_numeric($detail['metrage']))? $detail['metrage'] *  $detail['coef'] : 0;
		  			$totPiece += (is_numeric($detail['piece']))? $detail['piece'] *  $detail['coef'] : 0;
		  			$totMontant += (is_numeric($detail['montant']))? $detail['montant'] *  $detail['coef'] : 0;
		  			?>
		  				<tr<?php if ($detail['coef'] < 0): ?> class="table-danger"<?php endif; ?>>
		  					<td><?php echo $detail['libelle'] ?></td>
		  					<td><?php echo $detail['qualite'] ?></td>
		  					<td class="text-right"><?php if ($detail['coef'] < 0): ?>-&nbsp;<?php endif; ?><?php echo number_format($detail['metrage'] * 1, 0, ',', ' ') ?></td>
		  					<td class="text-right"><?php if ($detail['coef'] < 0): ?>-&nbsp;<?php endif; ?><?php echo number_format($detail['piece'] * 1, 0, ',', ' ') ?></td>
		  					<td class="text-right"><?php if ($detail['coef'] < 0): ?>-&nbsp;<?php endif; ?><?php echo number_format($detail['montant'] * 1, 2, ',', ' ') ?></td>
		  				</tr>
		  			<?php endforeach;?>
		  				<tr>
		  					<td colspan="2" class="text-right"><strong>Total</strong></td>
		  					<td class="text-right"><strong><?php echo number_format($totMetrage, 0, ',', ' ') ?></strong></td>
		  					<td class="text-right"><strong><?php echo number_format($totPiece, 0, ',', ' ') ?></strong></td>
		  					<td class="text-right"><strong><?php echo number_format($totMontant, 2, ',', ' ') ?></strong></td>
		  				</tr>
		  		</tbody>
		  	</table>
	  	
	  	</div>
	  	<div class="tab-pane fade" id="n1Tab" role="n1Tab" aria-labelledby="n1-tab">
	  	
		  	<table class="table table-striped table-bordered table-hover text-dark">
		  		<thead>
		    		<tr>
		      			<th scope="col">Saison</th>
		      			<th scope="col">Qualité</th>
		      			<th scope="col">Métrage</th>
		      			<th scope="col">Pièce</th>
		      			<th scope="col">Prix</th>
		    		</tr>
		  		</thead>
		  		<tbody>
		  			<?php 
		  			$totMetrage = 0;
		  			$totPiece = 0;
		  			$totMontant = 0;
		  			foreach ($activitePeriode1->getDetails($devise, $client->getId(), $fournisseur->getId()) as $detail): 
		  			$totMetrage += (is_numeric($detail['metrage']))? $detail['metrage'] *  $detail['coef'] : 0;
		  			$totPiece += (is_numeric($detail['piece']))? $detail['piece'] *  $detail['coef'] : 0;
		  			$totMontant += (is_numeric($detail['montant']))? $detail['montant'] *  $detail['coef'] : 0;
		  			?>
		  				<tr<?php if ($detail['coef'] < 0): ?> class="table-danger"<?php endif; ?>>
		  					<td><?php echo $detail['libelle'] ?></td>
		  					<td><?php echo $detail['qualite'] ?></td>
		  					<td class="text-right"><?php if ($detail['coef'] < 0): ?>-&nbsp;<?php endif; ?><?php echo number_format($detail['metrage'] * 1, 0, ',', ' ') ?></td>
		  					<td class="text-right"><?php if ($detail['coef'] < 0): ?>-&nbsp;<?php endif; ?><?php echo number_format($detail['piece'] * 1, 0, ',', ' ') ?></td>
		  					<td class="text-right"><?php if ($detail['coef'] < 0): ?>-&nbsp;<?php endif; ?><?php echo number_format($detail['montant'] * 1, 2, ',', ' ') ?></td>
		  				</tr>
		  			<?php endforeach;?>
		  				<tr>
		  					<td colspan="2" class="text-right"><strong>Total</strong></td>
		  					<td class="text-right"><strong><?php echo number_format($totMetrage, 0, ',', ' ') ?></strong></td>
		  					<td class="text-right"><strong><?php echo number_format($totPiece, 0, ',', ' ') ?></strong></td>
		  					<td class="text-right"><strong><?php echo number_format($totMontant, 2, ',', ' ') ?></strong></td>
		  				</tr>
		  		</tbody>
		  	</table>
	  	
	  	</div>
	  	<div class="tab-pane fade" id="n2Tab" role="n2Tab" aria-labelledby="n2-tab">
	  	
		  	<table class="table table-striped table-bordered table-hover text-dark">
		  		<thead>
		    		<tr>
		      			<th scope="col">Saison</th>
		      			<th scope="col">Qualité</th>
		      			<th scope="col">Métrage</th>
		      			<th scope="col">Pièce</th>
		      			<th scope="col">Prix</th>
		    		</tr>
		  		</thead>
		  		<tbody>
		  			<?php 
		  			$totMetrage = 0;
		  			$totPiece = 0;
		  			$totMontant = 0;
		  			foreach ($activitePeriode2->getDetails($devise, $client->getId(), $fournisseur->getId()) as $detail): 
		  			$totMetrage += (is_numeric($detail['metrage']))? $detail['metrage'] *  $detail['coef'] : 0;
		  			$totPiece += (is_numeric($detail['piece']))? $detail['piece'] *  $detail['coef'] : 0;
		  			$totMontant += (is_numeric($detail['montant']))? $detail['montant'] *  $detail['coef'] : 0;
		  			?>
		  				<tr<?php if ($detail['coef'] < 0): ?> class="table-danger"<?php endif; ?>>
		  					<td><?php echo $detail['libelle'] ?></td>
		  					<td><?php echo $detail['qualite'] ?></td>
		  					<td class="text-right"><?php if ($detail['coef'] < 0): ?>-&nbsp;<?php endif; ?><?php echo number_format($detail['metrage'] * 1, 0, ',', ' ') ?></td>
		  					<td class="text-right"><?php if ($detail['coef'] < 0): ?>-&nbsp;<?php endif; ?><?php echo number_format($detail['piece'] * 1, 0, ',', ' ') ?></td>
		  					<td class="text-right"><?php if ($detail['coef'] < 0): ?>-&nbsp;<?php endif; ?><?php echo number_format($detail['montant'] * 1, 2, ',', ' ') ?></td>
		  				</tr>
		  			<?php endforeach;?>
		  				<tr>
		  					<td colspan="2" class="text-right"><strong>Total</strong></td>
		  					<td class="text-right"><strong><?php echo number_format($totMetrage, 0, ',', ' ') ?></strong></td>
		  					<td class="text-right"><strong><?php echo number_format($totPiece, 0, ',', ' ') ?></strong></td>
		  					<td class="text-right"><strong><?php echo number_format($totMontant, 2, ',', ' ') ?></strong></td>
		  				</tr>
		  		</tbody>
		  	</table>
	  	
	  	</div>
	</div>
	
	
	<?php else: ?>

	<?php include_partial('activite/rapportPeriodique', array('from' => $from, 'to' => $to, 'activites' => $activiteAnnuel, 'devise' => $devise, 'clientId' => $clientId, 'fournisseurId' => $fournisseurId, 'activites1' => $activiteAnnuel1, 'activites2' => $activiteAnnuel2, 'titre' => 'Rapport annuel', 'annuel' => true)); ?>

	<?php endif; ?>
	<?php include_partial('activite/clientModal'); ?>
	<?php include_partial('activite/fournisseurModal'); ?>
	
</div>
<script type="text/javascript">
 $(function() {
	 $( ".dp" ).datepicker($.datepicker.regional[ "fr" ]);
	 });
</script>