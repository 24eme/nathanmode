<?php if ($coupe->getFacture()): ?>
<a href="/uploads/factures/<?php echo $coupe->getFichier() ?>" target="_blank">Facture</a>
<?php else: ?>
&nbsp;
<?php endif; ?>