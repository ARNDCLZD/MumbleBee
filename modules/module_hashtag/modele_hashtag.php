<?php
include_once 'Connexion.php';

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
  	public function getHashtagsList($start,$end) {
		try{
			$reponse = self::$bdd->prepare('SELECT * FROM hashtag LIMIT :start,:end');
			$reponse->bindParam(":start",$start,PDO::PARAM_INT);
			$reponse->bindParam(":end",$end,PDO::PARAM_INT);
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
  public function getPublicationsByHashtagId($id,$start,$end){
	try{
	  $reponse = self::$bdd->prepare('SELECT * FROM publication NATURAL JOIN taguer WHERE idHashtag=:id LIMIT :start,:end');
	  
	  $reponse->bindParam(":id",$id,PDO::PARAM_INT);
	  $reponse->bindParam(":start",$start,PDO::PARAM_INT);
	  $reponse->bindParam(":end",$end,PDO::PARAM_INT);
	  $reponse->execute();
	  $tab = $reponse->fetchAll();
	  return $tab;
	}catch(PDOException $e){
		print_r($e->getMessage());
	}
}

  public function getHashtagsTrending(){
	try{
		$reponse = self::$bdd->prepare('SELECT hashtag.IdHashtag,hashtag.Intitule,count(taguer.IdHashtag) as value_occurence FROM taguer NATURAL JOIN hashtag GROUP BY IdHashtag ORDER BY value_occurence DESC LIMIT 0,15');
		$reponse->execute();	
		$tab = $reponse->fetchAll();
	}catch(PDOException $p){
		  echo("commentaire introuvable");
	}
	return $tab;
}
public function getHashtagsOfficiel(){
	try{
		$reponse = self::$bdd->prepare('SELECT * FROM hashtag WHERE MarqueurOfficiel=1');
		$reponse->execute();	
		$tab = $reponse->fetchAll();
	}catch(PDOException $p){
		  echo("commentaire introuvable");
	}
	return $tab;
}

}
class ModeleHashtagException extends Exception{}
?>