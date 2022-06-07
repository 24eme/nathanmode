<?php if($coupe->situation != 'SOLDEE'): ?>
<input class="submit_ajax_on_change input-discreet" form="form_coupe_<?php echo $coupe->getId() ?>" name="coupe_ligne[prix]" data-partialview="<?php echo url_for('coupe_ligne_view', array('id' => $coupe->getId(), 'partial' => 'prix')) ?>" style="opacity: 1;" type="text" value="<?php echo $coupe->getPrix(); ?>" />
<?php else: ?>
    <?php echo $coupe->getPrix(); ?>
<?php endif; ?>