<?php
include_once 'cont_publication.php';

class ModPublication
{
  private $publication;
  function __construct() {
    $this->publication = new ContPublication();
  }
}
?>
