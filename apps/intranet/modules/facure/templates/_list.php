<div class="sf_admin_list">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableNm">
      <form action="<?php echo url_for('facture_collection', array('action' => 'filter')) ?>" method="post">
      <thead>
        <tr>
          <th id="sf_admin_list_batch_actions"><input id="sf_admin_list_batch_checkbox" type="checkbox" onclick="checkAll();" /></th>
          <?php include_partial('facure/list_th_tabular', array('sort' => $sort)) ?>
          <th id="sf_admin_list_th_actions"><?php echo __('Actions', array(), 'sf_admin') ?></th>
        </tr>
    	<?php if ($configuration->hasFilterForm()): ?>
        <tr class="first">
          <td>&nbsp;</td>
        <?php foreach ($configuration->getFormFilterFields($form) as $name => $field): ?>
        <?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?>
          <?php include_partial('facure/filters_field', array(
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
            <?php echo link_to(__('Reset', array(), 'sf_admin'), 'facture_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post')) ?>
            <input type="submit" value="<?php echo __('Filter', array(), 'sf_admin') ?>" />
          </td>
        </tr>
        <?php endif; ?>
      </thead>
      </form>
      <form id="sf_admin_batch_actions_form" action="<?php echo url_for('facture_collection', array('action' => 'batch')) ?>" method="post">
      <tfoot>
        <tr>
          <th colspan="3">
            <?php if ($listActions = $configuration->getValue('list.batch_actions')): ?>
            <select name="batch_action" id="sf_admin_batch_actions_choice">
              <?php foreach ((array) $listActions->getRawValue() as $action => $params): ?>
              <?php echo '<option value="'.$action.'">'.$params['label'].'</option>' ?>
              <?php endforeach; ?>
            </select>
            <?php $form = new BaseForm(); if ($form->isCSRFProtected()): ?>
              <input type="hidden" name="<?php echo $form->getCSRFFieldName() ?>" value="<?php echo $form->getCSRFToken() ?>" />
            <?php endif; ?>
            <input type="hidden" name="date" value="" id="sf_admin_batch_actions_date" />
            <input type="submit" value="<?php echo __('go', array(), 'sf_admin') ?>" />
          <?php endif; ?>
          </th>
          <th colspan="11">
            <?php if ($pager->haveToPaginate()): ?>
              <?php include_partial('facure/pagination', array('pager' => $pager)) ?>
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
        <?php $j = 0; foreach ($pager->getResults() as $i => $facture): $j++; $odd = fmod(++$i, 2) ? 'odd' : 'even' ?>
          <tr class="sf_admin_row <?php echo strtolower($facture->getStatut()) ?> <?php echo ($j == $pager->getNbResults())? 'last' : null; ?>">
            <?php include_partial('facure/list_td_batch_actions', array('facture' => $facture, 'helper' => $helper)) ?>
            <?php include_partial('facure/list_td_tabular', array('facture' => $facture)) ?>
            <?php include_partial('facure/list_td_actions', array('facture' => $facture, 'helper' => $helper)) ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
  <?php endif; ?>
    </form>
    </table>
</div>
<div class="modal fade" id="facturePayeeDateChoiceModal" tabindex="-1" role="dialog" aria-labelledby="facturePayeeDateChoiceModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	  <h5 class="modal-title text-dark" id="facturePayeeDateChoiceModalTitle">Définir la date de paiement</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          	<span aria-hidden="true">×</span>
          </button>
      </div>
      <div class="modal-body">
        <form id="sf_admin_batch_actions_complete_form" action="" method="post">
        <div class="input-group mb-3">
          <input type="date" class="form-control" name="date" required="required" />
          <div class="input-group-append">
            <span class="input-group-text oi oi-calendar"></span>
          </div>
        </div>
        <div class="col-6 mx-auto">
          <button type="submit" class="btn btn-block btn-success" type="button">Valider</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
/* <![CDATA[ */
function checkAll()
{
  var boxes = document.getElementsByTagName('input'); for(var index = 0; index < boxes.length; index++) { box = boxes[index]; if (box.type == 'checkbox' && box.className == 'sf_admin_batch_checkbox') box.checked = document.getElementById('sf_admin_list_batch_checkbox').checked } return true;
}
/* ]]> */
</script>
