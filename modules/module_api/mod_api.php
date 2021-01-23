<?php
include 'cont_api.php';

class ModApi
{
  private $api;
  function __construct() {
    $this->api = new ContApi();
  }
}
?>
