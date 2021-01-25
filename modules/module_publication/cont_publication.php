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
          $action = 'ajouter';
      }
        $this->trie($action);
  }
  function trie($action) {
    switch ($action) {
        case "ajouter":
          $this->ajoutPublication_form();
          break;
        case "ajout":
          $this->ajoutPublication();
          break;
        case "rechercher":
          $this->recherchePublication();
          break;
        case "afficher":
          $this->afficherPublication();
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

  public function recherchePublication(){
    $tab = $this->mod->recherchePublication();
    $this->vue->recherchePublication_form($tab);
  }
  public function ajoutPublication_form(){
    $this->vue->publication_form();
  }
  public function ajoutPublication(){
    $this->mod->ajoutPublication();
  }
  public function afficherPublication(){
    $publi = $this->mod->getPublicationId();
    $coms = $this->mod->getCommentaireById();
    $this->vue->affiche_publication($publi, $_GET['id']);
    foreach ($coms as $key => $val) {
      $this->vue->affiche_commentaire($val); 
    }
    $this->mod->ajoutCommentaire();
    $this->mod->liker();
    $this->mod->signalerPublication();
    $this->mod->signalerCommentaire();
    $this->mod->supprimerCommentaire();
    $this->mod->supprimerPublication();
    
  }

  public function supprimerPublication(){
    $this->mod->supprimerPublication();
    $this->vue->suppressionPublication_form();
  }

  public function supprimerCommentaire(){
    $this->mod->supprimerCommentaire();
    $this->vue->suppressionCommentaire();
  }
}
?>