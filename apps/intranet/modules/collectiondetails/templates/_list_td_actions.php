<td>
  <ul class="sf_admin_td_actions">
    <?php echo $helper->linkToEdit($collection_detail->getCollection(), array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
    <?php echo $helper->linkToDelete($collection_detail->getCollection(), array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
  </ul>
</td>
