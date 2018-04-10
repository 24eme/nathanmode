<?php

/**
 * CollectionTirelle form.
 *
 * @package    nathanmode
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CollectionTirelleForm extends BaseCollectionTirelleForm
{
    public function configure()
    {
        $this->useFields(array('date_expedition',
                               'colori',
                               'metrage',
                               'bain',
                               'date_validation',
                               'date_refusation',
                               'date_retraitement'));

        $this->setWidget('date_expedition', new sfWidgetFormInputText());
        $this->setValidator('date_expedition', new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~', 'required' => false)));

        $this->setWidget('date_validation', new sfWidgetFormInputText());
        $this->setValidator('date_validation', new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~', 'required' => false)));
        
        $this->setWidget('date_refusation', new sfWidgetFormInputText());
        $this->setValidator('date_refusation', new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~', 'required' => false)));
        
        $this->setWidget('date_retraitement', new sfWidgetFormInputText());
        $this->setValidator('date_retraitement', new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~', 'required' => false)));

        $this->getWidgetSchema()->setLabels(array(
           'date_expedition' => 'Date exp.',
           'colori' => 'Colori',
           'metrage' => 'Métrage',
           'bain' => 'Bain',
           'date_validation' => 'Validé',
           'date_refusation' => 'Réfusé',
           'date_retraitement' => 'Retraitement',
        ));
    }

    public function updateDefaultsFromObject() {
      parent::updateDefaultsFromObject();

      if ($this->getObject()->date_expedition) {
        $this->defaults['date_expedition'] = $this->getObject()->getDateTimeObject('date_expedition')->format('d/m/Y');
      }

      if ($this->getObject()->date_validation) {
        $this->defaults['date_validation'] = $this->getObject()->getDateTimeObject('date_validation')->format('d/m/Y');
      }

      if ($this->getObject()->date_refusation) {
        $this->defaults['date_refusation'] = $this->getObject()->getDateTimeObject('date_refusation')->format('d/m/Y');
      }

      if ($this->getObject()->date_retraitement) {
        $this->defaults['date_retraitement'] = $this->getObject()->getDateTimeObject('date_retraitement')->format('d/m/Y');
      }
    }
}
