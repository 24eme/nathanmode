<?php if ($coupe->getNumFacture()): ?>
<?php echo $coupe->getNumFacture() ?>
<?php else: ?>
<input form="form_coupe_<?php echo $coupe->getId() ?>" name="coupe_ligne[num_facture]" style="opacity: 0.3;" type="text" />
<?php endif; ?>