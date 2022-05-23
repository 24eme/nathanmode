<?php if ($coupe->getLivreLe()): ?>
<?php echo false !== strtotime($coupe->getLivreLe()) ? format_date($coupe->getLivreLe(), "dd/MM/yyyy") : '&nbsp;' ?>
<?php else: ?>
<input form="form_coupe_<?php echo $coupe->getId() ?>" name="coupe_ligne[livre_le]" style="opacity: 0.3;" type="date" />
<?php endif; ?>