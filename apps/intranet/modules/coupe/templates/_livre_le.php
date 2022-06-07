<?php use_helper('Date'); ?>
<input class="submit_ajax_on_change input-discreet" form="form_coupe_<?php echo $coupe->getId() ?>" name="coupe_ligne[livre_le]" data-partialview="<?php echo url_for('coupe_ligne_view', array('id' => $coupe->getId(), 'partial' => 'livre_le')) ?>" style="opacity: 0.3; <?php if($coupe->getLivreLe()): ?>display: none;<?php endif; ?>" type="date" value="<?php echo $coupe->getLivreLe() ?>" />

<?php if($coupe->getLivreLe()): ?>
<span class="clic2showfield"><?php echo false !== strtotime($coupe->getRawValue()->getLivreLe()) ? format_date($coupe->getLivreLe(), "dd/MM/yyyy") : '&nbsp;' ?></span>
<?php endif; ?>
