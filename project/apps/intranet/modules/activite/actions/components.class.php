<?php
class activiteComponents extends sfComponents {
	
	public function executeClientModal() {
		$this->clients = ClientTable::getInstance()->findFavorites();
	}
	public function executeFournisseurModal() {
		$this->fournisseurs = FournisseurTable::getInstance()->findFavorites();
	}
}