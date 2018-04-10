<div class="tableau">
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <div class="titre"><span>Infos générales</span></div>
	<div class="contentLeft">
  		<table width="100%" border="0" cellspacing="0" cellpadding="0">
  			<?php foreach($form as $widget): ?>
		        <?php if(!$widget instanceof sfFormFieldSchema && !$widget->isHidden()): ?>
		        	<tr>
		                <td width="20%"><?php echo $widget->renderLabel(); ?></td>
		                <td><?php echo $widget->render(); ?><br /><?php echo $widget->renderError(); ?></td>
               			 <td class="help"><?php echo $widget->renderHelp() ?></td>
		            </tr>
		        <?php endif; ?>
		    <?php endforeach; ?>
		    <tr>
		    	<td valign="top"><label for="details">&nbsp;</label></td>
		    	<td>
		    		<?php include_partial('relationDetailsForm', array('form' => $form)) ?>
		    	</td>
		    </tr>
  		</table>
	</div>
</div>
