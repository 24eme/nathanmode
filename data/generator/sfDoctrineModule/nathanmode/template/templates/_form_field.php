[?php if ($field->isPartial()): ?]
  [?php include_partial('<?php echo $this->getModuleName() ?>/'.$name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?]
[?php elseif ($field->isComponent()): ?]
  [?php include_component('<?php echo $this->getModuleName() ?>', $name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?]
[?php else: ?]
<tr>
  <td width="20%">[?php echo $form[$name]->renderLabel($label) ?]</td>
  <td>[?php echo $form[$name]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes) ?]<br />[?php echo $form[$name]->renderError() ?]</td>

      [?php if ($help): ?]
        <td class="help">[?php echo __($help, array(), '<?php echo $this->getI18nCatalogue() ?>') ?]</td>
      [?php elseif ($help = $form[$name]->renderHelp()): ?]
        <td class="help">[?php echo $help ?]</td>
      [?php endif; ?]
</tr>
[?php endif; ?]
