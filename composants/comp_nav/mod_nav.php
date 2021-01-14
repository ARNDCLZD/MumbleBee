<?php
include 'cont_nav.php';

class ModNav {
  private $controleur;
  function __construct() {
    $this->controleur = new ContMenu();
  }

  public function affiche() {
  	$this->controleur->affiche();
  }
}
?>

