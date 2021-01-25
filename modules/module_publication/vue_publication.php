<?php
class VuePublication{

  public function construct()
  {
    parent::construct();
  }

  public function affiche_publication($value, $id)
  {
    echo "<h1> Intitule : " . $value['Intitule'] . "</h1>";
    echo "<h1> Description : " . $value['Description'] . "</h1>";
    echo "<h1> Contenu : " . $value['Contenu'] . "</h1>";
    if($_SESSION['Admin'] == 0){
      echo "<form action=\"index.php?module=publication&action=afficher&id=".$id."\" method=\"post\">";;
      echo "<input name=\"like\" type=\"submit\" value=\"like\">"; 
      echo "<input name=\"id\" style=\"display:none\" type=\"text\" value=\"".$_GET['id']."\">"; 
      echo "</form>";
      echo "<form action=\"index.php?module=publication&action=afficher&id=".$id."\"method=\"post\">";
      echo "<label for=\"signaler-select\">Choisissez la raison du signalement de la publication:</label>     
      <select name=\"raison\" id=\"signaler-select\"> 
        <option value=\"raison-signalement\">Please choose an option</option>
        <option value=\"racisme\">Racisme</option>
        <option value=\"nudité\">Nudité</option>
        <option value=\"violence\">Violence</option>
        <option value=\"toxicité\">Toxicité</option>
      </select>";
      echo "<input name=\"like\" type=\"submit\" value=\"Signaler\" placeholder=\"signaler\">";
      echo "</form>";
      echo "<form action=\"index.php?module=publication&action=afficher&id=".$id."\" method=\"post\">";
      echo "<p>Commentaire : <input type=\"text\" name=\"texteCommentaire\" /></p>";
      echo "<p><input type=\"submit\" value=\"OK\"></p>";
      echo "</form>";
    }else{
        echo "<form method=\"POST\" action=\"index.php?module=publication&action=supprimer&id=\"".$_GET['id']."\">";
        echo "<input name=\"supprimer\" type=\"submit\" value=\"supprimer\">"; 
        echo "<input name=\"id\" style=\"display:none\" type=\"text\" value=\"".$_GET['id']."\">"; 
        echo "</form>";
    }
  }

  public function suppressionPublication_form(){
    echo "<h1>Cet article a bien été supprimé</h1>";
  }

  public function affiche_commentaire($com){
      echo "<br>";
      echo $com['NomAuteur']." : ".$com['Contenu'];
      echo "<br>";
      echo "<button class=\"bg-noir-800\">ça match</button>";
      if($_SESSION['Admin'] == 0){
        echo "<form action=\"index.php?module=publication&action=afficher&id=".$_GET['id']."\" method=\"post\">";
      echo "<label for=\"signaler-select\">Choisissez la raison du signalement du commentaire:</label>     
        <p><select name=\"raisonCom\" id=\"signaler-select\"> 
            <option value=\"raison-signalement\">Please choose an option</option>
            <option value=\"racisme\">Racisme</option>
            <option value=\"nudité\">Nudité</option>
            <option value=\"violence\">Violence</option>
            <option value=\"toxicité\">Toxicité</option>
        </select>";
        echo "<input name=\"signaler\" type=\"submit\" value=\"Signaler\" placeholder=\"signaler\"></p>";
        echo "</form>";
      }else{
        echo "<form action=\"index.php?module=publication&action=afficher&id=".$_GET['id']."\" method=\"post\">";
        echo "<input name=\"idCom\" style=\"display:none\" type=\"text\" value=\"".$com['IdCom']."\">";
        echo "<input name=\"supprimerCom\" type=\"submit\" value=\"supprimerCommentaire\" placeholder=\"signaler\">"; 
        echo "</form>";
      }
  }

  public function suppressionCommentaire(){
    echo "<h1>Ce commentaire a bien été supprimé</h1>";
    
  }



  public function publication_form(){
    echo "<form action=\"index.php?module=publication&action=ajout\" method=\"post\" enctype=\"multipart/form-data\">";
    echo "<p>Titre : <input type=\"text\" name=\"Intitule\" /></p>";
    echo "<p>TypeContenu : <select id=\"choix\" name=\"TypeContenu\">
                              <option value =\"\" disabled selected hidden></option>
                              <option value=\"texte\">Texte</option>
                              <option value =\"image\">Image</option>
                              <option value =\"son\">Son</option>
                              <option value =\"video\">Video</option>
                          </select></p>";
    ?>
    <script>
    window.addEventListener("load",function(){
      document.getElementById("choix").addEventListener("change",function(e){
        const inputs = {
          texte :"<p>Contenu : <textarea name=\"Contenu\"></textarea></p>",
          image :"<p><input type=\"file\" name=\"Contenu\"</p>",
          son :"<p><input type=\"file\" name=\"Contenu\"</p>",
          video :"<p><input type=\"file\" name=\"Contenu\"</p>",
        }
        document.getElementById("Contenu").innerHTML = inputs[e.target.value];
      });
    });
    </script>
    <?php
    echo "<div id=\"Contenu\"></div>";
    echo "<p>Description : <input type=\"text\" name=\"Description\" /></p>";
    echo "<p>Prive : <input type=\"checkbox\" name=\"Prive\" value=\"1\" /></p>";
    echo "<p><input id=\"bouton\" type=\"submit\" value=\"OK\"></p>";
    echo "</form>";

  }
  public function recherchePublication_form($tab){
    if(!empty($tab)){
      foreach ($tab as $value) {
        echo " <a style=\"color:blue;\" href=\"index.php?module=publication&action=afficher&id={$value['IdPubli']}\"> {$value['Intitule']}</a> ";
      }
    }
    else{
      echo "<h2>Pas de résultat :/</h2>";
    }
  }

  
}
?>