<div class="actions">
<?php if ($form->isNew()): ?>
  <?php echo $helper->linkToSave($form->getObject(), array(  'label' => 'Valider',  'params' =>   array(  ),  'class_suffix' => 'save',)) ?>
  <?php echo $helper->linkToList(array(  'params' =>   array(  ),  'class_suffix' => 'list',  'label' => 'Back to list',)) ?>
<?php else: ?>
  <?php echo $helper->linkToSave($form->getObject(), array(  'label' => 'Valider',  'params' =>   array(  ),  'class_suffix' => 'save',)) ?>
  <?php echo $helper->linkToDeleteForm($form->getObject(), array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
  <?php echo ($form->getObject()->getSituation() === Situations::SITUATION_SOLDEE)? link_to(__('Retour à la liste', array(), 'messages'), 'production/CommandesSoldees', array()) : $helper->linkToList(array(  'params' =>   array(  ),  'class_suffix' => 'list',  'label' => 'Back to list',)); ?>
<?php endif; ?>
</div>
