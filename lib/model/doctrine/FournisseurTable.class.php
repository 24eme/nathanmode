<?php

/**
 * FournisseurTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class FournisseurTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object FournisseurTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Fournisseur');
    }

    public function findByParameters($parameters)
    {
		$ids = $this->getIdsByParameters($parameters);

        if(count($ids)) {
		    $query = Doctrine_Query::create()->from('Fournisseur f')->whereIn('f.id', $ids);
            $items = $query->execute();
            $itemsById = array();
            foreach($items as $item) {
                $itemsById[$item->id] = $item;
            }
            return array_replace(array_flip($ids), $itemsById);
        }

		return $this->findAll();
    }

    public function findFavorites($parameters)
    {
        $ids = $this->getIdsByParameters($parameters, 9);

        if(count($ids)) {
		    $query = Doctrine_Query::create()->from('Fournisseur f')->whereIn('f.id', $ids);
            $items = $query->execute();
            $itemsById = array();
            foreach($items as $item) {
                $itemsById[$item->id] = $item;
            }
            return array_replace(array_flip($ids), $itemsById);
        }

        $query = Doctrine_Query::create()->from('Fournisseur f')->whereIn('f.id', array(1,2,9,52,8,23,41,53,44));

        return $query->execute();
    }

    protected function getIdsByParameters($parameters, $limit = null) {
        $client = (isset($parameters['client']) && !empty($parameters['client']))? $parameters['client'] : null;
        $commercial = (isset($parameters['commercial']) && !empty($parameters['commercial']))? $parameters['commercial'] : null;
        $from = (isset($parameters['from']) && !empty($parameters['from']))? $parameters['from'] : null;
        $to = (isset($parameters['to']) && !empty($parameters['to']))? $parameters['to'] : null;
        $saison = (isset($parameters['saison']) && !empty($parameters['saison']))? $parameters['saison'] : null;

    	$where = "";
        if($client) {
            $where .= " AND b.client_id = ".$client;
        }
        if($commercial) {
            $where .= " AND b.commercial_id = ".$commercial;
        }

        if (!$where) {
            return array();
        }

        if ($from && $to) {
    		$where .= " AND b.date <= '".$to."' AND b.date >= '".$from."'";
    	}
		if ($saison) {
			$where .= " AND b.saison_id = ".$saison;
		}

    	$req = "SELECT fournisseur_id, sum(b.montant) as total FROM commande b WHERE b.montant >  0".$where." GROUP BY b.fournisseur_id HAVING total > 0 ORDER BY total DESC";
    	if ($limit) {
    		$req .= " LIMIT $limit";
    	}
    	$result = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($req);
    	$ids = array();
    	foreach ($result as $item) {
    		$ids[] = $item['fournisseur_id'];
    	}
    	return $ids;
    }
}