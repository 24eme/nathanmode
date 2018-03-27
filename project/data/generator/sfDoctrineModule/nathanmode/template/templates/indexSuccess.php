[?php use_helper('I18N', 'Date') ?]
[?php include_partial('<?php echo $this->getModuleName() ?>/assets') ?]


  <div class="productName">
    <span>[?php echo <?php echo $this->getI18NString('list.title') ?> ?]</span>
    <div class="actions">
    	[?php include_partial('<?php echo $this->getModuleName() ?>/list_actions', array('helper' => $helper)) ?]
    </div>
  </div>
  [?php include_partial('<?php echo $this->getModuleName() ?>/flashes') ?]
	
	<?php if ($this->configuration->getValue('list.batch_actions')): ?>
	    <form action="[?php echo url_for('<?php echo $this->getUrlForAction('collection') ?>', array('action' => 'batch')) ?]" method="post">
	<?php endif; ?>
	    [?php if ($configuration->hasFilterForm()) { include_partial('<?php echo $this->getModuleName() ?>/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper, 'form' => $filters, 'configuration' => $configuration)); } else { include_partial('<?php echo $this->getModuleName() ?>/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper, 'configuration' => $configuration)); } ?]
	    <ul class="sf_admin_actions">
	      [?php include_partial('<?php echo $this->getModuleName() ?>/list_batch_actions', array('helper' => $helper)) ?]
	    </ul>
	<?php if ($this->configuration->getValue('list.batch_actions')): ?>
	    </form>
	<?php endif; ?>
	
	  <div id="sf_admin_footer">
	    [?php include_partial('<?php echo $this->getModuleName() ?>/list_footer', array('pager' => $pager)) ?]
	  </div>

