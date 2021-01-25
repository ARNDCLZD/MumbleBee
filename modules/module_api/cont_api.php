<?php
include_once 'modules/module_hashtag/modele_hashtag.php';
include_once 'modules/module_publication/modele_publication.php';
include_once 'modules/module_user/modele_user.php';

class ContApi {
  private $modHashtag;
  private $modPublication;
  private $modUser;
  private $response;
  public function __construct(){
      $this->modHashtag = new ModeleHashtag();
      $this->modPublication = new ModelePublication();
      $this->modUser = new ModeleUser();

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
        case "getLikedPublications":
          $this->getLikedPublications();
          break;
        case "getPublicationsTrending":
          $this->getPublicationsTrending();
          break;
          case "getHashtagsTrending":
            $this->getHashtagsTrending();
            break;
            case "getHashtagsOfficiel":
              $this->getHashtagsOfficiel();
              break;
            case "getPublicationsByHashtagId":
              $this->getPublicationsByHashtagId();
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

  public function getHashtagsTrending(){
    $hashtags = $this->modHashtag->getHashtagsTrending();
    echo json_encode($hashtags);
  }

  public function getHashtagsOfficiel(){
    $hashtags = $this->modHashtag->getHashtagsOfficiel();
    echo json_encode($hashtags);
  }

  public function getHashtags(){
    $hashtags = $this->modHashtag->getHashtags();
    echo json_encode($hashtags);
  }
  public function getHashtagsList(){
    $hashtags = $this->modHashtag->getHashtagsList($_GET['start'],$_GET['end']);
    echo json_encode($hashtags);
  }
  public function getLikedPublications(){
    $publications = $this->modUser->getLikedPublications($_GET['start'],$_GET['end']);
    echo json_encode($publications);
  }
  public function getPublicationsByAuthorId(){
    $publications = $this->modPublication->getPublicationsByAuthorId($_GET['id'],$_GET['start'],$_GET['end']);
    echo json_encode($publications);
  }

  public function getPublicationsByHashtagId(){
    $publications = $this->modHashtag->getPublicationsByHashtagId($_GET['id'],$_GET['start'],$_GET['end']);
    echo json_encode($publications);
  }
  public function getPublicationsTrending(){
    $publications = $this->modPublication->getPublicationsTrending();
    echo json_encode($publications);
  }
}
?>