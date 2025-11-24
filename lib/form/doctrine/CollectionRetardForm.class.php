<?php

/**
 * CollectionRetard form.
 *
 * @package    nathanmode
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CollectionRetardForm extends BaseCollectionRetardForm
{
    public function configure()
    {
        $this->useFields(array('date',
                               'qualite',
                               'colori',
                               'observation'));

        $this->setWidget('date', new WidgetFormInputDate());
        $this->setValidator('date', new sfValidatorDate(array('required' => false)));
        $this->setWidget('observation', new sfWidgetFormTextarea());

        $this->getWidgetSchema()->setLabels(array(
          'date' => 'Date de retard',
          'observation' => 'Observation',
        ));
    }
}
