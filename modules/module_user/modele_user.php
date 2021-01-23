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

    public function getUserLogin() {
    	try{
			if(isset($_SESSION['username'])){
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
  	$admin = $_POST['admin'];

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
}
class ModeleUserException extends Exception{}
?>