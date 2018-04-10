<div class="productName"><span>Rapport par client</span></div>
<p>Du <?php echo $printFrom ?> au <?php echo $printTo ?> (généré le <?php echo date('d/m/Y'); ?>)</p>
<p>&nbsp;</p>
<table class="tableNm" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-bottom:50px">
	<thead>
		<tr>
			<th>Client</th>
			<th>Cumul période</th>
			<th>Cumul période (N-1)</th>
			<th>% mensuel</th>
			<th>Cumul annuel</th>
			<th>Cumul annuel (N-1)</th>
			<th>% annuel</th>
			<th>Cumul période (N-2)</th>
			<th>Cumul annuel (N-2)</th>
		</tr>
	</thead>
	<tbody>
			<?php 
				$total_ap = 0;
				$total_ap_1 = 0;
				$total_ap_2 = 0;
				$total_aa = 0;
				$total_aa_1 = 0;
				$total_aa_2 = 0;
				foreach ($activitePeriode as $id => $ap): 
					$total_ap += $ap['total'];
					$total_ap_1 += (isset($activitePeriode1[$id]))? $activitePeriode1[$id]['total'] : 0;
					$total_ap_2 += (isset($activitePeriode2[$id]))? $activitePeriode2[$id]['total'] : 0;
					$total_aa += (isset($activiteAnnuel[$id]))? $activiteAnnuel[$id]['total'] : 0;
					$total_aa_1 += (isset($activiteAnnuel1[$id]))? $activiteAnnuel1[$id]['total'] : 0;
					$total_aa_2 += (isset($activiteAnnuel2[$id]))? $activiteAnnuel2[$id]['total'] : 0;
			?>
			<tr class="trHover">
				<td><?php echo $ap['client']; ?></td>
				<td align="right"><?php echo number_format($ap['total'], 2, '.', ' '); ?></td>
				<td align="right"><?php echo (isset($activitePeriode1[$id]))? number_format($activitePeriode1[$id]['total'], 2, '.', ' ') : ''; ?></td>
				<td align="right">
				<?php 
					if (isset($activitePeriode1[$id]) && $activitePeriode1[$id]['total'] > 0): 
						$diff = $ap['total'] / $activitePeriode1[$id]['total']; 
						if ($diff > 1) { 
							echo '<span class="pos_client">+'.number_format(($diff - 1) * 100, 2, '.', ' ').'%</span>';
						} else { 
							echo '<span class="neg_client">'.number_format(($diff - 1) * 100, 2, '.', ' ').'%</span>'; 
						}
					endif; 
				?>
				</td>
				<td align="right"><?php echo (isset($activiteAnnuel[$id]))? number_format($activiteAnnuel[$id]['total'], 2, '.', ' ') : ''; ?></td>
				<td align="right"><?php echo (isset($activiteAnnuel1[$id]))? number_format($activiteAnnuel1[$id]['total'], 2, '.', ' ') : ''; ?></td>
				<td align="right">
				<?php 
					if (isset($activiteAnnuel1[$id]) && $activiteAnnuel1[$id]['total'] > 0): 
						$diff = $ap['total'] / $activiteAnnuel1[$id]['total']; 
						if ($diff > 1) { 
							echo '<span class="pos_client">+'.number_format(($diff - 1) * 100, 2, '.', ' ').'%</span>'; 
						} else { 
							echo '<span class="neg_client">'.number_format(($diff - 1) * 100, 2, '.', ' ').'%</span>'; 
						} 
					endif; 
				?>
				</td>
				<td align="right"><?php echo (isset($activitePeriode2[$id]))? number_format($activitePeriode2[$id]['total'], 2, '.', ' ') : ''; ?></td>
				<td align="right"><?php echo (isset($activiteAnnuel2[$id]))? number_format($activiteAnnuel2[$id]['total'], 2, '.', ' ') : ''; ?></td>
			</tr>			
			<?php endforeach; ?>
			<tr class="lineTotal statTotalMax">
				<td align="right"><strong>Total</strong></td>
				<td align="right"><strong><?php echo number_format($total_ap, 2, '.', ' ') ?></strong></td>
				<td align="right"><strong><?php echo number_format($total_ap_1, 2, '.', ' ') ?></strong></td>
				<td align="right">
				<strong>
				<?php  
						$diff = $total_ap / $total_ap_1; 
						if ($diff > 1) { 
							echo '<span class="pos_client">+'.number_format(($diff - 1) * 100, 2, '.', ' ').'%</span>';
						} else { 
							echo '<span class="neg_client">'.number_format(($diff - 1) * 100, 2, '.', ' ').'%</span>'; 
						}
				?>
				</strong>
				</td>
				<td align="right"><strong><?php echo number_format($total_aa, 2, '.', ' ') ?></strong></td>
				<td align="right"><strong><?php echo number_format($total_aa_1, 2, '.', ' ') ?></strong></td>
				<td align="right">
				<strong>
				<?php  
						$diff = $total_aa / $total_aa_1; 
						if ($diff > 1) { 
							echo '<span class="pos_client">+'.number_format(($diff - 1) * 100, 2, '.', ' ').'%</span>';
						} else { 
							echo '<span class="neg_client">'.number_format(($diff - 1) * 100, 2, '.', ' ').'%</span>'; 
						}
				?>
				</strong>
				</td>
				<td align="right"><strong><?php echo number_format($total_ap_2, 2, '.', ' ') ?></strong></td>
				<td align="right"><strong><?php echo number_format($total_aa_2, 2, '.', ' ') ?></strong></td>
			</tr>
	</tbody>
	<thead>
		<tr>
			<th>Client</th>
			<th>Cumul période</th>
			<th>Cumul période (N-1)</th>
			<th>% mensuel</th>
			<th>Cumul annuel</th>
			<th>Cumul annuel (N-1)</th>
			<th>% annuel</th>
			<th>Cumul période (N-2)</th>
			<th>Cumul annuel (N-2)</th>
		</tr>
	</thead>
</table>
