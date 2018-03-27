<?php

class ActiviteFormFilter extends BaseForm
{
  public function configure()
  {
  	$this->setWidget('from', new sfWidgetFormInput());
  	$this->setWidget('to', new sfWidgetFormInput());
  	
  	$this->setValidator('from', new sfValidatorRegex(array('required' => false, 'pattern' => '#[0-9]{2}\/[0-9]{2}\/[0-9]{4}#')));
  	$this->setValidator('to', new sfValidatorRegex(array('required' => false, 'pattern' => '#[0-9]{2}\/[0-9]{2}\/[0-9]{4}#')));

    
    $this->setDefault('from', '01/01/'.date('Y'));
    $this->setDefault('to', date('d/m/Y'));
    
    
  	$this->widgetSchema->setNameFormat('activite_filters[%s]');
  }
}
