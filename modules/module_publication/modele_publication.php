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
    		$reponse = self::$bdd->prepare('SELECT * FROM publication WHERE IdPubli = :id');
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
	if(isset($_SESSION['id'])){
		$idAuteur = $_SESSION['id']['IdUtil'];
        $sql = self::$bdd->prepare('SELECT IdPubli FROM publication WHERE Intitule=:intitule');
        $sql->bindParam(':intitule',$intitule, PDO::PARAM_STR);
        $sql->execute();
        $idPubli = $sql->fetch(PDO::FETCH_ASSOC);
		$sql = self::$bdd->prepare('INSERT INTO poster VALUES (?,?)');
        $sql->execute([$idAuteur, $idPubli['IdPubli']]);
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
  public function deletePublicationId(){
	try{
		$id = $_GET['id'];
		$tab = $reponse->fetch(PDO::FETCH_ASSOC);
		$sql = self::$bdd->prepare('DELETE FROM publication WHERE IdPubli = :id'); 
		$sql->bindParam(":id",$id);
		$sql->execute();
	}catch(PDOException $p){
		  echo("publication introuvable");
	}
  }
}
class ModelePublicationException extends Exception{}
?>