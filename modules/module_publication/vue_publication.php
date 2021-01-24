<?php
class VuePublication{

  public function construct()
  {
    parent::construct();
  }

  public function affiche_publication($value, $coms, $id)
  {
    if(isset($_SESSION['Admin']) && $_SESSION['Admin'] == 1){
      echo $_SESSION['Admin'];
      echo "<form method=\"POST\" action=\"index.php?module=publication&action=supprimerPublication&id=\"".$_GET['id']."\">";
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
    foreach ($coms as $key => $val) {
      $idAuteur =  $val['IdAuteur'];
      $contenu = $val['Contenu'];
      $idPubli = $val['IdPubli'];
      echo "<br>";
      echo "Utilisateur: " . $idAuteur;
      echo "<br>";
      echo "Commentaire: " . $contenu;
      echo "<br>";
      if(isset($_SESSION['Admin']) && $_SESSION['Admin']==1){
        echo "<form action=\"index.php?module=publication&action=supprimerCommentaire\" method=\"post\">";
        echo "<p>Commentaire : <input type=\"text\" name=\"texteCommentaire\" /></p>";
        echo "<p><input type=\"submit\" value=\"OK\"></p>";
        echo "<input name=\"IdAuteur\" style=\"display:none\" type=\"text\" value=\"".$idAuteur."\">"; 
        echo "<input name=\"Contenu\" style=\"display:none\" type=\"text\" value=\"".$contenu."\">"; 
        echo "<input name=\"IdPubli\" style=\"display:none\" type=\"text\" value=\"".$idPubli."\">"; 
        echo "</form>";
      }
     
    
    }
  }

  public function suppressionPublication(){
    echo "<h1>Cet article a bien été supprimé</h1>";
  }

  public function suppressionCommentaire(){
    echo "<h1>Ce commentaire a bien été supprimé</h1>";
    

  }


  public function publication_form(){
    echo "<form action=\"index.php?module=publication&action=ajout\" method=\"post\">";
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
          texte :"<p>Contenu : <input type=\"text\" name=\"Contenu\"/></p>",
          image :"<p>placeholder</p>",
          son :"<p>placeholder</p>",
          video :"<p>placeholder</p>",
        }
        document.getElementById("contenu").innerHTML = inputs[e.target.value];
      });
    });
    </script>
    <?php
    echo "<div id=\"contenu\"></div>";
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