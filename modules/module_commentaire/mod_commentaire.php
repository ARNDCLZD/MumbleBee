<?php
include 'cont_commentaire.php';

class ModCommentaire
{
  private $publication;
  function __construct() {
    $this->commentaire = new ContCommentaire();
  }
}
?>
