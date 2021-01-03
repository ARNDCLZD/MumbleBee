<?php
class Connexion {
  protected static $bdd;

  public function __construct () {
  }
  public static function initConnexion() {
    $db_host = "localhost";
    $user = "root";
    $db_name = "mumblebee_database";
    $dns = 'mysql:host=' . $db_host . ';dbname=' . $db_name . ';charset=utf8';
    $password = '';
    try{
      self::$bdd = new PDO($dns, $user, $password);
      echo("Connexion a la bd correct \n");
    }
      catch(PDOException $e){
        echo $e->getMessage();
      }

  }

}
?>
<?php
  Connexion::initConnexion();
?>
