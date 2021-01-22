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
    		$id = $_GET['IdPubli'];
    		$reponse = self::$bdd->prepare('SELECT * FROM commentaire WHERE IdPubli = :id');
    		$reponse->bindParam(":id",$id);
    		$reponse->execute();
    		$tab = $reponse->fetch(PDO::FETCH_ASSOC);
    	}catch(PDOException $p){
      		echo("commentaire introuvable");
    	}
    	return $tab;
    }

  public function ajoutCommentaire(){
	if(isset($_SESSION['id'])){
		$idAuteur = $_SESSION['id']['IdUtil'];
		$contenu = $_POST['contenu'];
		$idPubli = $_GET['idPubli'];
		var_dump($idPubli);
        $sql = self::$bdd->prepare('SELECT Login FROM utilisateur WHERE IdUtil=:id');
        $sql->bindParam(':id',$idAuteur, PDO::PARAM_STR);
        $sql->execute();
		$nomAuteur = $sql->fetch(PDO::FETCH_ASSOC);
		$sql = self::$bdd->prepare('INSERT INTO commentaire VALUES (?,?,?,?)');
		var_dump($idAuteur);
		var_dump($contenu);
		var_dump($nomAuteur);
        $sql->execute([$idAuteur, $idPubli, $contenu, $nomAuteur['Login']]);
	} else {
		throw new ModeleCommentaireException("Connexion de l'utilisateur erronée.", 4);
	}

  }
  public function rechercheCommentaireAuteur(){
  	$idAuteur = $_GET['id'];
  	if($idAuteur !== ""){
  		try{
  			$sql = self::$bdd->prepare('SELECT * FROM commentaire WHERE IdUtil = :auteur');
  			$sql->bindParam(':auteur', $idAuteur);
  			$sql->execute();
  			$tab = $sql->fetchAll();
  		}catch(PDOException $e){
  			print_r($bdd->errorInfo());
  		}
  		return $tab;
  	}
  }

}
class ModeleCommentaireException extends Exception{}
?>