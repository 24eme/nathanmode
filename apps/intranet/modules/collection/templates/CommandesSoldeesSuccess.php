<?php use_helper('I18N', 'Date') ?>


  <div class="productName">
    <span><?php echo __('Liste des commandes de collection', array(), 'messages') ?></span>
    <div class="actions">
    	<?php echo link_to(__('Retour', array(), 'messages'), 'collection/index', array()) ?>
    	<?php echo link_to(__('CSV', array(), 'messages'), 'collection/ListCsvSoldees', array()) ?>
    </div>
  </div>
  <?php include_partial('collection/flashes') ?>
	
		    <?php include_partial('collection/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper, 'form' => $filters, 'configuration' => $configuration)) ?>
	    <ul class="sf_admin_actions">
	      <?php include_partial('collection/list_batch_actions', array('helper' => $helper)) ?>
	    </ul>
		
	  <div id="sf_admin_footer">
	    <?php include_partial('collection/list_footer', array('pager' => $pager)) ?>
	  </div>

