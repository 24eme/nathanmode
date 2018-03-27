<?php

class WidgetFormInputDisabled extends sfWidgetFormInput
{
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    return $this->renderTag('input', array_merge(array('style' => 'display:none;', 'type' => $this->getOption('type'), 'name' => $name, 'value' => $value), $attributes));
  }
}
