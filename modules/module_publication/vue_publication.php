<?php
class VuePublication{

  public function construct()
  {
    parent::construct();
  }

  public function affiche_publication($value, $id)
  {
    if(isset($_SESSION['Admin']) && $_SESSION['Admin'] == 1){
      echo $_SESSION['Admin'];
      echo "<form method=\"POST\" action=\"index.php?module=publication&action=supprimer&id=\"".$_GET['id']."\">";
      echo "<input name=\"supprimer\" type=\"submit\" value=\"supprimer\">"; 
      echo "<input name=\"id\" style=\"display:none\" type=\"text\" value=\"".$_GET['id']."\">"; 
      echo "</form>";

    }
    echo "<h1> " . $value['Intitule'] . "</h1>";
    switch ($value['TypeContenu']){
      case 'texte':
        echo "Description : " . $value['Description'] . "<br>" . "Contenu : " . $value['Contenu'];
        break;
      case "image":
        echo '<img src="data:image/jpeg;base64,'.base64_encode( $value['Contenu'] ).'"/>'. "<br>" . "Description : " . $value['Description'];
        break;
      case "son":
        echo '<audio controls src="data:audio/mp3;base64,'. base64_encode($value['Contenu']) . '"></audio>'. "<br>" . "Description : " . $value['Description'];
        break;
      case "video":
        echo '<video controls width="200px" src="data:video/mp4;base64,'. base64_encode($value['Contenu']) .'"></video>'. "<br>" ."Description : " . $value['Description'];
        break;
      default:
        echo "Impossible d'afficher la publication";
    }
    echo "<form action=\"index.php?module=publication&action=afficher&id=".$id."\" method=\"post\">";
    echo "<p>Commentaire : <input type=\"text\" name=\"texteCommentaire\" /></p>";
    echo "<p><input type=\"submit\" value=\"OK\"></p>";
    echo "</form>";
    echo "<button class=\"bg-noir-800\">ça match</button>";
  }

  public function suppression(){
    echo "<h1>Cet article a bien été supprimé</h1>";
  }

  public function affiche_commentaire($com){
      echo "<br>";
      echo "Utilisateur: " . $com['IdAuteur'];
      echo "<br>";
      echo "Commentaire: " . $com['Contenu'];
      echo "<br>";
      echo "<button class=\"bg-noir-800\">ça match</button>";
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
          texte :"<p>Contenu : <textarea class=\"w-2/5 h-2/5\" name=\"Contenu\"></textarea></p>",
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