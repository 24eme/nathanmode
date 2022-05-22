<?php if ($coupe->getNumFacture()): ?>
<?php echo $coupe->getNumFacture() ?>
<?php else: ?>
<input style="opacity: 0.3;" type="text" />
<?php endif; ?>