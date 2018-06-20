<?php use_helper('I18N', 'Date') ?>
<?php use_stylesheet('print.css', '', array('media' => 'print')) ?>

	<script>
		$(document).ready(function() {
			$("#noComTd").click(function(){
				$('.noTd').toggleClass("noneTd");
			});
		});
	</script>
  <div class="productName">
    <span>Rapport des factures non commissionnées<?php if($hasDate): ?> du <?php echo format_date($from) ?> au <?php echo format_date($to) ?><?php endif; ?></span>
    <div class="actions">
		<a href="<?php echo url_for('@facture') ?>">Retour à la liste</a>
		<a href="javascript:void(0);" id="noComTd">Supprimer colonnes Com. NM</a>
		<a href="javascript:window.print();">Imprimer</a>
	</div>
  </div>
  <div id="rapport">
  	<table class="tableNm" border="0" width="100%" cellspacing="0" cellpadding="0">
  		<thead class="noThead">
  			<tr>
  				<!-- <th>Fournisseur</th> -->
  				<th>Saison</th>
  				<th>Relation</th>
  				<th>N° Facture</th>
  				<th>Date</th>
  				<th>Client</th>
  				<th>Commercial(CC)</th>
  				<th>Montant(€)</th>
  				<th>Montant($)</th>
  				<th class="noTd">Com.&nbsp;NM(€)</th>
  				<th class="noTd">Com.&nbsp;NM($)</th>
  				<th>Com.&nbsp;CC(€)</th>
  				<th>Com.&nbsp;CC($)</th>
  			</tr>
  		</thead>
  		<tbody>
  			<?php
  				$fournisseur_id = null; 
  				$total_montant_eur = 0;
  				$total_fournisseur_eur = 0;
  				$total_commercial_eur = 0;
  				
  				$total_montant_dol = 0;
  				$total_fournisseur_dol = 0;
  				$total_commercial_dol = 0;
				
  				$total_montant_dol_all = 0;
  				$total_montant_eur_all = 0;
  				$total_fournisseur_dol_all = 0;
  				$total_fournisseur_eur_all = 0;
  				$total_commercial_dol_all = 0;
  				$total_commercial_eur_all = 0;
  				
				foreach ($bons as $bon): 
	  				if (!$fournisseur_id) {
	  					$fournisseur_id = $bon->getFournisseurId();
						echo '
							<tr class="statName">
								<td colspan="9">'.$bon->getFournisseur().'</td>
								<td class="noTd">&nbsp;</td>
								<td class="noTd">&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<tr class="noThPage">
								<!-- <td>Fournisseur</td> -->
								<td>Saison</td>
				  				<td>Relation</td>
				  				<td>N° Facture</td>
				  				<td>Date</td>
				  				<td>Client</td>
				  				<td>Commercial(CC)</td>
				  				<td>Montant(€)</td>
				  				<td>Montant($)</td>
				  				<td class="noTd">Com.&nbsp;NM(€)</td>
				  				<td class="noTd">Com.&nbsp;NM($)</td>
				  				<td>Com.&nbsp;CC(€)</td>
				  				<td>Com.&nbsp;CC($)</td>
							</tr>
						';
	  				}
  			?>
  			<?php 
  				if ($fournisseur_id != $bon->getFournisseurId()):
  			?>
  			<tr class="statTotal">
  				<td colspan="6"><strong>Total par fournisseur</strong></td>
  				<td align="right"><strong><?php echo number_format(round($total_montant_eur, 2), 2, '.', ' '); ?></strong></td>
  				<td align="right"><strong><?php echo number_format(round($total_montant_dol, 2), 2, '.', ' '); ?></strong></td>
  				<td align="right" class="noTd"><strong><?php echo number_format(round($total_fournisseur_eur, 2), 2, '.', ' '); ?></strong></td>
  				<td align="right" class="noTd"><strong><?php echo number_format(round($total_fournisseur_dol, 2), 2, '.', ' '); ?></strong></td>
  				<td align="right"><strong><?php echo number_format(round($total_commercial_eur, 2), 2, '.', ' '); ?></strong></td>
  				<td align="right"><strong><?php echo number_format(round($total_commercial_dol, 2), 2, '.', ' '); ?></strong></td>
  			</tr>
  			<thead class="noThead">
  			<tr>
  				<!-- <th>Fournisseur</th> -->
  				<th>Saison</th>
  				<th>Relation</th>
  				<th>N° Facture</th>
  				<th>Date</th>
  				<th>Client</th>
  				<th>Commercial(CC)</th>
  				<th>Montant(€)</th>
  				<th>Montant($)</th>
  				<th class="noTd">Com.&nbsp;NM(€)</th>
  				<th class="noTd">Com.&nbsp;NM($)</th>
  				<th>Com.&nbsp;CC(€)</th>
  				<th>Com.&nbsp;CC($)</th>
  			</tr>
  		</thead>
  			<tr class="statName">
  				<td colspan="9"><?php echo $bon->getFournisseur() ?></td>
				<td class="noTd">&nbsp;</td>
				<td class="noTd">&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
  			</tr>
			<tr class="noThPage">
				<!-- <td>Fournisseur</td> -->
				<td>Saison</td>
  				<td>Relation</td>
  				<td>N° Facture</td>
  				<td>Date</td>
  				<td>Client</td>
  				<td>Commercial(CC)</td>
  				<td>Montant(€)</td>
  				<td>Montant($)</td>
  				<td class="noTd">Com.&nbsp;NM(€)</td>
  				<td class="noTd">Com.&nbsp;NM($)</td>
  				<td>Com.&nbsp;CC(€)</td>
  				<td>Com.&nbsp;CC($)</td>
			</tr>
  			<?php 
  				$fournisseur_id = $bon->getFournisseurId();
  				$total_montant_eur = 0;
  				$total_montant_dol = 0;
  				$total_fournisseur_eur = 0;
  				$total_fournisseur_dol = 0;
  				$total_commercial_eur = 0;
  				$total_commercial_dol = 0;
  				endif;
  			?>
  			<tr>
  				<!-- <td><?php echo $bon->getFournisseur() ?></td> -->
  				<td style="white-space:nowrap"><?php echo $bon->getSaison() ?></td>
  				<td><?php echo $bon->getRelation() ?></td>
  				<td><?php echo $bon->getNumero() ?></td>
  				<td><?php if ($bon->getDate()) echo $bon->getDateTimeObject('date')->format('d/m/Y') ?></td>
  				<td><?php echo $bon->getClient() ?></td>
  				<td style="white-space:nowrap"><?php echo $bon->getCommercial() ?></td>
  				<?php if ($bon->getDeviseMontant()->getSymbole() == '$'): ?>
  				<td align="right">&nbsp;</td>
  				<td align="right"><?php if ($bon->getType() == Bon::TYPE_CREDIT && $bon->getMontant()): ?>-<?php endif; ?><?php echo number_format(round($bon->getMontant(), 2), 2, '.', ' '); ?></td>
  				<?php else: ?>
  				<td align="right"><?php if ($bon->getType() == Bon::TYPE_CREDIT && $bon->getMontant()): ?>-<?php endif; ?><?php echo number_format(round($bon->getMontant(), 2), 2, '.', ' '); ?></td>
  				<td align="right">&nbsp;</td>
  				<?php endif; ?>
				
  				<?php if ($bon->getDeviseFournisseur()->getSymbole() == '$'): ?>
  					<td align="right" class="noTd">&nbsp;</td>
  					<td align="right" class="noTd"><?php if ($bon->getType() == Bon::TYPE_CREDIT && $bon->getTotalFournisseur()): ?>-<?php endif; ?><?php echo number_format(round($bon->getTotalFournisseur(), 2), 2, '.', ' '); ?></td>
  				<?php elseif($bon->getDeviseFournisseur()->getSymbole() == '%'): ?>
  					<?php if ($bon->getDeviseMontant()->getSymbole() == '$'): ?>
  					<td align="right" class="noTd">&nbsp;</td>
  					<td align="right" class="noTd"><?php if ($bon->getType() == Bon::TYPE_CREDIT && $bon->getTotalFournisseur()): ?>-<?php endif; ?><?php echo number_format(round($bon->getTotalFournisseur(), 2), 2, '.', ' '); ?></td>
  					<?php else: ?>
  					<td align="right" class="noTd"><?php if ($bon->getType() == Bon::TYPE_CREDIT && $bon->getTotalFournisseur()): ?>-<?php endif; ?><?php echo number_format(round($bon->getTotalFournisseur(), 2), 2, '.', ' '); ?></td>
  					<td align="right" class="noTd">&nbsp;</td>
	  				<?php endif; ?>
  				<?php else: ?>
  					<td align="right" class="noTd"><?php if ($bon->getType() == Bon::TYPE_CREDIT && $bon->getTotalFournisseur()): ?>-<?php endif; ?><?php echo number_format(round($bon->getTotalFournisseur(), 2), 2, '.', ' '); ?></td>
  					<td align="right" class="noTd">&nbsp;</td>
  				<?php endif; ?>
				
  				<?php if ($bon->getDeviseCommercial()->getSymbole() == '$'): ?>
  					<td align="right">&nbsp;</td>
  					<td align="right"><?php if ($bon->getType() == Bon::TYPE_CREDIT && $bon->getTotalCommercial()): ?>-<?php endif; ?><?php echo number_format(round($bon->getTotalCommercial(), 2), 2, '.', ' '); ?></td>
  				<?php elseif ($bon->getDeviseCommercial()->getSymbole() == '%'): ?>
  					<?php if ($bon->getDeviseMontant()->getSymbole() == '$'): ?>
  					<td align="right">&nbsp;</td>
  					<td align="right"><?php if ($bon->getType() == Bon::TYPE_CREDIT && $bon->getTotalCommercial()): ?>-<?php endif; ?><?php echo number_format(round($bon->getTotalCommercial(), 2), 2, '.', ' '); ?></td>
  					<?php else: ?>
  					<td align="right"><?php if ($bon->getType() == Bon::TYPE_CREDIT && $bon->getTotalCommercial()): ?>-<?php endif; ?><?php echo number_format(round($bon->getTotalCommercial(), 2), 2, '.', ' '); ?></td>
  					<td align="right">&nbsp;</td>
  					<?php endif; ?>
  				<?php else: ?>
  					<td align="right"><?php if ($bon->getType() == Bon::TYPE_CREDIT && $bon->getTotalCommercial()): ?>-<?php endif; ?><?php echo number_format(round($bon->getTotalCommercial(), 2), 2, '.', ' '); ?></td>
  					<td align="right">&nbsp;</td>
  				<?php endif; ?>
  			</tr>
  			<?php 
  				if ($bon->getType() == Bon::TYPE_FACTURE) {
  					if ($bon->getDeviseMontant()->getSymbole() == '$') {
  						$total_montant_dol += round($bon->getMontant(), 2);
  						$total_montant_dol_all += round($bon->getMontant(), 2);
  					} else {
  						$total_montant_eur += round($bon->getMontant(), 2);
  						$total_montant_eur_all += round($bon->getMontant(), 2);
  					}
  					if ($bon->getDeviseFournisseur()->getSymbole() == '$') {
  						$total_fournisseur_dol += round($bon->getTotalFournisseur(), 2);
  						$total_fournisseur_dol_all += round($bon->getTotalFournisseur(), 2);
  					} elseif ($bon->getDeviseFournisseur()->getSymbole() == '%') {
	  					if ($bon->getDeviseMontant()->getSymbole() == '$') {
  							$total_fournisseur_dol += round($bon->getTotalFournisseur(), 2);
  							$total_fournisseur_dol_all += round($bon->getTotalFournisseur(), 2);
	  					} else {
  							$total_fournisseur_eur += round($bon->getTotalFournisseur(), 2);
  							$total_fournisseur_eur_all += round($bon->getTotalFournisseur(), 2);
	  					}
  					} else { 
  						$total_fournisseur_eur += round($bon->getTotalFournisseur(), 2);
  						$total_fournisseur_eur_all += round($bon->getTotalFournisseur(), 2);
  					}
  					if ($bon->getDeviseCommercial()->getSymbole() == '$') {
  						$total_commercial_dol += round($bon->getTotalCommercial(), 2);
  						$total_commercial_dol_all += round($bon->getTotalCommercial(), 2);
  					} elseif ($bon->getDeviseCommercial()->getSymbole() == '%') {
	  					if ($bon->getDeviseMontant()->getSymbole() == '$') {
  							$total_commercial_dol += round($bon->getTotalCommercial(), 2);
  							$total_commercial_dol_all += round($bon->getTotalCommercial(), 2);
	  					} else {
  							$total_commercial_eur += round($bon->getTotalCommercial(), 2);
  							$total_commercial_eur_all += round($bon->getTotalCommercial(), 2);
	  					}
  					} else {
  						$total_commercial_eur += round($bon->getTotalCommercial(), 2);
  						$total_commercial_eur_all += round($bon->getTotalCommercial(), 2);
  					}
					
  				} else {
  					if ($bon->getDeviseMontant()->getSymbole() == '$') {
  						$total_montant_dol -= round($bon->getMontant(), 2);
  						$total_montant_dol_all -= round($bon->getMontant(), 2);
  					} else {
  						$total_montant_eur -= round($bon->getMontant(), 2);
  						$total_montant_eur_all -= round($bon->getMontant(), 2);
  					}
  					if ($bon->getDeviseFournisseur()->getSymbole() == '$') {
  						$total_fournisseur_dol -= round($bon->getTotalFournisseur(), 2);
  						$total_fournisseur_dol_all -= round($bon->getTotalFournisseur(), 2);
  					} elseif ($bon->getDeviseFournisseur()->getSymbole() == '%') {
	  					if ($bon->getDeviseMontant()->getSymbole() == '$') {
  							$total_fournisseur_dol -= round($bon->getTotalFournisseur(), 2);
  							$total_fournisseur_dol_all -= round($bon->getTotalFournisseur(), 2);
	  					} else {
  							$total_fournisseur_eur -= round($bon->getTotalFournisseur(), 2);
  							$total_fournisseur_eur_all -= round($bon->getTotalFournisseur(), 2);
	  					}
  					} else { 
  						$total_fournisseur_eur -= round($bon->getTotalFournisseur(), 2);
  						$total_fournisseur_eur_all -= round($bon->getTotalFournisseur(), 2);
  					}
  					if ($bon->getDeviseCommercial()->getSymbole() == '$') {
  						$total_commercial_dol -= round($bon->getTotalCommercial(), 2);
  						$total_commercial_dol_all -= round($bon->getTotalCommercial(), 2);
  					} elseif ($bon->getDeviseCommercial()->getSymbole() == '%') {
	  					if ($bon->getDeviseMontant()->getSymbole() == '$') {
  							$total_commercial_dol -= round($bon->getTotalCommercial(), 2);
  							$total_commercial_dol_all -= round($bon->getTotalCommercial(), 2);
	  					} else {
  							$total_commercial_eur -= round($bon->getTotalCommercial(), 2);
  							$total_commercial_eur_all -= round($bon->getTotalCommercial(), 2);
	  					}
  					} else {
  						$total_commercial_eur -= round($bon->getTotalCommercial(), 2);
  						$total_commercial_eur_all -= round($bon->getTotalCommercial(), 2);
  					}

  				}
				
  				endforeach; 
  			?>
  			<tr class="statTotal">
  				<td colspan="6"><strong>Total par fournisseur</strong></td>
  				<td align="right"><strong><?php echo number_format(round($total_montant_eur, 2), 2, '.', ' '); ?></strong></td>
  				<td align="right"><strong><?php echo number_format(round($total_montant_dol, 2), 2, '.', ' '); ?></strong></td>
  				<td align="right" class="noTd"><strong><?php echo number_format(round($total_fournisseur_eur, 2), 2, '.', ' '); ?></strong></td>
  				<td align="right" class="noTd"><strong><?php echo number_format(round($total_fournisseur_dol, 2), 2, '.', ' '); ?></strong></td>
  				<td align="right"><strong><?php echo number_format(round($total_commercial_eur, 2), 2, '.', ' '); ?></strong></td>
  				<td align="right"><strong><?php echo number_format(round($total_commercial_dol, 2), 2, '.', ' '); ?></strong></td>
  			</tr>
  			<thead class="noThead">
  			<tr>
  				<!-- <th>Fournisseur</th> -->
  				<th>Saison</th>
  				<th>Relation</th>
  				<th>N° Facture</th>
  				<th>Date</th>
  				<th>Client</th>
  				<th>Commercial(CC)</th>
  				<th>Montant(€)</th>
  				<th>Montant($)</th>
  				<th class="noTd">Com.&nbsp;NM(€)</th>
  				<th class="noTd">Com.&nbsp;NM($)</th>
  				<th>Com.&nbsp;CC(€)</th>
  				<th>Com.&nbsp;CC($)</th>
  			</tr>
  		</thead>
  			<tr class="noSepar">
  				<td colspan="9">&nbsp;</td>
				<td class="noTd">&nbsp;</td>
				<td class="noTd">&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
  			</tr>
  			<tr class="statTotalMax">
  				<td colspan="6"><strong>Total cumulé</strong></td>
  				<td align="right"><strong><?php echo number_format(round($total_montant_eur_all, 2), 2, '.', ' '); ?></strong></td>
  				<td align="right"><strong><?php echo number_format(round($total_montant_dol_all, 2), 2, '.', ' '); ?></strong></td>
  				<td align="right" class="noTd"><strong><?php echo number_format(round($total_fournisseur_eur_all, 2), 2, '.', ' '); ?></strong></td>
  				<td align="right" class="noTd"><strong><?php echo number_format(round($total_fournisseur_dol_all, 2), 2, '.', ' '); ?></strong></td>
  				<td align="right"><strong><?php echo number_format(round($total_commercial_eur_all, 2), 2, '.', ' '); ?></strong></td>
  				<td align="right"><strong><?php echo number_format(round($total_commercial_dol_all, 2), 2, '.', ' '); ?></strong></td>
  			</tr>
  			<thead class="noThead">
  			<tr>
  				<!-- <th>Fournisseur</th> -->
  				<th>Saison</th>
  				<th>Relation</th>
  				<th>N° Facture</th>
  				<th>Date</th>
  				<th>Client</th>
  				<th>Commercial(CC)</th>
  				<th>Montant(€)</th>
  				<th>Montant($)</th>
  				<th class="noTd">Com.&nbsp;NM(€)</th>
  				<th class="noTd">Com.&nbsp;NM($)</th>
  				<th>Com.&nbsp;CC(€)</th>
  				<th>Com.&nbsp;CC($)</th>
  			</tr>
  		</thead>
  			<tr class="noSepar">
  				<td colspan="11">&nbsp;</td>
				<td class="noTd">&nbsp;</td>
				<td class="noTd">&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
  			</tr>
  			<?php 
				
  				$total_montant_dol_all = 0;
  				$total_montant_eur_all = 0;
  				$total_fournisseur_dol_all = 0;
  				$total_fournisseur_eur_all = 0;
  				$total_commercial_dol_all = 0;
  				$total_commercial_eur_all = 0;
  				foreach ($bons_cumul as $bon): 
  					if ($bon->getType() == Bon::TYPE_FACTURE) {
  					if ($bon->getDeviseMontant()->getSymbole() == '$') {
  						$total_montant_dol_all += round($bon->getMontant(), 2);
  					} else {
  						$total_montant_eur_all += round($bon->getMontant(), 2);
  					}
  					if ($bon->getDeviseFournisseur()->getSymbole() == '$') {
  						$total_fournisseur_dol_all += round($bon->getTotalFournisseur(), 2);
  					} elseif ($bon->getDeviseFournisseur()->getSymbole() == '%') {
	  					if ($bon->getDeviseMontant()->getSymbole() == '$') {
  							$total_fournisseur_dol_all += round($bon->getTotalFournisseur(), 2);
	  					} else {
  							$total_fournisseur_eur_all += round($bon->getTotalFournisseur(), 2);
	  					}
  					} else { 
  						$total_fournisseur_eur_all += round($bon->getTotalFournisseur(), 2);
  					}
  					if ($bon->getDeviseCommercial()->getSymbole() == '$') {
  						$total_commercial_dol_all += round($bon->getTotalCommercial(), 2);
  					} elseif ($bon->getDeviseCommercial()->getSymbole() == '%') {
	  					if ($bon->getDeviseMontant()->getSymbole() == '$') {
  							$total_commercial_dol_all += round($bon->getTotalCommercial(), 2);
	  					} else {
  							$total_commercial_eur_all += round($bon->getTotalCommercial(), 2);
	  					}
  					} else {
  						$total_commercial_eur_all += round($bon->getTotalCommercial(), 2);
  					}
					
  				} else {
  					if ($bon->getDeviseMontant()->getSymbole() == '$') {
  						$total_montant_dol_all -= round($bon->getMontant(), 2);
  					} else {
  						$total_montant_eur_all -= round($bon->getMontant(), 2);
  					}
  					if ($bon->getDeviseFournisseur()->getSymbole() == '$') {
  						$total_fournisseur_dol_all -= round($bon->getTotalFournisseur(), 2);
  					} elseif ($bon->getDeviseFournisseur()->getSymbole() == '%') {
	  					if ($bon->getDeviseMontant()->getSymbole() == '$') {
  							$total_fournisseur_dol_all -= round($bon->getTotalFournisseur(), 2);
	  					} else {
  							$total_fournisseur_eur_all -= round($bon->getTotalFournisseur(), 2);
	  					}
  					} else { 
  						$total_fournisseur_eur_all -= round($bon->getTotalFournisseur(), 2);
  					}
  					if ($bon->getDeviseCommercial()->getSymbole() == '$') {
  						$total_commercial_dol_all -= round($bon->getTotalCommercial(), 2);
  					} elseif ($bon->getDeviseCommercial()->getSymbole() == '%') {
	  					if ($bon->getDeviseMontant()->getSymbole() == '$') {
  							$total_commercial_dol_all -= round($bon->getTotalCommercial(), 2);
	  					} else {
  							$total_commercial_eur_all -= round($bon->getTotalCommercial(), 2);
	  					}
  					} else {
  						$total_commercial_eur_all -= round($bon->getTotalCommercial(), 2);
  					}

  				}
  			?>
  			
  			<?php endforeach; ?>
  			<tr class="statTotalMax">
  				<td colspan="6"><strong>Total cumulé du 01/01/<?php echo date('Y') ?> au <?php echo date('d/m/Y') ?></strong></td>
  				<td align="right"><strong><?php echo number_format(round($total_montant_eur_all, 2), 2, '.', ' '); ?></strong></td>
  				<td align="right"><strong><?php echo number_format(round($total_montant_dol_all, 2), 2, '.', ' '); ?></strong></td>
  				<td align="right" class="noTd"><strong><?php echo number_format(round($total_fournisseur_eur_all, 2), 2, '.', ' '); ?></strong></td>
  				<td align="right" class="noTd"><strong><?php echo number_format(round($total_fournisseur_dol_all, 2), 2, '.', ' '); ?></strong></td>
  				<td align="right"><strong><?php echo number_format(round($total_commercial_eur_all, 2), 2, '.', ' '); ?></strong></td>
  				<td align="right"><strong><?php echo number_format(round($total_commercial_dol_all, 2), 2, '.', ' '); ?></strong></td>
  			</tr>
  			<thead class="noThead">
  			<tr>
  				<!-- <th>Fournisseur</th> -->
  				<th>Saison</th>
  				<th>Relation</th>
  				<th>N° Facture</th>
  				<th>Date</th>
  				<th>Client</th>
  				<th>Commercial(CC)</th>
  				<th>Montant(€)</th>
  				<th>Montant($)</th>
  				<th class="noTd">Com.&nbsp;NM(€)</th>
  				<th class="noTd">Com.&nbsp;NM($)</th>
  				<th>Com.&nbsp;CC(€)</th>
  				<th>Com.&nbsp;CC($)</th>
  			</tr>
  		</thead>
  		</tbody>
  	</table>
  </div>
