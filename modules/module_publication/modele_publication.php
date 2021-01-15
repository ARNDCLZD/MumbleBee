<?php
include 'Connexion.php';

class ModelePublication extends Connexion
{
  public function __construct ()
  {
  }
  public function getPublications(){
    try{
    $reponse = self::$bdd->prepare('SELECT * FROM publication');
    $reponse->execute();
    
    if(($tab = $reponse->fetch(PDO::FETCH_ASSOC)) !== false) {
      return $tab;
    }
    throw new ModelePublicationException("Fetch impossible.",2);
    }catch(PDOException $p){
      echo("publication introuvable");
    }
  }
  	public function getPublicationId() {
    	try{
    		$id = $_GET['id'];
    		$reponse = self::$bdd->prepare('SELECT * FROM publication WHERE id = :id');
    		$reponse->bindParam(":id",$id);
    		$reponse->execute();
    		$tab = $reponse->fetch(PDO::FETCH_ASSOC);
    	}catch(PDOException $p){
      		echo("publication introuvable");
    	}
    	return $tab;
    }

    public function getPublicationIntitule() {
    	try{
    		$id = $_GET['Intitule'];
    		$reponse = self::$bdd->prepare('SELECT * FROM publication WHERE intitule = :intitule');
    		$reponse->bindParam(":intitule",$intitule);
    		$reponse->execute();
    		$tab = $reponse->fetch(PDO::FETCH_ASSOC);
    	}catch(PDOException $p){
      		echo("publication introuvable");
    	}
	return $tab;
  }
  public function ajoutPublication(){
  	$intitule = $_POST['intitule'];
  	$contenu = $_POST['contenu'];
  	$typeContenu = $_POST['typeContenu'];
  	$description = $_POST['description'];
  	$prive = $_POST['prive'];

  	if($intitule !== "" && $description !== "" && $typeContenu !== "" && $contenu !== ""){
      $intitule = trim(htmlentities($intitule));
  		$contenu = trim(htmlentities($contenu));
  		$description = trim(htmlentities($description));
  		$typeContenu = trim(htmlentities($typeContenu));
  		if($typeContenu !== "texte") throw new ModelePublicationException("TypeContenu saisi incorrect.", 3);
  		
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