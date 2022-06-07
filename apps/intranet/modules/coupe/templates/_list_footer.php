<?php foreach ($pager->getResults() as $coupe): ?>
    <form id="form_coupe_<?php echo $coupe->getId() ?>" method="POST" action="<?php echo url_for('coupe_ligne_update', array('id' => $coupe->getId())) ?>" enctype="multipart/form-data"></form>
<?php endforeach; ?>
    