<div id="containerCA" class="container">

<div class="row">
	
	<div class="col-sm-11">

	<nav aria-label="breadcrumb">
		<?php if ($client && !$fournisseur): ?>
		<ol class="breadcrumb">
			<li class="breadcrumb-item text-dark">Client : <strong><?php echo $client->getRaisonSociale() ?></strong></li>
			<li class="breadcrumb-item text-dark">Tous les fournisseurs</li>
		</ol>
		<?php elseif (!$client && $fournisseur): ?>
		<ol class="breadcrumb">
			<li class="breadcrumb-item text-dark">Fournisseur : <strong><?php echo $fournisseur->getRaisonSociale() ?></strong></li>
			<li class="breadcrumb-item text-dark">Tous les clients</li>
		</ol>
		<?php endif; ?>
	</nav>
	
	</div>
	<div class="col-sm-1">
		<div class="btn-group float-right p-2">
				<a href="<?php echo url_for('activiteRapports', array_merge($parameters->getRawValue(), array('devise' => 1))) ?>" class="btn btn-sm <?php if($devise==1): ?>btn-warning text-white<?php else: ?>btn-light<?php endif; ?>" role="button" aria-pressed="true"><span class="oi oi-euro" title="euro" aria-hidden="true"></span></a>
				<a href="<?php echo url_for('activiteRapports', array_merge($parameters->getRawValue(), array('devise' => 2))) ?>" class="btn btn-sm <?php if($devise==2): ?>btn-warning text-white<?php else: ?>btn-light<?php endif; ?>" role="button" aria-pressed="true"><span class="oi oi-dollar" title="dollar" aria-hidden="true"></span></a>
			</div>
	</div>

</div>


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
	<!-- PERIODE -->
	<div class="p-3 text-dark">
		<h4>Rapport périodique global</h4>
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
	

	<!-- ANNEE -->
	<div class="p-3 text-dark"><h4>Rapport annuel global</h4></div>
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
	
	<?php endforeach; ?>
</div>
<script type="text/javascript">
 $(function() {
	 $( ".dp" ).datepicker($.datepicker.regional[ "fr" ]);
	 });
</script>