<?php

/**
 * Devise
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    nathanmode
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Devise extends BaseDevise
{
	const POURCENTAGE = '%';
	const POURCENTAGE_ID = 3;
    public function __toString()
    {
        
        return $this->symbole;
    }
}
