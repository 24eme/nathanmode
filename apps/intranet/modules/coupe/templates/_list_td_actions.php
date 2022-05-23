<td>
  <form id="form_coupe_<?php echo $coupe->getId() ?>" method="post" action="<?php echo url_for('coupe_ligne_update', array('id' => $coupe->getId())) ?>" enctype="multipart/form-data"></form>
  <ul class="sf_admin_td_actions">
    <?php echo $helper->linkToEdit($coupe, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
    <?php echo $helper->linkToDelete($coupe, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
  </ul>
</td>
