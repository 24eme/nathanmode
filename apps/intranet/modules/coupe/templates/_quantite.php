<?php if($coupe->situation != 'SOLDEE'): ?>
<input class="submit_ajax_on_change input-discreet" form="form_coupe_<?php echo $coupe->getId() ?>" name="coupe_ligne[quantite]" data-partialview="<?php echo url_for('coupe_ligne_view', array('id' => $coupe->getId(), 'partial' => 'quantite')) ?>" style="opacity: 1;" type="text" value="<?php if(!$coupe->getPiece()): ?><?php echo $coupe->getMetrage() ?><?php else: ?><?php echo $coupe->getPiece() ?><?php endif; ?>" />
<?php else: ?>
<?php if(!$coupe->getPiece()): ?><?php echo $coupe->getMetrage() ?><?php else: ?><?php echo $coupe->getPiece() ?><?php endif; ?>
<?php endif; ?>