<?php if ($credit->getFichier()): ?>
<a href="/uploads/factures/<?php echo $credit->getFichier() ?>" target="_blank">PDF</a>
<?php else: ?>
&nbsp;
<?php endif; ?>