<div id="containerCA" class="container">

<div class="row">
	
	<div class="col-sm-11">

	<nav aria-label="breadcrumb">
		<?php if ($client && !$fournisseur): ?>
		<ol class="breadcrumb">
			<li class="breadcrumb-item text-dark">Client : <strong><?php echo $client->getRaisonSociale() ?></strong></li>
		</ol>
		<?php elseif (!$client && $fournisseur): ?>
		<ol class="breadcrumb">
			<li class="breadcrumb-item text-dark">Fournisseur : <strong><?php echo $fournisseur->getRaisonSociale() ?></strong></li>
		</ol>
		<?php elseif ($client && $fournisseur): ?>
		<ol class="breadcrumb">
			<li class="breadcrumb-item text-dark">Client : <strong><?php echo $client->getRaisonSociale() ?></strong></li>
			<li class="breadcrumb-item text-dark">Fournisseur : <strong><?php echo $fournisseur->getRaisonSociale() ?></strong></li>
		</ol>
		<?php elseif ($commercial): ?>
			<ol class="breadcrumb">
				<li class="breadcrumb-item text-dark">Commercial : <strong><?php echo $commercial ?></strong></li>
			</ol>
		<?php else: ?>
		<ol class="breadcrumb">
			<li class="breadcrumb-item text-dark">NathanMode : <strong>Chiffres globaux</strong></li>
		</ol>
		<?php endif; ?>
	</nav>

	</div>
	<div class="col-sm-1">
		<div class="btn-group float-right p-2">
				<a href="<?php echo url_for('activiteRapport', array_merge($parameters->getRawValue(), array('devise' => 1))) ?>" class="btn btn-sm <?php if($devise==1): ?>btn-warning text-white<?php else: ?>btn-light<?php endif; ?>" role="button" aria-pressed="true"><span class="oi oi-euro" title="euro" aria-hidden="true"></span></a>
				<a href="<?php echo url_for('activiteRapport', array_merge($parameters->getRawValue(), array('devise' => 2))) ?>" class="btn btn-sm <?php if($devise==2): ?>btn-warning text-white<?php else: ?>btn-light<?php endif; ?>" role="button" aria-pressed="true"><span class="oi oi-dollar" title="dollar" aria-hidden="true"></span></a>
			</div>
	</div>

