<ul>
<?php foreach ($prix_special->getPrixSpecialDetails() as $detail): ?>
	<li><?php echo $detail->getQuantite().'&nbsp;/&nbsp;'.$detail->getPrix().$detail->getDevise()->getSymbole() ?></li>
<?php endforeach;?>
</ul>