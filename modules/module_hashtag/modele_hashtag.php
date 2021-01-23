<?php
include 'Connexion.php';

class ModeleHashtag extends Connexion
{
  public function __construct ()
  {
  }
  public function getHashtags(){
    try{
    $reponse = self::$bdd->prepare('SELECT * FROM hashtag');
    $reponse->execute();
    
    if(($tab = $reponse->fetchAll()) !== false) {
      return $tab;
    }
    throw new ModeleHashtagException("Fetch impossible.",2);
    }catch(PDOException $p){
      echo("hashtag introuvable");
    }
  }
  	public function getHashtagId() {
    	try{
    		$id = $_GET['id'];
    		$reponse = self::$bdd->prepare('SELECT * FROM hashtag WHERE id = :id');
    		$reponse->bindParam(":id",$id);
    		$reponse->execute();
    		$tab = $reponse->fetch(PDO::FETCH_ASSOC);
    	}catch(PDOException $p){
      		echo("hashtag introuvable");
    	}
    	return $tab;
    }

    public function getHashtagIntitule() {
    	try{
    		$id = $_GET['Intitule'];
    		$reponse = self::$bdd->prepare('SELECT * FROM hashtag WHERE intitule = :intitule');
    		$reponse->bindParam(":intitule",$intitule);
    		$reponse->execute();
    		$tab = $reponse->fetch(PDO::FETCH_ASSOC);
    	}catch(PDOException $p){
      		echo("hashtag introuvable");
    	}
	return $tab;
  }
  public function ajoutHashtag(){
  	$intitule = $_POST['intitule'];
  	$marqueurOfficiel = $_POST['marqueurOfficiel'];

  	if($intitule !== ""){
      $intitule = trim(htmlentities($intitule));
  		
 		try {
      		$sql = self::$bdd->prepare('INSERT INTO hashtag (Intitule, MarqueurOfficiel) VALUES (?, ?)'); 
      		$sql->execute([$intitule, $marqueurOfficiel]);
    	} catch(PDOException $e) {
      		print_r($bdd->errorInfo());
    	}
    }
    else
    {
      throw new ModeleHashtagException("Champ d'insertion nul.", 4);
      
    }

  }
  public function rechercheHashtag(){
  	$intitule = $_POST['intitule'];
  	if($intitule !== ""){
  		try{
  			$sql = self::$bdd->prepare('SELECT * FROM hashtag WHERE intitule = :intitule');
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
class ModeleHashtagException extends Exception{}
?>