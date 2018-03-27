<?php if ($facture->getFichier()): ?>
<a href="/uploads/factures/<?php echo $facture->getFichier() ?>" target="_blank">PDF</a>
<?php else: ?>
&nbsp;
<?php endif; ?>