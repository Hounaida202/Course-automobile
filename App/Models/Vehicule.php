<?php
namespace App\Models;
use App\Config\database;
use PDO;
class Vehicule{
   private $id;
   private $nom;
   private $type;
   private $puissance;

   public function __construct($id=null,$nom=null,$type=null,$puissance=null){
          $this->id=$id;
          $this->nom=$nom;
          $this->type=$type;
          $this->puissance=$puissance;
   }
  public function getId(){
    return $this->id;
   }
   public function getNom(){
    return $this->nom;
   }
    public function getType(){
    return $this->type;
   }
    public function getPuissance(){
    return $this->puissance;
   }

public function inserer($nom,$type,$puissance){
        $db = database::getInstance()->getConnection();
 $sql = "INSERT INTO vehicule (nom, type, puissance) 
        VALUES (:nom, :type, :puissance)";
$stmt = $db->prepare($sql);
$stmt->bindParam(':nom',$nom);
$stmt->bindParam(':type',$type);
$stmt->bindParam(':puissance',$puissance);
 $stmt->execute();
        return $db->lastInsertId();
}
  



}
?>