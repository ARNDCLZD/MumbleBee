<?php
include_once 'cont_connexion.php';

class ModConnexion
{
  private $publication;
  function __construct() {
    $this->connexion = new ContConnexion();
  }
}
?>
