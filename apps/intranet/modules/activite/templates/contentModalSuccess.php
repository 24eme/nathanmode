<?php use_helper('Date'); ?>
<div class="modal-header">
	<h5 class="modal-title text-dark" id="fournisseurModalTitle">
		<?php if (isset($client) && !empty($client)): ?>
		<strong><?php echo $client ?></strong> / 
		<?php endif; ?>
		<?php if (isset($fournisseur) && !empty($fournisseur)): ?>
		<strong><?php echo $fournisseur ?></strong> / 
		<?php endif; ?>
		<?php if (((isset($client) && !empty($client)) || (isset($fournisseur) && !empty($fournisseur))) && isset($parameters['from']) && !empty($parameters['from']) && isset($parameters['to']) && !empty($parameters['to'])): ?>
		du <strong><?php echo format_date($parameters['from'], 'dd/MM/yyyy') ?></strong> au <strong><?php echo format_date($parameters['to'], 'dd/MM/yyyy') ?></strong> / 
		<?php endif; ?>
		Sélectionner un <?php echo $type ?> <small>(<?php echo count($itemsAll) ?>)</small>
	</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    	<span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
	<?php if (count($items) > 0): ?>
	
			<form action="<?php echo url_for('activiteRapport', array_merge($parameters->getRawValue(), array('from' => $parameters['ofrom'], 'to' => $parameters['oto'])))?>" method="get">
			  	<?php foreach ($parameters as $k => $value): if ($k == strtolower($type)) continue; ?>
			  	<input type="hidden" name="<?php echo $k ?>" value="<?php echo $value ?>" />
			  	<?php endforeach;?>
				<div class="input-group mb-3">
				
				    
			    <select id="modal_filters_<?php echo strtolower($type) ?>_id" class="form-control" name="<?php echo strtolower($type) ?>">
			        <option value="" selected="selected"></option>
			        <?php foreach ($itemsAll as $itemAll): ?>
			        <option value="<?php echo $itemAll->getId() ?>" ><?php echo $itemAll ?></option>
			        <?php endforeach; ?>
			    </select>
				    
				  <div class="input-group-append">
				    <button type="submit" class="btn btn-info"><span class="oi oi-magnifying-glass"></span></button>
				  </div>
				</div>
			</form>
	
			<ul>
			<?php $i=0; foreach ($items as $item): if ($i<9) $i++; else $i=1; ?>
			<li><a href="<?php echo url_for('activiteRapport', array_merge($parameters->getRawValue(), array(strtolower($type) => $item->getId()), array('from' => $parameters['ofrom'], 'to' => $parameters['oto']))) ?>" class="btn btn-info">
			    <strong><?php echo $item ?></strong>
			</a></li>
      		<?php endforeach; ?>
			</ul>
			
		<?php else: ?>
		<p class="font-italic text-dark text-center">Aucun <?php echo $type ?> pour cette configuration</p>
		<?php endif; ?>
</div>