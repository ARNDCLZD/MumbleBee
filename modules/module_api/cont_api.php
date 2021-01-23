<?php
include_once 'modules/module_hashtag/modele_hashtag.php';

class ContApi {
  private $mod;
  private $response;
  public function __construct(){
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
        case "getHashtags":
          $this->getHashtags();
          break;
        default:
          $this->error();
          break;
    }    
  }
  public function error(){
    echo "Page introuvable";
    http_response_code(404);
    die;
  }
  public function getHashtags(){
    $hashtags = $this->mod->getHashtags();
    echo json_encode($hashtags);
  }
}
?>