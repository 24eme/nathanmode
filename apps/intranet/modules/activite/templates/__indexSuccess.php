 <script type="text/javascript">
 $(function() {
	 $( ".dp" ).datepicker($.datepicker.regional[ "fr" ]);
	 });
</script>
<div class="productName"><span>Commercial Activity</span></div>

<form method="post" action="<?php echo url_for('@activite') ?>">
	<?php echo $filters->renderHiddenFields(); ?>
	<?php echo $filters->renderGlobalErrors(); ?>
	<table class="tableNm" cellspacing="0" cellpadding="0" border="0" width="100%">
		<tr>
			<td>Période</td>
			<td>
				<?php echo $filters['from']->renderError(); ?>
				<?php echo $filters['from']->render(array('class' => 'dp')); ?>
			</td>
			<td>
				<?php echo $filters['to']->renderError(); ?>
				<?php echo $filters['to']->render(array('class' => 'dp')); ?>
			</td>
			<td><input type="submit" value="Valider" /></td>
		</tr>
	</table>
</form>
<p>&nbsp;</p>
<table class="tableNm" cellspacing="0" cellpadding="0" border="0" width="100%">
	<thead>
		<tr>
			<th>Période</th>
			<th>Période N-1</th>
			<th>Période N-2</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td align="right">
				<?php echo number_format($activitePeriode, 2, '.', ' ') ?>&nbsp;€
			</td>
			<td align="right">
				<?php echo number_format($activitePeriode1, 2, '.', ' ') ?>&nbsp;€
				<?php if ($activitePeriode > 0 && $activitePeriode1 > 0): ?>
				<?php $diff = $activitePeriode / $activitePeriode1; ?>
			    <?php if ($diff > 1): ?>
			    	(<span class="pos">+<?php echo number_format(($diff - 1) * 100, 2, '.', ' ') ?>%</span>)
				<?php else: ?>
					(<span class="neg">-<?php echo number_format($diff * 100, 2, '.', ' ') ?>%</span>)
				<?php endif; ?>
				<?php endif; ?>
			</td>
			<td align="right">
				<?php echo number_format($activitePeriode2, 2, '.', ' ') ?>&nbsp;€
				<?php if ($activitePeriode > 0 && $activitePeriode2 > 0): ?>
				<?php $diff = $activitePeriode / $activitePeriode2; ?>
			    <?php if ($diff > 1): ?>
			    	(<span class="pos">+<?php echo number_format(($diff - 1) * 100, 2, '.', ' ') ?>%</span>)
				<?php else: ?>
					(<span class="neg">-<?php echo number_format($diff * 100, 2, '.', ' ') ?>%</span>)
				<?php endif; ?>
				<?php endif; ?>
			</td>
		</tr>
	</tbody>
</table>
<p>&nbsp;</p>
<p>Rapport annuel jusqu'au </p>
<p>&nbsp;</p>
<table class="tableNm" cellspacing="0" cellpadding="0" border="0" width="100%">
	<thead>
		<tr>
			<th>Année <?php echo $toAnnuel ?></th>
			<th>Année <?php echo $toAnnuel - 1; ?> (N-1)</th>
			<th>Année <?php echo $toAnnuel - 2; ?> (N-2)</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td align="right">
				<?php echo number_format($activiteAnnuel, 2, '.', ' ') ?>&nbsp;€
			</td>
			<td align="right">
				<?php echo number_format($activiteAnnuel1, 2, '.', ' ') ?>&nbsp;€
				<?php if ($activiteAnnuel > 0 && $activiteAnnuel1 > 0): ?>
				<?php $diff = $activiteAnnuel / $activiteAnnuel1; ?>
			    <?php if ($diff > 1): ?>
			    	(<span class="pos">+<?php echo number_format(($diff - 1) * 100, 2, '.', ' ') ?>%</span>)
				<?php else: ?>
					(<span class="neg">-<?php echo number_format($diff * 100, 2, '.', ' ') ?>%</span>)
				<?php endif; ?>
				<?php endif; ?>
			</td>
			<td align="right">
				<?php echo number_format($activiteAnnuel2, 2, '.', ' ') ?>&nbsp;€
				<?php if ($activiteAnnuel > 0 && $activiteAnnuel2 > 0): ?>
				<?php $diff = $activiteAnnuel / $activiteAnnuel2; ?>
			    <?php if ($diff > 1): ?>
			    	(<span class="pos">+<?php echo number_format(($diff - 1) * 100, 2, '.', ' ') ?>%</span>)
				<?php else: ?>
					(<span class="neg">-<?php echo number_format($diff * 100, 2, '.', ' ') ?>%</span>)
				<?php endif; ?>
				<?php endif; ?>
			</td>
		</tr>
	</tbody>
</table>

<a href="<?php echo url_for('@activiteclient') ?>?from=<?php echo $linkfrom ?>&to=<?php echo $linkto ?>">Client</a>
<br />
<a href="<?php echo url_for('@activiteglobal') ?>?from=<?php echo $linkfrom ?>&to=<?php echo $linkto ?>">Global</a>