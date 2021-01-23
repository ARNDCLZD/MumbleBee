<?php
include 'Connexion.php';

class ModeleConnexion extends Connexion
{
  public function __construct (){}
 
  public function verifyConnexion(){
    if(!isset($_SESSION['username'])){
      $username = $_POST['username'];
      $pwd = $_POST['pwd'];
      $sql = self::$bdd->prepare('SELECT MotDePasse FROM utilisateur WHERE Login=:username');
      $sql->bindParam(':username',$username, PDO::PARAM_STR);
      $sql->execute();
      $verifyPWD = $sql->fetch(PDO::FETCH_ASSOC);
      if(password_verify($pwd,$verifyPWD['MotDePasse'])){
        $_SESSION['username'] = $username;
        $sql = self::$bdd->prepare('SELECT IdUtil FROM utilisateur WHERE Login=:username');
        $sql->bindParam(':username',$username, PDO::PARAM_STR);
        $sql->execute();
        $_SESSION['id'] = $sql->fetch(PDO::FETCH_ASSOC);
        echo 'connecté en tant que '. $username;
      } else {
        echo 'pas bon' . "<br>" . $pwd;
      }
    } else echo 'déjà connecté sous le compte ' . $_SESSION['username'];
  }

  public function deconnexion(){
    echo "Deconnexion de " . $_SESSION['username'];
    session_destroy();
  }
}
class ModeleConnexionException extends Exception{}
?>