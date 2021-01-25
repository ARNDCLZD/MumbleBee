<?php
include_once 'modele_hashtag.php';
include_once 'vue_hashtag.php';

class ContHashtag {
  private $vue;
  private $mod;
  public function __construct(){
      $this->vue = new VueHashtag();
      $this->mod = new ModeleHashtag();

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
          $this->ajoutHashtagform();
          break;
        case "ajout":
          $this->ajoutHashtag();
          break;
        case "rechercher":
          $this->rechercheHashtagform();
          break;
        case "recherche":
          $this->rechercheHashtag();
          break;
        case "getHashtags":
          $this->getHashtags();
          break;
          case "afficher":
            $this->afficherHashtags();
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
  public function rechercheHashtagform(){
    $this->vue->rechercheHashtag_form();
  }
  public function rechercheHashtag(){
    $var = $this->mod->rechercheHashtag();
    foreach ($var as &$value) {
      $this->vue->affiche_hashtag($value);
    }
    
  }
  public function afficherHashtags(){
    readfile(getcwd().'/templates/listeDVPublicationsHashtag.html');
  }
  public function ajoutHashtagform(){
    $this->vue->hashtag_form();
  }
  public function ajoutHashtag(){
    $this->mod->ajoutHashtag();
  }

}
?>