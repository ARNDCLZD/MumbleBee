<?php
class VuePublication{

  public function construct()
  {
    parent::construct();
  }

  public function affiche_publication($value, $id)
  {
    echo "<div class=\"flex flex-col p-6\">";
    echo "<div class=\"flex flex-col items-center justify-center border-2 border-noir-800 rounded-t-md\">";
    echo "<h1 class=\"text-3xl\">" . $value['Intitule'] . "</h1>";
    echo "<h1 class=\"bg-noir-800 text-jaune-300 rounded-sm text-2xl\">" . $value['Contenu'] . "</h1>";
    echo "</div>";
    echo "<div class=\"flex flex-row justify-between border-noir-800 border-b-2\">";
    echo "<h1 class=\"text-xl\">" . $value['Description'] . "</h1>";
    if(isset($_SESSION['Admin']) && $_SESSION['Admin'] == 0){
      echo "<form action=\"index.php?module=publication&action=afficher&id=".$id."\" method=\"post\">";;
      echo "<input name=\"like\" type=\"submit\" value=\"like\">"; 
      echo "<input name=\"id\" style=\"display:none\" type=\"text\" value=\"".$_GET['id']."\">"; 
      echo "</form>";
      echo "</div>";
      echo "<div class=\"flex flex-row justify-between\">";
      echo "<form action=\"index.php?module=publication&action=afficher&id=".$id."\" method=\"post\">";
      echo "<input type=\"text\" name=\"texteCommentaire\" placeholder=\"Commentaire...\"/>";
      echo "<input type=\"submit\" value=\"OK\">";
      echo "</form>";
      echo "<form action=\"index.php?module=publication&action=afficher&id=".$id."\"method=\"post\">";
      echo "<select name=\"raison\" id=\"signaler-select\"> 
        <option value=\"raison-signalement\" disabled selected hidden>Motif</option>
        <option value=\"racisme\">Racisme</option>
        <option value=\"contenuExplicite\">Contenu Explicite</option>
        <option value=\"violence\">Violence</option>
        <option value=\"toxicité\">Toxicité</option>
      </select>";
      echo "<input name=\"like\" type=\"submit\" value=\"Signaler\" placeholder=\"signaler\">";
      echo "</form>";
    }else if(isset($_SESSION['Admin']) && $_SESSION['Admin']==1){
        echo "<form method=\"POST\" action=\"index.php?module=publication&action=afficher&id=".$_GET['id']."\">";
        echo "<input name=\"supprimerPublication\" type=\"submit\" value=\"supprimer\">"; 
        echo "<input name=\"idPubli\" style=\"display:none\" type=\"text\" value=\"".$_GET['id']."\">"; 
        echo "</form>";
    }
    echo "</div>";
    echo "</div>";
  }

  public function suppressionPublication_form(){
    echo "<h1>Cet article a bien été supprimé</h1>";
  }

  public function affiche_commentaire($com){
      echo "<br>";
      echo $com['NomAuteur']." : ".$com['Contenu'];
      echo "<br>";
      if(isset($_SESSION['Admin']) && $_SESSION['Admin'] == 0){
        echo "<form action=\"index.php?module=publication&action=afficher&id=".$_GET['id']."\" method=\"post\">";
      echo "<select name=\"raisonCom\" id=\"signaler-select\">
            <option value=\"raison-signalement\" disabled selected hidden>Motif</option>
            <option value=\"racisme\">Racisme</option>
            <option value=\"contenuExplicite\">Contenu Explicite</option>
            <option value=\"violence\">Violence</option>
            <option value=\"toxicité\">Toxicité</option>
        </select>";
        echo "<input name=\"IdCom\" style=\"display:none\" type=\"text\" value=\"".$com['IdCom']."\">";
        echo "<input name=\"signalerCom\" type=\"submit\" value=\"Signaler\" placeholder=\"signaler\">";
        echo "</form>";
      }else if(isset($_SESSION['Admin']) && $_SESSION['Admin']==1){
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
    echo "<div class=\"flex flex-col justify-center items-center text-center w-screen h-2/5\">";
    echo "<form class=\"w-full flex flex-col justify-center items-center h-full\" action=\"index.php?module=publication&action=ajout\" method=\"post\" enctype=\"multipart/form-data\">";
    echo "<input class=\"w-2/5 text-center bg-noir-800 text-jaune-300 placeholder-jaune-200 focus:outline-none focus:bg-jaune-300 focus:text-noir-800 transition duration-300 rounded-t-lg\" type=\"text\" name=\"Intitule\" placeholder=\"Titre\"/>";
    echo "<textarea class=\"w-3/5 h-3/5 resize-none bg-noir-800 text-jaune-300 focus:outline-none rounded-t-lg focus:bg-jaune-300 focus:text-noir-800 transition duration-300\" name=\"Contenu\"></textarea>";
    echo "<input class=\"w-3/5 text-center bg-noir-800 text-jaune-300 placeholder-jaune-200 focus:outline-none focus:bg-jaune-300 focus:text-noir-800 transition duration-300 rounded-b-lg\" type=\"text\" name=\"Description\" placeholder=\"Description\"/>";
    echo "<input class=\"w-1/5 bg-noir-800 text-jaune-300 focus:outline-none rounded-b-lg\" id=\"bouton\" type=\"submit\" value=\"Publier\">";
    echo "</form>";
    echo "</div>";

  }
  public function recherchePublication_form($tab){
    echo '<div class="">';
    echo '<p class="text-3xl text-jaune-300 bg-noir-800 border-b-2 border-noir-800">Résultats : </p>';
    if(!empty($tab)){
      foreach ($tab as $value) {
        echo " <a href=\"index.php?module=publication&action=afficher&id={$value['IdPubli']}\"> {$value['Intitule']}</a> ";
        echo "<br>";
      }
    }
    else{
      echo '<h2 class="text-2xl">Aucun résultat</h2>';
    }
    echo '</div>';
  }

  
}
?>