</div>


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
	

	<!-- PERIODE -->
	<div class="p-3 text-dark">
		<h4>Rapport périodique</h4>
	</div>
	<div class="row">
		<div class="col-sm-4">
			<div class="card border-info">
				<div class="card-header bg-info text-white"><h5>du <?php echo $from->format('d/m/Y') ?> au <?php echo $to->format('d/m/Y') ?><?php if($detailsLink): ?><a href="#" class="float-right" data-toggle="modal" data-target="#<?php echo $detailsLink ?>Modal" data-url="<?php echo url_for('modal'.ucfirst($detailsLink), array('parameters' => array_merge($parameters->getRawValue(), array('from' => $from->format('Y-m-d'), 'to' => $to->format('Y-m-d'), 'ofrom' => $from->format('Y-m-d'), 'oto' => $to->format('Y-m-d'))))) ?>"><span class="oi oi-zoom-in text-white" title="details" aria-hidden="true"></span></a><?php endif; ?></h5></div>
				<div class="list-group list-group-flush">
					<div class="list-group-item">
						<div class="col-3 text-dark">CA <span class="text-warning"><?php echo ($devise == 2)? '<small class="oi oi-dollar" title="dollar" aria-hidden="true"></small>' : '<small class="oi oi-euro" title="euro" aria-hidden="true"></small>'; ?></span></div>
						<div class="col-9 text-right text-dark"><?php echo number_format($activitePeriode->getMontant($devise, $clientId, $fournisseurId), 2, ',', ' ') ?></div>
					</div>
					<div class="list-group-item">
						<div class="col-3 text-dark">COM <span class="text-warning"><?php echo ($devise == 2)? '<small class="oi oi-dollar" title="dollar" aria-hidden="true"></small>' : '<small class="oi oi-euro" title="euro" aria-hidden="true"></small>'; ?></span></div>
						<div class="col-9 text-right text-dark"><?php echo number_format($activitePeriode->getCom($devise, $clientId, $fournisseurId), 2, ',', ' ') ?></div>
					</div>
					<div class="list-group-item">
						<div class="col-3 text-dark">MTS <small class="text-muted">mts</small></div>
						<div class="col-9 text-right text-dark"><?php echo number_format($activitePeriode->getMts($devise, $clientId, $fournisseurId), 2, ',', ' ') ?></div>
					</div>
					<div class="list-group-item">
						<div class="col-3 text-dark">PF <small class="text-muted">pcs</small></div>
						<div class="col-9 text-right text-dark"><?php echo number_format($activitePeriode->getPcs($devise, $clientId, $fournisseurId), 2, ',', ' ') ?></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="card border-secondary">
				<div class="card-header bg-secondary text-white"><h5>Période <?php echo $from->format('Y')-1 ?><?php if($detailsLink): ?><a href="#" class="float-right" data-toggle="modal" data-target="#<?php echo $detailsLink ?>Modal" data-url="<?php echo url_for('modal'.ucfirst($detailsLink), array('parameters' => array_merge($parameters->getRawValue(), array('from' => ($from->format('Y')-1).'-'.$from->format('m').'-'.$from->format('d'), 'to' => ($to->format('Y')-1).'-'.$to->format('m').'-'.$to->format('d'), 'ofrom' => $from->format('Y-m-d'), 'oto' => $to->format('Y-m-d'))))) ?>"><span class="oi oi-zoom-in text-white" title="details" aria-hidden="true"></span></a><?php endif; ?></h5></div>
				<div class="list-group list-group-flush">
					<div class="list-group-item">
						<div class="col-3 text-dark">CA <span class="text-warning"><?php echo ($devise == 2)? '<small class="oi oi-dollar" title="dollar" aria-hidden="true"></small>' : '<small class="oi oi-euro" title="euro" aria-hidden="true"></small>'; ?></span></div>
						<div class="col-3">
							<?php 
								if ($activitePeriode->getMontant($devise, $clientId, $fournisseurId) > 0 && $activitePeriode1->getMontant($devise, $clientId, $fournisseurId) > 0): 
									$diff = $activitePeriode->getMontant($devise, $clientId, $fournisseurId) / $activitePeriode1->getMontant($devise, $clientId, $fournisseurId);
									if ($diff > 1):
							?>
								<small class="text-success font-italic font-weight-bold">+ <?php echo number_format(($diff - 1) * 100, 0, ',', ' ') ?>%</small>
							<?php else: ?>
								<small class="text-danger font-italic font-weight-bold">- <?php echo number_format(($diff - 1) * -100, 0, ',', ' ') ?>%</small>
							<?php endif; endif; ?>
						</div>
						<div class="col-6 text-right text-dark"><?php echo number_format($activitePeriode1->getMontant($devise, $clientId, $fournisseurId), 2, ',', ' ') ?></div>
					</div>
					<div class="list-group-item">
						<div class="col-3 text-dark">COM <span class="text-warning"><?php echo ($devise == 2)? '<small class="oi oi-dollar" title="dollar" aria-hidden="true"></small>' : '<small class="oi oi-euro" title="euro" aria-hidden="true"></small>'; ?></span></div>
						<div class="col-3">
							<?php 
								if ($activitePeriode->getCom($devise, $clientId, $fournisseurId) > 0 && $activitePeriode1->getCom($devise, $clientId, $fournisseurId) > 0): 
									$diff = $activitePeriode->getCom($devise, $clientId, $fournisseurId) / $activitePeriode1->getCom($devise, $clientId, $fournisseurId);
									if ($diff > 1):
							?>
								<small class="text-success font-italic font-weight-bold">+ <?php echo number_format(($diff - 1) * 100, 0, ',', ' ') ?>%</small>
							<?php else: ?>
								<small class="text-danger font-italic font-weight-bold">- <?php echo number_format(($diff - 1) * -100, 0, ',', ' ') ?>%</small>
							<?php endif; endif; ?>
						</div>
						<div class="col-6 text-right text-dark"><?php echo number_format($activitePeriode1->getCom($devise, $clientId, $fournisseurId), 2, ',', ' ') ?></div>
					</div>
					<div class="list-group-item">
						<div class="col-3 text-dark">MTS <small class="text-muted">mts</small></div>
						<div class="col-3">
							<?php 
								if ($activitePeriode->getMts($devise, $clientId, $fournisseurId) > 0 && $activitePeriode1->getMts($devise, $clientId, $fournisseurId) > 0): 
									$diff = $activitePeriode->getMts($devise, $clientId, $fournisseurId) / $activitePeriode1->getMts($devise, $clientId, $fournisseurId);
									if ($diff > 1):
							?>
								<small class="text-success font-italic font-weight-bold">+ <?php echo number_format(($diff - 1) * 100, 0, ',', ' ') ?>%</small>
							<?php else: ?>
								<small class="text-danger font-italic font-weight-bold">- <?php echo number_format(($diff - 1) * -100, 0, ',', ' ') ?>%</small>
							<?php endif; endif; ?>
						</div>
						<div class="col-6 text-right text-dark"><?php echo number_format($activitePeriode1->getMts($devise, $clientId, $fournisseurId), 2, ',', ' ') ?></div>
					</div>
					<div class="list-group-item">
						<div class="col-3 text-dark">PF <small class="text-muted">pcs</small></div>
						<div class="col-3">
							<?php 
								if ($activitePeriode->getPcs($devise, $clientId, $fournisseurId) > 0 && $activitePeriode1->getPcs($devise, $clientId, $fournisseurId) > 0): 
									$diff = $activitePeriode->getPcs($devise, $clientId, $fournisseurId) / $activitePeriode1->getPcs($devise, $clientId, $fournisseurId);
									if ($diff > 1):
							?>
								<small class="text-success font-italic font-weight-bold">+ <?php echo number_format(($diff - 1) * 100, 0, ',', ' ') ?>%</small>
							<?php else: ?>
								<small class="text-danger font-italic font-weight-bold">- <?php echo number_format(($diff - 1) * -100, 0, ',', ' ') ?>%</small>
							<?php endif; endif; ?>
						</div>
						<div class="col-6 text-right text-dark"><?php echo number_format($activitePeriode1->getPcs($devise, $clientId, $fournisseurId), 2, ',', ' ') ?></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="card border-secondary">
				<div class="card-header bg-secondary text-white"><h5>Période <?php echo $from->format('Y')-2 ?><?php if($detailsLink): ?><a href="#" class="float-right" data-toggle="modal" data-target="#<?php echo $detailsLink ?>Modal" data-url="<?php echo url_for('modal'.ucfirst($detailsLink), array('parameters' => array_merge($parameters->getRawValue(), array('from' => ($from->format('Y')-2).'-'.$from->format('m').'-'.$from->format('d'), 'to' => ($to->format('Y')-2).'-'.$to->format('m').'-'.$to->format('d'), 'ofrom' => $from->format('Y-m-d'), 'oto' => $to->format('Y-m-d'))))) ?>"><span class="oi oi-zoom-in text-white" title="details" aria-hidden="true"></span></a><?php endif; ?></h5></div>
				<div class="list-group list-group-flush">
					<div class="list-group-item">
						<div class="col-3 text-dark">CA <span class="text-warning"><?php echo ($devise == 2)? '<small class="oi oi-dollar" title="dollar" aria-hidden="true"></small>' : '<small class="oi oi-euro" title="euro" aria-hidden="true"></small>'; ?></span></div>
						<div class="col-3">
							<?php 
								if ($activitePeriode->getMontant($devise, $clientId, $fournisseurId) > 0 && $activitePeriode2->getMontant($devise, $clientId, $fournisseurId) > 0): 
									$diff = $activitePeriode->getMontant($devise, $clientId, $fournisseurId) / $activitePeriode2->getMontant($devise, $clientId, $fournisseurId);
									if ($diff > 1):
							?>
								<small class="text-success font-italic font-weight-bold">+ <?php echo number_format(($diff - 1) * 100, 0, ',', ' ') ?>%</small>
							<?php else: ?>
								<small class="text-danger font-italic font-weight-bold">- <?php echo number_format(($diff - 1) * -100, 0, ',', ' ') ?>%</small>
							<?php endif; endif; ?>
						</div>
						<div class="col-6 text-right text-dark"><?php echo number_format($activitePeriode2->getMontant($devise, $clientId, $fournisseurId), 2, ',', ' ') ?></div>
					</div>
					<div class="list-group-item">
						<div class="col-3 text-dark">COM <span class="text-warning"><?php echo ($devise == 2)? '<small class="oi oi-dollar" title="dollar" aria-hidden="true"></small>' : '<small class="oi oi-euro" title="euro" aria-hidden="true"></small>'; ?></span></div>
						<div class="col-3">
							<?php 
								if ($activitePeriode->getCom($devise, $clientId, $fournisseurId) > 0 && $activitePeriode2->getCom($devise, $clientId, $fournisseurId) > 0): 
									$diff = $activitePeriode->getCom($devise, $clientId, $fournisseurId) / $activitePeriode2->getCom($devise, $clientId, $fournisseurId);
									if ($diff > 1):
							?>
								<small class="text-success font-italic font-weight-bold">+ <?php echo number_format(($diff - 1) * 100, 0, ',', ' ') ?>%</small>
							<?php else: ?>
								<small class="text-danger font-italic font-weight-bold">- <?php echo number_format(($diff - 1) * -100, 0, ',', ' ') ?>%</small>
							<?php endif; endif; ?>
						</div>
						<div class="col-6 text-right text-dark"><?php echo number_format($activitePeriode2->getCom($devise, $clientId, $fournisseurId), 2, ',', ' ') ?></div>
					</div>
					<div class="list-group-item">
						<div class="col-3 text-dark">MTS <small class="text-muted">mts</small></div>
						<div class="col-3">
							<?php 
								if ($activitePeriode->getMts($devise, $clientId, $fournisseurId) > 0 && $activitePeriode2->getMts($devise, $clientId, $fournisseurId) > 0): 
									$diff = $activitePeriode->getMts($devise, $clientId, $fournisseurId) / $activitePeriode2->getMts($devise, $clientId, $fournisseurId);
									if ($diff > 1):
							?>
								<small class="text-success font-italic font-weight-bold">+ <?php echo number_format(($diff - 1) * 100, 0, ',', ' ') ?>%</small>
							<?php else: ?>
								<small class="text-danger font-italic font-weight-bold">- <?php echo number_format(($diff - 1) * -100, 0, ',', ' ') ?>%</small>
							<?php endif; endif; ?>
						</div>
						<div class="col-6 text-right text-dark"><?php echo number_format($activitePeriode2->getMts($devise, $clientId, $fournisseurId), 2, ',', ' ') ?></div>
					</div>
					<div class="list-group-item">
						<div class="col-3 text-dark">PF <small class="text-muted">pcs</small></div>
						<div class="col-3">
							<?php 
								if ($activitePeriode->getPcs($devise, $clientId, $fournisseurId) > 0 && $activitePeriode2->getPcs($devise, $clientId, $fournisseurId) > 0): 
									$diff = $activitePeriode->getPcs($devise, $clientId, $fournisseurId) / $activitePeriode2->getPcs($devise, $clientId, $fournisseurId);
									if ($diff > 1):
							?>
								<small class="text-success font-italic font-weight-bold">+ <?php echo number_format(($diff - 1) * 100, 0, ',', ' ') ?>%</small>
							<?php else: ?>
								<small class="text-danger font-italic font-weight-bold">- <?php echo number_format(($diff - 1) * -100, 0, ',', ' ') ?>%</small>
							<?php endif; endif; ?>
						</div>
						<div class="col-6 text-right text-dark"><?php echo number_format($activitePeriode2->getPcs($devise, $clientId, $fournisseurId), 2, ',', ' ') ?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
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
	<!-- ANNEE -->
	<div class="p-3 text-dark"><h4>Rapport annuel</h4></div>
	<div class="row">
		<div class="col-sm-4">
			<div class="card border-info">
				<div class="card-header bg-info text-white"><h5><?php echo $from->format('Y') ?></h5></div>
				<div class="list-group list-group-flush">
					<div class="list-group-item">
						<div class="col-3 text-dark">CA <span class="text-warning"><?php echo ($devise == 2)? '<small class="oi oi-dollar" title="dollar" aria-hidden="true"></small>' : '<small class="oi oi-euro" title="euro" aria-hidden="true"></small>'; ?></span></div>
						<div class="col-9 text-right text-dark"><?php echo number_format($activiteAnnuel->getMontant($devise, $clientId, $fournisseurId), 2, ',', ' ') ?></div>
					</div>
					<div class="list-group-item">
						<div class="col-3 text-dark">COM <span class="text-warning"><?php echo ($devise == 2)? '<small class="oi oi-dollar" title="dollar" aria-hidden="true"></small>' : '<small class="oi oi-euro" title="euro" aria-hidden="true"></small>'; ?></span></div>
						<div class="col-9 text-right text-dark"><?php echo number_format($activiteAnnuel->getCom($devise, $clientId, $fournisseurId), 2, ',', ' ') ?></div>
					</div>
					<div class="list-group-item">
						<div class="col-3 text-dark">MTS <small class="text-muted">mts</small></div>
						<div class="col-9 text-right text-dark"><?php echo number_format($activiteAnnuel->getMts($devise, $clientId, $fournisseurId), 2, ',', ' ') ?></div>
					</div>
					<div class="list-group-item">
						<div class="col-3 text-dark">PF <small class="text-muted">pcs</small></div>
						<div class="col-9 text-right text-dark"><?php echo number_format($activiteAnnuel->getPcs($devise, $clientId, $fournisseurId), 2, ',', ' ') ?></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="card border-secondary">
				<div class="card-header bg-secondary text-white"><h5>Année <?php echo $from->format('Y')-1 ?></h5></div>
				<div class="list-group list-group-flush">
					<div class="list-group-item">
						<div class="col-3 text-dark">CA <span class="text-warning"><?php echo ($devise == 2)? '<small class="oi oi-dollar" title="dollar" aria-hidden="true"></small>' : '<small class="oi oi-euro" title="euro" aria-hidden="true"></small>'; ?></span></div>
						<div class="col-3">
							<?php 
								if ($activiteAnnuel->getMontant($devise, $clientId, $fournisseurId) > 0 && $activiteAnnuel1->getMontant($devise, $clientId, $fournisseurId) > 0): 
									$diff = $activiteAnnuel->getMontant($devise, $clientId, $fournisseurId) / $activiteAnnuel1->getMontant($devise, $clientId, $fournisseurId);
									if ($diff > 1):
							?>
								<small class="text-success font-italic font-weight-bold">+ <?php echo number_format(($diff - 1) * 100, 0, ',', ' ') ?>%</small>
							<?php else: ?>
								<small class="text-danger font-italic font-weight-bold">- <?php echo number_format(($diff - 1) * -100, 0, ',', ' ') ?>%</small>
							<?php endif; endif; ?>
						</div>
						<div class="col-6 text-right text-dark"><?php echo number_format($activiteAnnuel1->getMontant($devise, $clientId, $fournisseurId), 2, ',', ' ') ?></div>
					</div>
					<div class="list-group-item">
						<div class="col-3 text-dark">COM <span class="text-warning"><?php echo ($devise == 2)? '<small class="oi oi-dollar" title="dollar" aria-hidden="true"></small>' : '<small class="oi oi-euro" title="euro" aria-hidden="true"></small>'; ?></span></div>
						<div class="col-3">
							<?php 
								if ($activiteAnnuel->getCom($devise, $clientId, $fournisseurId) > 0 && $activiteAnnuel1->getCom($devise, $clientId, $fournisseurId) > 0): 
									$diff = $activiteAnnuel->getCom($devise, $clientId, $fournisseurId) / $activiteAnnuel1->getCom($devise, $clientId, $fournisseurId);
									if ($diff > 1):
							?>
								<small class="text-success font-italic font-weight-bold">+ <?php echo number_format(($diff - 1) * 100, 0, ',', ' ') ?>%</small>
							<?php else: ?>
								<small class="text-danger font-italic font-weight-bold">- <?php echo number_format(($diff - 1) * -100, 0, ',', ' ') ?>%</small>
							<?php endif; endif; ?>
						</div>
						<div class="col-6 text-right text-dark"><?php echo number_format($activiteAnnuel1->getCom($devise, $clientId, $fournisseurId), 2, ',', ' ') ?></div>
					</div>
					<div class="list-group-item">
						<div class="col-3 text-dark">MTS <small class="text-muted">mts</small></div>
						<div class="col-3">
							<?php 
								if ($activiteAnnuel->getMts($devise, $clientId, $fournisseurId) > 0 && $activiteAnnuel1->getMts($devise, $clientId, $fournisseurId) > 0): 
									$diff = $activiteAnnuel->getMts($devise, $clientId, $fournisseurId) / $activiteAnnuel1->getMts($devise, $clientId, $fournisseurId);
									if ($diff > 1):
							?>
								<small class="text-success font-italic font-weight-bold">+ <?php echo number_format(($diff - 1) * 100, 0, ',', ' ') ?>%</small>
							<?php else: ?>
								<small class="text-danger font-italic font-weight-bold">- <?php echo number_format(($diff - 1) * -100, 0, ',', ' ') ?>%</small>
							<?php endif; endif; ?>
						</div>
						<div class="col-6 text-right text-dark"><?php echo number_format($activiteAnnuel1->getMts($devise, $clientId, $fournisseurId), 2, ',', ' ') ?></div>
					</div>
					<div class="list-group-item">
						<div class="col-3 text-dark">PF <small class="text-muted">pcs</small></div>
						<div class="col-3">
							<?php 
								if ($activiteAnnuel->getPcs($devise, $clientId, $fournisseurId) > 0 && $activiteAnnuel1->getPcs($devise, $clientId, $fournisseurId) > 0): 
									$diff = $activiteAnnuel->getPcs($devise, $clientId, $fournisseurId) / $activiteAnnuel1->getPcs($devise, $clientId, $fournisseurId);
									if ($diff > 1):
							?>
								<small class="text-success font-italic font-weight-bold">+ <?php echo number_format(($diff - 1) * 100, 0, ',', ' ') ?>%</small>
							<?php else: ?>
								<small class="text-danger font-italic font-weight-bold">- <?php echo number_format(($diff - 1) * -100, 0, ',', ' ') ?>%</small>
							<?php endif; endif; ?>
						</div>
						<div class="col-6 text-right text-dark"><?php echo number_format($activiteAnnuel1->getPcs($devise, $clientId, $fournisseurId), 2, ',', ' ') ?></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="card border-secondary">
				<div class="card-header bg-secondary text-white"><h5>Année <?php echo $from->format('Y')-2 ?></h5></div>
				<div class="list-group list-group-flush">
					<div class="list-group-item">
						<div class="col-3 text-dark">CA <span class="text-warning"><?php echo ($devise == 2)? '<small class="oi oi-dollar" title="dollar" aria-hidden="true"></small>' : '<small class="oi oi-euro" title="euro" aria-hidden="true"></small>'; ?></span></div>
						<div class="col-3">
							<?php 
								if ($activiteAnnuel->getMontant($devise, $clientId, $fournisseurId) > 0 && $activiteAnnuel2->getMontant($devise, $clientId, $fournisseurId) > 0): 
									$diff = $activiteAnnuel->getMontant($devise, $clientId, $fournisseurId) / $activiteAnnuel2->getMontant($devise, $clientId, $fournisseurId);
									if ($diff > 1):
							?>
								<small class="text-success font-italic font-weight-bold">+ <?php echo number_format(($diff - 1) * 100, 0, ',', ' ') ?>%</small>
							<?php else: ?>
								<small class="text-danger font-italic font-weight-bold">- <?php echo number_format(($diff - 1) * -100, 0, ',', ' ') ?>%</small>
							<?php endif; endif; ?>
						</div>
						<div class="col-6 text-right text-dark"><?php echo number_format($activiteAnnuel2->getMontant($devise, $clientId, $fournisseurId), 2, ',', ' ') ?></div>
					</div>
					<div class="list-group-item">
						<div class="col-3 text-dark">COM <span class="text-warning"><?php echo ($devise == 2)? '<small class="oi oi-dollar" title="dollar" aria-hidden="true"></small>' : '<small class="oi oi-euro" title="euro" aria-hidden="true"></small>'; ?></span></div>
						<div class="col-3">
							<?php 
								if ($activiteAnnuel->getCom($devise, $clientId, $fournisseurId) > 0 && $activiteAnnuel2->getCom($devise, $clientId, $fournisseurId) > 0): 
									$diff = $activiteAnnuel->getCom($devise, $clientId, $fournisseurId) / $activiteAnnuel2->getCom($devise, $clientId, $fournisseurId);
									if ($diff > 1):
							?>
								<small class="text-success font-italic font-weight-bold">+ <?php echo number_format(($diff - 1) * 100, 0, ',', ' ') ?>%</small>
							<?php else: ?>
								<small class="text-danger font-italic font-weight-bold">- <?php echo number_format(($diff - 1) * -100, 0, ',', ' ') ?>%</small>
							<?php endif; endif; ?>
						</div>
						<div class="col-6 text-right text-dark"><?php echo number_format($activiteAnnuel2->getCom($devise, $clientId, $fournisseurId), 2, ',', ' ') ?></div>
					</div>
					<div class="list-group-item">
						<div class="col-3 text-dark">MTS <small class="text-muted">mts</small></div>
						<div class="col-3">
							<?php 
								if ($activiteAnnuel->getMts($devise, $clientId, $fournisseurId) > 0 && $activiteAnnuel2->getMts($devise, $clientId, $fournisseurId) > 0): 
									$diff = $activiteAnnuel->getMts($devise, $clientId, $fournisseurId) / $activiteAnnuel2->getMts($devise, $clientId, $fournisseurId);
									if ($diff > 1):
							?>
								<small class="text-success font-italic font-weight-bold">+ <?php echo number_format(($diff - 1) * 100, 0, ',', ' ') ?>%</small>
							<?php else: ?>
								<small class="text-danger font-italic font-weight-bold">- <?php echo number_format(($diff - 1) * -100, 0, ',', ' ') ?>%</small>
							<?php endif; endif; ?>
						</div>
						<div class="col-6 text-right text-dark"><?php echo number_format($activiteAnnuel2->getMts($devise, $clientId, $fournisseurId), 2, ',', ' ') ?></div>
					</div>
					<div class="list-group-item">
						<div class="col-3 text-dark">PF <small class="text-muted">pcs</small></div>
						<div class="col-3">
							<?php 
								if ($activiteAnnuel->getPcs($devise, $clientId, $fournisseurId) > 0 && $activiteAnnuel2->getPcs($devise, $clientId, $fournisseurId) > 0): 
									$diff = $activiteAnnuel->getPcs($devise, $clientId, $fournisseurId) / $activiteAnnuel2->getPcs($devise, $clientId, $fournisseurId);
									if ($diff > 1):
							?>
								<small class="text-success font-italic font-weight-bold">+ <?php echo number_format(($diff - 1) * 100, 0, ',', ' ') ?>%</small>
							<?php else: ?>
								<small class="text-danger font-italic font-weight-bold">- <?php echo number_format(($diff - 1) * -100, 0, ',', ' ') ?>%</small>
							<?php endif; endif; ?>
						</div>
						<div class="col-6 text-right text-dark"><?php echo number_format($activiteAnnuel2->getPcs($devise, $clientId, $fournisseurId), 2, ',', ' ') ?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<?php include_partial('activite/clientModal'); ?>
	<?php include_partial('activite/fournisseurModal'); ?>
	
</div>
<script type="text/javascript">
 $(function() {
	 $( ".dp" ).datepicker($.datepicker.regional[ "fr" ]);
	 });
</script>