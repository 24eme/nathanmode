<?php use_helper('I18N', 'Date') ?>


  <div class="productName">
    <span><?php echo __('Commandes Soldées', array(), 'messages') ?></span>
    <div class="actions action-buttons">
    	<?php echo link_to(__('Retour', array(), 'messages'), 'productiondetails/index', array()) ?>
    	<?php echo link_to(__('CSV', array(), 'messages'), 'productiondetails/ListCsvSoldees', array()) ?>
    </div>
  </div>
  <?php include_partial('productiondetails/flashes') ?>


  <div class="sf_admin_list  ">
      <form action="<?php echo url_for('collection_detail_collection', array('action' => 'filter')) ?>" method="post">
      <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableNm">
        <thead>
          <tr>
            <?php include_partial('productiondetails/list_th_tabular', array('sort' => $sort)) ?>
            <th id="sf_admin_list_th_actions"><?php echo __('Actions', array(), 'sf_admin') ?></th>
          </tr>
        <?php if ($configuration->hasFilterForm()): ?>
          <tr class="first">
          <?php foreach ($configuration->getFormFilterFields($filters) as $name => $field): ?>
          <?php if ((isset($filters[$name]) && $filters[$name]->isHidden()) || (!isset($filters[$name]) && $field->isReal())) continue ?>
            <?php include_partial('productiondetails/filters_field', array(
              'name'       => $name,
              'attributes' => $field->getConfig('attributes', array()),
              'label'      => $field->getConfig('label'),
              'help'       => $field->getConfig('help'),
              'form'       => $filters,
              'field'      => $field,
              'class'      => 'sf_admin_form_row sf_admin_'.strtolower($field->getType()).' sf_admin_filter_field_'.$name,
            )) ?>
          <?php endforeach; ?>
          <td>
              <?php echo $filters->renderHiddenFields() ?>
              <?php echo link_to(__('Reset', array(), 'sf_admin'), 'collection_detail_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post')) ?>
              <input type="submit" value="<?php echo __('Filter', array(), 'sf_admin') ?>" />
            </td>
          </tr>
          <?php endif; ?>
        </thead>
        <tfoot>
          <tr>
            <th colspan="19">
              <?php if ($pager->haveToPaginate()): ?>
                <div class="sf_admin_pagination">
                  <a href="<?php echo url_for('productiondetails/CommandesSoldees') ?>?page=1">
                    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/first.png', array('alt' => __('First page', array(), 'sf_admin'), 'title' => __('First page', array(), 'sf_admin'))) ?>
                  </a>

                  <a href="<?php echo url_for('productiondetails/CommandesSoldees') ?>?page=<?php echo $pager->getPreviousPage() ?>">
                    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/previous.png', array('alt' => __('Previous page', array(), 'sf_admin'), 'title' => __('Previous page', array(), 'sf_admin'))) ?>
                  </a>

                  <?php foreach ($pager->getLinks() as $page): ?>
                    <?php if ($page == $pager->getPage()): ?>
                      <?php echo $page ?>
                    <?php else: ?>
                      <a href="<?php echo url_for('productiondetails/CommandesSoldees') ?>?page=<?php echo $page ?>"><?php echo $page ?></a>
                    <?php endif; ?>
                  <?php endforeach; ?>

                  <a href="<?php echo url_for('productiondetails/CommandesSoldees') ?>?page=<?php echo $pager->getNextPage() ?>">
                    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/next.png', array('alt' => __('Next page', array(), 'sf_admin'), 'title' => __('Next page', array(), 'sf_admin'))) ?>
                  </a>

                  <a href="<?php echo url_for('productiondetails/CommandesSoldees') ?>?page=<?php echo $pager->getLastPage() ?>">
                    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/last.png', array('alt' => __('Last page', array(), 'sf_admin'), 'title' => __('Last page', array(), 'sf_admin'))) ?>
                  </a>
                </div>
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
          <?php $j = 0; foreach ($pager->getResults() as $i => $collection_detail): $j++; $odd = fmod(++$i, 2) ? 'odd' : 'even' ?>
            <tr class="sf_admin_row <?php echo $odd ?> <?php echo ($j == $pager->getNbResults())? 'last' : null; ?>">
              <?php include_partial('productiondetails/list_td_tabular', array('collection_detail' => $collection_detail)) ?>
              <?php include_partial('productiondetails/list_td_actions', array('collection_detail' => $collection_detail, 'helper' => $helper)) ?>
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


	    <ul class="sf_admin_actions">
	      <?php include_partial('productiondetails/list_batch_actions', array('helper' => $helper)) ?>
	    </ul>

	  <div id="sf_admin_footer">
	    <?php include_partial('productiondetails/list_footer', array('pager' => $pager)) ?>
	  </div>
