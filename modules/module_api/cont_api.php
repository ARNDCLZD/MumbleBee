<?php
include_once 'modules/module_hashtag/modele_hashtag.php';
include_once 'modules/module_publication/modele_publication.php';

class ContApi {
  private $modHashtag;
  private $modPublication;
  private $response;
  public function __construct(){
      $this->modHashtag = new ModeleHashtag();
      $this->modPublication = new ModelePublication();

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
        case "getHashtagsList":
          $this->getHashtagsList();
          break;
        case "getPublicationsByAuthorId":
          $this->getPublicationsByAuthorId();
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
    $hashtags = $this->modHashtag->getHashtags();
    echo json_encode($hashtags);
  }
  public function getHashtagsList(){
    $hashtags = $this->modHashtag->getHashtagsList($_GET['start'],$_GET['end']);
    echo json_encode($hashtags);
  }
  public function getPublicationsByAuthorId(){
    var_dump($_GET['id']);
    $publications = $this->modPublication->getPublicationsByAuthorId($_GET['id'],$_GET['start'],$_GET['end']);
    echo json_encode($publications);
  }
}
?>