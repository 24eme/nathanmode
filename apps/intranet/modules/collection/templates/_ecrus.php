<ul>
<?php foreach ($collection->getCollectionDetails() as $detail): ?>
	<li><?php echo $detail->getColori() ?> - <?php echo ($detail->getMetrage())? $detail->getMetrage().' MTS' : $detail->getPiece().' PF'; ?> - <?php echo $detail->getPrix() ?>&nbsp;€</li>
<?php endforeach;?>
</ul>
