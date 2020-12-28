<div class="row">

	<div class="col-sm-11">

	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<?php if ($commercial): ?>
					<li class="breadcrumb-item text-dark">Commercial : <strong><?php echo $commercial ?></strong></li>
			<?php endif; ?>
			<?php if ($client): ?>
			<li class="breadcrumb-item text-dark">Client : <strong><?php echo $client->getRaisonSociale() ?></strong></li>
			<?php endif; ?>
            <?php if($client && !$fournisseur && isset($tous)): ?>
            <li class="breadcrumb-item text-dark">Tous les fournisseurs</li>
            <?php endif; ?>
			<?php if ($fournisseur): ?>
			<li class="breadcrumb-item text-dark">Fournisseur : <strong><?php echo $fournisseur->getRaisonSociale() ?></strong></li>
			<?php endif; ?>
            <?php if($fournisseur && !$client && isset($tous)): ?>
            <li class="breadcrumb-item text-dark">Tous les clients</li>
            <?php endif; ?>
			<?php if (!$commercial && !$client && !$fournisseur): ?>
			<li class="breadcrumb-item text-dark">NathanMode : <strong>Chiffres globaux</strong></li>
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
