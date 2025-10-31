<?php if ($collection_detail->getImage()) : ?>
	<?php
		$url = CollectionDetailTable::getInstance()->getUploadPath(false).$collection_detail->getImage();
		$width = 600;
		$height = 400 ;
	?>

	<a href="javascript: open_popup(<?php echo "'".$url."',".$height.",".$width; ?>)"><img height="50" style="display:block; margin:auto;" src="<?php echo CollectionDetailTable::getInstance()->getUploadPath(false).$collection_detail->getImage() ?>" /></a>

	<script type="text/javascript">

	function open_popup(url,height,width)
	{
		popup_top=((screen.height-height)/2);
		popup_left=((screen.width-width)/2);
		window.open(url,"image","top="+popup_top+", left="+popup_left+", height="+height+", width="+width);
	}
	</script>
<?php endif ?>
