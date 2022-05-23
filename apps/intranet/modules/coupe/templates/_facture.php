<?php if ($coupe->getFichier()): ?>
<a style="color: #000;" href="/uploads/factures/<?php echo $coupe->getFichier() ?>" target="_blank">PDF</a>
<?php else: ?>
<input class="submit_ajax_on_change" form="form_coupe_<?php echo $coupe->getId() ?>" name="coupe_ligne[fichier]" data-partialview="<?php echo url_for('coupe_ligne_view', array('id' => $coupe->getId(), 'partial' => 'facture')) ?>" type="file" style="width: 120px; opacity: 0.4;" />
<?php endif; ?>