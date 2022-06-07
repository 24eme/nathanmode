<?php use_helper('I18N', 'Date') ?>
<?php include_partial('coupe/assets') ?>

  <?php echo form_tag_for($form, '@coupe') ?>
  <div class="productName">
    <span><?php echo __('Modification de la coupe %%tissu%% %%colori%% %%metrage%%', array('%%tissu%%' => $coupe->getTissu(), '%%colori%%' => $coupe->getColori(), '%%metrage%%' => $coupe->getMetrage()), 'messages') ?></span>
    <?php include_partial('coupe/form_actions', array('coupe' => $coupe, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <?php include_partial('coupe/flashes') ?>
  
  
  <?php echo $form->renderHiddenFields(false) ?>
  
  <?php if ($form->hasGlobalErrors()): ?>
    <?php echo $form->renderGlobalErrors() ?>
  <?php endif; ?>

  <?php include_partial('coupe/form', array('coupe' => $coupe, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  
  </form>
