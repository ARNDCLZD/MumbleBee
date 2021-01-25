<?php

class ContStatic {

  public function __construct(){

      if (isset($_GET['action'])) {
          $action = $_GET['action'];
      } else {
          $action = 'accueil';
      }
        $this->trie($action);
  }
  function trie($action) {
    switch ($action) {
        case "accueil":
          $this->showAccueil();
          break;
        case "contact":
          $this->showBlabla();
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
  public function showAccueil(){
      include_once "templates/accueil.php";
  }
  public function showBlabla(){
      readfile(getcwd()."/templates/contact.html");
  }

}
?>