<?php
include_once 'modele_connexion.php';
include_once 'vue_connexion.php';

class ContConnexion {
  private $vue;
  private $mod;
  public function __construct(){
      $this->vue = new VueConnexion();
      $this->mod = new ModeleConnexion();

      $action = isset($_GET['action']) ? $_GET['action'] : 'connecter';
      $this->trie($action);

  }
  function trie($action) {
    switch ($action) {
        case "connecter":
          $this->connexionform();
          break;
        case "connexion":
          $this->connexion();
          break;
        case "deconnecter":
          $this->deconnexionform();
          break;
        case "deconnexion":
          $this->deconnexion();
          break;
        default:
          $this->error();
      }    
  }
  public function error(){
    echo "Page introuvable";
    http_response_code(404);
    die;
  }
  public function connexionform(){
    $this->vue->connexion_form();
  }
  public function connexion(){
    $this->mod->verifyConnexion();
  }
  public function deconnexionform(){
    $this->vue->deconnexion_form();
  }
  public function deconnexion(){
    $this->mod->deconnexion();
  }
}
?>