<?php
include 'cont_commentaire.php';

class ModCommentaire
{
  private $commentaire;
  function __construct() {
    $this->commentaire = new ContCommentaire();
  }
}
?>
