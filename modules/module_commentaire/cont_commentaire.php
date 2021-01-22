<?php
include_once 'modele_commentaire.php';
include_once 'vue_commentaire.php';

class ContCommentaire {
  private $vue;
  private $mod;
  public function __construct(){
      $this->vue = new VueCommentaire();
      $this->mod = new ModeleCommentaire();

      if (isset($_GET['action'])) {
          $action = $_GET['action'];
      } else {
          $action = 'ajouter';
      }
        $this->trie($action);

  }
  function trie($action) {
    switch ($action) {
        case "ajouter":
          $this->ajoutCommentaireform();
          break;
        case "ajout":
          $this->ajoutCommentaire();
          break;
        case "rechercher":
          $this->rechercheCommentaireform();
          break;
        case "recherche":
          $this->rechercheCommentaire();
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
  public function rechercheCommentaireform(){
    $this->vue->rechercheCommentaire_form();
  }
  public function rechercheCommentaire(){
    $var = $this->mod->rechercheCommentaire();
    foreach ($var as &$value) {
      $this->vue->affiche_commentaire($value);
    }
    
  }
  public function ajoutCommentaireform(){
    $this->vue->commentaire_form();
  }
  public function ajoutCommentaire(){
    $this->mod->ajoutCommentaire();
  }

}
?>