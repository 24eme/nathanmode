<?php if ($coupe->getLivreLe()): ?>
<?php echo false !== strtotime($coupe->getLivreLe()) ? format_date($coupe->getLivreLe(), "dd/MM/yyyy") : '&nbsp;' ?>
<?php else: ?>
<input style="opacity: 0.3;" type="date" />
<?php endif; ?>