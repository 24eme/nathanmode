<?php if ($actions = $this->configuration->getValue('list.actions')): ?>
<span class="action-buttons">
<?php foreach ($actions as $name => $params): ?>
  <?php if ('_new' == $name): ?>
  <?php echo $this->addCredentialCondition('[?php echo $helper->linkToNew('.$this->asPhp($params).') ?]', $params)."\n" ?>
  <?php else: ?>
    <?php echo $this->addCredentialCondition($this->getLinkToAction($name, $params, false), $params)."\n" ?>
  <?php endif; ?>
<?php endforeach; ?>
</span>

<?php endif; ?>
