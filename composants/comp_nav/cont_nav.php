<?php
include 'modele_nav.php';
include 'vue_nav.php';

class ContNav {
  private $vue;
  private $mod;
  public function __construct()
  {
      $this->vue = new VueMenu();
      $this->mod = new ModeleMenu();
      //$this->vue->menu();

      /*if (isset($_GET['action'])) {
          $action = $_GET['action'];
      } else {
          $action = 'bienvenue';
      }
        $this->trie($action);*/

  }
  public function affiche()
  {
      $this->vue->affiche();
  }
}
?>
