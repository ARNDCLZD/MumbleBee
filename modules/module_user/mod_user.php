<?php
include 'cont_user.php';

class ModUser
{
  private $user;
  function __construct() {
    $this->user = new ContUser();
  }
}
?>