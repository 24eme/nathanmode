<?php if ($coupe->getFichierConfirmation()): ?>
<a style="color: #000;" href="/uploads/coupe/<?php echo $coupe->getFichierConfirmation() ?>" target="_blank">PDF</a>
<?php else: ?>
<input class="submit_ajax_on_change input-discreet" form="form_coupe_<?php echo $coupe->getId() ?>" name="coupe_ligne[fichier_confirmation]" data-partialview="<?php echo url_for('coupe_ligne_view', array('id' => $coupe->getId(), 'partial' => 'fichier_confirmation')) ?>" type="file" style="width: 120px; opacity: 0.4;" />
<?php endif; ?>
