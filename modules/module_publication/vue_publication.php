<?php
class VuePublication{

  public function construct()
  {
    parent::construct();
  }

  public function affiche_publication($value, $coms)
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
    foreach ($coms as $key => $val) {
   
      echo "<br>";
      echo "Utilisateur: " . $val['Login'];
      echo "<br>";
      echo "Commentaire: " . $val['Contenu'];
      echo "<br>";
      
     
    
    }
  }

  public function suppression(){
    echo "<h1>Cet article a bien été supprimé</h1>";
  }



  public function publication_form(){
    echo "<form action=\"index.php?module=publication&action=ajout\" method=\"post\">";
    echo "<p>Titre : <input type=\"text\" name=\"intitule\" /></p>";
    echo "<p>TypeContenu : <select id=\"choix\" name=\"typeContenu\">
                              <option value =\"\" disabled selected hidden></option>
                              <option value=\"texte\">Texte</option>
                              <option value =\"image\">Image</option>
                              <option value =\"son\">Son</option>
                              <option value =\"video\">Video</option>
                          </select></p></form>";
    ?>
    <script>
    $(function{
      document.getElementById("choix").onChange = function(){
        switch(document.getElementById("choix").onChange){
          case 'texte' :
            document.getElementById("contenu").innerHTML=
            "<p>Contenu : <input type=\"text\" name=\"contenu\"/></p>";
          break;
          case 'image' :
            document.getElementById("contenu").innerHTML=
            "<p>placeholder</p>";
          break;
          case 'son' :
            document.getElementById("contenu").innerHTML=
            "<p>placeholder</p>";
          break;
          case 'video' :
            document.getElementById("contenu").innerHTML=
            "<p>placeholder</p>";
          break;
          default :
          break;
        }

      }
    });
    </script>
    <?php
    echo "<p>Contenu : <input type=\"text\" name=\"contenu\" /></p>";
    echo "<div id=\"contenu\"></div>";
    echo "<p>Description : <input type=\"text\" name=\"description\" /></p>";
    echo "<p>Prive : <input type=\"checkbox\" name=\"prive\" value=\"1\" /></p>";
    echo "<p><input type=\"submit\" value=\"OK\"></p>";
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