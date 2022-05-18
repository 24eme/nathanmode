<?php

/**
 * Collection
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    nathanmode
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Collection extends BaseCollection
{
    public function getPath($name, $absolute = false) {
        if($this->$name) {

            return CollectionTable::getInstance()->getUploadPath($absolute).$this->$name;
        }
    }

    public function isInRetardDespiteTimeExtension($date) {
      $retard = null;
      foreach ($this->getCollectionRetards() as $collectionRetard) {
        if (!$retard||$collectionRetard->getDate() > $retard) {
          $retard = $collectionRetard->getDate();
        }
      }
      return ($retard)? ($date >= $retard) : false;
    }

    public function getMetrageRestantALivrer() {
      return $this->getRestantALivrer('metrage');
    }

    public function getPFRestantALivrer() {
      return $this->getRestantALivrer('piece');
    }

    private function getRestantALivrer($attr) {
      $quantiteEntree = 0;
      $quantiteSortie = 0;
      foreach ($this->getCollectionDetails() as $collectionDetail) {
          $val = $collectionDetail->get($attr);
          if (!is_numeric($val)) continue;
          $quantiteEntree += $val;
      }
      foreach ($this->getCollectionLivraisons() as $collectionLivraison) {
          $val = $collectionLivraison->get($attr);
          if (!is_numeric($val)) continue;
          $quantiteSortie += $val;
      }
      return $quantiteEntree - $quantiteSortie;
    }


    public function delete(Doctrine_Connection $conn = null)
    {

    	foreach ($this->getCollectionLivraisons() as $collectionLivraison) {
    		if ($facture = $collectionLivraison->getFacture())
    			$facture->delete();
    	}
    	foreach ($this->getCollectionDetails() as $collectionDetail) {
    		if ($commande = $collectionDetail->getCommande())
    			$commande->delete();
    	}
    	
        parent::delete($conn);

        $this->removeFile('fichier');
        $this->removeFile('fiche_client');
        $this->removeFile('fiche_technique');
        $this->removeFile('fichier_confirmation');
    }

    protected function removeFile($name) {
        if (!$this->$name) {

            return;
        }

        $path = $this->getPath($name, true);

        if(is_file($path)) {
            unlink($path);
        }
    }
    public function save(Doctrine_Connection $conn = null)
    {
	$dateRetardMax = null;
    	foreach ($this->getCollectionRetards() as $collectionRetard) {
    		if ($date = $collectionRetard->getDate()) {
			if (!$dateRetardMax) {
				$dateRetardMax = $date;
			}
			else {
				if ($date > $dateRetardMax) {
					$dateRetardMax = $date;
				}
			}
    		}
    	}
	$this->date_retard = $dateRetardMax;
        parent::save($conn);
        $montantFacture = 0;
        $montantCommande = 0;
        $deviseId = null;
        $hasFacture = false;
    	foreach ($this->getCollectionLivraisons() as $collectionLivraison) {
    		if ($facture = $collectionLivraison->getFacture()) {
          $hasFacture = true;
          $montantFacture += $facture->getMontant();
          $deviseId = $facture->getDeviseMontantId();
	    		if ($this->getProduction() && $facture->getRelation() != Facture::TYPE_PRODUCTION) {
	    			$facture->setRelation(Facture::TYPE_PRODUCTION);
	    			$facture->save();
	    		} elseif (!$this->getProduction() && $facture->getRelation() != Facture::TYPE_COLLECTION) {
	    			$facture->setRelation(Facture::TYPE_COLLECTION);
	    			$facture->save();
	    		}
    		}
    	}
    	foreach ($this->getCollectionDetails() as $collectionDetail) {
    		if ($commande = $collectionDetail->getCommande()) {
          $montantCommande += $commande->getMontant();
          if (!$deviseId) {
            $deviseId = $commande->getDeviseMontantId();
          }
    			if ($this->getProduction() && $commande->getRelation() != Commande::TYPE_PRODUCTION) {
    				$commande->setRelation(Commande::TYPE_PRODUCTION);
    				$commande->setSituation($this->getSituation());
    				$commande->save();
    			} elseif (!$this->getProduction() && $commande->getRelation() != Commande::TYPE_COLLECTION) {
    				$commande->setRelation(Commande::TYPE_COLLECTION);
    				$commande->setSituation($this->getSituation());
    				$commande->save();
    			}
    		}
    	}
      if ($hasFacture && (($this->getMetrageRestantALivrer() + $this->getPFRestantALivrer())  > 0 || round($montantCommande - $montantFacture,2) > 0)) {
      	$creditCommande = $this->updateCreditCommande(round($montantCommande - $montantFacture,2), $deviseId);
       	$creditCommande->save();
      } elseif (count($this->getCreditCommandes()) > 0) {
        $cc = $this->getCreditCommandes()[0];
        $cc->delete();
      }
    }

    public function updateCreditCommande($montant, $deviseId)
    {
    	$creditCommande = (count($this->getCreditCommandes()) > 0)? $this->getCreditCommandes()[0] : new CreditCommande();
      $creditCommande->type = Bon::TYPE_CREDIT_COMMANDE;
    	if ($creditCommande->isNew()) {
        $creditCommande->setActif(true);
        $creditCommande->setCollectionId($this->getId());
        $creditCommande->setCollection($this);
    	}
    	$creditCommande->setSaisonId($this->getSaisonId());
      $creditCommande->setFournisseurId($this->getFournisseurId());
      $creditCommande->setCommercialId($this->getCommercialId());
      $creditCommande->setClientId($this->getClientId());
      $creditCommande->setDeviseMontantId($deviseId);
      $creditCommande->setDeviseFournisseurId($this->getDeviseFournisseurId());
      $creditCommande->setDeviseCommercialId($this->getDeviseCommercialId());
      if ($this->getPrixFournisseur() != "" || $this->getDeviseFournisseurId() != Devise::POURCENTAGE_ID)
      	$creditCommande->setPrixFournisseur($this->getPrixFournisseur());
      else {
      	$creditCommande->setPrixFournisseur($this->getFournisseur()->getCommission());
      	$creditCommande->setDeviseFournisseurId($this->getFournisseur()->getDeviseId());
      }
      if ($this->getPrixCommercial() != "" || $this->getDeviseCommercialId() != Devise::POURCENTAGE_ID)
      	$creditCommande->setPrixCommercial($this->getPrixCommercial());
      else {
      	$creditCommande->setPrixCommercial($this->getCommercial()->getCommission());
      	$creditCommande->setDeviseCommercialId($this->getCommercial()->getDeviseId());
      }
      $creditCommande->setNumero('Commande : '.$this->getNumCommande());
      $creditCommande->setDate($this->getDateCommande());
      $creditCommande->setStatut(StatutsFacture::KEY_NON_PAYEE);
      $creditCommande->setMetrage($this->getMetrageRestantALivrer());
      $creditCommande->setPiece($this->getPFRestantALivrer());
      if ($montant >= 0) {
        $creditCommande->setMontantTotal($montant);
      } else {
        $creditCommande->setMontantTotal(0);
      }
      $creditCommande->setQualite($this->getQualite());
      if ($this->getProduction())
      	$creditCommande->setRelation(Facture::TYPE_PRODUCTION);
      else
      	$creditCommande->setRelation(Facture::TYPE_COLLECTION);

      if ($this->getDeviseFournisseur() && $this->getDeviseFournisseur()->getSymbole() == Devise::POURCENTAGE) {
      	try {
      			$creditCommande->setTotalFournisseur($montant * $creditCommande->getPrixFournisseur() / 100);
      	} catch (Exception $e) {
      		$creditCommande->setTotalFournisseur(0);
      	}
      }

      if ($this->getDeviseCommercial() && $this->getDeviseCommercial()->getSymbole() == Devise::POURCENTAGE) {
      	try {
      			$creditCommande->setTotalCommercial($montant * $creditCommande->getPrixCommercial() / 100);
      	} catch (Exception $e) {
      		$creditCommande->setTotalCommercial(0);
      	}
      }

      return $creditCommande;
    }
}
