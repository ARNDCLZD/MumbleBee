<?php

class VueNav extends VueGenerique {

  public $link_bienvenue;
  public $link_listeequipe;
  public $link_listejoueur;
  public $link_ajouter;
  public $link_deconnexion;
  public $link_connexion;

  public function __construct() {
    parent::__construct();

    $this->link_bienvenue = "index.php?module=equipes&action=bienvenue";
    $this->link_listeequipe = "index.php?module=equipes&action=liste";
    $this->link_listejoueur = "index.php?module=joueurs&action=liste";
    $this->link_ajouter = "index.php?module=joueurs&action=form_ajout";

    $this->link_deconnexion = "index.php?module=connexion&action=form_deconnexion";
    $this->link_connexion = "index.php?module=connexion&action=form_connexion";

  

  }

  public function affiche() {
    echo "<a href=". $this->link_bienvenue .">Link Bienvenue </a>" . "<br>" . "<a href=". $this->link_listeequipe .">Liste Equipe</a>" . "<br>" .  "<a href=". $this->link_listejoueur .">Liste joueurs</a>" . "<br>"
    .  "<a href=". $this->link_ajouter .">Liste ajouter </a>" . "<br>" ;
    if(isset($_SESSION['name'])){
      echo "<a href=". $this->link_deconnexion .">Link Deconnexion </a>" . "<br>" ;
    }else{
      echo "<a href=". $this->link_connexion .">Link connexion </a>" . "<br>" ;
    }

  }

}
?>