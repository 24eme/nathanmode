 <script type="text/javascript">
 $(function() {
	 $( ".dp" ).datepicker($.datepicker.regional[ "fr" ]);
	 });
</script>
<div class="productName"><span>Commercial Activity</span></div>


<div class="ca_content">

	<form method="post" action="<?php echo url_for('@activite') ?>">
		<?php echo $filters->renderHiddenFields(); ?>
		<?php echo $filters->renderGlobalErrors(); ?>
		
		<div class="activity_date activity_content">
			<span class="activity_title"></span>
			
			<div class="activity_date_input">
				Période du&nbsp;
				<?php echo $filters['from']->renderError(); ?>
				<?php echo $filters['from']->render(array('class' => 'dp')); ?>
				&nbsp;au&nbsp;
				<?php echo $filters['to']->renderError(); ?>
				<?php echo $filters['to']->render(array('class' => 'dp')); ?>
				&nbsp;<input type="submit" value="OK" class="activity_date_bt" />
			</div>
			
			
		</div>
	</form>

	<div class="activity_period activity_content">
		<p class="ca_subttl">Rapport périodique</p>
		<div class="p1 ca_block">
			<span class="ca_ttl">Période</span>
			<span class="ca_nb">
				<table>
					<tr>
						<td>CA</td>
						<td><?php echo number_format($activitePeriode, 2, '.', ' ') ?>&nbsp;€</td>
						<td></td>
					</tr>
					<tr>
						<td>COM</td>
						<td><?php echo number_format($activitePeriodeCom, 2, '.', ' ') ?>&nbsp;€</td>
						<td></td>
					</tr>
					<tr>
						<td>MTS</td>
						<td><?php echo number_format($activitePeriodeMts, 2, '.', ' ') ?>&nbsp;Mts</td>
						<td></td>
					</tr>
				</table>
			</span>
		</div>
		<div class="p2 ca_block">
			<span class="ca_ttl">Période N-1</span>
			<span class="ca_nb">
				<table>
					<tr>
						<td>CA</td>
						<td><?php echo number_format($activitePeriode1, 2, '.', ' ') ?>&nbsp;€</td>
						<td>
						<?php if ($activitePeriode > 0 && $activitePeriode1 > 0): ?>
						<?php $diff = $activitePeriode / $activitePeriode1; ?>
						<?php if ($diff > 1): ?>
							<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', ' ') ?>%</span>
						<?php else: ?>
							<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', ' ') ?>%</span>
						<?php endif; ?>
						<?php endif; ?>
						</td>
					</tr>
					<tr>
						<td>COM</td>
						<td><?php echo number_format($activitePeriode1Com, 2, '.', ' ') ?>&nbsp;€</td>
						<td>
						<?php if ($activitePeriodeCom > 0 && $activitePeriode1Com > 0): ?>
						<?php $diff = $activitePeriodeCom / $activitePeriode1Com; ?>
						<?php if ($diff > 1): ?>
							<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', ' ') ?>%</span>
						<?php else: ?>
							<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', ' ') ?>%</span>
						<?php endif; ?>
						<?php endif; ?>
						</td>
					</tr>
					<tr>
						<td>MTS</td>
						<td><?php echo number_format($activitePeriode1Mts, 2, '.', ' ') ?>&nbsp;Mts</td>
						<td>
						<?php if ($activitePeriodeMts > 0 && $activitePeriode1Mts > 0): ?>
						<?php $diff = $activitePeriodeMts / $activitePeriode1Mts; ?>
						<?php if ($diff > 1): ?>
							<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', ' ') ?>%</span>
						<?php else: ?>
							<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', ' ') ?>%</span>
						<?php endif; ?>
						<?php endif; ?>
						</td>
					</tr>
				</table>
			</span>
		</div>
		<div class="p3 ca_block">
			<span class="ca_ttl">Période N-2</span>
			<span class="ca_nb">
				<table>
					<tr>
						<td>CA</td>
						<td><?php echo number_format($activitePeriode2, 2, '.', ' ') ?>&nbsp;€</td>
						<td>
						<?php if ($activitePeriode > 0 && $activitePeriode2 > 0): ?>
						<?php $diff = $activitePeriode / $activitePeriode2; ?>
						<?php if ($diff > 1): ?>
							<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', ' ') ?>%</span>
						<?php else: ?>
							<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', ' ') ?>%</span>
						<?php endif; ?>
						<?php endif; ?>	
						</td>
					</tr>
					<tr>
						<td>COM</td>
						<td><?php echo number_format($activitePeriode2Com, 2, '.', ' ') ?>&nbsp;€</td>
						<td>
						<?php if ($activitePeriodeCom > 0 && $activitePeriode2Com > 0): ?>
						<?php $diff = $activitePeriodeCom / $activitePeriode2Com; ?>
						<?php if ($diff > 1): ?>
							<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', ' ') ?>%</span>
						<?php else: ?>
							<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', ' ') ?>%</span>
						<?php endif; ?>
						<?php endif; ?>	
						</td>
					</tr>
					<tr>
						<td>MTS</td>
						<td><?php echo number_format($activitePeriode2Mts, 2, '.', ' ') ?>&nbsp;Mts</td>
						<td>
						<?php if ($activitePeriodeMts > 0 && $activitePeriode2Mts > 0): ?>
						<?php $diff = $activitePeriodeMts / $activitePeriode2Mts; ?>
						<?php if ($diff > 1): ?>
							<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', ' ') ?>%</span>
						<?php else: ?>
							<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', ' ') ?>%</span>
						<?php endif; ?>
						<?php endif; ?>	
						</td>
					</tr>
				</table>	
			</span>
		</div>
	</div>
	
	

	<div class="activity_period activity_content">
		<div class="p1 ca_block">
			<span class="ca_ttl">Période</span>
			<span class="ca_nb">				
				<table>
					<tr>
						<td>CA</td>
						<td><?php echo number_format($activitePeriodeDoll, 2, '.', ' ') ?>&nbsp;$</td>
						<td>	
						</td>
					</tr>
					<tr>
						<td>COM</td>
						<td><?php echo number_format($activitePeriodeDollCom, 2, '.', ' ') ?>&nbsp;$</td>
						<td>
						</td>
					</tr>
					<tr>
						<td>MTS</td>
						<td><?php echo number_format($activitePeriodeDollMts, 2, '.', ' ') ?>&nbsp;Mts</td>
						<td>
						</td>
					</tr>
				</table>
			</span>
		</div>
		<div class="p2 ca_block">
			<span class="ca_ttl">Période N-1</span>
			<span class="ca_nb">
				<table>
					<tr>
						<td>CA</td>
						<td><?php echo number_format($activitePeriode1Doll, 2, '.', ' ') ?>&nbsp;$</td>
						<td>
						<?php if ($activitePeriodeDoll > 0 && $activitePeriode1Doll > 0): ?>
						<?php $diff = $activitePeriodeDoll / $activitePeriode1Doll; ?>
						<?php if ($diff > 1): ?>
							<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', ' ') ?>%</span>
						<?php else: ?>
							<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', ' ') ?>%</span>
						<?php endif; ?>
						<?php endif; ?>
						</td>
					</tr>
					<tr>
						<td>COM</td>
						<td><?php echo number_format($activitePeriode1DollCom, 2, '.', ' ') ?>&nbsp;$</td>
						<td>
						<?php if ($activitePeriodeDollCom > 0 && $activitePeriode1DollCom > 0): ?>
						<?php $diff = $activitePeriodeDollCom / $activitePeriode1DollCom; ?>
						<?php if ($diff > 1): ?>
							<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', ' ') ?>%</span>
						<?php else: ?>
							<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', ' ') ?>%</span>
						<?php endif; ?>
						<?php endif; ?>
						</td>
					</tr>
					<tr>
						<td>MTS</td>
						<td><?php echo number_format($activitePeriode1DollMts, 2, '.', ' ') ?>&nbsp;Mts</td>
						<td>
						<?php if ($activitePeriodeDollMts > 0 && $activitePeriode1DollMts > 0): ?>
						<?php $diff = $activitePeriodeDollMts / $activitePeriode1DollMts; ?>
						<?php if ($diff > 1): ?>
							<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', ' ') ?>%</span>
						<?php else: ?>
							<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', ' ') ?>%</span>
						<?php endif; ?>
						<?php endif; ?>
						</td>
					</tr>
				</table>
			</span>
		</div>
		<div class="p3 ca_block">
			<span class="ca_ttl">Période N-2</span>
			<span class="ca_nb">
				<table>
					<tr>
						<td>CA</td>
						<td><?php echo number_format($activitePeriode2Doll, 2, '.', ' ') ?>&nbsp;$</td>
						<td>
						<?php if ($activitePeriodeDoll > 0 && $activitePeriode2Doll > 0): ?>
						<?php $diff = $activitePeriodeDoll / $activitePeriode2Doll; ?>
						<?php if ($diff > 1): ?>
							<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', ' ') ?>%</span>
						<?php else: ?>
							<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', ' ') ?>%</span>
						<?php endif; ?>
						<?php endif; ?>		
						</td>
					</tr>
					<tr>
						<td>COM</td>
						<td><?php echo number_format($activitePeriode2DollCom, 2, '.', ' ') ?>&nbsp;$</td>
						<td>
						<?php if ($activitePeriodeDollCom > 0 && $activitePeriode2DollCom > 0): ?>
						<?php $diff = $activitePeriodeDollCom / $activitePeriode2DollCom; ?>
						<?php if ($diff > 1): ?>
							<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', ' ') ?>%</span>
						<?php else: ?>
							<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', ' ') ?>%</span>
						<?php endif; ?>
						<?php endif; ?>		
						</td>
					</tr>
					<tr>
						<td>MTS</td>
						<td><?php echo number_format($activitePeriode2DollMts, 2, '.', ' ') ?>&nbsp;Mts</td>
						<td>
						<?php if ($activitePeriodeDollMts > 0 && $activitePeriode2DollMts > 0): ?>
						<?php $diff = $activitePeriodeDollMts / $activitePeriode2DollMts; ?>
						<?php if ($diff > 1): ?>
							<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', ' ') ?>%</span>
						<?php else: ?>
							<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', ' ') ?>%</span>
						<?php endif; ?>
						<?php endif; ?>		
						</td>
					</tr>
				</table>	
			</span>
		</div>
	</div>

	<p>&nbsp;</p>

	<div class="activity_year activity_content">
		<p class="ca_subttl">Rapport annuel</p>
		<div class="y1 ca_block">
			<span class="ca_ttl">Année <?php echo $toAnnuel ?></span>
			<span class="ca_nb">
				<table>
					<tr>
						<td>CA</td>
						<td><?php echo number_format($activiteAnnuel, 2, '.', ' ') ?>&nbsp;€</td>
						<td>	
						</td>
					</tr>
					<tr>
						<td>COM</td>
						<td><?php echo number_format($activiteAnnuelCom, 2, '.', ' ') ?>&nbsp;€</td>
						<td>	
						</td>
					</tr>
				</table>
			</span>
		</div>
		<div class="y2 ca_block">
			<span class="ca_ttl">Année <?php echo $toAnnuel - 1; ?> (N-1)</span>
			<span class="ca_nb">
				<table>
					<tr>
						<td>CA</td>
						<td><?php echo number_format($activiteAnnuel1, 2, '.', ' ') ?>&nbsp;€</td>
						<td>
						<?php if ($activiteAnnuel > 0 && $activiteAnnuel1 > 0): ?>
						<?php $diff = $activiteAnnuel / $activiteAnnuel1; ?>
						<?php if ($diff > 1): ?>
							<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', ' ') ?>%</span>
						<?php else: ?>
							<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', ' ') ?>%</span>
						<?php endif; ?>
						<?php endif; ?>		
						</td>
					</tr>
					<tr>
						<td>COM</td>
						<td><?php echo number_format($activiteAnnuel1Com, 2, '.', ' ') ?>&nbsp;€</td>
						<td>
						<?php if ($activiteAnnuelCom > 0 && $activiteAnnuel1Com > 0): ?>
						<?php $diff = $activiteAnnuelCom / $activiteAnnuel1Com; ?>
						<?php if ($diff > 1): ?>
							<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', ' ') ?>%</span>
						<?php else: ?>
							<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', ' ') ?>%</span>
						<?php endif; ?>
						<?php endif; ?>		
						</td>
					</tr>
				</table>	
			</span>
		</div>
		<div class="y3 ca_block">
			<span class="ca_ttl">Année <?php echo $toAnnuel - 2; ?> (N-2)</span>
			<span class="ca_nb">
				<table>
					<tr>
						<td>CA</td>
						<td><?php echo number_format($activiteAnnuel2, 2, '.', ' ') ?>&nbsp;€</td>
						<td>
						<?php if ($activiteAnnuel > 0 && $activiteAnnuel2 > 0): ?>
						<?php $diff = $activiteAnnuel / $activiteAnnuel2; ?>
						<?php if ($diff > 1): ?>
							<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', ' ') ?>%</span>
						<?php else: ?>
							<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', ' ') ?>%</span>
						<?php endif; ?>
						<?php endif; ?>	
						</td>
					</tr>
					<tr>
						<td>COM</td>
						<td><?php echo number_format($activiteAnnuel2Com, 2, '.', ' ') ?>&nbsp;€</td>
						<td>
						<?php if ($activiteAnnuelCom > 0 && $activiteAnnuel2Com > 0): ?>
						<?php $diff = $activiteAnnuelCom / $activiteAnnuel2Com; ?>
						<?php if ($diff > 1): ?>
							<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', ' ') ?>%</span>
						<?php else: ?>
							<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', ' ') ?>%</span>
						<?php endif; ?>
						<?php endif; ?>	
						</td>
					</tr>
				</table>	
			</span>
		</div>
	</div>

	<div class="activity_year activity_content">
		<div class="y1 ca_block">
			<span class="ca_ttl">Année <?php echo $toAnnuel ?></span>
			<span class="ca_nb">
				<table>
					<tr>
						<td>CA</td>
						<td><?php echo number_format($activiteAnnuelDoll, 2, '.', ' ') ?>&nbsp;$</td>
						<td>	
						</td>
					</tr>
					<tr>
						<td>COM</td>
						<td><?php echo number_format($activiteAnnuelDollCom, 2, '.', ' ') ?>&nbsp;$</td>
						<td>	
						</td>
					</tr>
				</table>
			</span>
		</div>
		<div class="y2 ca_block">
			<span class="ca_ttl">Année <?php echo $toAnnuel - 1; ?> (N-1)</span>
			<span class="ca_nb">
				<table>
					<tr>
						<td>CA</td>
						<td><?php echo number_format($activiteAnnuel1Doll, 2, '.', ' ') ?>&nbsp;$</td>
						<td>
						<?php if ($activiteAnnuelDoll > 0 && $activiteAnnuel1Doll > 0): ?>
						<?php $diff = $activiteAnnuelDoll / $activiteAnnuel1Doll; ?>
						<?php if ($diff > 1): ?>
							<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', ' ') ?>%</span>
						<?php else: ?>
							<span class="neg percent"><?php echo number_format(($diff - 1) * 100, O, '.', ' ') ?>%</span>
						<?php endif; ?>
						<?php endif; ?>		
						</td>
					</tr>
					<tr>
						<td>COM</td>
						<td><?php echo number_format($activiteAnnuel1DollCom, 2, '.', ' ') ?>&nbsp;$</td>
						<td>
						<?php if ($activiteAnnuelDollCom > 0 && $activiteAnnuel1DollCom > 0): ?>
						<?php $diff = $activiteAnnuelDollCom / $activiteAnnuel1DollCom; ?>
						<?php if ($diff > 1): ?>
							<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', ' ') ?>%</span>
						<?php else: ?>
							<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', ' ') ?>%</span>
						<?php endif; ?>
						<?php endif; ?>		
						</td>
					</tr>
				</table>	
			</span>
		</div>
		<div class="y3 ca_block">
			<span class="ca_ttl">Année <?php echo $toAnnuel - 2; ?> (N-2)</span>
			<span class="ca_nb">
				<table>
					<tr>
						<td>CA</td>
						<td><?php echo number_format($activiteAnnuel2Doll, 2, '.', ' ') ?>&nbsp;$</td>
						<td>
						<?php if ($activiteAnnuelDoll > 0 && $activiteAnnuel2Doll > 0): ?>
						<?php $diff = $activiteAnnuelDoll / $activiteAnnuel2Doll; ?>
						<?php if ($diff > 1): ?>
							<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', ' ') ?>%</span>
						<?php else: ?>
							<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', ' ') ?>%</span>
						<?php endif; ?>
						<?php endif; ?>			
						</td>
					</tr>
					<tr>
						<td>COM</td>
						<td><?php echo number_format($activiteAnnuel2DollCom, 2, '.', ' ') ?>&nbsp;$</td>
						<td>
						<?php if ($activiteAnnuelDollCom > 0 && $activiteAnnuel2DollCom > 0): ?>
						<?php $diff = $activiteAnnuelDollCom / $activiteAnnuel2DollCom; ?>
						<?php if ($diff > 1): ?>
							<span class="pos percent">+<?php echo number_format(($diff - 1) * 100, 0, '.', ' ') ?>%</span>
						<?php else: ?>
							<span class="neg percent"><?php echo number_format(($diff - 1) * 100, 0, '.', ' ') ?>%</span>
						<?php endif; ?>
						<?php endif; ?>			
						</td>
					</tr>
				</table>	
			</span>
		</div>
	</div>
	
	<div class="bt_ca_content">
		<a href="<?php echo url_for('@activiteclient') ?>?from=<?php echo $linkfrom ?>&to=<?php echo $linkto ?>" class="bt_ca_client bt_ca">Rapport par client</a>
		<a href="<?php echo url_for('@activiteglobal') ?>?from=<?php echo $linkfrom ?>&to=<?php echo $linkto ?>" class="bt_ca_global bt_ca">Rapport Global</a>
	</div>

</div>