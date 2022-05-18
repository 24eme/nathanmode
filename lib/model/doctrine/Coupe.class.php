<?php

/**
 * Coupe
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    nathanmode
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Coupe extends BaseCoupe
{

    public function getPath($name, $absolute = false) {
        if($this->$name) {
            
            return FactureTable::getInstance()->getUploadPath($absolute).$this->$name;
        }
    }

    public function delete(Doctrine_Connection $conn = null)
    {
    	if ($facture = $this->getFacture()) {
    		$facture->delete();
    	}
    	if ($commande = $this->getCommande()) {
    		$commande->delete();
    	}
        parent::delete($conn);
		
        $this->removeFile('fichier');
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

    public function getQualite() {

        return $this->tissu;
    }

    public function setQualite($qualite) {

        $this->tissu = $qualite;
    }

  public function save(Doctrine_Connection $conn = null)
  {
  	$facture = $this->updateFacture();
 	$facture->save();
 	$this->setFactureId($facture->getId());
 	$this->setFacture($facture);
 	$commande = $this->updateCommande();
 	$commande->save();
 	$this->setCommandeId($commande->getId());
 	$this->setCommande($commande);
    return parent::save($conn);
  }
  
  public function updateFacture()
  {
  	$facture = ($this->isNew())? new Facture() : $this->getFacture();
  	if ($this->isNew()) {
  		$facture->setActif(true);
  	}
  	$facture->setSaisonId($this->getSaisonId());
    $facture->setFournisseurId($this->getFournisseurId());
    $facture->setCommercialId($this->getCommercialId());
    $facture->setClientId($this->getClientId());
    $facture->setDeviseMontantId($this->getDeviseId());
    $facture->setDeviseFournisseurId($this->getFournisseurDeviseId());
    $facture->setDeviseCommercialId($this->getCommercialDeviseId());
    if ($this->getCommissionFournisseur() != "" || $this->getFournisseurDeviseId() != Devise::POURCENTAGE_ID)
    	$facture->setPrixFournisseur($this->getCommissionFournisseur());
    else {
    	$facture->setPrixFournisseur($this->getFournisseur()->getCommission());
    	$facture->setDeviseFournisseurId($this->getFournisseur()->getDeviseId());
    }
    if ($this->getCommissionCommercial() != "" || $this->getCommercialDeviseId() != Devise::POURCENTAGE_ID)
    	$facture->setPrixCommercial($this->getCommissionCommercial());
    else {
    	$facture->setPrixCommercial($this->getCommercial()->getCommission());
    	$facture->setDeviseCommercialId($this->getCommercial()->getDeviseId());
    }
    $facture->setNumero($this->getNumFacture());
    if ($this->getLivreLe()) {
    	$facture->setDate($this->getLivreLe());
    	$dt = $this->getDateTimeObject('livre_le');
    	$dt->modify('+'.Paiements::getNbJoursByStatut($this->getPaiement()).' day');
    	$facture->setEcheance($dt->format('Y-m-d'));
    	if (str_replace('-', '', $facture->getEcheance()) > date('Ymd') && $facture->getStatut() == StatutsFacture::KEY_NON_PAYEE) {
    		$facture->setStatut(StatutsFacture::KEY_NON_PAYEE);
    	}
    }
    $facture->setMontant($this->getMontantFacture());
    $facture->setMontantTotal($this->getMontantFacture());
    $facture->setMetrage($this->getMetrage());
    $facture->setPieceCategorie($this->getPieceCategorie());
    $facture->setPiece($this->getPiece());
    $facture->setQualite($this->getTissu());
    $facture->setFichier($this->getFichier());
    if ($this->isNew())
    	$facture->setStatut(StatutsFacture::KEY_NON_PAYEE);
    $facture->setRelation(Facture::TYPE_COUPE);
    
  
    
    if ($this->getDeviseFournisseur() == Devise::POURCENTAGE) {
    	try {
    		$facture->setTotalFournisseur($this->getMontantFacture() * $facture->getPrixFournisseur() / 100);
    	} catch (Exception $e) {
    		$facture->setTotalFournisseur(0);
    	}
    } else {
    	$facture->setTotalFournisseur($facture->getPrixFournisseur());
    }
    
    if ($this->getDeviseCommercial() == Devise::POURCENTAGE) {
    	try {
    		$facture->setTotalCommercial($this->getMontantFacture() * $facture->getPrixCommercial() / 100);
    	} catch (Exception $e) {
    		$facture->setTotalCommercial(0);
    	}
    } else {
    	$facture->setTotalCommercial($facture->getPrixCommercial());
    }
    return $facture;
  }
  
  public function updateCommande()
  {
  	$commande = ($this->isNew())? new Commande() : $this->getCommande();
  	$commande->setRelation(Commande::TYPE_COUPE);
  	$commande->setSaisonId($this->getSaisonId());
    $commande->setFournisseurId($this->getFournisseurId());
    $commande->setCommercialId($this->getCommercialId());
    $commande->setClientId($this->getClientId());
    $commande->setDeviseMontantId($this->getDeviseId());
    $commande->setDeviseFournisseurId($this->getFournisseurDeviseId());
    $commande->setDeviseCommercialId($this->getCommercialDeviseId());
    if ($this->getCommissionFournisseur())
    	$commande->setPrixFournisseur($this->getCommissionFournisseur());
    else
    	$commande->setPrixFournisseur($this->getFournisseur()->getCommission());
    if ($this->getCommissionCommercial())
    	$commande->setPrixCommercial($this->getCommissionCommercial());
    else
    	$commande->setPrixCommercial($this->getCommercial()->getCommission());
    $commande->setNumero(null);
    $commande->setDate($this->getLivreLe());
    $commande->setMontant($this->getMontantFacture());
    $commande->setMetrage($this->getMetrage());
    $commande->setPieceCategorie($this->getPieceCategorie());
    $commande->setPiece($this->getPiece());
    $commande->setQualite($this->getTissu());
    $commande->setColori($this->getColori());
    if ($this->getDeviseFournisseur() == Devise::POURCENTAGE) {
    	try {
    		$commande->setTotalFournisseur($this->getMontantFacture() * $commande->getPrixFournisseur() / 100);
    	} catch (Exception $e) {
    		$commande->setTotalFournisseur(0);
    	}
    } else {
    	$commande->setTotalFournisseur($commande->getPrixFournisseur());
    }
    if ($this->getDeviseCommercial() == Devise::POURCENTAGE) {
    	try {
    		$commande->setTotalCommercial($this->getMontantFacture() * $commande->getPrixCommercial() / 100);
    	} catch (Exception $e) {
    		$commande->setTotalCommercial(0);
    	}
    } else {
    	$commande->setTotalCommercial($commande->getPrixCommercial());
    }
    return $commande;
  }

}
