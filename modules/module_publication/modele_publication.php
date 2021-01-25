<?php
include_once 'Connexion.php';

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

  public function supprimerPublication(){
	if(isset($_POST['supprimerPublication'])){
	try{
		$id = $_POST['idPubli'];
		$reponse = self::$bdd->prepare('DELETE FROM publication WHERE IdPubli = :id');
		$reponse->bindParam(":id",$id);
		$reponse->execute();
		}catch(PDOException $p){
		  echo("publication non supprimable");
	}
	try{
		$id = $_POST['idPubli'];
		$reponse = self::$bdd->prepare('DELETE FROM signalerpublication WHERE IdPubli = :id');
		$reponse->bindParam(":id",$id);
		$reponse->execute();
		}catch(PDOException $p){
		  echo("reports non supprimable");
	}
	try{
		$id = $_POST['idPubli'];
		$reponse = self::$bdd->prepare('DELETE FROM signalercommentaire WHERE IdPubli = :id');
		$reponse->bindParam(":id",$id);
		$reponse->execute();
		}catch(PDOException $p){
		  echo("reports non supprimable");
	}
	echo "<meta http-equiv='refresh' content='0'>";
	header('Location: http://'.$_SERVER['HTTP_HOST'].'/MumbleBee/index.php?module=user&action=reports');
	}
  }

  
  public function supprimerCommentaire(){
	if(isset($_POST['supprimerCom'])){
	try{
		$id = $_POST['idCom'];
		$reponse = self::$bdd->prepare('DELETE FROM signalercommentaire WHERE IdCom = :id');
		$reponse->bindParam(":id",$id);
		$reponse->execute();
		}catch(PDOException $p){
		  echo("reports non supprimable");
	}
	try{
		$id = $_POST['idCom'];
		$reponse = self::$bdd->prepare('DELETE FROM commentaire WHERE IdCom = :id');
		$reponse->bindParam(":id",$id);
		$reponse->execute();
		}catch(PDOException $p){
		  echo("commentaire non supprimable");
	}
	echo "<meta http-equiv='refresh' content='0'>";
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
	
	public function getCommentaireById(){
		try{
			$id = $_GET['id'];
    		$reponse = self::$bdd->prepare('SELECT * FROM commentaire WHERE IdPubli=:id');
    		$reponse->bindParam(":id",$id);
			$reponse->execute();			
			$tab = $reponse->fetchAll();
    	}catch(PDOException $p){
      		echo("commentaire introuvable");
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
  public function getPublicationsByAuthorId($id,$start,$end){
	  try{
		$reponse = self::$bdd->prepare('SELECT * FROM publication NATURAL JOIN poster WHERE idAuteur=:id LIMIT :start,:end');
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
  public function ajoutPublication(){
	//$contenu = basename($_FILES["Contenu"]["tmp_name"]);
	$intitule = $_POST['Intitule'];
	
  	$contenu = $_POST['Contenu'];
  	$typeContenu = $_POST['TypeContenu'];
  	$description = $_POST['Description'];
  	$prive = isset($_POST['Prive']) ? $_POST['Prive'] : 0;

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
	if(isset($_POST['intitule'])){
		$intitule = $_POST['intitule'];
	}
	else{
		$intitule = "";
	}
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

  public function liker(){  
	  if(isset($_POST['like'])){
		  $idAuteur = $_SESSION['id'];
		  $idPubli = $_GET['id'];
		  try{
			$sql = self::$bdd->prepare('INSERT INTO likepublication (IdAuteur,IdPubli) VALUES(:idAuteur, :idPubli)');
			$sql->bindParam(':idAuteur',$idAuteur['IdUtil'], PDO::PARAM_INT);
			$sql->bindParam(':idPubli',$idPubli, PDO::PARAM_INT);
			$sql->execute();
		}catch(PDOException $e){
			print_r($bdd->errorInfo());
		}
	  }
  }

  public function signalerPublication(){
	if(isset($_POST['raison'])){
		$idAuteur = $_SESSION['id'];
		$idPubli = $_GET['id'];
		$raison = $_POST['raison'];
		try{
		  $sql = self::$bdd->prepare('INSERT INTO signalerpublication (IdAuteur,IdPubli, Motif) VALUES(:idAuteur, :idPubli, :raison)');
		  $sql->bindParam(':idAuteur',$idAuteur['IdUtil'], PDO::PARAM_INT);
		  $sql->bindParam(':idPubli',$idPubli, PDO::PARAM_INT);
		  $sql->bindParam(':raison',$raison, PDO::PARAM_STR);
		  $sql->execute();
	  }catch(PDOException $e){
		  print_r($bdd->errorInfo());
	  }
	}
  }

  public function signalerCommentaire(){
	if(isset($_POST['raisonCom'])){
		$idCom = $_POST['IdCom'];
		$idAuteur = $_SESSION['id'];
		$idPubli = $_GET['id'];
		$raison = $_POST['raisonCom'];
		try{
		  $sql = self::$bdd->prepare('INSERT INTO signalercommentaire (IdCom, IdAuteur,IdPubli, Motif) VALUES(:idCom, :idAuteur, :idPubli, :raisonCom)');
		  $sql->bindParam(':idCom',$idCom, PDO::PARAM_INT);
		  $sql->bindParam(':idAuteur',$idAuteur['IdUtil'], PDO::PARAM_INT);
		  $sql->bindParam(':idPubli',$idPubli, PDO::PARAM_INT);
		  $sql->bindParam(':raisonCom',$raison, PDO::PARAM_STR);
		  $sql->execute();
	  }catch(PDOException $e){
		  print_r($bdd->errorInfo());
	  }
	  echo "<meta http-equiv='refresh' content='0'>";
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
  public function ajoutCommentaire(){
	if(isset($_POST['texteCommentaire'])){
		$commentaire = $_POST['texteCommentaire'];
		$idAuteur = $_SESSION['id']['IdUtil'];
		$idPubli = $_GET['id'];
		$sql = self::$bdd->prepare('SELECT Login FROM utilisateur WHERE IdUtil=:id');
		$sql->bindParam(':id',$idAuteur, PDO::PARAM_STR);
		$sql->execute();
		$nomAuteur = $sql->fetch(PDO::FETCH_ASSOC);
		try {
			$sql = self::$bdd->prepare('INSERT INTO commentaire (Contenu, IdAuteur, IdPubli, NomAuteur) VALUES (?, ?, ?, ?)'); 
			$sql->execute([$commentaire,$idAuteur, $idPubli, $nomAuteur['Login']]);
		} catch(PDOException $e) {
			print_r($bdd->errorInfo());
		}
    echo "<meta http-equiv='refresh' content='0'>";
	}
  }

}
class ModelePublicationException extends Exception{}
?>