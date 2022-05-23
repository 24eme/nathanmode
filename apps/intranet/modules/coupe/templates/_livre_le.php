<?php use_helper('Date'); ?>
<?php if ($coupe->getLivreLe()): ?>
<?php echo false !== strtotime($coupe->getRawValue()->getLivreLe()) ? format_date($coupe->getLivreLe(), "dd/MM/yyyy") : '&nbsp;' ?>
<?php else: ?>
<input class="submit_ajax_on_change" form="form_coupe_<?php echo $coupe->getId() ?>" name="coupe_ligne[livre_le]" data-partialview="<?php echo url_for('coupe_ligne_view', array('id' => $coupe->getId(), 'partial' => 'livre_le')) ?>" style="opacity: 0.3;" type="date" />
<?php endif; ?>