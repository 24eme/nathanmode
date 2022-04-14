<?php use_helper('I18N', 'Date') ?>
<?php include_partial('facure/assets') ?>


  <div class="productName">
    <span>Liste des factures</span>
    <div class="actions">
    	<?php include_partial('facure/list_actions', array('helper' => $helper)) ?>
    </div>
  </div>
  <?php include_partial('facure/flashes') ?>

  <?php if ($configuration->hasFilterForm()) { include_partial('facure/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper, 'form' => $filters, 'configuration' => $configuration)); } else { include_partial('facure/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper, 'configuration' => $configuration)); } ?>


<div id="sf_admin_footer">
  <?php include_partial('facure/list_footer', array('pager' => $pager)) ?>
</div>
