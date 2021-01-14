<?php
include_once 'modele_publication.php';
include_once 'vue_publication.php';

class ContPublication {
  private $vue;
  private $mod;
  public function __construct(){
      $this->vue = new VuePublication();
      $this->mod = new ModelePublication();

      if (isset($_GET['action'])) {
          $action = $_GET['action'];
      } else {
          $action = 'rechercher';
      }
        $this->trie($action);

  }
  function trie($action) {
    switch ($action) {
        case "ajouter":
          $this->ajoutPublicationform();
          break;
        case "ajout":
          $this->ajoutPublication();
          break;
        case "rechercher":
          $this->recherchePublicationform();
          break;
        case "recherche":
          $this->recherchePublication();
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
  public function recherchePublicationform(){
    $this->vue->recherchePublication_form();
  }
  public function recherchePublication(){
    $var = $this->mod->recherchePublication();
    foreach ($var as &$value) {
      $this->vue->affiche_publication($value);
    }
    
  }
  public function ajoutPublicationform(){
    $this->vue->publication_form();
  }
  public function ajoutPublication(){
    $this->mod->ajoutPublication();
  }

}
?>