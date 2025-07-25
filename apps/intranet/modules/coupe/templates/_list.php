<div class="sf_admin_list">
  	<form action="<?php echo url_for('coupe_collection', array('action' => 'filter')) ?>" method="post">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableNm">
      <thead>
        <tr>
          <?php include_partial('coupe/list_th_tabular', array('sort' => $sort)) ?>
          <th id="sf_admin_list_th_actions"><?php echo __('Actions', array(), 'sf_admin') ?></th>
        </tr>
    	<?php if ($configuration->hasFilterForm()): ?>
        <tr class="first">
        <?php foreach ($configuration->getFormFilterFields($form) as $name => $field): ?>
        <?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?>
          <?php include_partial('coupe/filters_field', array(
            'name'       => $name,
            'attributes' => $field->getConfig('attributes', array()),
            'label'      => $field->getConfig('label'),
            'help'       => $field->getConfig('help'),
            'form'       => $form,
            'field'      => $field,
            'class'      => 'sf_admin_form_row sf_admin_'.strtolower($field->getType()).' sf_admin_filter_field_'.$name,
          )) ?>
        <?php endforeach; ?>
        <td>
            <?php echo $form->renderHiddenFields() ?>
            <?php echo link_to(__('Reset', array(), 'sf_admin'), 'coupe_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post')) ?>
            <input type="submit" value="<?php echo __('Filter', array(), 'sf_admin') ?>" />
          </td>
        </tr>
        <?php endif; ?>
      </thead>
      <tfoot>
        <tr>
          <th colspan="16">
            <?php if ($pager->haveToPaginate()): ?>
              <?php include_partial('coupe/pagination', array('pager' => $pager)) ?>
            <?php endif; ?>

            <?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults(), 'sf_admin') ?>
            <?php if ($pager->haveToPaginate()): ?>
              <?php echo __('(page %%page%%/%%nb_pages%%)', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage()), 'sf_admin') ?>
            <?php endif; ?>
          </th>
        </tr>
      </tfoot>
  <?php if ($pager->getNbResults()): ?>
      <tbody>
        <?php $j = 0; foreach ($pager->getResults() as $i => $coupe): $j++; ?>
          <tr class="sf_admin_row coupe_statut_<?php echo strtolower($coupe->getSituation()) ?> <?php echo ($j == $pager->getNbResults())? 'last' : null; ?>">
            <?php include_partial('coupe/list_td_tabular', array('coupe' => $coupe)) ?>
            <?php include_partial('coupe/list_td_actions', array('coupe' => $coupe, 'helper' => $helper)) ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
  <?php endif; ?>
    </table>
    </form>
</div>
<script type="text/javascript">
/* <![CDATA[ */
function checkAll()
{
  var boxes = document.getElementsByTagName('input'); for(var index = 0; index < boxes.length; index++) { box = boxes[index]; if (box.type == 'checkbox' && box.className == 'sf_admin_batch_checkbox') box.checked = document.getElementById('sf_admin_list_batch_checkbox').checked } return true;
}
/* ]]> */
</script>
