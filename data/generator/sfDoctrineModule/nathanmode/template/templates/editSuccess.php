[?php use_helper('I18N', 'Date') ?]
[?php include_partial('<?php echo $this->getModuleName() ?>/assets') ?]

  [?php echo form_tag_for($form, '@<?php echo $this->params['route_prefix'] ?>') ?]
  <div class="productName">
    <span>[?php echo <?php echo $this->getI18NString('edit.title') ?> ?]</span>
    [?php include_partial('<?php echo $this->getModuleName() ?>/form_actions', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?]
  </div>

  [?php include_partial('<?php echo $this->getModuleName() ?>/flashes') ?]


  <div class="colLeft">
    [?php include_partial('<?php echo $this->getModuleName() ?>/form', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?]
  </div>
  
  </form>
