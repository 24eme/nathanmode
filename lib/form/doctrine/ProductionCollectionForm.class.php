<?php

class ProductionCollectionForm extends CollectionForm
{
    public function configure() {
        parent::configure();
        unset(
            $this['fiche_client'],
            $this['fiche_technique'],
            $this['observation_client']
        );
    }

    public function doUpdateObject($values)
    {
        parent::doUpdateObject($values);
        $this->getObject()->production = true;
    }
}