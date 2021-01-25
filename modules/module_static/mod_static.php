<?php
include 'cont_static.php';

class ModStatic
{
  private $static;
  function __construct() {
    $this->static = new ContStatic();
  }
}
?>