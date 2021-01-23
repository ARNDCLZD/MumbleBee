<?php

class VueHashtag{

  public function construct()
  {
    parent::construct();
  }

  public function affiche_hashtag($value)
  {
    echo "#". $value['intitule']."<br>";
  }
  public function hashtag_form(){
    echo "<p>Ton hashtag : <input type=\"text\" name=\"intitule\" /></p>";
    echo "<p>hashtag officiel : <input type=\"checkbox\" name=\"marqueurOfficiel\" value=\"1\" /></p>";
    echo "<p><input type=\"submit\" value=\"OK\"></p>";
    echo "</form>";
  }
  public function rechercheHashtag_form(){
    echo "<form action=\"index.php?action=recherche\" method=\"post\">";
    echo "<p><input type=\"search\" name=\"intitule\"></p>";
    echo "<p><input type=\"submit\" value=\"OK\"></p>";
    echo "</form>";
  } 
}
?>