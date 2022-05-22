<?php if ($coupe->getFichier()): ?>
<a style="color: #000;" href="/uploads/factures/<?php echo $coupe->getFichier() ?>" target="_blank">PDF</a>
<?php else: ?>
<input type="file" style="width: 120px; opacity: 0.4;" />
<?php endif; ?>