<?php
include_once 'Connexion.php';

class ModeleUser extends Connexion
{
  public function __construct ()
  {
  }
  public function getUsers(){
    try{
    $reponse = self::$bdd->prepare('SELECT * FROM utilisateur');
    $reponse->execute();
    
    if(($tab = $reponse->fetch(PDO::FETCH_ASSOC)) !== false) {
      return $tab;
    }
    throw new ModeleUserException("Fetch impossible.",2);
    }catch(PDOException $p){
      echo("utilisateur introuvable");
    }
  }
  	public function getUserId() {
    	try{
			if(isset($_POST['id'])) {
				$id = $_POST['id'];
    			$reponse = self::$bdd->prepare('SELECT * FROM utilisateur WHERE id = :id');
    			$reponse->bindParam(":id",$id);
    			$reponse->execute();
				$tab = $reponse->fetch(PDO::FETCH_ASSOC);
			} else throw new ModeleUserException("Pas d'utilisateur connecté",1);
    	}catch(PDOException $p){
      		throw new ModeleUserException(1,"Utilisateur introuvable");
    	}
    	return $tab;
	}
	
	public function getReportsPublication(){
		try{
			$reponse = self::$bdd->prepare('SELECT * FROM signalerpublication');
			$reponse->execute();
			$tab = $reponse->fetchAll(PDO::FETCH_ASSOC);
		}catch(PDOException $e){
			print_r($e->getMessage());
		}
		return $tab;
	}

	public function getReportsCommentaire(){
		try{
    		$reponse = self::$bdd->prepare('SELECT * FROM signalercommentaire');
    		$reponse->execute();
			$tab = $reponse->fetchAll(PDO::FETCH_ASSOC);
    	}catch(PDOException $e){
			print_r($e->getMessage());    
		}
    	return $tab;
	}

    public function getUserLogin() {
    	try{
			if(isset($_SESSION['id']['IdUtil'])){
				$login = $_SESSION['username'];
    			$reponse = self::$bdd->prepare('SELECT * FROM utilisateur WHERE login = :login');
    			$reponse->bindParam(":login",$login);
    			$reponse->execute();
				$tab = $reponse->fetch(PDO::FETCH_ASSOC);
			} else throw new ModeleUserException("Pas d'utilisateur en SESSION",1);
    	}catch(PDOException $p){
      		echo("utilisateur introuvable");
    	}
	return $tab;
  }
  public function ajoutUser(){
  	$login = $_POST['login'];
  	$email = $_POST['email'];
	$motDePasse = $_POST['motDePasse'];
	$confPwd = $_POST['confPwd'];
	if($motDePasse!==$confPwd) {
		include_once "templates/registerForm.php";
		echo "Mots de passe différents.";
	}
	else{
	if(isset($_POST['admin']))$admin = $_POST['admin'];
	else $admin=0;

  	if($login !== "" && $email !== "" && $motDePasse !== ""){	
      $motDePasse = password_hash($motDePasse, PASSWORD_DEFAULT);	
 		try {
      		$sql = self::$bdd->prepare('INSERT INTO utilisateur (Login, Email, MotDePasse, Admin) VALUES (?, ?, ?, ?)'); 
      		$sql->execute([$login, $email, $motDePasse, $admin]);
        	echo "Insertion effectuée. <br>";
    	} catch(PDOException $e) {
      		print_r($bdd->errorInfo());
    	}
    }
    else
    {
      throw new ModeleUserException("Champ d'insertion nul.", 4);
    }
	}
  }
  public function rechercheUser(){
  	$login = $_POST['login'];
  	if($login !== ""){
  		try{
  			$sql = self::$bdd->prepare('SELECT * FROM utilisateur WHERE login = :login');
  			$sql->bindParam(':login', $login);
  			$sql->execute();
  			$tab = $sql->fetchAll();
  		}catch(PDOException $e){
  			print_r($bdd->errorInfo());
  		}
  		return $tab;
  	}
  }

  public function getNbPubli(){
	try{
		$idUtil = $_GET['id'];
		$sql = self::$bdd->prepare('SELECT count(*) FROM poster WHERE IdAuteur=:id');
		$sql->bindParam(':id', $idUtil);
  		$sql->execute();
		
		if(($tab = $sql->fetch(PDO::FETCH_ASSOC)) !== false) {
		  return $tab;
		}
		throw new ModeleUserException("Fetch impossible.",2);
		}catch(PDOException $p){
		  echo("utilisateur introuvable");
		}
  }

  public function getNbLikesPubli(){
	try{
		$idUtil = $_GET['id'];
		$sql = self::$bdd->prepare('SELECT count(*) FROM likepublication INNER JOIN poster ON likepublication.IdPubli = poster.IdPubli WHERE poster.IdAuteur = :id');
		$sql->bindParam(':id', $idUtil);
  		$sql->execute();
		if(($tab = $sql->fetch(PDO::FETCH_ASSOC)) !== false) {
		  return $tab;
		}
		throw new ModeleUserException("Fetch impossible.",2);
		}catch(PDOException $p){
		  echo("utilisateur introuvable");
		}
  }
  public function getLikedPublications($start,$end){
	try{
		$idUtil = $_SESSION['id']['IdUtil'];
		$sql = self::$bdd->prepare('SELECT publication.IdPubli,publication.Intitule FROM publication INNER JOIN likepublication ON publication.IdPubli=likepublication.IdPubli WHERE likepublication.IdAuteur = :id LIMIT :start,:end');
		$sql->bindParam(':id', $idUtil);
		$sql->bindParam(":start",$start,PDO::PARAM_INT);
		$sql->bindParam(":end",$end,PDO::PARAM_INT);
  		$sql->execute();
		if(($tab = $sql->fetchAll()) != false) {
		  return $tab;
		}
		}catch(PDOException $p){
		  echo("utilisateur introuvable");
		}
  }
  public function getNbLikesAuteur(){
	try{
		$idUtil = $_GET['id'];
		$sql = self::$bdd->prepare('SELECT count(*) FROM likepublication WHERE IdAuteur = :id');
		$sql->bindParam(':id', $idUtil);
  		$sql->execute();
		if(($tab = $sql->fetch(PDO::FETCH_ASSOC)) !== false) {
		  return $tab;
		}
		throw new ModeleUserException("Fetch impossible.",2);
		}catch(PDOException $p){
		  echo("utilisateur introuvable");
		}
  }
}
class ModeleUserException extends Exception{}
?>