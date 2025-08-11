<?php if ($collection_detail->getImage()) : ?>
<img height="50" src="<?php echo CollectionDetailTable::getInstance()->getUploadPath(false).$collection_detail->getImage() ?>" />
<?php endif ?>
