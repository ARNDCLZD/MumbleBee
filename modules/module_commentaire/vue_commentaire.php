<?php
include 'vue_generique.php';

class VueCommentaire extends VueGenerique{

  public function construct()
  {
    parent::construct();
  }

  public function affiche_commentaire($value)
  {
    echo $value['NomAuteur'] . " : " . $value['Contenu'];
  }
  public function commentaire_form(){
    echo "<form action=\"index.php?module=commentaire&action=ajout&idPubli=22\" method=\"post\">";
    echo "<p>Commente : <input type=\"text\" name=\"contenu\" /></p></form>";
  }

  public function rechercheCommentaire_form(){
    echo "<form action=\"index.php?module=commentaire&action=recherche&idPubli=22\" method=\"post\">";
    echo "</form>";
  }
}
?>