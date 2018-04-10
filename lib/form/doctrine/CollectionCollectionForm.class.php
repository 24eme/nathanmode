<?php

class CollectionCollectionForm extends CollectionForm
{
    public function configure() {
        parent::configure();
        unset(
            $this['tm_date_expedition'],
            $this['tm_refus_test'],
            $this['tm_validation'],
            $this['tm_date_expedition_coteco'],
            $this['tm_metrage_coteco'],
            $this['tm_validation_coteco'],
            $this['tm_observation']
        );
    }
}