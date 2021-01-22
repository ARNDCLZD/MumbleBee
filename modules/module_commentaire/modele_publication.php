<?php
include 'Connexion.php';

class ModeleCommentaire extends Connexion
{
  public function __construct ()
  {
  }
  public function getCommentaires(){
    try{
    $reponse = self::$bdd->prepare('SELECT * FROM commentaire');
    $reponse->execute();
    
    if(($tab = $reponse->fetch(PDO::FETCH_ASSOC)) !== false) {
      return $tab;
    }
    throw new ModeleCommentaireException("Fetch impossible.",2);
    }catch(PDOException $p){
      echo("commentaire introuvable");
    }
  }
  	public function getCommentaireId() {
    	try{
    		$id = $_GET['id'];
    		$reponse = self::$bdd->prepare('SELECT * FROM commentaire WHERE id = :id');
    		$reponse->bindParam(":id",$id);
    		$reponse->execute();
    		$tab = $reponse->fetch(PDO::FETCH_ASSOC);
    	}catch(PDOException $p){
      		echo("commentaire introuvable");
    	}
    	return $tab;
    }

  public function ajoutCommentaire(){
  	$intitule = $_POST['intitule'];
  	$contenu = $_POST['contenu'];
  	$typeContenu = $_POST['typeContenu'];
  	$description = $_POST['description'];
  	$prive = isset($_POST['prive']) ? $_POST['prive'] : 0;

  	if($intitule !== "" && $description !== "" && $typeContenu !== "" && $contenu !== ""){
      $intitule = trim(htmlentities($intitule));
  		$contenu = trim(htmlentities($contenu));
  		$description = trim(htmlentities($description));
  		$typeContenu = trim(htmlentities($typeContenu));
  		
 		try {
      $sql = self::$bdd->prepare('INSERT INTO publication (Contenu, Intitule, Description, Prive, TypeContenu) VALUES (?, ?, ?, ?, ?)'); 
      $sql->execute([$contenu, $intitule, $description, $prive, $typeContenu]);
    } catch(PDOException $e) {
      print_r($bdd->errorInfo());
    	}
    }
    else
    {
      throw new ModelePublicationException("Champ d'insertion nul.", 4);
      
    }

  }
  public function recherchePublication(){
  	$intitule = $_POST['intitule'];
  	if($intitule !== ""){
  		try{
  			$sql = self::$bdd->prepare('SELECT * FROM publication WHERE intitule = :intitule');
  			$sql->bindParam(':intitule', $intitule);
  			$sql->execute();
  			$tab = $sql->fetchAll();
  		}catch(PDOException $e){
  			print_r($bdd->errorInfo());
  		}
  		return $tab;
  	}
  }

}
class ModelePublicationException extends Exception{}
?>