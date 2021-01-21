<?php
include 'cont_hashtag.php';

class ModHashtag
{
  private $publication;
  function __construct() {
    $this->hashtag = new ContHashtag();
  }
}
?>
