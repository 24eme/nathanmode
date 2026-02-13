<div class="actions action-buttons" style="flex: 1;display: flex; gap:20px;">
<div style="display:flex; gap:15px;">
  <?php echo $helper->linkToList(array('params' =>   array('obj' => $form->getObject()),  'class_suffix' => 'list',  'label' => 'Retour',)) ?>
  <?php echo $helper->linkToDeleteForm($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'delete',  'label' => ' ', 'confirm' => 'Confirmez-vous la suppression ?' )) ?>
</div>
<div class="vr"></div>
  <?php echo $helper->linkToSave($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save',  'label' => 'Valider')) ?>
</div>
