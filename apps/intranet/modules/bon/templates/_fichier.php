<?php if ($bon->getFichier()): ?>
<a href="/uploads/factures/<?php echo $bon->getFichier() ?>" target="_blank">PDF</a>
<?php else: ?>
&nbsp;
<?php endif; ?>