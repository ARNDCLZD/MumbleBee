<?php
include 'cont_connexion.php';

class ModConnexion
{
  private $publication;
  function __construct() {
    $this->connexion = new ContConnexion();
  }
}
?>
