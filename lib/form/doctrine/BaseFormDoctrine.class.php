<?php

/**
 * Project form base class.
 *
 * @package    nathanmode
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormBaseTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class BaseFormDoctrine extends sfFormDoctrine
{
    protected $bindableRelations = array();
    protected $formTemplate = null;

    public function setup()
    {
    }
  
    public function embedRelation($relationName, $formClass = null, $formArgs = array(), $innerDecorator = null, $decorator = null)
    {
        parent::embedRelation($relationName, $formClass, $formArgs, $innerDecorator);
        if (false !== $pos = stripos($relationName, ' as '))
        {
            $fieldName = substr($relationName, $pos + 4);
            $relationName = substr($relationName, 0, $pos);
        }
        else
        {
            $fieldName = $relationName;
        }

        $relation = $this->getObject()->getTable()->getRelation($relationName);

        if($relation->getType() != Doctrine_Relation::ONE) {
            $this->bindableRelations[$fieldName] = array('name' => $relationName, 'object'  => $relation);
        }
    }

    public function bind(array $taintedValues = null, array $taintedFiles = null)
    {
        foreach($this->bindableRelations as $key => $relation) {
        	$values = array();
            if (isset($taintedValues[$key])) {
                $values = $taintedValues[$key];
            }
            $this->bindRelationForm($key, $relation, $values);
        }
        parent::bind($taintedValues, $taintedFiles);
    }

    public function bindRelationForm($name, $relation, $values) {
        $relation_name = $relation['name'];
        $relation_object = $relation['object'];
        $relation_object_class = $relation_object->getClass();

        $changed = false;

        foreach ($this->embeddedForms[$name]->getEmbeddedForms() as $key => $form)
        {
            if(!array_key_exists($key, $values)){
                $this->getObject()->$relation_name->remove($key);
                $changed = true;
            }
        }
        
        foreach($values as $key => $item_values) {
            if(array_key_exists($key, $this->embeddedForms[$name]->getEmbeddedForms())) {                
                continue;
            }

            $this->getObject()->$relation_name->add(new $relation_object_class(), $key);
            $changed = true;
        }

        if ($changed) {
            $this->embedRelation($relation_name.' as '.$name);
        }
    }

    public function getTemplate($name) {
        $this->createFormTemplate();

        return $this->formTemplate[$name]['var---nbItem---'];
    }

    protected function createFormTemplate() {
        if (!is_null($this->formTemplate)) {

            return ;
        }

        $model_name = $this->getModelName();
        $form_class = get_class($this);
        $object = clone $this->getObject();
        foreach($this->bindableRelations as $key => $relation) {
            $relation_name = $relation['name'];
            $relation_object = $relation['object'];
            $relation_object_class = $relation_object->getClass();
            $object->$relation_name->add(new $relation_object_class(), 'var---nbItem---');
        }

        $this->formTemplate = new $form_class($object);
    }
}
