<?php if ($coupe->getNumFacture()): ?>
<?php echo $coupe->getNumFacture() ?>
<?php else: ?>
<input class="submit_ajax_on_change input-discreet" form="form_coupe_<?php echo $coupe->getId() ?>" name="coupe_ligne[num_facture]" data-partialview="<?php echo url_for('coupe_ligne_view', array('id' => $coupe->getId(), 'partial' => 'num_facture')) ?>" style="opacity: 0.3;" type="text" />
<?php endif; ?>