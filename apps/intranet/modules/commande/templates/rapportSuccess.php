<?php use_helper('I18N', 'Date') ?>
<?php use_stylesheet('print.css', '', array('media' => 'print')) ?>
<?php if ($print): ?>
<?php use_stylesheet('print.css?htmlmode') ?>
<style type="text/css">
    #wrapper {
        width: 1400px;
    }
</style>
<script type="text/javascript">
    javascript:window.print();
</script>
<?php endif; ?>
	<script>
		$(document).ready(function() {
			$("#noComTd").click(function(){
				$('.noTd').toggleClass("noneTd");
			});
		});
	</script>
  <div class="productName">
    <span>Rapport de stats<?php if($hasDate): ?> du <?php echo format_date($from) ?> au <?php echo format_date($to) ?><?php endif; ?></span>
    <div class="actions">
		<a href="<?php echo url_for('@commande') ?>">Retour à la liste</a>
		<a href="javascript:void(0);" id="noComTd">Supprimer colonnes Com. NM</a>
		<a target="_blank" href="<?php echo url_for('commande/rapport') ?>?print=1">Imprimer</a>
	</div>
  </div>
  <div id="rapport">
  	<table id="rapportCommande" class="tableNm" border="0" width="100%" cellspacing="0" cellpadding="0">
  			<tr class="noThead">
  				<th colspan="20">&nbsp;</th>
  			</tr>
			<?php
  				$fournisseur_id = null; 
  				$total_montant_eur = 0;
  				$total_fournisseur_eur = 0;
  				$total_commercial_eur = 0;
  				
  				$total_montant_dol = 0;
  				$total_fournisseur_dol = 0;
  				$total_commercial_dol = 0;
  				
  				$total_metrage = 0;
				
  				$total_montant_dol_all = 0;
  				$total_montant_eur_all = 0;
  				$total_fournisseur_dol_all = 0;
  				$total_fournisseur_eur_all = 0;
  				$total_commercial_dol_all = 0;
  				$total_commercial_eur_all = 0;
  				$total_metrage_all = 0;
  				
				foreach ($commandes as $commande): 
	  				if (!$fournisseur_id) {
	  					$fournisseur_id = $commande->getFournisseurId();
						echo '
							<tr class="statName">
								<td colspan="14">'.$commande->getFournisseur().'</td>
								<td class="noTd">&nbsp;</td>
								<td>&nbsp;</td>
								<td class="noTd">&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							
				  			<tr>
				  				<th>Saison</th>
				  				<th>N° cde</th>
				  				<th>Client</th>
				  				<th>Commercial(CC)</th>
				  				<th>Date cde</th>
				  				<th>Type</th>
				  				<th>Qualité</th>
				  				<th>Colori</th>
				  				<th>Métrage</th>
				  				<th>%</th>
				  				<th>Montant(€)</th>
				  				<th>%</th>
				  				<th>Montant($)</th>
				  				<th>%</th>
				  				<th class="noTd">Com.&nbsp;NM(€)</th>
				  				<th>%</th>
				  				<th class="noTd">Com.&nbsp;NM($)</th>
				  				<th>%</th>
				  				<th>Com.&nbsp;CC(€)</th>
				  				<th>Com.&nbsp;CC($)</th>
				  			</tr>
						';
	  				}
  			?>
  			<?php 
  				if ($fournisseur_id != $commande->getFournisseurId()):
  			?>
			<tr class="noThead">
				<th colspan="8"></th>
				<th>Métrage</th>
				<th>%</th>
				<th>Montant(€)</th>
				<th>%</th>
				<th>Montant($)</th>
				<th>%</th>
				<th class="noTd">Com.&nbsp;NM(€)</th>
				<th>%</th>
				<th class="noTd">Com.&nbsp;NM($)</th>
				<th>%</th>
				<th>Com.&nbsp;CC(€)</th>
				<th>Com.&nbsp;CC($)</th>
			</tr>
  			<tr class="statTotal">
  				<td colspan="8"><strong>Total par fournisseur période</strong> du <?php echo $fromN0->format('d/m/Y') ?> au <?php echo $toN0->format('d/m/Y') ?></td>
  				<td><strong><?php echo round($total_metrage, 2); ?></strong></td>
  				<td align="right"></td>
  				<td align="right"><strong><?php echo number_format(round($total_montant_eur, 2), 2, '.', '&nbsp;'); ?></strong></td>
  				<td align="right"></td>
  				<td align="right"><strong><?php echo number_format(round($total_montant_dol, 2), 2, '.', '&nbsp;'); ?></strong></td>
  				<td align="right"></td>
  				<td align="right" class="noTd"><strong><?php echo number_format(round($total_fournisseur_eur, 2), 2, '.', '&nbsp;'); ?></strong></td>
  				<td align="right"></td>
  				<td align="right" class="noTd"><strong><?php echo number_format(round($total_fournisseur_dol, 2), 2, '.', '&nbsp;'); ?></strong></td>
  				<td align="right"></td>
  				<td align="right"><strong><?php echo number_format(round($total_commercial_eur, 2), 2, '.', '&nbsp;'); ?></strong></td>
  				<td align="right"><strong><?php echo number_format(round($total_commercial_dol, 2), 2, '.', '&nbsp;'); ?></strong></td>
  			</tr>
  			<tr class="statTotal ligneMarine">
  				<td colspan="8"><strong>Total N-1 période</strong> du <?php echo $fromN1->format('d/m/Y') ?> au <?php echo $toN1->format('d/m/Y') ?></td>
  				<td><strong><?php echo (isset($n1[$fournisseur_id]))? round($n1[$fournisseur_id]['metrage'], 2) : 0; ?></strong></td>
  				<td align="right">
					<?php if (isset($n1[$fournisseur_id]) && $total_metrage > 0 && $n1[$fournisseur_id]['metrage'] > 0): ?>
					<?php $diff = $total_metrage / $n1[$fournisseur_id]['metrage']; ?>
					<?php if ($diff > 1): ?>
						<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php else: ?>
						<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php endif; ?>
					<?php endif; ?>
				</td>
  				<td align="right"><strong><?php echo (isset($n1[$fournisseur_id]))? number_format(round($n1[$fournisseur_id]['montant_eur'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right">
					<?php if (isset($n1[$fournisseur_id]) && $total_montant_eur > 0 && $n1[$fournisseur_id]['montant_eur'] > 0): ?>
					<?php $diff = $total_montant_eur / $n1[$fournisseur_id]['montant_eur']; ?>
					<?php if ($diff > 1): ?>
						<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php else: ?>
						<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php endif; ?>
					<?php endif; ?>
				</td>
  				<td align="right"><strong><?php echo (isset($n1[$fournisseur_id]))? number_format(round($n1[$fournisseur_id]['montant_doll'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right">
					<?php if (isset($n1[$fournisseur_id]) && $total_montant_dol > 0 && $n1[$fournisseur_id]['montant_doll'] > 0): ?>
					<?php $diff = $total_montant_dol / $n1[$fournisseur_id]['montant_doll']; ?>
					<?php if ($diff > 1): ?>
						<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php else: ?>
						<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php endif; ?>
					<?php endif; ?>
				</td>
  				<td align="right" class="noTd"><strong><?php echo (isset($n1[$fournisseur_id]))? number_format(round($n1[$fournisseur_id]['nm_eur'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right">
					<?php if (isset($n1[$fournisseur_id]) && $total_fournisseur_eur > 0 && $n1[$fournisseur_id]['nm_eur'] > 0): ?>
					<?php $diff = $total_fournisseur_eur / $n1[$fournisseur_id]['nm_eur']; ?>
					<?php if ($diff > 1): ?>
						<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php else: ?>
						<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php endif; ?>
					<?php endif; ?>
				</td>
  				<td align="right" class="noTd"><strong><?php echo (isset($n1[$fournisseur_id]))? number_format(round($n1[$fournisseur_id]['nm_doll'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right">
					<?php if (isset($n1[$fournisseur_id]) && $total_fournisseur_dol > 0 && $n1[$fournisseur_id]['nm_doll'] > 0): ?>
					<?php $diff = $total_fournisseur_dol / $n1[$fournisseur_id]['nm_doll']; ?>
					<?php if ($diff > 1): ?>
						<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php else: ?>
						<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php endif; ?>
					<?php endif; ?>
				</td>
  				<td align="right"><strong><?php echo (isset($n1[$fournisseur_id]))? number_format(round($n1[$fournisseur_id]['cc_eur'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right"><strong><?php echo (isset($n1[$fournisseur_id]))? number_format(round($n1[$fournisseur_id]['cc_doll'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  			</tr>
  			<tr class="statTotal ligneJaune">
  				<td colspan="8"><strong>Total N-2 période</strong> du <?php echo $fromN2->format('d/m/Y') ?> au <?php echo $toN2->format('d/m/Y') ?></td>
  				<td><strong><?php echo (isset($n2[$fournisseur_id]))? round($n2[$fournisseur_id]['metrage'], 2) : 0; ?></strong></td>
  				<td align="right">
					<?php if (isset($n2[$fournisseur_id]) && $total_metrage > 0 && $n2[$fournisseur_id]['metrage'] > 0): ?>
					<?php $diff = $total_metrage / $n2[$fournisseur_id]['metrage']; ?>
					<?php if ($diff > 1): ?>
						<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php else: ?>
						<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php endif; ?>
					<?php endif; ?>
				</td>
  				<td align="right"><strong><?php echo (isset($n2[$fournisseur_id]))? number_format(round($n2[$fournisseur_id]['montant_eur'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right">
					<?php if (isset($n2[$fournisseur_id]) && $total_montant_eur > 0 && $n2[$fournisseur_id]['montant_eur'] > 0): ?>
					<?php $diff = $total_montant_eur / $n2[$fournisseur_id]['montant_eur']; ?>
					<?php if ($diff > 1): ?>
						<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php else: ?>
						<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php endif; ?>
					<?php endif; ?>
				</td>
  				<td align="right"><strong><?php echo (isset($n2[$fournisseur_id]))? number_format(round($n2[$fournisseur_id]['montant_doll'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right">
					<?php if (isset($n2[$fournisseur_id]) && $total_montant_dol > 0 && $n2[$fournisseur_id]['montant_doll'] > 0): ?>
					<?php $diff = $total_montant_dol / $n2[$fournisseur_id]['montant_doll']; ?>
					<?php if ($diff > 1): ?>
						<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php else: ?>
						<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php endif; ?>
					<?php endif; ?>
				</td>
  				<td align="right" class="noTd"><strong><?php echo (isset($n2[$fournisseur_id]))? number_format(round($n2[$fournisseur_id]['nm_eur'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right">
					<?php if (isset($n2[$fournisseur_id]) && $total_fournisseur_eur > 0 && $n2[$fournisseur_id]['nm_eur'] > 0): ?>
					<?php $diff = $total_fournisseur_eur / $n2[$fournisseur_id]['nm_eur']; ?>
					<?php if ($diff > 1): ?>
						<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php else: ?>
						<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php endif; ?>
					<?php endif; ?>
				</td>
  				<td align="right" class="noTd"><strong><?php echo (isset($n2[$fournisseur_id]))? number_format(round($n2[$fournisseur_id]['nm_doll'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right">
					<?php if (isset($n2[$fournisseur_id]) && $total_fournisseur_dol > 0 && $n2[$fournisseur_id]['nm_doll'] > 0): ?>
					<?php $diff = $total_fournisseur_dol / $n2[$fournisseur_id]['nm_doll']; ?>
					<?php if ($diff > 1): ?>
						<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php else: ?>
						<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php endif; ?>
					<?php endif; ?>
				</td>
  				<td align="right"><strong><?php echo (isset($n2[$fournisseur_id]))? number_format(round($n2[$fournisseur_id]['cc_eur'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right"><strong><?php echo (isset($n2[$fournisseur_id]))? number_format(round($n2[$fournisseur_id]['cc_doll'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  			</tr>
			<tr class="noThead">
				<th colspan="8"></th>
				<th>Métrage</th>
				<th>%</th>
				<th>Montant(€)</th>
				<th>%</th>
				<th>Montant($)</th>
				<th>%</th>
				<th class="noTd">Com.&nbsp;NM(€)</th>
				<th>%</th>
				<th class="noTd">Com.&nbsp;NM($)</th>
				<th>%</th>
				<th>Com.&nbsp;CC(€)</th>
				<th>Com.&nbsp;CC($)</th>
			</tr>
  			<tr class="statTotal">
  				<td colspan="8"><strong>Total par fournisseur cumulé du <?php echo $fromCumul->format('d/m/Y') ?> au <?php echo $toCumul->format('d/m/Y') ?></strong></td>
  				<td><strong><?php echo (isset($cn[$fournisseur_id]))? round($cn[$fournisseur_id]['metrage'], 2) : 0; ?></strong></td>
  				<td align="right"></td>
  				<td align="right"><strong><?php echo (isset($cn[$fournisseur_id]))? number_format(round($cn[$fournisseur_id]['montant_eur'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right"></td>
  				<td align="right"><strong><?php echo (isset($cn[$fournisseur_id]))? number_format(round($cn[$fournisseur_id]['montant_doll'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right"></td>
  				<td align="right" class="noTd"><strong><?php echo (isset($cn[$fournisseur_id]))? number_format(round($cn[$fournisseur_id]['nm_eur'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right"></td>
  				<td align="right" class="noTd"><strong><?php echo (isset($cn[$fournisseur_id]))? number_format(round($cn[$fournisseur_id]['nm_doll'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right"></td>
  				<td align="right"><strong><?php echo (isset($cn[$fournisseur_id]))? number_format(round($cn[$fournisseur_id]['cc_eur'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right"><strong><?php echo (isset($cn[$fournisseur_id]))? number_format(round($cn[$fournisseur_id]['cc_doll'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  			</tr>
  			<tr class="statTotal ligneMarine">
  				<td colspan="8"><strong>Total N-1 cumulé du <?php echo $fromCumul1->format('d/m/Y') ?> au <?php echo $toCumul1->format('d/m/Y') ?></strong></td>
  				<td><strong><?php echo (isset($cn1[$fournisseur_id]))? round($cn1[$fournisseur_id]['metrage'], 2) : 0; ?></strong></td>
  				<td align="right">
					<?php if (isset($cn1[$fournisseur_id]) && isset($cn[$fournisseur_id]) && $cn[$fournisseur_id]['metrage'] > 0 && $cn1[$fournisseur_id]['metrage'] > 0): ?>
					<?php $diff = $cn[$fournisseur_id]['metrage'] / $cn1[$fournisseur_id]['metrage']; ?>
					<?php if ($diff > 1): ?>
						<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php else: ?>
						<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php endif; ?>
					<?php endif; ?>
  				</td>
  				<td align="right"><strong><?php echo (isset($cn1[$fournisseur_id]))? number_format(round($cn1[$fournisseur_id]['montant_eur'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right">
					<?php if (isset($cn1[$fournisseur_id]) && isset($cn[$fournisseur_id]) && $cn[$fournisseur_id]['montant_eur'] > 0 && $cn1[$fournisseur_id]['montant_eur'] > 0): ?>
					<?php $diff = $cn[$fournisseur_id]['montant_eur'] / $cn1[$fournisseur_id]['montant_eur']; ?>
					<?php if ($diff > 1): ?>
						<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php else: ?>
						<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php endif; ?>
					<?php endif; ?>
  				</td>
  				<td align="right"><strong><?php echo (isset($cn1[$fournisseur_id]))? number_format(round($cn1[$fournisseur_id]['montant_doll'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right">
					<?php if (isset($cn1[$fournisseur_id]) && isset($cn[$fournisseur_id]) && $cn[$fournisseur_id]['montant_doll'] > 0 && $cn1[$fournisseur_id]['montant_doll'] > 0): ?>
					<?php $diff = $cn[$fournisseur_id]['montant_doll'] / $cn1[$fournisseur_id]['montant_doll']; ?>
					<?php if ($diff > 1): ?>
						<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php else: ?>
						<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php endif; ?>
					<?php endif; ?>
				</td>
  				<td align="right" class="noTd"><strong><?php echo (isset($cn1[$fournisseur_id]))? number_format(round($cn1[$fournisseur_id]['nm_eur'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right">
					<?php if (isset($cn1[$fournisseur_id]) && isset($cn[$fournisseur_id]) && $cn[$fournisseur_id]['nm_eur'] > 0 && $cn1[$fournisseur_id]['nm_eur'] > 0): ?>
					<?php $diff = $cn[$fournisseur_id]['nm_eur'] / $cn1[$fournisseur_id]['nm_eur']; ?>
					<?php if ($diff > 1): ?>
						<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php else: ?>
						<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php endif; ?>
					<?php endif; ?>
				</td>
  				<td align="right" class="noTd"><strong><?php echo (isset($cn1[$fournisseur_id]))? number_format(round($cn1[$fournisseur_id]['nm_doll'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right">
					<?php if (isset($cn1[$fournisseur_id]) && isset($cn[$fournisseur_id]) && $cn[$fournisseur_id]['nm_doll'] > 0 && $cn1[$fournisseur_id]['nm_doll'] > 0): ?>
					<?php $diff = $cn[$fournisseur_id]['nm_doll'] / $cn1[$fournisseur_id]['nm_doll']; ?>
					<?php if ($diff > 1): ?>
						<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php else: ?>
						<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php endif; ?>
					<?php endif; ?>
				</td>
  				<td align="right"><strong><?php echo (isset($cn1[$fournisseur_id]))? number_format(round($cn1[$fournisseur_id]['cc_eur'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right"><strong><?php echo (isset($cn1[$fournisseur_id]))? number_format(round($cn1[$fournisseur_id]['cc_doll'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  			</tr>
  			<tr class="statTotal ligneJaune">
  				<td colspan="8"><strong>Total N-2 cumulé du <?php echo $fromCumul2->format('d/m/Y') ?> au <?php echo $toCumul2->format('d/m/Y') ?></strong></td>
  				<td><strong><?php echo (isset($cn2[$fournisseur_id]))? round($cn2[$fournisseur_id]['metrage'], 2) : 0; ?></strong></td>
  				<td align="right">
					<?php if (isset($cn2[$fournisseur_id]) && isset($cn[$fournisseur_id]) && $cn[$fournisseur_id]['metrage'] > 0 && $cn2[$fournisseur_id]['metrage'] > 0): ?>
					<?php $diff = $cn[$fournisseur_id]['metrage'] / $cn2[$fournisseur_id]['metrage']; ?>
					<?php if ($diff > 1): ?>
						<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php else: ?>
						<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php endif; ?>
					<?php endif; ?>
				</td>
  				<td align="right"><strong><?php echo (isset($cn2[$fournisseur_id]))? number_format(round($cn2[$fournisseur_id]['montant_eur'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right">
					<?php if (isset($cn2[$fournisseur_id]) && isset($cn[$fournisseur_id]) && $cn[$fournisseur_id]['montant_eur'] > 0 && $cn2[$fournisseur_id]['montant_eur'] > 0): ?>
					<?php $diff = $cn[$fournisseur_id]['montant_eur'] / $cn2[$fournisseur_id]['montant_eur']; ?>
					<?php if ($diff > 1): ?>
						<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php else: ?>
						<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php endif; ?>
					<?php endif; ?>
				</td>
  				<td align="right"><strong><?php echo (isset($cn2[$fournisseur_id]))? number_format(round($cn2[$fournisseur_id]['montant_doll'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right">
					<?php if (isset($cn2[$fournisseur_id]) && isset($cn[$fournisseur_id]) && $cn[$fournisseur_id]['montant_doll'] > 0 && $cn2[$fournisseur_id]['montant_doll'] > 0): ?>
					<?php $diff = $cn[$fournisseur_id]['montant_doll'] / $cn2[$fournisseur_id]['montant_doll']; ?>
					<?php if ($diff > 1): ?>
						<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php else: ?>
						<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php endif; ?>
					<?php endif; ?>
				</td>
  				<td align="right" class="noTd"><strong><?php echo (isset($cn2[$fournisseur_id]))? number_format(round($cn2[$fournisseur_id]['nm_eur'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right">
					<?php if (isset($cn2[$fournisseur_id]) && isset($cn[$fournisseur_id]) && $cn[$fournisseur_id]['nm_eur'] > 0 && $cn2[$fournisseur_id]['nm_eur'] > 0): ?>
					<?php $diff = $cn[$fournisseur_id]['nm_eur'] / $cn2[$fournisseur_id]['nm_eur']; ?>
					<?php if ($diff > 1): ?>
						<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php else: ?>
						<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php endif; ?>
					<?php endif; ?>
				</td>
  				<td align="right" class="noTd"><strong><?php echo (isset($cn2[$fournisseur_id]))? number_format(round($cn2[$fournisseur_id]['nm_doll'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right">
					<?php if (isset($cn2[$fournisseur_id]) && isset($cn[$fournisseur_id]) && $cn[$fournisseur_id]['nm_doll'] > 0 && $cn2[$fournisseur_id]['nm_doll'] > 0): ?>
					<?php $diff = $cn[$fournisseur_id]['nm_doll'] / $cn2[$fournisseur_id]['nm_doll']; ?>
					<?php if ($diff > 1): ?>
						<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php else: ?>
						<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php endif; ?>
					<?php endif; ?>
				</td>
  				<td align="right"><strong><?php echo (isset($cn2[$fournisseur_id]))? number_format(round($cn2[$fournisseur_id]['cc_eur'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right"><strong><?php echo (isset($cn2[$fournisseur_id]))? number_format(round($cn2[$fournisseur_id]['cc_doll'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  			</tr>
  			<tr class="statName">
  				<td colspan="14"><?php echo $commande->getFournisseur() ?></td>
				<td class="noTd">&nbsp;</td>
				<td>&nbsp;</td>
				<td class="noTd">&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
  			</tr>
  			<tr>
  				<th>Saison</th>
  				<th>N° cde</th>
  				<th>Client</th>
  				<th>Commercial(CC)</th>
  				<th>Date cde</th>
  				<th>Type</th>
  				<th>Qualité</th>
  				<th>Colori</th>
  				<th>Métrage</th>
				<th>%</th>
  				<th>Montant(€)</th>
				<th>%</th>
  				<th>Montant($)</th>
				<th>%</th>
  				<th class="noTd">Com.&nbsp;NM(€)</th>
				<th>%</th>
  				<th class="noTd">Com.&nbsp;NM($)</th>
				<th>%</th>
  				<th>Com.&nbsp;CC(€)</th>
  				<th>Com.&nbsp;CC($)</th>
  			</tr>
  			<?php 
  				$fournisseur_id = $commande->getFournisseurId();
  				$total_montant_eur = 0;
  				$total_montant_dol = 0;
  				$total_fournisseur_eur = 0;
  				$total_fournisseur_dol = 0;
  				$total_commercial_eur = 0;
  				$total_commercial_dol = 0;
  				$total_metrage = 0;
  				endif;
  			?>
  			<tr>
  				<!-- <td><?php echo $commande->getFournisseur() ?></td> -->
  				<td style="white-space:nowrap"><?php echo $commande->getSaison() ?></td>
  				<td><?php echo $commande->getNumero() ?></td>
  				<td><?php echo $commande->getClient() ?></td>
  				<td><?php echo $commande->getCommercial() ?></td>
  				<td><?php if ($commande->getDate()) echo $commande->getDateTimeObject('date')->format('d/m/Y') ?></td>
  				<td><?php echo $commande->getRelation() ?></td>
  				<td><?php echo $commande->getQualite() ?></td>
  				<td><?php echo $commande->getColori() ?></td>
  				<td><?php echo $commande->getMetrage() ?></td>
  				<td></td>
  				<?php if ($commande->getDeviseMontantId() == 2): ?>
  				<td align="right">&nbsp;</td>
  				<td></td>
  				<td align="right"><?php echo number_format(round($commande->getMontant(), 2), 2, '.', '&nbsp;'); ?></td>
  				<td></td>
  				<?php else: ?>
  				<td align="right"><?php echo number_format(round($commande->getMontant(), 2), 2, '.', '&nbsp;'); ?></td>
  				<td></td>
  				<td align="right">&nbsp;</td>
  				<td></td>
  				<?php endif; ?>
				
				<?php if ($commande->getDeviseFournisseurId() == 2): ?>
				<td align="right" class="noTd">&nbsp;</td>
  				<td></td>
				<td align="right" class="noTd"><?php echo number_format(round($commande->getTotalFournisseur(), 2), 2, '.', '&nbsp;'); ?></td>
  				<td></td>
				<?php elseif($commande->getDeviseFournisseurId() == 3): ?>
				<?php if ($commande->getDeviseMontantId() == 2): ?>
				<td align="right" class="noTd">&nbsp;</td>
  				<td></td>
				<td align="right" class="noTd"><?php echo number_format(round($commande->getTotalFournisseur(), 2), 2, '.', '&nbsp;'); ?></td>
  				<td></td>
				<?php else: ?>
				<td align="right" class="noTd"><?php echo number_format(round($commande->getTotalFournisseur(), 2), 2, '.', '&nbsp;'); ?></td>
  				<td></td>
				<td align="right" class="noTd">&nbsp;</td>
  				<td></td>
				<?php endif; ?>
				<?php else: ?>
				<td align="right" class="noTd"><?php echo number_format(round($commande->getTotalFournisseur(), 2), 2, '.', '&nbsp;'); ?></td>
  				<td></td>
				<td align="right" class="noTd">&nbsp;</td>
  				<td></td>
				<?php endif; ?>
				
  				<?php if ($commande->getDeviseCommercialId() == 2): ?>
  				<td align="right">&nbsp;</td>
  				<td align="right"><?php echo number_format(round($commande->getTotalCommercial(), 2), 2, '.', '&nbsp;'); ?></td>
  				<?php elseif ($commande->getDeviseCommercialId() == 3): ?>
  				<?php if ($commande->getDeviseMontantId() == 2): ?>
  				<td align="right">&nbsp;</td>
  				<td align="right"><?php echo number_format(round($commande->getTotalCommercial(), 2), 2, '.', '&nbsp;'); ?></td>
  				<?php else: ?>
  				<td align="right"><?php echo number_format(round($commande->getTotalCommercial(), 2), 2, '.', '&nbsp;'); ?></td>
  				<td align="right">&nbsp;</td>
  				<?php endif; ?>
  				<?php else: ?>
  				<td align="right"><?php echo number_format(round($commande->getTotalCommercial(), 2), 2, '.', '&nbsp;'); ?></td>
  				<td align="right">&nbsp;</td>
  				<?php endif; ?>
  			</tr>
  			<?php 
  					if ($commande->getDeviseMontantId() == 2) {
  						$total_montant_dol += round($commande->getMontant(), 2);
  						$total_montant_dol_all += round($commande->getMontant(), 2);
  					} else {
  						$total_montant_eur += round($commande->getMontant(), 2);
  						$total_montant_eur_all += round($commande->getMontant(), 2);
  					}
  					if ($commande->getDeviseFournisseurId() == 2) {
  						$total_fournisseur_dol += round($commande->getTotalFournisseur(), 2);
  						$total_fournisseur_dol_all += round($commande->getTotalFournisseur(), 2);
  					} elseif ($commande->getDeviseFournisseurId() == 3) {
	  					if ($commande->getDeviseMontantId() == 2) {
  							$total_fournisseur_dol += round($commande->getTotalFournisseur(), 2);
  							$total_fournisseur_dol_all += round($commande->getTotalFournisseur(), 2);
	  					} else {
  							$total_fournisseur_eur += round($commande->getTotalFournisseur(), 2);
  							$total_fournisseur_eur_all += round($commande->getTotalFournisseur(), 2);
	  					}
  					} else { 
  						$total_fournisseur_eur += round($commande->getTotalFournisseur(), 2);
  						$total_fournisseur_eur_all += round($commande->getTotalFournisseur(), 2);
  					}
  					if ($commande->getDeviseCommercialId() == 2) {
  						$total_commercial_dol += round($commande->getTotalCommercial(), 2);
  						$total_commercial_dol_all += round($commande->getTotalCommercial(), 2);
  					} elseif ($commande->getDeviseCommercialId() == 3) {
	  					if ($commande->getDeviseMontantId() == 2) {
  							$total_commercial_dol += round($commande->getTotalCommercial(), 2);
  							$total_commercial_dol_all += round($commande->getTotalCommercial(), 2);
	  					} else {
  							$total_commercial_eur += round($commande->getTotalCommercial(), 2);
  							$total_commercial_eur_all += round($commande->getTotalCommercial(), 2);
	  					}
  					} else {
  						$total_commercial_eur += round($commande->getTotalCommercial(), 2);
  						$total_commercial_eur_all += round($commande->getTotalCommercial(), 2);
  					}
  					
  					$total_metrage += round(str_replace(" ", "", $commande->getMetrage()), 2);
					$total_metrage_all += round(str_replace(" ", "", $commande->getMetrage()), 2);
				
  				endforeach; 
  				
  				// FIN TABLEAU PAR FOURNISSEUR
  				// CALCUL POUR LE DERNIER FOURNISSEUR
  			?>
			<?php if ($from && $to): ?>
			<tr class="">
				<th colspan="8"></th>
				<th>Métrage</th>
				<th>%</th>
				<th>Montant(€)</th>
				<th>%</th>
				<th>Montant($)</th>
				<th>%</th>
				<th class="noTd">Com.&nbsp;NM(€)</th>
				<th>%</th>
				<th class="noTd">Com.&nbsp;NM($)</th>
				<th>%</th>
				<th>Com.&nbsp;CC(€)</th>
				<th>Com.&nbsp;CC($)</th>
			</tr>
			</thead>
  			<tr class="statTotal">
  				<td colspan="8"><strong>Total par fournisseur période</strong> du <?php echo $fromN0->format('d/m/Y') ?> au <?php echo $toN0->format('d/m/Y') ?></td>
  				<td><strong><?php echo round($total_metrage, 2); ?></strong></td>
  				<td align="right"></td>
  				<td align="right"><strong><?php echo number_format(round($total_montant_eur, 2), 2, '.', '&nbsp;'); ?></strong></td>
  				<td align="right"></td>
  				<td align="right"><strong><?php echo number_format(round($total_montant_dol, 2), 2, '.', '&nbsp;'); ?></strong></td>
  				<td align="right"></td>
  				<td align="right" class="noTd"><strong><?php echo number_format(round($total_fournisseur_eur, 2), 2, '.', '&nbsp;'); ?></strong></td>
  				<td align="right"></td>
  				<td align="right" class="noTd"><strong><?php echo number_format(round($total_fournisseur_dol, 2), 2, '.', '&nbsp;'); ?></strong></td>
  				<td align="right"></td>
  				<td align="right"><strong><?php echo number_format(round($total_commercial_eur, 2), 2, '.', '&nbsp;'); ?></strong></td>
  				<td align="right"><strong><?php echo number_format(round($total_commercial_dol, 2), 2, '.', '&nbsp;'); ?></strong></td>
  			</tr>
  			<tr class="statTotal ligneMarine">
  				<td colspan="8"><strong>Total N-1 période</strong> du <?php echo $fromN1->format('d/m/Y') ?> au <?php echo $toN1->format('d/m/Y') ?></td>
  				<td><strong><?php echo (isset($n1[$fournisseur_id]))? round($n1[$fournisseur_id]['metrage'], 2) : 0; ?></strong></td>
  				<td align="right">
					<?php if (isset($n1[$fournisseur_id]) && $total_metrage > 0 && $n1[$fournisseur_id]['metrage'] > 0): ?>
					<?php $diff = $total_metrage / $n1[$fournisseur_id]['metrage']; ?>
					<?php if ($diff > 1): ?>
						<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php else: ?>
						<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php endif; ?>
					<?php endif; ?>
				</td>
  				<td align="right"><strong><?php echo (isset($n1[$fournisseur_id]))? number_format(round($n1[$fournisseur_id]['montant_eur'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right">
					<?php if (isset($n1[$fournisseur_id]) && $total_montant_eur > 0 && $n1[$fournisseur_id]['montant_eur'] > 0): ?>
					<?php $diff = $total_montant_eur / $n1[$fournisseur_id]['montant_eur']; ?>
					<?php if ($diff > 1): ?>
						<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php else: ?>
						<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php endif; ?>
					<?php endif; ?>
				</td>
  				<td align="right"><strong><?php echo (isset($n1[$fournisseur_id]))? number_format(round($n1[$fournisseur_id]['montant_doll'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right">
					<?php if (isset($n1[$fournisseur_id]) && $total_montant_dol > 0 && $n1[$fournisseur_id]['montant_doll'] > 0): ?>
					<?php $diff = $total_montant_dol / $n1[$fournisseur_id]['montant_doll']; ?>
					<?php if ($diff > 1): ?>
						<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php else: ?>
						<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php endif; ?>
					<?php endif; ?>
				</td>
  				<td align="right" class="noTd"><strong><?php echo (isset($n1[$fournisseur_id]))? number_format(round($n1[$fournisseur_id]['nm_eur'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right">
					<?php if (isset($n1[$fournisseur_id]) && $total_fournisseur_eur > 0 && $n1[$fournisseur_id]['nm_eur'] > 0): ?>
					<?php $diff = $total_fournisseur_eur / $n1[$fournisseur_id]['nm_eur']; ?>
					<?php if ($diff > 1): ?>
						<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php else: ?>
						<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php endif; ?>
					<?php endif; ?>
				</td>
  				<td align="right" class="noTd"><strong><?php echo (isset($n1[$fournisseur_id]))? number_format(round($n1[$fournisseur_id]['nm_doll'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right">
					<?php if (isset($n1[$fournisseur_id]) && $total_fournisseur_dol > 0 && $n1[$fournisseur_id]['nm_doll'] > 0): ?>
					<?php $diff = $total_fournisseur_dol / $n1[$fournisseur_id]['nm_doll']; ?>
					<?php if ($diff > 1): ?>
						<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php else: ?>
						<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php endif; ?>
					<?php endif; ?>
				</td>
  				<td align="right"><strong><?php echo (isset($n1[$fournisseur_id]))? number_format(round($n1[$fournisseur_id]['cc_eur'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right"><strong><?php echo (isset($n1[$fournisseur_id]))? number_format(round($n1[$fournisseur_id]['cc_doll'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  			</tr>
  			<tr class="statTotal ligneJaune">
  				<td colspan="8"><strong>Total N-2 période</strong> du <?php echo $fromN2->format('d/m/Y') ?> au <?php echo $toN2->format('d/m/Y') ?></td>
  				<td><strong><?php echo (isset($n2[$fournisseur_id]))? round($n2[$fournisseur_id]['metrage'], 2) : 0; ?></strong></td>
  				<td align="right">
					<?php if (isset($n2[$fournisseur_id]) && $total_metrage > 0 && $n2[$fournisseur_id]['metrage'] > 0): ?>
					<?php $diff = $total_metrage / $n2[$fournisseur_id]['metrage']; ?>
					<?php if ($diff > 1): ?>
						<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php else: ?>
						<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php endif; ?>
					<?php endif; ?>
				</td>
  				<td align="right"><strong><?php echo (isset($n2[$fournisseur_id]))? number_format(round($n2[$fournisseur_id]['montant_eur'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right">
					<?php if (isset($n2[$fournisseur_id]) && $total_montant_eur > 0 && $n2[$fournisseur_id]['montant_eur'] > 0): ?>
					<?php $diff = $total_montant_eur / $n2[$fournisseur_id]['montant_eur']; ?>
					<?php if ($diff > 1): ?>
						<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php else: ?>
						<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php endif; ?>
					<?php endif; ?>
				</td>
  				<td align="right"><strong><?php echo (isset($n2[$fournisseur_id]))? number_format(round($n2[$fournisseur_id]['montant_doll'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right">
					<?php if (isset($n2[$fournisseur_id]) && $total_montant_dol > 0 && $n2[$fournisseur_id]['montant_doll'] > 0): ?>
					<?php $diff = $total_montant_dol / $n2[$fournisseur_id]['montant_doll']; ?>
					<?php if ($diff > 1): ?>
						<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php else: ?>
						<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php endif; ?>
					<?php endif; ?>
				</td>
  				<td align="right" class="noTd"><strong><?php echo (isset($n2[$fournisseur_id]))? number_format(round($n2[$fournisseur_id]['nm_eur'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right">
					<?php if (isset($n2[$fournisseur_id]) && $total_fournisseur_eur > 0 && $n2[$fournisseur_id]['nm_eur'] > 0): ?>
					<?php $diff = $total_fournisseur_eur / $n2[$fournisseur_id]['nm_eur']; ?>
					<?php if ($diff > 1): ?>
						<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php else: ?>
						<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php endif; ?>
					<?php endif; ?>
				</td>
  				<td align="right" class="noTd"><strong><?php echo (isset($n2[$fournisseur_id]))? number_format(round($n2[$fournisseur_id]['nm_doll'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right">
					<?php if (isset($n2[$fournisseur_id]) && $total_fournisseur_dol > 0 && $n2[$fournisseur_id]['nm_doll'] > 0): ?>
					<?php $diff = $total_fournisseur_dol / $n2[$fournisseur_id]['nm_doll']; ?>
					<?php if ($diff > 1): ?>
						<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php else: ?>
						<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php endif; ?>
					<?php endif; ?>
				</td>
  				<td align="right"><strong><?php echo (isset($n2[$fournisseur_id]))? number_format(round($n2[$fournisseur_id]['cc_eur'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right"><strong><?php echo (isset($n2[$fournisseur_id]))? number_format(round($n2[$fournisseur_id]['cc_doll'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  			</tr>
			<tr>
				<th colspan="8"></th>
				<th>Métrage</th>
				<th>%</th>
				<th>Montant(€)</th>
				<th>%</th>
				<th>Montant($)</th>
				<th>%</th>
				<th class="noTd">Com.&nbsp;NM(€)</th>
				<th>%</th>
				<th class="noTd">Com.&nbsp;NM($)</th>
				<th>%</th>
				<th>Com.&nbsp;CC(€)</th>
				<th>Com.&nbsp;CC($)</th>
			</tr>
  			<tr class="statTotal">
  				<td colspan="8"><strong>Total par fournisseur cumulé du <?php echo $fromCumul->format('d/m/Y') ?> au <?php echo $toCumul->format('d/m/Y') ?></strong></td>
  				<td><strong><?php echo (isset($cn[$fournisseur_id]))? round($cn[$fournisseur_id]['metrage'], 2) : 0; ?></strong></td>
  				<td align="right"></td>
  				<td align="right"><strong><?php echo (isset($cn[$fournisseur_id]))? number_format(round($cn[$fournisseur_id]['montant_eur'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right"></td>
  				<td align="right"><strong><?php echo (isset($cn[$fournisseur_id]))? number_format(round($cn[$fournisseur_id]['montant_doll'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right"></td>
  				<td align="right" class="noTd"><strong><?php echo (isset($cn[$fournisseur_id]))? number_format(round($cn[$fournisseur_id]['nm_eur'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right"></td>
  				<td align="right" class="noTd"><strong><?php echo (isset($cn[$fournisseur_id]))? number_format(round($cn[$fournisseur_id]['nm_doll'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right"></td>
  				<td align="right"><strong><?php echo (isset($cn[$fournisseur_id]))? number_format(round($cn[$fournisseur_id]['cc_eur'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right"><strong><?php echo (isset($cn[$fournisseur_id]))? number_format(round($cn[$fournisseur_id]['cc_doll'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  			</tr>
  			<tr class="statTotal ligneMarine">
  				<td colspan="8"><strong>Total N-1 cumulé du <?php echo $fromCumul1->format('d/m/Y') ?> au <?php echo $toCumul1->format('d/m/Y') ?></strong></td>
  				<td><strong><?php echo (isset($cn1[$fournisseur_id]))? round($cn1[$fournisseur_id]['metrage'], 2) : 0; ?></strong></td>
  				<td align="right">
					<?php if (isset($cn1[$fournisseur_id]) && isset($cn[$fournisseur_id]) && $cn[$fournisseur_id]['metrage'] > 0 && $cn1[$fournisseur_id]['metrage'] > 0): ?>
					<?php $diff = $cn[$fournisseur_id]['metrage'] / $cn1[$fournisseur_id]['metrage']; ?>
					<?php if ($diff > 1): ?>
						<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php else: ?>
						<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php endif; ?>
					<?php endif; ?>
  				</td>
  				<td align="right"><strong><?php echo (isset($cn1[$fournisseur_id]))? number_format(round($cn1[$fournisseur_id]['montant_eur'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right">
					<?php if (isset($cn1[$fournisseur_id]) && isset($cn[$fournisseur_id]) && $cn[$fournisseur_id]['montant_eur'] > 0 && $cn1[$fournisseur_id]['montant_eur'] > 0): ?>
					<?php $diff = $cn[$fournisseur_id]['montant_eur'] / $cn1[$fournisseur_id]['montant_eur']; ?>
					<?php if ($diff > 1): ?>
						<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php else: ?>
						<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php endif; ?>
					<?php endif; ?>
  				</td>
  				<td align="right"><strong><?php echo (isset($cn1[$fournisseur_id]))? number_format(round($cn1[$fournisseur_id]['montant_doll'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right">
					<?php if (isset($cn1[$fournisseur_id]) && isset($cn[$fournisseur_id]) && $cn[$fournisseur_id]['montant_doll'] > 0 && $cn1[$fournisseur_id]['montant_doll'] > 0): ?>
					<?php $diff = $cn[$fournisseur_id]['montant_doll'] / $cn1[$fournisseur_id]['montant_doll']; ?>
					<?php if ($diff > 1): ?>
						<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php else: ?>
						<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php endif; ?>
					<?php endif; ?>
				</td>
  				<td align="right" class="noTd"><strong><?php echo (isset($cn1[$fournisseur_id]))? number_format(round($cn1[$fournisseur_id]['nm_eur'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right">
					<?php if (isset($cn1[$fournisseur_id]) && isset($cn[$fournisseur_id]) && $cn[$fournisseur_id]['nm_eur'] > 0 && $cn1[$fournisseur_id]['nm_eur'] > 0): ?>
					<?php $diff = $cn[$fournisseur_id]['nm_eur'] / $cn1[$fournisseur_id]['nm_eur']; ?>
					<?php if ($diff > 1): ?>
						<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php else: ?>
						<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php endif; ?>
					<?php endif; ?>
				</td>
  				<td align="right" class="noTd"><strong><?php echo (isset($cn1[$fournisseur_id]))? number_format(round($cn1[$fournisseur_id]['nm_doll'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right">
					<?php if (isset($cn1[$fournisseur_id]) && isset($cn[$fournisseur_id]) && $cn[$fournisseur_id]['nm_doll'] > 0 && $cn1[$fournisseur_id]['nm_doll'] > 0): ?>
					<?php $diff = $cn[$fournisseur_id]['nm_doll'] / $cn1[$fournisseur_id]['nm_doll']; ?>
					<?php if ($diff > 1): ?>
						<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php else: ?>
						<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php endif; ?>
					<?php endif; ?>
				</td>
  				<td align="right"><strong><?php echo (isset($cn1[$fournisseur_id]))? number_format(round($cn1[$fournisseur_id]['cc_eur'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right"><strong><?php echo (isset($cn1[$fournisseur_id]))? number_format(round($cn1[$fournisseur_id]['cc_doll'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  			</tr>
  			<tr class="statTotal ligneJaune">
  				<td colspan="8"><strong>Total N-2 cumulé du <?php echo $fromCumul2->format('d/m/Y') ?> au <?php echo $toCumul2->format('d/m/Y') ?></strong></td>
  				<td><strong><?php echo (isset($cn2[$fournisseur_id]))? round($cn2[$fournisseur_id]['metrage'], 2) : 0; ?></strong></td>
  				<td align="right">
					<?php if (isset($cn2[$fournisseur_id]) && isset($cn[$fournisseur_id]) && $cn[$fournisseur_id]['metrage'] > 0 && $cn2[$fournisseur_id]['metrage'] > 0): ?>
					<?php $diff = $cn[$fournisseur_id]['metrage'] / $cn2[$fournisseur_id]['metrage']; ?>
					<?php if ($diff > 1): ?>
						<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php else: ?>
						<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php endif; ?>
					<?php endif; ?>
				</td>
  				<td align="right"><strong><?php echo (isset($cn2[$fournisseur_id]))? number_format(round($cn2[$fournisseur_id]['montant_eur'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right">
					<?php if (isset($cn2[$fournisseur_id]) && isset($cn[$fournisseur_id]) && $cn[$fournisseur_id]['montant_eur'] > 0 && $cn2[$fournisseur_id]['montant_eur'] > 0): ?>
					<?php $diff = $cn[$fournisseur_id]['montant_eur'] / $cn2[$fournisseur_id]['montant_eur']; ?>
					<?php if ($diff > 1): ?>
						<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php else: ?>
						<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php endif; ?>
					<?php endif; ?>
				</td>
  				<td align="right"><strong><?php echo (isset($cn2[$fournisseur_id]))? number_format(round($cn2[$fournisseur_id]['montant_doll'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right">
					<?php if (isset($cn2[$fournisseur_id]) && isset($cn[$fournisseur_id]) && $cn[$fournisseur_id]['montant_doll'] > 0 && $cn2[$fournisseur_id]['montant_doll'] > 0): ?>
					<?php $diff = $cn[$fournisseur_id]['montant_doll'] / $cn2[$fournisseur_id]['montant_doll']; ?>
					<?php if ($diff > 1): ?>
						<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php else: ?>
						<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php endif; ?>
					<?php endif; ?>
				</td>
  				<td align="right" class="noTd"><strong><?php echo (isset($cn2[$fournisseur_id]))? number_format(round($cn2[$fournisseur_id]['nm_eur'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right">
					<?php if (isset($cn2[$fournisseur_id]) && isset($cn[$fournisseur_id]) && $cn[$fournisseur_id]['nm_eur'] > 0 && $cn2[$fournisseur_id]['nm_eur'] > 0): ?>
					<?php $diff = $cn[$fournisseur_id]['nm_eur'] / $cn2[$fournisseur_id]['nm_eur']; ?>
					<?php if ($diff > 1): ?>
						<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php else: ?>
						<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php endif; ?>
					<?php endif; ?>
				</td>
  				<td align="right" class="noTd"><strong><?php echo (isset($cn2[$fournisseur_id]))? number_format(round($cn2[$fournisseur_id]['nm_doll'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right">
					<?php if (isset($cn2[$fournisseur_id]) && isset($cn[$fournisseur_id]) && $cn[$fournisseur_id]['nm_doll'] > 0 && $cn2[$fournisseur_id]['nm_doll'] > 0): ?>
					<?php $diff = $cn[$fournisseur_id]['nm_doll'] / $cn2[$fournisseur_id]['nm_doll']; ?>
					<?php if ($diff > 1): ?>
						<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php else: ?>
						<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', '&nbsp;') ?>%</span>
					<?php endif; ?>
					<?php endif; ?>
				</td>
  				<td align="right"><strong><?php echo (isset($cn2[$fournisseur_id]))? number_format(round($cn2[$fournisseur_id]['cc_eur'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  				<td align="right"><strong><?php echo (isset($cn2[$fournisseur_id]))? number_format(round($cn2[$fournisseur_id]['cc_doll'], 2), 2, '.', '&nbsp;') : 0; ?></strong></td>
  			</tr>

			<?php else: ?>
			<tr class="">
				<th colspan="8"></th>
				<th>Métrage</th>
				<th>%</th>
				<th>Montant(€)</th>
				<th>%</th>
				<th>Montant($)</th>
				<th>%</th>
				<th class="noTd">Com.&nbsp;NM(€)</th>
				<th>%</th>
				<th class="noTd">Com.&nbsp;NM($)</th>
				<th>%</th>
				<th>Com.&nbsp;CC(€)</th>
				<th>Com.&nbsp;CC($)</th>
			</tr>
			</thead>
  			<tr class="statTotal">
  				<td colspan="8"><strong>Total par fournisseur</td>
  				<td><strong><?php echo round($total_metrage, 2); ?></strong></td>
  				<td align="right"></td>
  				<td align="right"><strong><?php echo number_format(round($total_montant_eur, 2), 2, '.', '&nbsp;'); ?></strong></td>
  				<td align="right"></td>
  				<td align="right"><strong><?php echo number_format(round($total_montant_dol, 2), 2, '.', '&nbsp;'); ?></strong></td>
  				<td align="right"></td>
  				<td align="right" class="noTd"><strong><?php echo number_format(round($total_fournisseur_eur, 2), 2, '.', '&nbsp;'); ?></strong></td>
  				<td align="right"></td>
  				<td align="right" class="noTd"><strong><?php echo number_format(round($total_fournisseur_dol, 2), 2, '.', '&nbsp;'); ?></strong></td>
  				<td align="right"></td>
  				<td align="right"><strong><?php echo number_format(round($total_commercial_eur, 2), 2, '.', '&nbsp;'); ?></strong></td>
  				<td align="right"><strong><?php echo number_format(round($total_commercial_dol, 2), 2, '.', '&nbsp;'); ?></strong></td>
  			</tr>
			<?php endif; ?>
  	</table>
  </div>
