<input class="submit_ajax_on_change input-discreet input-float" form="form_coupe_<?php echo $coupe->getId() ?>" name="coupe_ligne[prix]" data-partialview="<?php echo url_for('coupe_ligne_view', array('id' => $coupe->getId(), 'partial' => 'prix')) ?>" style="opacity: 1; <?php if($coupe->getPrix()): ?>display: none;<?php endif; ?>" type="text" value="<?php echo $coupe->getPrix(); ?>" />
<?php if($coupe->getPrix()): ?>
<span class="clic2showfield"><?php echo $coupe->getPrix(); ?></span>
<?php endif; ?>