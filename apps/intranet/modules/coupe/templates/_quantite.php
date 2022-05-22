<?php if(!$coupe->getPieceCategorie()): ?>
    <?php echo $coupe->getMetrage() ?>
<?php else: ?>
    <?php echo $coupe->getPiece() ?>
<?php endif; ?>