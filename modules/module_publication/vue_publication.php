<?php
include 'vue_generique.php';

class VuePublication extends VueGenerique{

  public function construct()
  {
    parent::construct();
  }

  public function affiche_publication($value)
  {
    switch ($value['TypeContenu']){

      case 'texte':
        echo "Description : " . $value['Description'] . "<br>" . "Contenu : " . $value['Contenu'];
        break;

      case "image":
        echo "Description : " . $value['description'] . "<br>" . "<img src=\"\" ". $value['contenu'] . "alt=\"image\" title=\"image proposée\"/>";
        break;

      case "son":
        echo "Description : " . $value['description'] . "<br>" . "<audio controls src=\"\"" . $value['contenu'] . ">Le contenu audio n'est pas accessible</audio>";
        break;

      default:
        echo "Impossible d'afficher la publication";
    }
  }
  public function publication_form(){
    echo "<form action=\"index.php?module=publication&action=ajout\" method=\"post\">";
    echo "<p>Titre : <input type=\"text\" name=\"intitule\" /></p>";
    echo "<p>Contenu : <input type=\"text\" name=\"contenu\" /></p>";
    echo "<p>Description : <input type=\"text\" name=\"description\" /></p>";
    echo "<p>Prive : <input type=\"checkbox\" name=\"prive\" value=\"1\" /></p>";
    echo "<p>TypeContenu : <input type=\"text\" name=\"typeContenu\" /></p>";
    echo "<p><input type=\"submit\" value=\"OK\"></p>";
    echo "</form>";
  }
  public function recherchePublication_form(){
    echo "<form action=\"index.php?action=recherche\" method=\"post\">";
    echo "<p><input type=\"search\" name=\"intitule\"></p>";
    echo "<p><input type=\"submit\" value=\"OK\"></p>";
    echo "</form>";
  } 
}
?>