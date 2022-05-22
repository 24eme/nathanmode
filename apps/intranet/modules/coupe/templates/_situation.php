<select style="<?php if (!$coupe->getSituation()): ?>opacity: 0.3;<?php endif; ?>">
    <option value=""> </option>
<?php foreach(CoupeForm::getSituations() as $key => $libelle): ?>
    <option <?php if($key == $coupe->situation): ?>selected="selected"<?php endif; ?> value="<?php echo $key ?>"><?php echo $libelle; ?></option>
<?php endforeach; ?>
</select>
